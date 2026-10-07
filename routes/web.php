<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Route
Route::prefix('admin')->group(function () {
    // Halaman Utama Admin (Dashboard)
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Manajemen Master Komponen (Dokter)
    Route::post('/doctors', [AdminController::class, 'storeDoctor'])->name('admin.doctors.store');

    // Manajemen Alur Menu Appointment
    Route::put('/appointments/{id}/status', [AdminController::class, 'updateAppointmentStatus'])->name('admin.appointments.updateStatus');
});