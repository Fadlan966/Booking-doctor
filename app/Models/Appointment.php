<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'appointment_date',
        'status',
        'patient_notes',
    ];

    // Relasi ke User (Pasien)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Doctor (Master Komponen)
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}