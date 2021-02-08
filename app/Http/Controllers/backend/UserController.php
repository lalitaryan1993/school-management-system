<?php

namespace App\Http\Controllers\backend;

use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userView()
    {
        $allData = User::all();
        return view('backend.user.view_user',compact('allData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userAdd()
    {
        return view('backend.user.add_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userStore(Request $request)
    {
        $validatedData = $request->validate(
            [
                'email' => 'required|unique:users',
                'name' => 'required',
                'name' => 'required',

            ]
        );

        $data = new User();
        $data->user_type = $request->user_type;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);

        $data->save();

        Toastr::success('User Inserted Successfully', 'Success', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('user.view');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userEdit($id)
    {
        $editData = User::findOrFail($id);
        return view('backend.user.edit_user',compact('editData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userUpdate(Request $request, $id)
    {

        $data =  User::findOrFail($id);
        $data->user_type = $request->user_type;
        $data->name = $request->name;
        $data->email = $request->email;

        $data->save();
        // dd($request);
        Toastr::info('User Updated Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('user.view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userDelete($id)
    {
        $data =  User::findOrFail($id)->delete();
        Toastr::warning('User Deleted Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('user.view');

    }
}
