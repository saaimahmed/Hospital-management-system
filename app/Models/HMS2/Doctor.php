<?php

namespace App\Models\HMS2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Doctor extends Model
{
    use HasFactory;
    use softDeletes;
    protected $fillable = [

       'dr_id','dr_name','dr_department','dr_designation','dr_email','dr_phone','image',
        'dr_biography','dr_specialization','dr_experience','dr_qualification',
        'status','deleted_at',

    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'dr_department');
    }

    public function schedule(){
        $this->hasMany(Schedule::class);
    }


}
