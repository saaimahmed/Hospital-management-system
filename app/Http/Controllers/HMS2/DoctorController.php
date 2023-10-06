<?php

namespace App\Http\Controllers\HMS2;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\HMS2\Department;
use App\Models\HMS2\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::latest()->get(['id', 'dr_name', 'dr_designation', 'dr_department', 'dr_phone', 'status', 'image']);

        if ($doctors->isEmpty()) {
            return view('backend.HMS2.doctor.all-doctor-list', [
                'departments' => Department::where('status', 1)->where('department_type', 'doctor')->get(['id', 'department_name']),
                'doctors' => $doctors,
            ]);
        } else {
            $doctors = $doctors->reverse();

            $lastId = $doctors->first()->id;
            $customId = $lastId;

            $formattedDoctors = $doctors->map(function ($doctor) use (&$customId) {
                $doctor->custom_id = 'DR-' . $customId--;
                return $doctor;
            });

            return view('backend.HMS2.doctor.all-doctor-list', [
                'departments' => Department::where('status', 1)->where('department_type', 'doctor')->get(['id', 'department_name']),
                'doctors' => $formattedDoctors,
            ]);
        }
    }

    public function store(Request $request){

        $request->validate([
            'dr_name' => ['required'],
            'dr_department' => ['required'],
            'dr_designation' => ['required'],
            'dr_phone' => ['required'],

        ]);

        $image = $request->file('image');
        $imageDirectory = 'assets/media/Doctor/';

        $imageUrl = Helper::getImageUrl($image, $imageDirectory);

          $doctor = new Doctor();
          $doctor->dr_name                = $request->dr_name;
          $doctor->dr_department          = $request->dr_department;
          $doctor->dr_designation         = $request->dr_designation;
          $doctor->dr_phone                = $request->dr_phone;
          $doctor->dr_email                = $request->dr_email;
          $doctor->dr_biography                = $request->dr_biography;
          $doctor->dr_specialization                = $request->dr_specialization;
          $doctor->dr_experience                = $request->dr_experience;
          $doctor->dr_qualification                = $request->dr_qualification;

          $doctor->image                  = $imageUrl;

          $doctor->save();
          return response()->json([
            'status' => 'success',
            'message' => 'Department added successfully.'
         ], 200);
    }

    public function edit($id)
    {
        return view('backend.HMS2.doctor.edit-doctor',[
            'departments' => Department::where('status', 1)->where('department_type', 'doctor')->get(['id', 'department_name']),
            'doctor' => Doctor::find(decrypt($id)),
        ]);
    }

    public function update(Request $request, $id){

        $request->validate([
            'dr_name' => ['required'],
            'dr_department' => ['required'],
            'dr_designation' => ['required'],
            'dr_phone' => ['required'],

        ]);


        $doctor = Doctor::find(decrypt($id));




        $doctor->dr_name                = $request->dr_name;
        $doctor->dr_department          = $request->dr_department;
        $doctor->dr_designation         = $request->dr_designation;
        $doctor->dr_phone               = $request->dr_phone;
        $doctor->dr_email               = $request->dr_email;
        $doctor->dr_biography           = $request->dr_biography;
        $doctor->dr_specialization      = $request->dr_specialization;
        $doctor->dr_experience          = $request->dr_experience;
        $doctor->dr_qualification       = $request->dr_qualification;


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageDirectory = 'assets/media/Doctor/';
            $imageUrl = Helper::getImageUrl($image, $imageDirectory);


            if ($doctor->image) {
                unlink(public_path($doctor->image));
            }

            $doctor->image = $imageUrl;
        }


        $doctor->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Department update successfully.'
        ], 200);
    }




    public function status($id){

        $doctor = Doctor::find(decrypt($id));
        $doctor->status = $doctor->status == 1 ? 0 : 1 ;
        $doctor->save();
        return redirect()->back()->with('success', 'Status changed successfully.');

    }

    public function destroy($id){

        $doctor = Doctor::find($id);
        $doctor->delete();
        return redirect()->back()->with('success', 'Doctor delete successfully.');
    }

    public function softDelete(){
        return view('backend.HMS2.doctor.all-doctor-trash',[
            'doctors' => Doctor::onlyTrashed()->latest()->get(['id', 'dr_name', 'dr_designation', 'dr_department', 'dr_phone', 'status', 'image']),
        ]);
    }

    public function restore($id){
        $doctor = Doctor::withTrashed()->find(decrypt($id));
        $doctor->restore();
        return redirect()->back()->with('success', 'Doctor Restore successfully.');

    }

    public function permanentDelete($id)
    {
        $doctor = Doctor::onlyTrashed()->find($id);
        $doctor->forceDelete();
        return redirect()->back()->with('success', 'Permanently Doctor delete successfully.');

    }
}
