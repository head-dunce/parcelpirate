<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Imagick;

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
            $uploadDirectory = "/var/www/html/uploads/";

            if ($request->hasFile('pdfFile') && $request->file('pdfFile')->isValid()) {
                $originalFileName = $request->file('pdfFile')->getClientOriginalName();
                $fileType = strtolower($request->file('pdfFile')->getClientOriginalExtension());
                $uniqueName = uniqid("amazon_", true);
                $uniqueFileName = $uniqueName . '.' . $fileType;
                $targetFile = $uploadDirectory . $uniqueFileName;

                if (!is_dir($uploadDirectory) && !mkdir($uploadDirectory, 0755, true) && !is_dir($uploadDirectory)) {
                    throw new \RuntimeException('Failed to create upload directory.');
                }

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

                    // Proceed with OCR and data extraction
                    // This part should include your OCR logic, pattern matching, and data extraction

                    // Placeholder for extracted data
                    $orderPlaced = "Date";
                    $orderNumber = "Order Number";
                    $description = "Description"; // Placeholder for description
                    $totalcost = 0; // Placeholder for total cost

                    // Database insertion
                    DB::beginTransaction();
                    $packageId = DB::table('packages')->insertGetId([
                        'UserID' => auth()->user()->id, // Assuming this is the correct field to get the user ID from the authenticated user
                        'PackageInvoiceImage' => $targetFile,
                        'Description' => $description,
                        'PackageValue' => $totalcost,
                        // Add other fields as needed
                    ]);

                    DB::table('package_status')->insert([
                        'package_id' => $packageId,
                        'status_id' => 1, // Assuming the status_id for "Purchased" is 5
                    ]);

                    // Commit transaction
                    DB::commit();

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

