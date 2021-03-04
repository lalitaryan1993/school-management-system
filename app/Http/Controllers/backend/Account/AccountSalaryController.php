<?php

namespace App\Http\Controllers\Backend\Account;

use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\AccountEmployeeSalary;

class AccountSalaryController extends Controller
{
    public function view()
    {
        $data['allData'] = AccountEmployeeSalary::all();
        return view('backend.account.employee_salary.view_employee_salary', $data);
    }


    public function add()
    {
        return view('backend.account.employee_salary.add_employee_salary');
    }

    public function getEmployee(Request $request)
    {

        $date = date('Y-m', strtotime($request->date));

        if($date != ''){
            $where[] = ['date', 'like', $date.'%'];
        }

        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
        // dd($data);
        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Select</th>';

        foreach ($data as $key => $attend) {

            $account_salary = AccountEmployeeSalary::where('employee_id', $attend->employee_id)->where('date',$date)->first();

            if($account_salary !=null) {
                $checked = 'checked';
            }else{
                $checked = '';
            }


            $totalAttend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $attend->employee_id)->get();
            $absentCount = count($totalAttend->where('attend_status' , 'Absent'));

            $color = 'success';
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['id_no'].'<input type="hidden" name="date" value="'.$date.'" > '.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'</td>';


            $salary = (float)$attend->user->salary;
            $salaryPerDay = (float)$salary/30;
            $totalSalaryMinus = (float)$absentCount*(float)$salaryPerDay;
            $totalSalary= (float)$salary - (float)$totalSalaryMinus;

            $html[$key]['tdsource'] .= '<td>'.(float)number_format($totalSalary, 2, '.', '').' <input type="hidden" name="amount[]" value="'.(float)number_format($totalSalary, 2, '.', '').'" > ₹'.'</td>';

            $html[$key]['tdsource'] .='<td>'.'<input type="hidden" name="employee_id[]" value="'.$attend->employee_id.'">'.'<input type="checkbox" name="checkManage[]" id="id'.$key.'" value="'.$key.'" '.$checked.' style="transform: scale(1.5);margin-left: 10px;"> <label for="id'.$key.'"> </label> '.'</td>';
        }

        return response()->json(@$html);
    }

    public function store(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));

        AccountEmployeeSalary::where('date',$date)->delete();

        $checkData = $request->checkManage;

        if($checkData != null){
            for ($i=0; $i < count($checkData); $i++) {
                $data = new AccountEmployeeSalary();
                $data->date  = $date;
                $data->employee_id  = $request->employee_id[$checkData[$i]];
                $data->amount  = $request->amount[$checkData[$i]];
                $data->save();
            } // End For Loop
        } // End IF

        if(!empty(@$data) || empty($checkData)){
            Toastr::success('Well Done Data Inserted Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('account.salary.view');
        } else {
            Toastr::error('Sorry Data Not Saved 😢😢😢😢', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('account.salary.view');
        }

    }

}
