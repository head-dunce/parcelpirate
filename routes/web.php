<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackageCombineController;

use App\Http\Controllers\AmazonInvoiceController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\StatusNameController;

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ExportController;

Route::post('/combine-packages', [PackageCombineController::class, 'index'])->name('combine.index');


Route::get('/show-export-links', [ExportController::class, 'showExportLinks'])->name('show.export.links');
     //->middleware('auth');


Route::get('/print-invoices', [InvoiceController::class, 'printInvoices'])->name('print.invoices');
Route::get('/export-receipts', [InvoiceController::class, 'exportReceipts'])->name('export.receipts');

Route::post('/amazon-invoice', [AmazonInvoiceController::class, 'upload'])->name('amazon.invoice.upload');
Route::get('/amazon-invoice', [AmazonInvoiceController::class, 'index'])->name('amazon.invoice');

Route::post('/status/update/bulk', [StatusController::class, 'updateBulk'])->name('status.update.bulk');
Route::post('/packages/{package}/update-status', [PackageController::class, 'updateStatus'])->name('packages.updateStatus');

//Route::get('/packages', [PackageController::class, 'index']);
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');


Route::get('/packages/edit/{package}', [PackageController::class, 'edit'])->name('packages.edit');
Route::put('/packages/update/{package}', [PackageController::class, 'update'])->name('packages.update');
Route::delete('/packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');
Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
Route::post('/packages', [PackageController::class, 'store'])->name('packages.store');
Route::post('/packages/delete-status-nine', [PackageController::class, 'deleteStatusNine'])->name('packages.deleteStatusNine');


Route::get('/status-names/edit', [StatusNameController::class, 'edit'])->name('statusNames.edit');
Route::put('/status-names/update', [StatusNameController::class, 'update'])->name('statusNames.update');
Route::delete('/status-names/{status}', [StatusNameController::class, 'destroy'])->name('statusNames.destroy');



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
