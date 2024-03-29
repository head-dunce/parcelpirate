<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package; // Import the Package model
use Illuminate\Support\Facades\Storage; // Import the Storage facade
use Illuminate\Support\Str; // Import the Str class


class PackageCombineController extends Controller
{
    public function index(Request $request)
    {
        // Check if the form for combining packages is submitted
        if ($request->isMethod('post') && $request->has('combinePackages')) {
            $trackingNumber = $request->input('trackingNumber');

            try {
                // Fetch all packages with the given tracking number
                $packages = Package::where('TrackingNumber', $trackingNumber)->get();

                if ($packages->count() > 1) {
                    // Total the values
                    $combinedValue = $packages->sum('PackageValue');

                    // Combine descriptions
                    $descriptions = $packages->pluck('Description')->toArray();
                    array_unshift($descriptions, "COMBINED ORDERS:"); // Prepend the prefix
                    $combinedDescription = implode("\n\n\n", $descriptions); // Combine with new lines

                    // Choose one package to keep and update it
                    $packageToKeep = $packages->first();

                    // Assuming you have a function to combine images
                    $combinedImagePath = $this->combineInvoiceImages($packages);

                    // Update the chosen package
                    $packageToKeep->update([
                        'PackageValue' => $combinedValue,
                        'Description' => $combinedDescription,
                        'PackageInvoiceImage' => $combinedImagePath
                    ]);

                    // Delete the other packages
                    $idsToDelete = $packages->except([$packageToKeep->id])->pluck('id');
                    Package::whereIn('id', $idsToDelete)->delete();

                    //echo "Packages combined successfully.";
                    return redirect()->route('packages.index')->with('success', 'Packages combined successfully.');
                } else {
                    echo "Not enough packages to combine.";
                }
            } catch (\Exception $e) {
                die("Error combining packages: " . $e->getMessage());
            }
        }
    }



    private function combineInvoiceImages($packages)
    {
        $images = []; // Collect full image paths
        foreach ($packages as $package) {
            if (!empty($package->PackageInvoiceImage)) {
                // Construct the full path from the database path
                $fullPath = storage_path('app/public/' . $package->PackageInvoiceImage);
                if (file_exists($fullPath)) { // Ensure the file exists before adding
                    $images[] = $fullPath;
                }
            }
        }

        if (count($images) < 2) {
            // If there's only one image or none, return the existing image or an empty string
            return $images[0] ?? ''; 
        }
    
        // Load the first image to initialize dimensions
        $firstImage = imagecreatefromjpeg($images[0]);
        $firstWidth = imagesx($firstImage);
        $firstHeight = imagesy($firstImage);
    
        // Calculate the total height for all images
        $combinedHeight = $firstHeight;
        $combinedWidth = $firstWidth; // Assuming all images have the same width for simplicity
    
        // Add the heights of the rest of the images
        foreach (array_slice($images, 1) as $imagePath) {
            $img = imagecreatefromjpeg($imagePath);
            $combinedHeight += imagesy($img); // Add each image's height to the total
        }
    
        // Create a new image to hold the combined image
        $combinedImage = imagecreatetruecolor($combinedWidth, $combinedHeight);
        $currentHeight = 0;
    
        // Copy the first image into the combined image
        imagecopy($combinedImage, $firstImage, 0, $currentHeight, 0, 0, $firstWidth, $firstHeight);
        $currentHeight += $firstHeight;
        imagedestroy($firstImage); // Free the memory of the first image
    
        // Copy the rest of the images into the combined image
        foreach (array_slice($images, 1) as $imagePath) {
            $img = imagecreatefromjpeg($imagePath);
            $imgWidth = imagesx($img);
            $imgHeight = imagesy($img);
            imagecopy($combinedImage, $img, 0, $currentHeight, 0, 0, $imgWidth, $imgHeight);
            $currentHeight += $imgHeight;
            imagedestroy($img); // Free the memory of the current image
        }
    
        // Generate a unique filename for the combined image
        $filename = 'combined_' . Str::random(10) . '.jpg';

        // Start output buffering to capture the image data
        ob_start();
        imagejpeg($combinedImage);
        $imageData = ob_get_clean(); // Get the image data from the buffer
    
        // Use Laravel's Storage facade to save the image to the public disk
        $path = 'uploads/' . $filename; // Define the path within your public disk
        Storage::disk('public')->put($path, $imageData);

        // Delete the original images
        foreach ($images as $imagePath) {
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    
        imagedestroy($combinedImage); // Free the memory of the combined image
    
        // Return the relative path to be stored in the database
        // This path is relative to the "storage/app/public" directory and suitable for use with the asset() or Storage::url() helper
        return $path;

    }
}
