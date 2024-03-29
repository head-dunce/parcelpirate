<?php
namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\StatusName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;


class PackageController extends Controller
{
  

    public function index()
    {
        if (!Auth::check()) {
            // For not logged in users, show packages for user ID 1
            $userId = 1;
        } else {
            // For logged in users, show their own packages
            $userId = auth()->id();
        }
    
        // Fetch packages based on the determined $userId
        $statuses = StatusName::with(['packages' => function ($query) use ($userId) {
            $query->where('user_id', $userId); // Load packages that belong to the determined user ID
        }])->orderBy('sort_order', 'ASC')->get();
    
        // Find packages with duplicate tracking numbers for the authenticated user
        // Fetch all packages for the user
        $packages = Package::where('user_id', $userId)
            ->whereNotNull('TrackingNumber') // Ensure the package has a tracking number
            ->where('TrackingNumber', '!=', '') // Exclude packages with empty tracking numbers
            ->get();
    
        // Group packages by their tracking numbers
        $packagesGroupedByTracking = $packages->groupBy('TrackingNumber');
    
        // Filter out groups with only one package
        $duplicateTrackingNumbers = $packagesGroupedByTracking->filter(function ($group) {
            return $group->count() > 1;
        });
    
        // Create a nested array to store packages grouped by tracking numbers
        $packagesWithDuplicates = [];
    
        foreach ($duplicateTrackingNumbers as $trackingNumber => $packages) {
            $packagesWithDuplicates[$trackingNumber] = $packages;
        }
    
        return view('packages.index', compact('statuses', 'packagesWithDuplicates'));
    }
    
    
    

    public function updateStatus(Request $request, $packageId)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'newStatusID' => 'required|exists:status_names,id', // Ensure the status ID exists
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)
                         ->withInput();
        }
    
        // Retrieve the package, ensuring it belongs to the logged-in user
        $package = Package::where('id', $packageId)
                          ->where('user_id', auth()->id())
                          ->firstOrFail(); // Use firstOrFail to throw a 404 if no package is found for the user
    
        // Update the package's status
        $package->status_id = $request->input('newStatusID');
        $package->save();
    
        return back()->with('success', 'Package status updated successfully.');
    }
    
    public function edit($packageId)
    {
        //$package = Package::findOrFail($packageId);
        $package = Package::where('id', $packageId)->where('user_id', auth()->id())->firstOrFail();
        $statusNames = StatusName::all(); // Assuming you want to list all status names in the dropdown
    
        return view('packages.edit', compact('package', 'statusNames'));
    }

    public function update(Request $request, $packageId)
    {
        //$package = Package::findOrFail($packageId);
        $package = Package::where('id', $packageId)->where('user_id', auth()->id())->firstOrFail();

        $validated = $request->validate([
            'trackingNumber' => 'nullable|string|max:255', // Changed to nullable
            'carrier' => 'nullable|string|max:255',       // Changed to nullable
            'description' => 'required|string',
            'packageValue' => 'nullable|numeric',         // Changed to nullable
            'statusID' => 'nullable|exists:status_names,id', // Changed to nullable
            'packageImage' => 'nullable|image|max:10240',    // Already allows null
            'packageInvoiceImage' => 'nullable|image|max:10240', // Already allows null
        ]);
     
        $package->update([
            'TrackingNumber' => $validated['trackingNumber'],
            'Carrier' => $validated['carrier'],
            'Description' => $validated['description'],
            'PackageValue' => $validated['packageValue'],
            'status_id' => $validated['statusID'], // Make sure this matches your column name in the database
            // Don't forget to handle file uploads separately
        ]);

        if ($request->hasFile('packageImage')) {
            $path = $request->file('packageImage')->store('uploads', 'public');
            $package->PackageImage = $path;
        }
        
        if ($request->hasFile('packageInvoiceImage')) {
            $path = $request->file('packageInvoiceImage')->store('uploads', 'public');
            $package->PackageInvoiceImage = $path;
        }
        $package->save();
        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy($packageId)
    {
        $package = Package::where('id', $packageId)->where('user_id', auth()->id())->firstOrFail();
        
        // Delete package images from storage
        if ($package->PackageInvoiceImage) {
            Storage::delete('public/' . $package->PackageInvoiceImage);
        }
        
        if ($package->PackageImage) {
            Storage::delete('public/' . $package->PackageImage);
        }

        // Delete the package record from the database
        $package->delete();

        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');
    }

    public function create()
    {
        $statusNames = StatusName::all(); // Assuming you have status names to select from
        return view('packages.create', compact('statusNames'));
    }
   
    public function Xstore(Request $request)
    {
        // Define your validation rules
        $validated = $request->validate([
            'trackingNumber' => 'nullable|string|max:255',
            'carrier' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'packageValue' => 'nullable|numeric',
            'statusID' => 'nullable|exists:status_names,id', // Ensure statusID exists in your status_names table
            'packageInvoiceImage' => 'nullable|image|max:10240', // Adjust max size as needed
            'packageImage' => 'nullable|image|max:10240', // Adjust max size as needed
        ]);
    
        // Create a new package instance and fill it with validated data
        $package = new Package;
        $package->user_id = auth()->id();
        $package->TrackingNumber = $validated['trackingNumber'];
        $package->Carrier = $validated['carrier'];
        $package->Description = $validated['description'];
        $package->PackageValue = $validated['packageValue'];
        $package->status_id = $validated['statusID']; // Make sure the column name matches
    
        // Handle file uploads
        if ($request->hasFile('packageInvoiceImage')) {
            $path = $request->file('packageInvoiceImage')->store('uploads', 'public');
            $package->PackageInvoiceImage = $path; // Save the path in the database
        }
    
        if ($request->hasFile('packageImage')) {
            $path = $request->file('packageImage')->store('uploads', 'public');
            $package->PackageImage = $path; // Save the path in the database
        }
    
        $package->save(); // Save the package to the database
    
        // Redirect the user back to the packages index with a success message
        return redirect()->route('packages.index')->with('success', 'New package created successfully.');
    }


    public function store(Request $request)
    {
        // Define your validation rules
        $validated = $request->validate([
            'trackingNumber' => 'nullable|string|max:255',
            'carrier' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'packageValue' => 'nullable|numeric',
            'statusID' => 'nullable|exists:status_names,id', // Ensure statusID exists in your status_names table
            'packageInvoiceImage' => 'nullable|file|mimes:jpeg,png,pdf|max:10240', // Adjust max size and allowed mime types as needed
            'packageImage' => 'nullable|image|max:10240', // Adjust max size as needed
        ]);
    
        // Create a new package instance and fill it with validated data
        $package = new Package;
        $package->user_id = auth()->id();
        $package->TrackingNumber = $validated['trackingNumber'];
        $package->Carrier = $validated['carrier'];
        $package->Description = $validated['description'];
        $package->PackageValue = $validated['packageValue'];
        $package->status_id = $validated['statusID']; // Make sure the column name matches
    
        // Handle file uploads
        if ($request->hasFile('packageInvoiceImage')) {
            $file = $request->file('packageInvoiceImage');

            // Check if the uploaded file is a PDF
            if ($file->getClientOriginalExtension() === 'pdf') {
                // Generate a unique name for the converted image file
                $imageFileName = Str::random(20) . '.jpg';
                $imageFilePath = storage_path('app/public/uploads/' . $imageFileName);
                $imageFilePathSave = 'uploads/'. $imageFileName; // this is what needs to be stored to the db

                // Convert PDF to image
                // Store the PDF file
                $pdfFilePath = $file->storeAs('uploads', $file->getClientOriginalName(), 'public');

                // Get the full path of the stored PDF file
                $pdfFullPath = Storage::disk('public')->path($pdfFilePath);

                // Check if the PDF file exists
                if (!file_exists($pdfFullPath)) {
                    // Handle the case where the PDF file doesn't exist
                    echo "PDF file not found at path: $pdfFullPath";
                    exit; // or die("PDF file not found at path: $pdfFullPath");
                }
                $convertCommand = "convert -density 300 -append '$pdfFullPath' -trim +repage -units PixelsPerInch '$imageFilePath'";
                $process = Process::fromShellCommandline($convertCommand);
                
                try {
                    $process->mustRun();
                } catch (ProcessFailedException $exception) {
                    // Handle conversion failure
                    return back()->withError('PDF conversion failed: ' . $exception->getMessage());
                }
                unlink( $pdfFullPath );

                // Save the path to the converted image in the database
                $package->PackageInvoiceImage = $imageFilePathSave;
            } else {
                // For non-PDF files, handle the upload as usual
                $path = $file->store('uploads', 'public');
                $package->PackageInvoiceImage = $path;
            }
        }
    
        if ($request->hasFile('packageImage')) {
            $path = $request->file('packageImage')->store('uploads', 'public');
            $package->PackageImage = $path; // Save the path in the database
        }
    
        $package->save(); // Save the package to the database
    
        // Redirect the user back to the packages index with a success message
        return redirect()->route('packages.index')->with('success', 'New package created successfully.');
    }

    

    // PackageController.php
    public function deleteStatusNine(Request $request)
    {
        $userPackages = Package::where('user_id', auth()->id())->where('status_id', 9);
        
        $userPackages->each(function ($package) {
            // Delete package images from storage
            if ($package->PackageInvoiceImage) {
                Storage::delete('public/' . $package->PackageInvoiceImage);
            }
            
            if ($package->PackageImage) {
                Storage::delete('public/' . $package->PackageImage);
            }

            // Delete the package
            $package->delete();
        });

        return back()->with('success', 'All packages with status 9 have been deleted.');
    }


    

}
