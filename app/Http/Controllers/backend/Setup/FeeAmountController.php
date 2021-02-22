<?php

namespace App\Http\Controllers\Backend\Setup;

use Illuminate\Http\Request;
use App\Models\FeeCategoryAmount;
use App\Http\Controllers\Controller;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use Brian2694\Toastr\Facades\Toastr;

class FeeAmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        // $data['allData'] = FeeCategoryAmount::all();
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_fee_amount', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();

        return view('backend.setup.fee_amount.add_fee_amount', $data);
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
            'fee_category_id' => 'required',
            'amount' => 'required|array',
            'amount.*' => 'required|numeric',
            ]);

        $countClass = count($request->class_id);
        if($countClass != NULL){
            for($i = 0; $i < $countClass; $i++){
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];

                $fee_amount->save();
            }
        }


            Toastr::success('Fee Amount Inserted Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('fee.amount.view');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($fee_category_id)
    {
        $data['editData'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'asc')->get();
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        // dd($data['editData']->toArray());
        return view('backend.setup.fee_amount.edit_fee_amount', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fee_category_id)
    {
        if($request->class_id == NULL){
            Toastr::error('Sorry You do not select any class amount', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->back();
        } else {
            $validatedData = $request->validate([
                'fee_category_id' => 'required',
                'amount' => 'required|array',
                'amount.*' => 'required|numeric',
                ]);

            $countClass = count($request->class_id);
            FeeCategoryAmount::where(['fee_category_id' => $fee_category_id])->delete();
            if($countClass != NULL){
                for($i = 0; $i < $countClass; $i++){
                    $fee_amount = new FeeCategoryAmount();
                    $fee_amount->fee_category_id = $request->fee_category_id;
                    $fee_amount->class_id = $request->class_id[$i];
                    $fee_amount->amount = $request->amount[$i];

                    $fee_amount->save();
                }
            }


                Toastr::success('Fee Amount Updated Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
                return redirect()->route('fee.amount.view');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($fee_category_id)
    {
        $data['detailsData'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'asc')->get();

        // $data['fee_categories'] = FeeCategory::all();
        // $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.details_fee_amount', $data);
    }
}
