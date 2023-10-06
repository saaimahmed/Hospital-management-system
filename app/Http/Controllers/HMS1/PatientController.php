<?php

namespace App\Http\Controllers\HMS1;

use App\Http\Controllers\Controller;
use App\Models\HMS2\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function  index()
    {
        $patients = Patient::latest()->get();

        if ($patients->isEmpty()) {
            return view('backend.HMS2.patient.all-patient-list', [

                'patients' => $patients,
            ]);

        }
        else {
            $patients = $patients->reverse();

            $lastId = $patients->first()->id;

            $customId = $lastId;

            $formattedPatient = $patients->map(function ($patient) use (&$customId) {
                $patient->custom_id = 'HMSPI-' . $customId--;
                return $patient;
            });

            return view('backend.HMS2.patient.all-patient-list', [

                'patients' => $formattedPatient,
            ]);
        }


    }

    public function store(Request $request){
        $request->validate([
            'patient_name' => ['required'],
            'patient_mobile' => ['required'],
            'patient_gender' => ['required'],
        ]);

        $patient                            = new Patient();
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
}
