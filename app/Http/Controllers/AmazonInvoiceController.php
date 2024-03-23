<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Imagick;
use PDOException;

class AmazonInvoiceController extends Controller
{
    public function index()
    {
        try {
            $host = 'localhost';
            $dbname = 'PackageTracking';
            $username = 'root';
            $password = 'MariadbTKCA1ZZ';

            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

            $stmtUsers = $pdo->prepare("SELECT ID, Name FROM User");
            $stmtUsers->execute();
            $users = $stmtUsers->fetchAll(PDO::FETCH_ASSOC);

       
            return view('amazon-invoice.amazon-invoice', ['users' => $users]);

        } catch(PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    }

    public function upload(Request $request)
    {
        try {


            $uploadDirectory = "/var/www/html/ParcelPirate/public/uploads/";
            $convertedText = '';

            if ($request->hasFile('pdfFile') && $request->file('pdfFile')->isValid()) {
                if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0755, true) && !is_dir($uploadDirectory)) {
                    throw new \RuntimeException('Failed to create upload directory.');
                }

                $originalFileName = $request->file('pdfFile')->getClientOriginalName();
                $fileType = strtolower($request->file('pdfFile')->getClientOriginalExtension());
                $uniqueName = uniqid("amazon_", true);
                $uniqueFileName = $uniqueName . '.' . $fileType;
                $targetFile = $uploadDirectory . $uniqueFileName;

                if ($fileType !== 'pdf') {
                    return "Sorry, only PDF files are allowed.";
                }

                if (move_uploaded_file($request->file('pdfFile')->getPathname(), $targetFile)) {
                    // Construct and execute the conversion command
                    $imageFilePath = $uploadDirectory . $uniqueName . '.jpg';
                    $convertCommand = "convert -density 300 -append '$targetFile' -trim +repage -units PixelsPerInch '$imageFilePath'";
                    shell_exec($convertCommand);

                    // Initialize variables for OCR
                    $imagePath = $imageFilePath;
                    $image = new Imagick($imagePath);
                    $width = $image->getImageWidth();
                    $height = $image->getImageHeight();
                    $breakPositions = [];
                    $orderPlaced = '';
                    $orderNumber = '';

                    // Detect horizontal black lines
                    for ($y = 0; $y < $height; $y++) {
                        $centerX = (int)($width / 2);
                        $pixel = $image->getImagePixelColor($centerX, $y);
                        $colors = $pixel->getColor();

                        if ($colors['r'] < 5 && $colors['g'] < 5 && $colors['b'] < 5) { // Center pixel is black
                            $blackPixelsCount = 1; // Start counting from the center pixel

                            // Expand to the left
                            for ($x = $centerX - 1; $x >= 0; $x--) {
                                $pixel = $image->getImagePixelColor($x, $y);
                                $colors = $pixel->getColor();
                                if ($colors['r'] < 5 && $colors['g'] < 5 && $colors['b'] < 5) {
                                    $blackPixelsCount++;
                                } else {
                                    break;
                                }
                            }

                            // Expand to the right
                            for ($x = $centerX + 1; $x < $width; $x++) {
                                $pixel = $image->getImagePixelColor($x, $y);
                                $colors = $pixel->getColor();
                                if ($colors['r'] < 5 && $colors['g'] < 5 && $colors['b'] < 5) {
                                    $blackPixelsCount++;
                                } else {
                                    break;
                                }
                            }

                            if ($blackPixelsCount >= 1000) { // Found a line
                                $breakPositions[] = $y;
                                $y += 50; // Skip the next 50 pixels to avoid detecting the same line
                            }
                        }
                    }

                    // Display the array of line break positions
                    echo "Line Break Positions:\n";
                    print_r($breakPositions);

                    // Proceed only if line breaks are found
                    if (!empty($breakPositions)) {
                        // Split and save each part of the image
                        $lastPosition = 0;
                        $orderPlaced = '';
                        $orderNumber = '';
                        foreach ($breakPositions as $index => $position) {
                            $segmentHeight = $position - $lastPosition;
                            $segment = clone $image;
                            $segment->cropImage($width, $segmentHeight, 0, $lastPosition);
                            
                            $segmentFilePath = $uploadDirectory.$uniqueName."-part-{$index}.jpg";

                            $segment->writeImage($segmentFilePath);
                            $lastPosition = $position + 1; // Move past the detected line
                            $segment->clear(); // Clear memory

                            $ocrOutput = shell_exec("tesseract $segmentFilePath stdout -l eng");


                            // Extract details on the first loop iteration
                            if ($index === 0) { // Check if it's the first iteration
                                // Extracting order placed date
                                if (preg_match("/Order Placed: (\w+ \d+, \d{4})/", $ocrOutput, $dateMatches)) {
                                    $orderPlaced = $dateMatches[1];
                                } else {
                                    $orderPlaced = "Not Found";
                                }
                                // Extracting order number
                                if (preg_match("/order number: (\d+-\d+-\d+)/", $ocrOutput, $numberMatches)) {
                                    $orderNumber = $numberMatches[1];
                                } else {
                                    $orderNumber = "Not Found";
                                }
                            } else {

                                $description = "Amazon Order Number: $orderNumber\n";

                                // Define a pattern to match "Shipped on [Month Name] [Day], [Year]"
                                $shippingDatePattern = '/Shipped on (\w+ \d{1,2}, \d{4})/';

                                // Search for the shipping date
                                if (preg_match($shippingDatePattern, $ocrOutput, $dateMatches)) {
                                    $description .= "Shipped on " . $dateMatches[1] . "\n";
                                }

                                $totalcost = 0;
                                $pattern = '/(\d+) of: (.*?) \$(\d+\.\d{2})/';
                                preg_match_all($pattern, $ocrOutput, $matches, PREG_SET_ORDER);
                                $items = [];
                                foreach ($matches as $match) {
                                    $description .= "\nITEM: ".trim($match[2]);
                                    $quantity = (int)$match[1];
                                    $costeach = $match[3];
                                    $description .= "\nQUANTITY: ".$quantity;
                                    $description .= "\nCOST: ";
                                    if( $quantity == 1){
                                        $description .= $costeach;
                                        $totalcost = $totalcost + $costeach;
                                    } else {
                                        $subtotal = $costeach * $quantity;
                                        $totalcost = $totalcost + $subtotal;
                                        $description .= "$costeach x $quantity = $subtotal";
                                    }
                                    $description .= "\n";
                                }

                               // Database insertion
                                DB::beginTransaction();
                                $packageId = DB::table('packages')->insertGetId([
                                    'UserID' => auth()->id(), // Assuming this is the correct field to get the user ID from the authenticated user
                                    'PackageInvoiceImage' => $segmentFilePath,
                                    'Description' => $description,
                                    'PackageValue' => $totalcost,
                                    // Add other fields as needed
                                ]);

                                DB::table('package_status')->insert([
                                    'package_id' => $packageId,
                                    'status_id' => 1, 
                                ]);
                                // Commit transaction
                                DB::commit();
                            }

                        }
                    }
                    return "Invoice uploaded successfully.";
                } else {
                    return "Sorry, there was an error uploading your file.";
                }
            } else {
                return "No file uploaded or file is invalid.";
            }


        } catch (\Exception $e) {
            // Rollback transaction if an error occurs
            DB::rollBack();
            return "Error: " . $e->getMessage();
        }
    }
}