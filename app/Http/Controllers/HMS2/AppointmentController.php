<?php

namespace App\Http\Controllers\HMS2;

use App\Http\Controllers\Controller;
use App\Models\HMS2\Department;
use App\Models\HMS2\Doctor;
use App\Models\HMS2\Patient;
use App\Models\HMS2\Schedule;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(){
        return view('backend.HMS2.appointment.all-appointment-list',[
            'departments' => Department::where('status', 1)->where('department_type', 'doctor')->get(['id', 'department_name']),
            'doctors' => Doctor::latest()->get(['id','dr_id','dr_name', 'dr_designation', 'dr_department',]),
        ]);
    }

    public function getPatients(Request $request)
    {
        if ($request->ajax()) {
            $searchTerm = $request->input('search');
            $data = Patient::where('patient_name', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('patient_id', 'LIKE', '%' . $searchTerm . '%')
                ->get();

            $output = '';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1;">';
                foreach ($data as $row) {
                    $output .= '<li class="list-group-item">' . $row->patient_name . ' [' . $row->patient_id . ']</li>';
                }
                $output .= '</ul>';
            } else {
                $output .= '<li class="list-group-item">No Data Found</li>';
            }
            return $output;
        }
    }

    public function getDoctorName(Request $request) {

        $doctors = Doctor::where('dr_department', $request->department_id)->get();
        return response()->json($doctors);
    }
    public function getDepartmentName(Request $request)
    {
        $departments = Department::where('department_name', $request->doctor_id)->get();
        return response()->json($departments);
    }


//    public function getSchedules(Request $request)
//    {
//        $doctorId = $request->doctor_id;
//        $appointmentDate = $request->appointment_date;
//        $appointmentDayOfWeek = date('l', strtotime($appointmentDate));
//
//
//        $schedules = Schedule::where('doctor_id', $doctorId)
//            ->where('schedule_days', $appointmentDayOfWeek)
//            ->where('status', 1)
//            ->get();
//
//        if ($schedules->isEmpty()) {
//            return response()->json(['error' => 'No schedules available for this doctor on this day'], 404);
//        }
//
//        return response()->json($schedules);
//    }


    public function getSchedules(Request $request)
    {
        $doctorId = $request->doctor_id;
        $appointmentDate = $request->appointment_date;
        $appointmentDayOfWeek = date('l', strtotime($appointmentDate));

        $schedules = Schedule::where('doctor_id', $doctorId)
            ->where('schedule_days', $appointmentDayOfWeek)
            ->where('status', 1)
            ->get();

        $schedulesEmpty = $schedules->isEmpty();

        return response()->json(['schedules' => $schedules, 'schedulesEmpty' => $schedulesEmpty]);
    }


}
