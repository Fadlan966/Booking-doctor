<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
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
        // 1. Validasi data dan simpan hasilnya ke variabel $validatedData
        $validatedData = $request->validate([
            'name' => 'required|string',
            'specialization' => 'required|string',
            'consultation_fee' => 'required|numeric',
        ]);

        // 2. Gunakan $validatedData untuk create, bukan $request->all()
        // Ini otomatis akan mengabaikan _token dan hanya memasukkan data yang lolos validasi
        Doctor::create($validatedData);

        return back()->with('success', 'Master data dokter berhasil ditambahkan!');
    }

    // Fungsi untuk memperbarui status di menu appointment (misal: pending -> confirmed)
    public function updateAppointmentStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status appointment berhasil diperbarui!');
    }

    // Fungsi untuk Update data dokter (U)
    public function updateDoctor(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'specialization' => 'required|string',
            'consultation_fee' => 'required|numeric'
        ]);

        $doctor->update($validatedData);

        return back()->with('success', 'Master data dokter berhasil diperbarui!');
    }

    // Fungsi untuk Menghapus data dokter (D)
    public function destroyDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);

        // Hapus data dari database
        $doctor->delete();

        return back()->with('success', 'Master data dokter berhasil dihapus!');
    }
}
