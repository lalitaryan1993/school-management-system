<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Models\User;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\EmployeeSalaryLog;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

use PDF;


class EmployeeRegController extends Controller
{
    public function view()
    {
        $data['allData'] = User::where('user_type','Employee')->get();
        return view('backend.employee.employee_reg.view_employee', $data);
    }

    public function add()
    {
        $data['designation'] = Designation::all();
        return view('backend.employee.employee_reg.add_employee', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'designation_id' => 'required',
            'salary' => 'required',
            'join_date' => 'required',


            ]);

                DB::transaction(function () use ($request){
                    $checkYear = date('Ym', strtotime($request->join_date));
                    // dd($checkYear);
                    $employee = User::where('user_type', 'employee')->orderBy('id','DESC')->first();

                    if($employee == null){
                        $firstReg = 0;
                        $employeeId = $firstReg + 1;

                        if($employeeId < 10 ){
                            $id_no = '000'.$employeeId;
                        } elseif($employeeId < 100){
                            $id_no = '00'.$employeeId;

                        }elseif($employeeId < 1000){
                            $id_no = '0'.$employeeId;

                        }
                    } else {
                        $employee = User::where('user_type', 'employee')->orderBy('id','DESC')->first()->id;
                        $employeeId = $employee + 1;

                        if($employeeId < 10 ){
                            $id_no = '000'.$employeeId;
                        } elseif($employeeId < 100){
                            $id_no = '00'.$employeeId;

                        }elseif($employeeId < 1000){
                            $id_no = '0'.$employeeId;

                        }else {
                            $id_no = $employeeId;
                        }


                    } // end else

                    $final_id_no = $checkYear.$id_no;
                    $user = new User();
                    $code = rand(0000, 9999);
                    $user->id_no = $final_id_no;
                    $user->password = bcrypt($code);
                    $user->user_type = 'employee';
                    $user->code = $code;
                    $user->name = $request->name;
                    $user->fname = $request->fname;
                    $user->mname = $request->mname;
                    $user->mobile = $request->mobile;
                    $user->address = $request->address;
                    $user->gender = $request->gender;
                    $user->religion = $request->religion;
                    $user->salary = $request->salary;
                    $user->designation_id = $request->designation_id;
                    $user->dob = date('Y-m-d', strtotime($request->dob));
                    $user->join_date = date('Y-m-d', strtotime($request->join_date));

                    if($request->hasFile('image')){

                        $file = $request->file('image');
                        $filename = date('YmdHi').$file->getClientOriginalName();
                        $file->move(public_path('upload/employee_images/'),$filename);
                        $user->image = $filename;

                    }

                    $user->save();


                    $employee_salary = new EmployeeSalaryLog();
                    $employee_salary->employee_id = $user->id;
                    $employee_salary->effected_salary = date('Y-m-d', strtotime($request->join_date));
                    $employee_salary->previous_salary = $request->salary;
                    $employee_salary->present_salary = $request->salary;
                    $employee_salary->increment_salary = 0;
                    $employee_salary->save();




                });




            Toastr::success('Employee Registration Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('employee.registration.view');
    }

    public function edit($id)
    {

        $data['designation'] = Designation::all();


        $data['editData'] = User::find($id);

        // dd($data['editData']->toArray());


        return view('backend.employee.employee_reg.edit_employee', $data);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'designation_id' => 'required',

            ]);



            $user = User::where('id', $id)->first();

            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->designation_id = $request->designation_id;

            $user->dob = date('Y-m-d', strtotime($request->dob));

            if($request->hasFile('image')){

                $file = $request->file('image');
                @unlink(public_path('upload/employee_images/'.$user->image));

                $filename = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/employee_images/'),$filename);
                $user->image = $filename;

            }

            $user->save();

            Toastr::success('Employee Registration Updated Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('employee.registration.view');
    }


    public function details($id)
    {


        $data['details'] = User::findOrFail($id);

        $pdf = PDF::loadView('backend.employee.employee_reg.pdf_employee_details', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');



    }
}
