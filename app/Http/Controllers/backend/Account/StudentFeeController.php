<?php

namespace App\Http\Controllers\Backend\Account;

use App\Models\ExamType;
use App\Models\FeeCategory;
use App\Models\StudentYear;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\AccountStudentFee;
use App\Models\FeeCategoryAmount;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class StudentFeeController extends Controller
{
    public function view()
    {
        $data['allData'] = AccountStudentFee::all();
        return view('backend.account.student_fee.view_student_fee', $data);
    }

    public function add()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['fee_categories'] = FeeCategory::all();

        return view('backend.account.student_fee.add_student_fee', $data);

    }

    public function getStudent(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $fee_category_id = $request->fee_category_id;
        $date = date('Y-m',strtotime($request->date));

        $data = AssignStudent::with(['discount'])->where('year_id',$year_id)->where('class_id',$class_id)->get();

        $html['thsource']  = '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Father Name</th>';
        $html['thsource'] .= '<th>Original Fee </th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee (This Student)</th>';
        $html['thsource'] .= '<th>Select</th>';

    	 foreach ($data as $key => $std) {
            $registrationFee = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->where('class_id',$std->class_id)->first();

            $accountStudentFees = AccountStudentFee::where('student_id',$std->student_id)->where('year_id',$std->year_id)->where('class_id',$std->class_id)->where('fee_category_id',$fee_category_id)->where('date',$date)->first();

            if($accountStudentFees !=null) {
                $checked = 'checked';
            }else{
                $checked = '';
            }

            $color = 'success';
            $html[$key]['tdsource']  = '<td>'.$std['student']['id_no']. '<input type="hidden" name="fee_category_id" value= " '.$fee_category_id.' " >'.'</td>';

            $html[$key]['tdsource']  .= '<td>'.$std['student']['name']. '<input type="hidden" name="year_id" value= " '.$std->year_id.' " >'.'</td>';

            $html[$key]['tdsource']  .= '<td>'.$std['student']['fname']. '<input type="hidden" name="class_id" value= " '.$std->class_id.' " >'.'</td>';

            $html[$key]['tdsource']  .= '<td>'.$registrationFee->amount.'₹'.'<input type="hidden" name="date" value= " '.$date.' " >'.'</td>';

            $html[$key]['tdsource'] .= '<td>'.$std['discount']['discount'].'%'.'</td>';

            $originalFee = $registrationFee->amount;
            $discount = $std['discount']['discount'];
            $discountableFee = $discount/100*$originalFee;
            $finalFee = (int)$originalFee-(int)$discountableFee;

            $html[$key]['tdsource'] .='<td>'. '<input type="text" name="amount[]" value="'.$finalFee.' " class="form-control" readonly'.'</td>';

            $html[$key]['tdsource'] .='<td>'.'<input type="hidden" name="student_id[]" value="'.$std->student_id.'">'.'<input type="checkbox" name="checkManage[]" id="id'.$key.'" value="'.$key.'" '.$checked.' style="transform: scale(1.5);margin-left: 10px;"> <label for="id'.$key.'"> </label> '.'</td>';

    	 }
    	return response()->json(@$html);
    }

    public function store(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));

        AccountStudentFee::where('year_id', $request->year_id)->where('class_id',$request->class_id)->where('fee_category_id',$request->fee_category_id)->where('date',$date)->delete();

        $checkData = $request->checkManage;

        if($checkData != null){
            for ($i=0; $i < count($checkData); $i++) {
                $data = new AccountStudentFee();
                $data->year_id  = $request->year_id;
                $data->class_id  = $request->class_id;
                $data->fee_category_id  = $request->fee_category_id;
                $data->date  = $date;
                $data->student_id  = $request->student_id[$checkData[$i]];
                $data->amount  = $request->amount[$checkData[$i]];
                $data->save();
            } // End For Loop
        } // End IF

        if(!empty(@$data) || empty($checkData)){
            Toastr::success('Well Done Data Inserted Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('student.fee.view');
        } else {
            Toastr::error('Sorry Data Not Saved 😢😢😢😢', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('student.fee.view');
        }
    }
}
