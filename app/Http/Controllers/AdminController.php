<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan halaman dashboard beserta datanya
    public function index()
    {
        // Mengambil semua data master komponen dokter
        $doctors = Doctor::all();

        // Mengambil data appointment beserta data pasien dan dokter terkait
        $appointments = Appointment::with(['user', 'doctor'])->orderBy('appointment_date', 'desc')->get();

        return view('admin.dashboard', compact('doctors', 'appointments'));
    }

    // Fungsi untuk menambah master data dokter baru
    public function storeDoctor(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'specialization' => 'required|string',
            'consultation_fee' => 'required|numeric'
        ]);

        Doctor::create($request->all());
        return back()->with('success', 'Master data dokter berhasil ditambahkan!');
    }

    // Fungsi untuk memperbarui status di menu appointment (misal: pending -> confirmed)
    public function updateAppointmentStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status appointment berhasil diperbarui!');
    }
}
