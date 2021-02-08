<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profileView()
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        return view('backend.user.view_profile', compact('user'));
    }

    /**
     * Edit the form for Update Logged In user.
     *
     * @return \Illuminate\Http\Response
     */
    public function profileEdit()
    {
        $id = Auth::user()->id;
        $editData = User::findOrFail($id);
        $user = User::findOrFail($id);

        return view('backend.user.edit_profile', compact('editData','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profileStore(Request $request)
    {
        $data = User::findOrFail(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;


        if($request->hasFile('image')){

            $file = $request->file('image');
            @unlink(public_path('upload/user_images/'.$data->image));

            $filename = date('YmdHi').$file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images/'),$filename);
            $data['image'] = $filename;

        }

        // dd($data);
        $data->save();

        Toastr::success('Profile Updated Successfully', 'Success', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
        return redirect()->route('profile.view');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function passwordView()
    {
        return view('backend.user.edit_password');
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
    public function passwordUpdate(Request $request)
    {
        $validatedData = $request->validate([
                'current_password' => 'required',
                'password' => 'required|confirmed',

            ]);

            $hashedPassword = Auth::user()->password;
            if(Hash::check($request->password, $hashedPassword)){
                $user = User::findOrFail(Auth::user()->id);
                $user->password = Hash::make($request->password);
                $user->save();

                Auth::logout();

                return redirect()->route('login');
            } else {
                return redirect()->back();

            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
