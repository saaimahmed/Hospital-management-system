<?php

namespace App\Http\Controllers\HMS2;

use App\Http\Controllers\Controller;
use App\Models\HMS2\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(){
        return view('backend.HMS2.appointment.all-appointment-list');
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







}
