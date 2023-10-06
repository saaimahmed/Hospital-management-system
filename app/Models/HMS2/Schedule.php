<?php

namespace App\Models\HMS2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id','schedule_days','start_time','end_time','maximum_patient','new_patient_fee','old_patient_fee','report_fee','status'
    ];
}
