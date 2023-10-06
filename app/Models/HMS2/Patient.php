<?php

namespace App\Models\HMS2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_name','patient_mobile','patient_email','patient_gender','patient_blood_group',
        'patient_age','unit','patient_address',
    ];
}
