<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeSalaryLog;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;


use PDF;


class EmployeeSalaryController extends Controller
{
    public function view()
    {

        $data['allData'] = User::where('user_type', 'employee')->get();


        return view('backend.employee.employee_salary.view_employee_salary', $data);
    }

    public function salaryIncrement($id)
    {
        $data['editData'] = User::findOrFail($id);

        return view('backend.employee.employee_salary.increment_employee_salary', $data);

    }

    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'increment_salary' => 'required',
            'effected_salary' => 'required|date',
        ]);

        $user = User::findOrFail($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary + (float) $request->increment_salary;

        $user->salary = $present_salary;
        $user->save();

        $salaryData = new EmployeeSalaryLog();
        $salaryData->employee_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->increment_salary = $request->increment_salary;
        $salaryData->present_salary = $present_salary;
        $salaryData->effected_salary = date('Y-m-d', strtotime($request->effected_salary));
        $salaryData->save();



        Toastr::success('Employee Salary Increment Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('employee.registration.view');
    }

    public function details($id)
    {


        $data['details'] = User::findOrFail($id);
        $data['salary_log'] = EmployeeSalaryLog::where('employee_id', $data['details']->id)->get();

        // dd($data['salary_log']->toArray());

        return view('backend.employee.employee_salary.employee_salary_details', $data);



    }


}
