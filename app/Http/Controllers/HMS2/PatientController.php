<?php

namespace App\Http\Controllers\HMS2;

use App\Http\Controllers\Controller;
use App\Models\HMS2\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function  index()
    {
        return view('backend.HMS2.patient.all-patient-list', [
            'patients' => Patient::latest()->get(),
        ]);

    }

    public function store(Request $request){
        $request->validate([
            'patient_name' => ['required'],
            'patient_mobile' => ['required'],
            'patient_gender' => ['required'],
            'patient_age' => ['required'],
        ]);


        $patient                            = new Patient();
        $patient->patient_id                = "HMS".DB::table('patients')->latest()->value('id')+1;
        $patient->patient_name              = $request->patient_name;
        $patient->patient_mobile            = $request->patient_mobile;
        $patient->patient_gender            = $request->patient_gender;
        $patient->patient_email             = $request->patient_email;
        $patient->patient_blood_group       = $request->patient_blood_group;
        $patient->patient_age               = $request->patient_age;
        $patient->unit                      = $request->unit;
        $patient->patient_address           = $request->patient_address;

        $patient->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Patient added successfully.'
        ], 200);
    }

    public function edit($id){
        return view('backend.HMS2.patient.edit-patient',[
            'patient' => Patient::find(decrypt($id)),
        ]);
    }

    public function update(Request $request,$id){
        $request->validate([

            'patient_name' => ['required'],
            'patient_mobile' => ['required'],
            'patient_gender' => ['required'],
            'patient_age' => ['required'],
        ]);

        $patient                            = Patient::find(decrypt($id));
        $patient->patient_name              = $request->patient_name;
        $patient->patient_mobile            = $request->patient_mobile;
        $patient->patient_gender            = $request->patient_gender;
        $patient->patient_email             = $request->patient_email;
        $patient->patient_blood_group       = $request->patient_blood_group;
        $patient->patient_age               = $request->patient_age;
        $patient->unit                      = $request->unit;
        $patient->patient_address           = $request->patient_address;

        $patient->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Patient Update successfully.'
        ], 200);
    }
    public function destroy($id){

        $patient = Patient::find($id);
        $patient->delete();
        return redirect()->back()->with('success', 'Doctor delete successfully.');
    }
    public function softDelete(){
        return view('backend.HMS2.patient.all-patient-trash',[
            'patients' => Patient::onlyTrashed()->latest()->get(),
        ]);
    }
    public function restore($id){
        $patient = Patient::withTrashed()->find(decrypt($id));
        $patient->restore();
        return redirect()->back()->with('success', 'Doctor Restore successfully.');

    }
    public function selectedDelete(Request $request) {

        $Ids = $request->ids;

        Patient::whereIn('id',  $Ids)->delete();

        return response()->json(['message' => 'Selected data deleted successfully']);
    }
    public function allRestore(Request $request) {
        $Ids = $request->ids;

        Patient::whereIn('id',  $Ids)->restore();

        return response()->json(['message' => 'Selected data Restore successfully']);
    }
    public function permanentDelete($id)
    {
        $patient = Patient::onlyTrashed()->find($id);
        $patient->forceDelete();
        return redirect()->back()->with('success', 'Permanently Doctor delete successfully.');

    }

    public function selectPermanentDelete(Request $request){

        $Ids = $request->ids;
        Patient::whereIn('id',  $Ids)->forceDelete();
        return redirect()->back()->with('success', 'Select Permanently Doctor delete successfully.');
    }



}
