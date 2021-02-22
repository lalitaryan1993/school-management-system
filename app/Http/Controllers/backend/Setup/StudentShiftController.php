<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentShift;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class StudentShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewShift()
    {
        $data['allData'] = StudentShift::all();
        return view('backend.setup.shift.view_shift', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addShift()
    {
        return view('backend.setup.shift.add_shift');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeShift(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_shifts,name',
            ]);

            $data = new StudentShift();
            $data->name  = $request->name;
            $data->save();

            Toastr::success('Student Shift Saved Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('student.shift.view');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editShift($id)
    {
        $editData = StudentShift::findOrFail($id);
        return view('backend.setup.shift.edit_shift', compact('editData'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateShift(Request $request, $id)
    {
        $data  = StudentShift::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_shifts,name,'.$data->id
            ]);

            $data->name  = $request->name;
            $data->save();

            Toastr::success('Student Shift Updated Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('student.shift.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteShift($id)
    {
        $data =  StudentShift::findOrFail($id)->delete();
        Toastr::warning('Student Shift Deleted Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('student.shift.view');
    }
}
