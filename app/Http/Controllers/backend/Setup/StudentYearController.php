<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class StudentYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewYear()
    {
        $data['allData'] = StudentYear::all();
        return view('backend.setup.year.view_year', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addYear()
    {
        return view('backend.setup.year.add_year');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeYear(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name',
            ]);

            $data = new StudentYear();
            $data->name  = $request->name;
            $data->save();

            Toastr::success('Student year saved successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('student.year.view');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editYear($id)
    {
        $editData = StudentYear::findOrFail($id);
        return view('backend.setup.year.edit_year', compact('editData'));
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
    public function updateYear(Request $request, $id)
    {
        $data  = StudentYear::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name,'.$data->id
            ]);

            $data->name  = $request->name;
            $data->save();

            Toastr::success('Student year updated successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('student.year.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteYear($id)
    {
        $data =  StudentYear::findOrFail($id)->delete();
        Toastr::warning('Student Year Deleted Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('student.year.view');
    }
}
