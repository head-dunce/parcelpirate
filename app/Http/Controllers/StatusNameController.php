<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusName;

class StatusNameController extends Controller
{
    public function edit()
    {
        $statusNames = StatusName::orderBy('sort_order', 'asc')->get(); // Assuming you have a sort_order column
        return view('status_names.edit', compact('statusNames'));
    }

    public function update(Request $request)
    {
        // Reset the print_export flag for all statuses
        StatusName::query()->update(['print_export' => false]);

        // Update existing statuses
        $statusNames = $request->input('statusNames', []);
        foreach ($statusNames as $id => $data) {
            $status = StatusName::findOrFail($id);
            $status->update([
                'package_status_name' => $data['name'],
                'sort_order' => $data['sortOrder'],
                'print_export' => ($request->input('printExport') == $id),
            ]);
        }

        // Handle adding a new status
        $newStatusData = $request->input('newStatusName');
        if (!empty($newStatusData['name'])) {
            StatusName::create([
                'package_status_name' => $newStatusData['name'],
                'sort_order' => $newStatusData['sortOrder'],
                // New statuses are not marked for print_export by default
            ]);
        }

        return redirect()->route('packages.index')->with('success', 'Updated successfully.');
    }

    public function destroy($statusId)
    {
        $status = StatusName::findOrFail($statusId);
    
        // Optional: Check for related packages and handle them before deleting the status
        // e.g., reassign packages to a default status, or prevent deletion if packages exist
        
        $status->delete();
    
        return redirect()->route('packages.index')->with('success', 'Updated successfully.');
    }
    


}
