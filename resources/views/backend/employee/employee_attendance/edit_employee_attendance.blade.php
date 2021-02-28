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
            <h4 class="box-title">Edit Attendance</h4>


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
                                        <input type="date" name="date" class="form-control" value={{ $editData[0]->date }} required>
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
                                        @foreach ($editData as $key => $data)
                                        <tr id="div{{$data->id}}" class="text-center">
                                            <input type="hidden" name="employee_id[]" value="{{$data->employee_id}}" />
                                            <td>{{ $key + 1}}</td>
                                            <td>{{ $data->user->name }}</td>
                                            <td colspan="3" class="text-center ">
                                                <div class="switch-toggle switch-3 switch-candy d-flex ">
                                                    <div class="mr-auto text-center">
                                                        <input name="attend_status{{$key}}" type="radio" value="Present" id="present{{$key}}" {{ $data->attend_status == 'Present' ? 'checked' : ''}} class="radio-col-success mr-auto" >
                                                        <label for="present{{$key}}">Present</label>

                                                    </div>
                                                    <div class="text-center ">
                                                        <input name="attend_status{{$key}}" type="radio" value="Leave" id="leave{{$key}}" {{ $data->attend_status == 'Leave' ? 'checked' : ''}}  class="radio-col-warning">
                                                        <label for="leave{{$key}}"> Leave</label>

                                                    </div>
                                                    <div class="ml-auto text-center">
                                                        <input name="attend_status{{$key}}" type="radio" value="Absent" id="absent{{$key}}" {{ $data->attend_status == 'Absent' ? 'checked' : ''}}  class="radio-col-danger ml-auto">
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

