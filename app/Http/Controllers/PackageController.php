<?php
namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\StatusName;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        //$statuses = StatusName::orderBy('sort_order', 'ASC')->get();
        $statuses = StatusName::with('packages')->orderBy('sort_order', 'ASC')->get();

        return view('packages.index', compact('packages', 'statuses'));
    }

    // Method for handling status update (as an example)
    public function updateStatus(Request $request, $packageId)
    {
        // Validation and update logic here
    }
}
