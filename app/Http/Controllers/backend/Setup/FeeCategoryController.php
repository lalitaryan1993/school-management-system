<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\FeeCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class FeeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $data['allData'] = FeeCategory::all();
        return view('backend.setup.fee_category.view_fee_category', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('backend.setup.fee_category.add_fee_category');
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
            'name' => 'required|unique:fee_categories,name',
            ]);

            $data = new FeeCategory();
            $data->name  = $request->name;
            $data->save();

            Toastr::success('Fee Category Saved Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('fee.category.view');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = FeeCategory::findOrFail($id);
        return view('backend.setup.fee_category.edit_fee_category', compact('editData'));
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
        $data  = FeeCategory::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:fee_categories,name,'.$data->id
            ]);

            $data->name  = $request->name;
            $data->save();

            Toastr::success('Fee Category Updated Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('fee.category.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data =  FeeCategory::findOrFail($id)->delete();
        Toastr::warning('Fee Category Deleted Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('fee.category.view');
    }
}
