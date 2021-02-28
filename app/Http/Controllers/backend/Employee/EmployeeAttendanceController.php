<?php

namespace App\Http\Controllers\Backend\employee;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeLeave;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class EmployeeAttendanceController extends Controller
{
    public function view()
    {
        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id', 'DESC')->get();
        // $data['allData'] = EmployeeAttendance::orderBy('id', 'desc')->get();

        return view('backend.employee.employee_attendance.view_employee_attendance', $data);
    }

    public function add()
    {
        $data['employees'] = User::where('user_type', 'employee')->get();


        return view('backend.employee.employee_attendance.add_employee_attendance', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
        ]);
       $deleteData = EmployeeAttendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();
        // dd($deleteData);
        $countEmployees = count($request->employee_id);

        for ($i=0; $i < $countEmployees; $i++) {
            $attend_status = 'attend_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        } // end for Loop
        $deleteData > 0 ? $msg = "Updated" : $msg = "Inserted";
        Toastr::success("Employee Attendance Data $msg Successfully", '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('employee.attendance.view');
    }

    public function edit($date)
    {

        $data['editData'] = EmployeeAttendance::where('date', $date)->get();
        $data['employees'] = User::where('user_type', 'employee')->get();


        return view('backend.employee.employee_attendance.edit_employee_attendance', $data);

    }

    public function details($date)
    {

        $data['details'] = EmployeeAttendance::where('date', $date)->get();
        $data['employees'] = User::where('user_type', 'employee')->get();


        return view('backend.employee.employee_attendance.details_employee_attendance', $data);

    }



}
