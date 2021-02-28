<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Models\MarksGrade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class GradeController extends Controller
{
    public function view()
    {
        $data['allData'] = MarksGrade::all();
        return view('backend.marks.view_grade_marks', $data);
    }

    public function add()
    {
        return view('backend.marks.add_grade_marks');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'grade_name' => 'required',
            'grade_point' => 'required',
            'start_marks' => 'required',
            'end_marks' => 'required',
            'start_point' => 'required',
            'end_point' => 'required',
            'remarks' => 'required',

            ]);

            $data = new MarksGrade();
            $data->grade_name = $request->grade_name;
            $data->grade_point = $request->grade_point;
            $data->start_marks = $request->start_marks;
            $data->end_marks = $request->end_marks;
            $data->start_point = $request->start_point;
            $data->end_point = $request->end_point;
            $data->remarks = $request->remarks;
            $data->save();


            Toastr::success('Grade Marks Inserted Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('marks.entry.grade');
    }

    public function edit($id)
    {

        $data['editData'] = MarksGrade::findOrFail($id);
        return view('backend.marks.edit_grade_marks', $data);

    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'grade_name' => 'required',
            'grade_point' => 'required',
            'start_marks' => 'required',
            'end_marks' => 'required',
            'start_point' => 'required',
            'end_point' => 'required',
            'remarks' => 'required',

            ]);

            $data = MarksGrade::where('id', $id)->first();
            $data->grade_name = $request->grade_name;
            $data->grade_point = $request->grade_point;
            $data->start_marks = $request->start_marks;
            $data->end_marks = $request->end_marks;
            $data->start_point = $request->start_point;
            $data->end_point = $request->end_point;
            $data->remarks = $request->remarks;
            $data->save();


            Toastr::success('Grade Marks Updated Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('marks.entry.grade');
    }



}
