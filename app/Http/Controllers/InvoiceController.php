<?php

namespace App\Http\Controllers;

use App\Models\Package; // Ensure you use your actual model here
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function printInvoices()
    {
        //$packages = Package::where('user_id', auth()->id())
        //->whereHas('status', function ($query) {
        //    $query->where('print_export', true);
        //})->get();
        $packages = Package::with('user')
        ->where('user_id', auth()->id())
        ->whereHas('status', function ($query) {
            $query->where('print_export', true);
        })->get();

        // Render your view with the data
        $html = view('pdf.invoice', compact('packages'))->render();

        // Initialize mPDF and generate the PDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('invoices.pdf', 'D'); // Sends the PDF to the browser for download
    }

    public function exportReceipts()
    {
        $packages = Package::with('user')
        ->where('user_id', auth()->id())
        ->whereHas('status', function ($query) {
            $query->where('print_export', true);
        })->get();


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Headers and Style
        $headers = ['Customer Name', 'Value', 'Tracking Number', 'Carrier', 'Description'];
        $letters = ['A', 'B', 'C', 'D', 'E'];
        $boldStyle = ['font' => ['bold' => true]];

        foreach ($headers as $index => $header) {
            $cellCoordinate = $letters[$index] . '1';
            $sheet->setCellValue($cellCoordinate, $header);
            $sheet->getStyle($cellCoordinate)->applyFromArray($boldStyle);
        }

        // Filling data
        $rowCount = 2;
        foreach ($packages as $package) {
            $userName = optional($package->user)->name ?? 'User not found';
            $sheet->setCellValue('A' . $rowCount, $userName);
            $sheet->setCellValue('B' . $rowCount, '$' . number_format($package->PackageValue, 2));
            $sheet->setCellValue('C' . $rowCount, $package->TrackingNumber);
            $sheet->setCellValue('D' . $rowCount, $package->Carrier);
            $sheet->setCellValue('E' . $rowCount, $package->Description);
            $rowCount++;
        }

        // Auto-size columns
        foreach ($letters as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Download
        $writer = new Xlsx($spreadsheet);
        $fileName = 'packages.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
            'Cache-Control' => 'max-age=0',
        ])->deleteFileAfterSend(true);
    }
}

