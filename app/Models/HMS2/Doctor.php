<?php

namespace App\Models\HMS2;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [

        'dr_name','dr_department','dr_designation','dr_email','dr_phone','image',
        'dr_biography','dr_specialization','dr_experience','dr_qualification',
        'status','deleted_at',

    ];


}
