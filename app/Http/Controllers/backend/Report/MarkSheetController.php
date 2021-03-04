<?php

namespace App\Http\Controllers\Backend\Report;

use App\Models\ExamType;
use App\Models\MarksGrade;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentMarks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class MarkSheetController extends Controller
{
    public function view()
    {
        $data['years'] = StudentYear::orderBy('id', 'desc')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();

        return view('backend.report.markSheet.view_markSheet', $data);
    }

    public function markSheetGet(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no = $request->id_no;

        $count_fail = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id',$exam_type_id)->where('id_no', $id_no)->where('marks', '<', '33')->get()->count();
        // dd($count_fail);
        $singleStudent = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id',$exam_type_id)->where('id_no', $id_no)->first();

        if($singleStudent == true) {
            $allMarks = StudentMarks::with(['assign_subject', 'year'])->where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id',$exam_type_id)->where('id_no', $id_no)->get();
            // dd($allMarks->toArray());

            $allGrades = MarksGrade::all();

            return view("backend.report.markSheet.pdf_markSheet",compact("allGrades","allMarks","count_fail"));

        } else {
            Toastr::error('Sorry these criteria does not match', '', ["positionClass" => "toast-top-right", "timeOut" => "5000"]);
            return redirect()->back();
        }


    }
}
