<?php

namespace App\Models\HMS2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'patient_id','department_id','doctor_id','appointment_date','schedule_id',
        'patient_type','status'
    ];
}
