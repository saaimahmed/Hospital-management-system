<?php

namespace App\Http\Controllers\HMS2;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\HMS2\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public  function index(){
        return view('backend.HMS2.Department.all-department-list',[
            'departments' => Department::latest()->get(['id','department_name','department_type','status','image'])
        ]);
    }


    public function store(Request $request){
        $request->validate([
            'department_name' => ['required', 'unique:departments'],
            'department_type' => ['required'],

        ]);

        Department::DepartmentStoreAndUpdate($request);
//        $department = new Department();
//        $department->department_name        = $request->department_name;
//        $department->department_type        = $request->department_type;
//        $department->department_description = $request->department_description;
//        $department->image                  = Helper::getImageUrl($request->file('image'), 'assets/media/Department/');
//
//
//        $department->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Department added successfully.'
        ], 200);
    }
    public function edit($id){

        return view('backend.HMS2.Department.edit-department',[
            'department' => Department::find(decrypt($id)),
            ]);

    }
    public function update(Request $request, $id){
        $request->validate([
            'department_name' => ['required'],
            'department_type' => ['required'],

        ]);
        Department::DepartmentStoreAndUpdate($request, $id);
//        return redirect()->route('departments.index')->with('success','Department Update successfully');
        return response()->json([
            'status' => 'success',
            'message' => 'Department Update successfully.'
        ], 200);
    }



    public function status($id){

        $department = Department::find(decrypt($id));
        $department->status = $department->status == 1 ? 0 : 1 ;
        $department->save();
        return redirect()->back()->with('success', 'Status changed successfully.');


//        return response()->json(['success' => true, 'message' => 'Status changed successfully.']);


    }


    public function destroy($id){

        $department = Department::find($id);
        $department->delete();
        return redirect()->back()->with('success', 'Department delete successfully.');
    }
}
