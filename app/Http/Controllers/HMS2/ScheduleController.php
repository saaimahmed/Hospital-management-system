<?php

namespace App\Http\Controllers\HMS2;

use App\Http\Controllers\Controller;
use App\Models\HMS2\Doctor;
use App\Models\HMS2\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(){
        return view('backend.HMS2.schedule.all-schedule-list',[
            'doctors' => Doctor::where('status', 1)->get(['id', 'dr_name']),
            'schedules' => Schedule::latest()->get(),
        ]);
    }

//    public function store(Request $request){
//
//     $validationData =   $request->validate([
//            'doctor_id' => ['required'],
//            'schedule_days' => ['required','array','min:1'],
//            'start_time' => ['required'],
//            'end_time' => ['required'],
//            'new_patient_fee' => ['required'],
//        ]);
//
////        $scheduleDays = implode(',', $validationData['schedule_days']);
////        if (is_array($validationData['schedule_days'])) {
////            $scheduleDays = json_encode($validationData['schedule_days']);
////        } else {
////            $scheduleDays = $validationData['schedule_days'];
////        }
//
//        foreach($validationData['schedule_days'] as $day) {
//            $schedule = new Schedule();
//            $schedule->doctor_id = $request->doctor_id;
//            $schedule->schedule_days = $request->$day;
//            $schedule->start_time = $request->start_time;
//            $schedule->end_time = $request->end_time;
//            $schedule->maximum_patient = $request->maximum_patient;
//            $schedule->new_patient_fee = $request->new_patient_fee;
//            $schedule->old_patient_fee = $request->old_patient_fee;
//            $schedule->report_fee = $request->report_fee;
//            $schedule->save();
//
//        }
//
//        return response()->json([
//            'status' => 'success',
//            'message' => 'Schedule added successfully.'
//        ], 200);
//    }
    public function store(Request $request)
    {
        $validationData = $request->validate([
            'doctor_id' => ['required'],
            'schedule_days' => ['required', 'array', 'min:1'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'new_patient_fee' => ['required'],
        ]);

        foreach ($validationData['schedule_days'] as $day) {
            $schedule = new Schedule();
            $schedule->doctor_id = $validationData['doctor_id'];
            $schedule->schedule_days = $day;
            $schedule->start_time = $validationData['start_time'];
            $schedule->end_time = $validationData['end_time'];
            $schedule->maximum_patient = $request->maximum_patient;
            $schedule->new_patient_fee = $validationData['new_patient_fee'];
            $schedule->old_patient_fee = $request->old_patient_fee;
            $schedule->report_fee = $request->report_fee;
            $schedule->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Schedule added successfully.'
        ], 200);
    }

}
