<?php

namespace App\Http\Controllers\backend\student;

use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class StudentRollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        return view('backend.student.roll_generate.view_roll_generate', $data);
    }


    public function getStudents(Request $request)
    {
        // dd('ok');
        $allData =  AssignStudent::with(['student'])->where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        // dd($allData->toArray());
        return response()->json($allData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        if($request->student_id != null){
            for ($i=0; $i < count($request->student_id); $i++) {

                AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->where('student_id', $request->student_id[$i])->update(['roll'=> $request->roll[$i]]);
            } //end for loop
        } else {
            Toastr::error('Sorry there are no students', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->back();
        } //end if conditions

        Toastr::success('Well Done Roll Generate Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
