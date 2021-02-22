<?php

namespace App\Http\Controllers\Backend\Student;

use PDF;
use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;

use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use App\Http\Controllers\Controller;

class MonthlyFeeController extends Controller
{
    public function view()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        return view('backend.student.monthly_fee.view_monthly_fee', $data);
    }

    public function monthlyFeeClassData(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $month = $request->month;

        if($year_id != ''){
            $where[] = ['year_id', 'like', $year_id.'%'];
        }
        if($class_id != ''){
            $where[] = ['class_id', 'like', $class_id.'%'];
        }

        $allStudent = AssignStudent::with(['discount'])->where($where)->get();
        // dd($allStudent);
        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Monthly Fee</th>';
        $html['thsource'] .= '<th>Discount</th>';
        $html['thsource'] .= '<th>Student Fee</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($allStudent as $key => $v) {
            // dd($v->class_id);
            $monthlyFee = FeeCategoryAmount::where('fee_category_id', 2)->where('class_id', $v->class_id)->first();
            // dd($monthlyFee->amount);

            $color = 'success';
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['student']['id_no'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['student']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v->roll.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$monthlyFee->amount.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['discount']['discount'].'%' .'</td>';

            $originalFee = $monthlyFee->amount;
            $discount = $v['discount']['discount'];
            $discountTableFee = $discount/100*$originalFee;
            $finalFee = (float)$originalFee - (float)$discountTableFee;

            $html[$key]['tdsource'] .= '<td>'.$finalFee.'₹'.'</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title = "PaySlip" target="_blank" href="'.route('student.monthly.fee.payslip').'?class_id='.$v->class_id. '&student_id='. $v->student_id. '&month='.$request->month.'">Fee Slip</a>';
            $html[$key]['tdsource'] .= '</td>';
        }

        return response()->json(@$html);

    }

    public function paySlip(Request $request)
    {
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $data['month'] = $request->month;

        $data['details'] = AssignStudent::with(['student','discount'])->where('student_id', $student_id)->where('class_id', $class_id)->first();

        $pdf = PDF::loadView('backend.student.monthly_fee.pdf_monthly_fee', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
