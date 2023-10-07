<?php

namespace App\Http\Controllers\HMS2;

use App\Http\Controllers\Controller;
use App\Models\HMS2\Doctor;
use App\Models\HMS2\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ScheduleController extends Controller
{
    public function index(){
        return view('backend.HMS2.schedule.all-schedule-list',[
            'doctors' => Doctor::where('status', 1)->get(['id', 'dr_name']),
            'schedules' => Schedule::latest()->get(),
        ]);
    }


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

    public function edit($id)
    {
        return view('backend.HMS2.schedule.edit-schedule',[
            'doctors' => Doctor::where('status', 1)->get(['id', 'dr_name']),
            'schedule' => Schedule::find(decrypt($id)),
        ]);
    }

    public function update(Request $request ,$id){


        $validationData = $request->validate([
            'doctor_id' => ['required'],
            'schedule_days' => ['required', 'array', 'min:1'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'new_patient_fee' => ['required'],
        ]);

        foreach ($validationData['schedule_days'] as $day) {

            $schedule = Schedule::find(decrypt($id));
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
            'message' => 'Schedule Update successfully.'
        ], 200);

    }
    public function status($id){

        $schedule = Schedule::find(decrypt($id));
        $schedule->status = $schedule->status == 1 ? 0 : 1 ;
        $schedule->save();
        return redirect()->back()->with('success', 'Status changed successfully.');

    }
    public function destroy($id){

        $schedule = Schedule::find($id);
        $schedule->delete();
        return redirect()->back()->with('success', 'Doctor delete successfully.');
    }

    public function softDelete(){
        return view('backend.HMS2.schedule.all-schedule-trash',[
            'schedules' => Schedule::onlyTrashed()->latest()->get(),
        ]);
    }
    public function restore($id){
        $schedule = Schedule::withTrashed()->find(decrypt($id));
        $schedule->restore();
        return redirect()->back()->with('success', 'Doctor Restore successfully.');

    }

    public function selectedDelete(Request $request) {

        $Ids = $request->ids;

        Schedule::whereIn('id',  $Ids)->delete();

        return response()->json(['message' => 'Selected data deleted successfully']);
    }
    public function allRestore(Request $request) {
        $Ids = $request->ids;

        Schedule::whereIn('id',  $Ids)->restore();

        return response()->json(['message' => 'Selected data Restore successfully']);
    }

    public function permanentDelete($id)
    {
        $schedule = Schedule::onlyTrashed()->find($id);
        $schedule->forceDelete();
        return redirect()->back()->with('success', 'Permanently Doctor delete successfully.');

    }

    public function selectPermanentDelete(Request $request){

        $Ids = $request->ids;
        Schedule::whereIn('id',  $Ids)->forceDelete();
        return redirect()->back()->with('success', 'Select Permanently Doctor delete successfully.');
    }
}
