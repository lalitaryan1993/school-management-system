<?php

namespace App\Http\Controllers\Backend\Report;

use Illuminate\Http\Request;
use App\Models\AccountStudentFee;
use App\Http\Controllers\Controller;
use App\Models\AccountEmployeeSalary;
use App\Models\AccountOtherCost;

use PDF;

class ProfitController extends Controller
{
    public function monthlyProfitView()
    {
        return view("backend.report.profit.view_profit");
    }

    public function monthlyProfitDateWise(Request $request)
    {
        $start_date = date('Y-m', strtotime($request->start_date));
        $end_date = date('Y-m', strtotime($request->end_date));

        $sDate = date('Y-m-d', strtotime($request->start_date));
        $eDate = date('Y-m-d', strtotime($request->end_date));

        $student_fee = AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');

        $other_cost = AccountOtherCost::whereBetween('date', [$sDate, $eDate])->sum('amount');

        $employee_salary = AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');

        $totalCost = $other_cost + $employee_salary;

        $profit = $student_fee - $totalCost;
        // dd($data);
        $html['thsource'] = '<th>Student Fee</th>';
        $html['thsource'] .= '<th>Other Cost</th>';
        $html['thsource'] .= '<th>Employee Salary</th>';
        $html['thsource'] .= '<th>Total Cost</th>';
        $html['thsource'] .= '<th>Profit</th>';
        $html['thsource'] .= '<th>Action</th>';


            $color = 'success';

            $html['tdsource'] = '<td>'.(float)number_format($student_fee, 2, '.', '').'₹'.'</td>';
            $html['tdsource'] .= '<td>'.(float)number_format($other_cost, 2, '.', '').'₹'.'</td>';
            $html['tdsource'] .= '<td>'.(float)number_format($employee_salary, 2, '.', '').'₹'.'</td>';
            $html['tdsource'] .= '<td>'.(float)number_format($totalCost, 2, '.', '').'₹'.'</td>';
            $html['tdsource'] .= '<td>'.(float)number_format($profit, 2, '.', '').'₹'.'</td>';
            $html['tdsource'] .= '<td>';
            $html['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title = "PDF" target="_blank" href="'.route('report.profit.pdf').'?start_date='.$sDate.'&end_date='.$eDate.'">Pay Slip</a>';
            $html['tdsource'] .= '</td>';

        return response()->json(@$html);



    }


    public function monthlyProfitPDF(Request $request)
    {

        $data['start_date'] = date('Y-m', strtotime($request->start_date));
        $data['end_date']  = date('Y-m', strtotime($request->end_date));

        $data['sDate']  = date('Y-m-d', strtotime($request->start_date));
        $data['eDate']  = date('Y-m-d', strtotime($request->end_date));


        $pdf = PDF::loadView('backend.report.profit.pdf_profit', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }


}
