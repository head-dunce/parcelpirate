<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{
    public function updateBulk(Request $request)
    {
        $currentStatusId = $request->input('currentStatusID');
        $newStatusId = $request->input('bulkNewStatusID');
    
        // Only update packages that belong to the logged-in user and have the specified current status ID
        Package::where('user_id', auth()->id())
               ->where('status_id', $currentStatusId)
               ->update(['status_id' => $newStatusId]);
    
        return back()->with('success', 'The statuses have been updated successfully.');
    }
    
}
