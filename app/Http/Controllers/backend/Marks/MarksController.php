<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\StudentMarks;
use App\Models\StudentYear;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    public function marksAdd()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();

        return view('backend.marks.add_marks', $data);
    }

    public function marksStore(Request $request)
    {
        $studentCount = $request->student_id;
        if ($studentCount) {
            for ($i = 0; $i < count(($studentCount)); $i++) {
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];

                $data->save();
            } //end for Loop

        } // end if conditions
        Toastr::success('Student Marks Inserted Successfully', '', ["positionClass" => "toast-top-right", "timeOut" => "5000"]);
        return redirect()->back();
    } // end methods

    public function edit()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();

        return view('backend.marks.edit_marks', $data);
    }

    public function marksEditGetStudents(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type_id = $request->exam_type_id;

        $getStudent = StudentMarks::with(['student'])->where('year_id', $year_id)
                        ->where('class_id', $class_id)
                        ->where('assign_subject_id', $assign_subject_id)
                        ->where('exam_type_id', $exam_type_id)
                        ->get();

        return response()->json($getStudent);
    }

    public function marksUpdate(Request $request)
    {
        StudentMarks::where('year_id', $request->year_id)
                        ->where('class_id', $request->class_id)
                        ->where('assign_subject_id', $request->assign_subject_id)
                        ->where('exam_type_id', $request->exam_type_id)
                        ->delete();


        $studentCount = $request->student_id;
        if ($studentCount) {
            for ($i = 0; $i < count(($studentCount)); $i++) {
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];

                $data->save();
            } //end for Loop

        } // end if conditions
        Toastr::success('Student Marks Updated Successfully', '', ["positionClass" => "toast-top-right", "timeOut" => "5000"]);
        return redirect()->back();
    } // end methods
}
