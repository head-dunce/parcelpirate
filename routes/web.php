<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PackageController;

use App\Http\Controllers\AmazonInvoiceController;

Route::post('/amazon-invoice', [AmazonInvoiceController::class, 'upload'])->name('amazon.invoice.upload');
Route::get('/amazon-invoice', [AmazonInvoiceController::class, 'index'])->name('amazon.invoice');


Route::get('/packages', [PackageController::class, 'index']);
// Add more routes as needed for updating statuses, etc.


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
