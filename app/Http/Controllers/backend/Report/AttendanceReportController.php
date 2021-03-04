<?php

namespace App\Http\Controllers\Backend\Report;

use PDF;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;


class AttendanceReportController extends Controller
{
    public function view()
    {
        $data['employees'] = User::where('user_type', 'employee')->get();
        return view('backend.report.attendance_report.view_attendance_report', $data);

    }

    public function get(Request $request)
    {
        $employee_id = $request->employee_id;

        if($employee_id != null) {
            $where[] = ['employee_id' ,$employee_id];
        }

        $date = date('Y-m', strtotime($request->date));

        if($date != null) {
            $where[] = ['date','like' ,$date.'%'];
        }

        $singleAttendance = EmployeeAttendance::with(['user'])->where($where)->get();

        if($singleAttendance = true) {
            $data['allData'] = EmployeeAttendance::with(['user'])->where($where)->orderBy('date', 'asc')->get();
            // dd($data['allData']->toArray());

            $data['absent'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status', 'Absent')->get()->count();

            $data['leave'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status', 'Leave')->get()->count();

            $data['month'] = date('m-Y', strtotime($request->date));

            $pdf = PDF::loadView('backend.report.attendance_report.pdf_attendance_report', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        } else {
            Toastr::error('Sorry these criteria does not match', '', ["positionClass" => "toast-top-right", "timeOut" => "5000"]);
            return redirect()->back();
        }



    }
}
