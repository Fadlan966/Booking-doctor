<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    // Tentukan kolom yang boleh diisi secara massal (mass assignable)
    protected $fillable = [
        'name',
        'specialization',
        'consultation_fee',
        'is_active',
    ];
}