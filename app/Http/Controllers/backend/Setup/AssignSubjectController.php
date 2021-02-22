<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class AssignSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        // $data['allData'] = AssignSubject::all();
        $data['allData'] = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign_subject.view_assign_subject', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();

        return view('backend.setup.assign_subject.add_assign_subject', $data);
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
            'class_id' => 'required',
            'subject_id' => 'required',
            'subject_id.*' => 'required',
            'full_mark' => 'required|array',
            'full_mark.*' => 'required|numeric',
            'pass_mark' => 'required|array',
            'pass_mark.*' => 'required|numeric',
            'subjective_mark' => 'required|array',
            'subjective_mark.*' => 'required|numeric',
            ]);

        $subjectClass = count($request->subject_id);
        if($subjectClass != NULL){
            for($i = 0; $i < $subjectClass; $i++){
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];

                $assign_subject->save();
            }
        }


            Toastr::success('Subject Assign Inserted Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->route('assign.subject.view');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($class_id)
    {
        $data['editData'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'asc')->get();
        $data['subjects'] = SchoolSubject::all();
        $data['classes'] = StudentClass::all();
        // dd($data['editData']->toArray());
        return view('backend.setup.assign_subject.edit_assign_subject', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $class_id)
    {
        if($request->subject_id == NULL){
            Toastr::error('Sorry You do not select any subject', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
            return redirect()->back();
        } else {
            $validatedData = $request->validate([
                'class_id' => 'required',
                'subject_id' => 'required',
                'subject_id.*' => 'required',
                'full_mark' => 'required|array',
                'full_mark.*' => 'required|numeric',
                'pass_mark' => 'required|array',
                'pass_mark.*' => 'required|numeric',
                'subjective_mark' => 'required|array',
                'subjective_mark.*' => 'required|numeric',
                ]);

            $countSubject = count($request->subject_id);
            AssignSubject::where(['class_id' => $class_id])->delete();
            if($countSubject != NULL){
                for($i = 0; $i < $countSubject; $i++){
                    $assign_subject = new AssignSubject();
                    $assign_subject->class_id = $request->class_id;
                    $assign_subject->subject_id = $request->subject_id[$i];
                    $assign_subject->full_mark = $request->full_mark[$i];
                    $assign_subject->pass_mark = $request->pass_mark[$i];
                    $assign_subject->subjective_mark = $request->subjective_mark[$i];

                    $assign_subject->save();
                }
            }


                Toastr::success('Subject Assign Updated Successfully', '', ["positionClass" => "toast-top-right","timeOut"=> "5000"]);
                return redirect()->route('assign.subject.view');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($class_id)
    {
        $data['detailsData'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'asc')->get();

        // $data['fee_categories'] = FeeCategory::all();
        // $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.details_assign_subject', $data);
    }
}
