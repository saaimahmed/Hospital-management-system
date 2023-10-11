<?php

namespace App\Http\Controllers\HMS2;

use App\Http\Controllers\Controller;
use App\Models\HMS2\Appointment;
use App\Models\HMS2\Department;
use App\Models\HMS2\Doctor;
use App\Models\HMS2\Patient;
use App\Models\HMS2\Schedule;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(){
        return view('backend.HMS2.appointment.all-appointment-list',[
            'doctors' => Doctor::orderBy('id', 'DESC')->get(),
            'departments' => Department::where('status', 1)->where('department_type', 'doctor')->get(['id', 'department_name']),


            'appointments' => Appointment::orderBy('id', 'DESC')->get()

        ]);
    }

    public function store(Request $request){
        $request->validate([
            'patient_id' => ['required'],
            'department_id' => ['required'],
            'doctor_id' => ['required'],
            'appointment_date' => ['required'],
            'schedule_id' => ['required'],
            'patient_type' => ['required'],
            'status' => ['required'],
        ]);


        $appointment                            = new Appointment();
        $appointment->patient_id                = $request->patient_id;
        $appointment->department_id              = $request->department_id;
        $appointment->doctor_id            = $request->doctor_id;
        $appointment->appointment_date            = $request->appointment_date;
        $appointment->schedule_id             = $request->schedule_id;
        $appointment->patient_type       = $request->patient_type;
        $appointment->status               = $request->status;

        $appointment->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Appointment added successfully.'
        ], 200);
    }



    public function edit($id){
        return view('backend.HMS2.appointment.edit-appointment',[
            'departments' => Department::where('status', 1)->where('department_type', 'doctor')->get(['id', 'department_name']),
            'appointment' => Appointment::find(decrypt($id)),
        ]);
    }
    public function update(Request $request, $id){

        $request->validate([
            'appointment_date' => ['required'],
            'schedule_id' => ['required'],
            'patient_type' => ['required'],
            'status' => ['required'],
        ]);
        $appointment = Appointment::find(decrypt($id));
        $appointment->appointment_date            = $request->appointment_date;
        $appointment->schedule_id             = $request->schedule_id;
        $appointment->patient_type       = $request->patient_type;
        $appointment->status               = $request->status;

        $appointment->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Appointment Update successfully.'
        ], 200);

    }


    public function status(Request $request, $id){
        $request->validate([
            'status' => ['required'],
        ]);

        $appointment = Appointment::find(decrypt($id));
        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Appointment Status Update successfully.');

    }

    public function destroy($id){

        $appointment = Appointment::find($id);
        $appointment->delete();
        return redirect()->back()->with('success', 'Appointment delete successfully.');
    }



    public function getPatients(Request $request)
    {
        if ($request->ajax()) {
            $searchTerm = $request->input('search');
//            $data = Patient::where('patient_name', 'LIKE', '%' . $searchTerm . '%')
//                ->orWhere('patient_id', 'LIKE', '%' . $searchTerm . '%')
//                ->get();

            $data = Patient::whereRaw("SUBSTRING(patient_name, 1, 3) = ? OR patient_id LIKE ?", [substr($searchTerm, 0, 3), '%' . $searchTerm . '%'])
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
