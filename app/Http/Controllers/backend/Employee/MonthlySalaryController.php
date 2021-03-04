<?php

namespace App\Http\Controllers\Backend\Employee;

use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;

use PDF;


class MonthlySalaryController extends Controller
{
    public function view()
    {
        // $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id', 'DESC')->get();
        // $data['allData'] = EmployeeAttendance::orderBy('id', 'desc')->get();

        return view('backend.employee.monthly_salary.view_monthly_salary');
    }

    public function monthlySalaryGet(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));

        if($date != ''){
            $where[] = ['date', 'like', $date.'%'];
        }

        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        // dd($data);
        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($data as $key => $attend) {
            $totalAttend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $attend->employee_id)->get();
            $absentCount = count($totalAttend->where('attend_status' , 'Absent'));

            $color = 'success';
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'</td>';


            $salary = (float)$attend->user->salary;
            $salaryPerDay = (float)$salary/30;
            $totalSalaryMinus = (float)$absentCount*(float)$salaryPerDay;
            $totalSalary= (float)$salary - (float)$totalSalaryMinus;

            $html[$key]['tdsource'] .= '<td>'.(float)number_format($totalSalary, 2, '.', '').'₹'.'</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title = "PaySlip" target="_blank" href="'.route('employee.monthly.salary.paySlip', $attend->employee_id).'">Pay Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }

        return response()->json(@$html);



    }

    public function monthlySalaryPaySlip(Request $request, $employee_id)
    {
        $id = EmployeeAttendance::where('employee_id', $employee_id)->first();


        $date = date('Y-m', strtotime($id->date));

        if($date != ''){
            $where[] = ['date', 'like', $date.'%'];
        }

        $data['details'] = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $id->employee_id)->get();


        $pdf = PDF::loadView('backend.employee.monthly_salary.pdf_monthly_salary', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
