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

    public function patient()
    {
        return $this->belongsTo(Patient::class,'');
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class,'schedule_id');
    }
}
