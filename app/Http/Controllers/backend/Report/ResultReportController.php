<?php

namespace App\Http\Controllers\Backend\Report;

use PDF;
use App\Models\ExamType;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentMarks;
use Illuminate\Http\Request;
use App\Models\AssignStudent;


use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;


class ResultReportController extends Controller
{
    public function view()
    {
        $data['years'] = StudentYear::orderBy('id', 'desc')->get();
        $data['classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();

        return view('backend.report.student_result.view_student_result', $data);

    }

    public function get(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;

        $singleResult = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id',$exam_type_id)->first();


        if($singleResult == true) {
            $data['allData'] = StudentMarks::select('year_id', 'class_id', 'exam_type_id', 'student_id')->where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id',$exam_type_id)->groupBy('year_id')->groupBy('class_id')->groupBy('exam_type_id')->groupBy('student_id')->get();

            dd($data['allData']->toArray());

            $pdf = PDF::loadView('backend.report.student_result.pdf_student_result', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');

        } else {
            Toastr::error('Sorry these criteria does not match', '', ["positionClass" => "toast-top-right", "timeOut" => "5000"]);
            return redirect()->back();
        }


    }

    public function IDCardView()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        return view('backend.report.IDCard.view_IDCard', $data);

    }

    public function IDCardGet(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        $checkData = AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->first();

        if ($checkData == true) {
            $data['allData'] =  AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->get();

            // dd($data['allData']->toArray());

            $pdf = PDF::loadView('backend.report.IDCard.pdf_IDCard', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');


        } else {
            Toastr::error('Sorry these criteria does not match', '', ["positionClass" => "toast-top-right", "timeOut" => "5000"]);
            return redirect()->back();

        }

        return view('backend.report.IDCard.view_IDCard', $data);

    }
}
