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
             <h4 class="box-title">Add Attendance</h4>

           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                   <form action="{{ route('employee.attendance.store')}}" method="post" >
                    @csrf
                    @method('post')
                     <div class="row">
                       <div class="col-12">

                        <div class="row">



                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="date" class="form-control" required>
                                    </div>
                                        @error('date')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- End col-md-6 --}}

                            <div class="col-md-6">

                            </div>{{-- End col-md-6 --}}

                        </div> {{-- End row --}}


                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">SL</th>
                                            <th rowspan="2" class="text-center">Employee List</th>
                                            <th colspan="3" class="text-center" width="25%">Attendance Status</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center btn present_all" style="display: table-cell; background-color: #000000" >Present</th>
                                            <th class="text-center btn present_all" style="display: table-cell; background-color: #000000">Leave</th>
                                            <th class="text-center btn present_all" style="display: table-cell; background-color: #000000">Absent</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $key => $employee)
                                        <tr id="div{{$employee->id}}" class="text-center">
                                            <input type="hidden" name="employee_id[]" value="{{$employee->id}}" />
                                            <td>{{ $key + 1}}</td>
                                            <td>{{ $employee->name }}</td>
                                            <td colspan="3" class="text-center ">
                                                <div class="switch-toggle switch-3 switch-candy d-flex ">
                                                    <div class="mr-auto text-center">
                                                        <input name="attend_status{{$key}}" type="radio" value="Present" id="present{{$key}}" class="radio-col-success mr-auto" checked="checked">
                                                        <label for="present{{$key}}">Present</label>

                                                    </div>
                                                    <div class="text-center ">
                                                        <input name="attend_status{{$key}}" type="radio" value="Leave" id="leave{{$key}}" class="radio-col-warning">
                                                        <label for="leave{{$key}}"> Leave</label>

                                                    </div>
                                                    <div class="ml-auto text-center">
                                                        <input name="attend_status{{$key}}" type="radio" value="Absent" id="absent{{$key}}" class="radio-col-danger ml-auto">
                                                        <label for="absent{{$key}}">Absent</label>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>{{-- End col-md-12 --}}




                        </div>
                            {{-- End row --}}



                       <div class="text-xs-right">
                           <button type="submit" name="submit" class="btn btn-rounded btn-info">Submit</button>
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

