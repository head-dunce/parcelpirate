<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\StatusName;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ExportController extends Controller
{
    public function showExportLinks()
    {
        $packages = Package::with('user')
            ->where('user_id', Auth::id())
            ->whereHas('status', function ($query) {
                $query->where('print_export', true);
            })->get();

        $hasDataForExport = $packages->isNotEmpty();

       // Find the status with the print_export flag
       $printExportStatus = StatusName::where('print_export', true)->first();

       // If there is a status marked for print_export, count the packages
       $statusName = $printExportStatus ? $printExportStatus->package_status_name : null;
       $packageCount = $printExportStatus ? $packages->count() : 0;

       return view('exports.show_links', compact('hasDataForExport', 'statusName', 'packageCount'));
    }
}

