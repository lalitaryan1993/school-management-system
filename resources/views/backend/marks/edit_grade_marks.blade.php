@extends('admin.admin_master')

@section('admin')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->

	<!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
         <div class="box">
           <div class="box-header with-border">
             <h4 class="box-title">Add Grade Marks </h4>

           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                   <form action="{{ route('marks.grade.update', $editData->id)}}" method="post" >
                    @csrf
                    @method('PATCH')
                     <div class="row">
                       <div class="col-12">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Grade Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="grade_name" class="form-control" value="{{ $editData->grade_name }}" required autofocus>
                                    </div>
                                        @error('grade_name')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5> Grade Point <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="grade_point" class="form-control" value="{{ $editData->grade_point }}" required >
                                    </div>
                                        @error('grade_point')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Start Marks <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="start_marks" class="form-control" value="{{ $editData->start_marks }}" required >
                                    </div>
                                        @error('start_marks')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}

                        </div> {{-- 1 row end --}}


                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>End Marks <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="end_marks" class="form-control" value="{{ $editData->end_marks }}" required >
                                    </div>
                                        @error('end_marks')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}


                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Start Point <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="start_point" class="form-control" value="{{ $editData->start_point }}" required >
                                    </div>
                                        @error('start_point')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>End Point <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="end_point" class="form-control" value="{{ $editData->end_point }}" required >
                                    </div>
                                        @error('end_point')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}


                        </div> {{--2nd row end --}}
                        <div class="row">




                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Remarks <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="remarks" class="form-control" value="{{ $editData->remarks }}" required >
                                    </div>
                                        @error('remarks')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}


                            <div class="col-md-4">

                            </div>{{-- col-md-4 end --}}


                        </div> {{-- 3rd row end --}}



                       <div class="text-xs-right">
                           <button type="submit" name="submit" class="btn btn-rounded btn-info">Update</button>
                       </div>
                   </form>

               </div>
               <!-- /.col -->
             </div>
             <!-- /.row -->
           </div>
           <!-- /.box-body -->
         </div>
         <!-- /.box -->

       </section>
       <!-- /.content -->


    </div>
  </div>



@endsection

