<?php

namespace App\Models\HMS2;

use App\Helper\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
       'department_name',
        'department_type',
        'department_description',
        'image'
    ];


    public static function DepartmentStoreAndUpdate($request,  $id=null){

        if ($id !== null) {
            $id = decrypt($id);
        }

       Department::updateOrCreate(['id' => $id],[
           'department_name' => $request->department_name,
           'department_type' => $request->department_type,
           'department_description' => $request->department_description,
           'image' =>  Helper::getImageUrl($request->file('image'),'assets/media/Department/',
               ($id) ? Department::find($id)->image : '' )
       ]);

    }

}
