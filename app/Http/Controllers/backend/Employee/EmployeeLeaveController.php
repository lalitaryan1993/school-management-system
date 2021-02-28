<?php

namespace App\Http\Controllers\Backend\employee;

use App\Models\User;
use App\Models\LeavePurpose;
use Illuminate\Http\Request;
use App\Models\EmployeeLeave;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class EmployeeLeaveController extends Controller
{
    public function view()
    {
        $data['allData'] = EmployeeLeave::orderBy('id', 'desc')->get();

        return view('backend.employee.employee_leave.view_employee_leave', $data);
    }

    public function add()
    {
        $data['employees'] = User::where('user_type', 'employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();


        return view('backend.employee.employee_leave.add_employee_leave', $data);
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'employee_id' => 'required',
            'start_date' => 'required|date',
            'leave_purpose_id' => 'required',
            'end_date' => 'required|date',
        ]);

        if($request->leave_purpose_id == 0){

            $check_leave_purpose = LeavePurpose::where('name', '=', $request->name)->first();
            if ($check_leave_purpose === null) {
                $leave_purpose = new LeavePurpose();
                $leave_purpose->name = $request->name;
                $leave_purpose->save();

                $leave_purpose_id = $leave_purpose->id;
            } else {
                $leave_purpose_id = $check_leave_purpose->id;
            }


        } else {
            $leave_purpose_id = $request->leave_purpose_id;

        }

        $data = new EmployeeLeave();
        $data->employee_id  = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d', strtotime($request->start_date));
        $data->end_date = date('Y-m-d', strtotime($request->end_date));

        $data->save();

        Toastr::success('Employee leave Data Inserted Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('employee.leave.view');
    }

    public function edit($id)
    {
        $data['editData'] = EmployeeLeave::findOrFail($id);
        $data['employees'] = User::where('user_type', 'employee')->get();
        $data['leave_purpose'] = LeavePurpose::all();


        return view('backend.employee.employee_leave.edit_employee_leave', $data);

    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'employee_id' => 'required',
            'start_date' => 'required|date',
            'leave_purpose_id' => 'required',
            'end_date' => 'required|date',
        ]);

        if($request->leave_purpose_id == 0){

            $check_leave_purpose = LeavePurpose::where('name', '=', $request->name)->first();
            if ($check_leave_purpose === null) {
                $leave_purpose = new LeavePurpose();
                $leave_purpose->name = $request->name;
                $leave_purpose->save();

                $leave_purpose_id = $leave_purpose->id;
            } else {
                $leave_purpose_id = $check_leave_purpose->id;
            }


        } else {
            $leave_purpose_id = $request->leave_purpose_id;

        }

        $data =  EmployeeLeave::findOrFail($id);
        $data->employee_id  = $request->employee_id;
        $data->leave_purpose_id = $leave_purpose_id;
        $data->start_date = date('Y-m-d', strtotime($request->start_date));
        $data->end_date = date('Y-m-d', strtotime($request->end_date));

        $data->save();

        Toastr::success('Employee leave Data Updated Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('employee.leave.view');
    }


    public function delete($id)
    {


        $leave = EmployeeLeave::findOrFail($id)->delete();

        // dd($data['salary_log']->toArray());

        Toastr::error('Employee leave Data Deleted Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('employee.leave.view');



    }

}
