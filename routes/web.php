<?php

use App\Http\Controllers\BarangayController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PDFCertificateController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/barangays/{slug}', [BarangayController::class, 'show'])->name('barangays.show');

Route::get('/admin/export-waste-report', [App\Http\Controllers\ExportController::class, 'exportWasteReport'])
    ->name('admin.export-waste-report');

Route::get('/admin/download-certificate/{clearance}', [PDFCertificateController::class, 'downloadCertificate'])
    ->name('admin.download-certificate');
