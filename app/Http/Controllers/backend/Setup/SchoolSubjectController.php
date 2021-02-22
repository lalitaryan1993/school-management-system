<?php

namespace App\Http\Controllers\backend\setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Brian2694\Toastr\Facades\Toastr;

class SchoolSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $data['allData'] = SchoolSubject::all();
        return view('backend.setup.school_subject.view_school_subject', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('backend.setup.school_subject.add_school_subject');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:school_subjects,name',
            ]);

            $data = new SchoolSubject();
            $data->name  = $request->name;
            $data->save();

            Toastr::success('School Subject Saved Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('school.subject.view');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = SchoolSubject::findOrFail($id);
        return view('backend.setup.school_subject.edit_school_subject', compact('editData'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data  = SchoolSubject::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:school_subjects,name,'.$data->id
            ]);

            $data->name  = $request->name;
            $data->save();

            Toastr::success('School Subject Updated Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('school.subject.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data =  SchoolSubject::findOrFail($id)->delete();
        Toastr::warning('School Subject Deleted Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('school.subject.view');
    }
}
