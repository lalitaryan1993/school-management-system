<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class StudentClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewStudent()
    {
        $data['allData'] = StudentClass::all();
        return view('backend.setup.student_class.view_class', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentClassAdd()
    {
        return view('backend.setup.student_class.add_class');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function studentClassStore(Request $request)
    {
        $validatedData = $request->validate([
                'name' => 'required|unique:student_classes,name',
                ]);

                $data = new StudentClass();
                $data->name  = $request->name;
                $data->save();

                Toastr::success('Student class saved successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
                return redirect()->route('student.class.view');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function studentClassEdit($id)
    {
        $editData = StudentClass::findOrFail($id);
        return view('backend.setup.student_class.edit_class', compact('editData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function studentClassUpdate(Request $request, $id)
    {
        $data  = StudentClass::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_classes,name,'.$data->id
            ]);

            $data->name  = $request->name;
            $data->save();

            Toastr::success('Student class updated successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('student.class.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function studentClassDelete($id)
    {
        $data =  StudentClass::findOrFail($id)->delete();
        Toastr::warning('Student Class Deleted Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('student.class.view');
    }
}
