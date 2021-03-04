<?php

namespace App\Http\Controllers\Backend\Account;

use Illuminate\Http\Request;
use App\Models\AccountOtherCost;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class OtherCostController extends Controller
{
    public function view()
    {
        $data['allData'] = AccountOtherCost::orderBy('id', 'desc')->get();
        return view('backend.account.other_cost.view_other_cost', $data);
    }

    public function add()
    {

        return view('backend.account.other_cost.add_other_cost');

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required',
            'date' => 'required',
            'description' => 'required',

        ]);

        $cost= new AccountOtherCost();
        $cost->amount = $request->amount;
        $cost->date = date('Y-m-d',strtotime($request->date));
        $cost->description = $request->description;

        if($request->hasFile('image')){

            $file = $request->file('image');

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/other_images/'),$filename);
            $cost->image = $filename;

        }
        $cost->save();
        Toastr::success('Other Cost Inserted Successfully', 'Success', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('other.cost.view');
    }

    public function edit($id)
    {
        $data['editData'] = AccountOtherCost::findOrFail($id);


        return view('backend.account.other_cost.edit_other_cost', $data);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'amount' => 'required',
            'date' => 'required',
            'description' => 'required',

        ]);

        $cost=  AccountOtherCost::findOrFail($id);
        $cost->amount = $request->amount;
        $cost->date = date('Y-m-d',strtotime($request->date));
        $cost->description = $request->description;

        if($request->hasFile('image')){

            $file = $request->file('image');

            @unlink(public_path('upload/user_images/'.$cost->image));

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/other_images/'),$filename);
            $cost->image = $filename;

        }
        $cost->save();
        Toastr::success('Other Cost Updated Successfully', 'Success', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('other.cost.view');
    }


}
