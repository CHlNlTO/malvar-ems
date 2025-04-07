<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/admin/export-waste-report', [App\Http\Controllers\ExportController::class, 'exportWasteReport'])
    ->name('admin.export-waste-report');
