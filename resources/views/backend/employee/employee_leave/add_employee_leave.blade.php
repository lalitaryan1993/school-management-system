@extends('admin.admin_master')

@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->

	<!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
         <div class="box">
           <div class="box-header with-border">
             <h4 class="box-title">Employee Leave</h4>

           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                   <form action="{{ route('employee.leave.store')}}" method="post" >
                    @csrf
                    @method('post')
                     <div class="row">
                       <div class="col-12">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Employee Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="employee_id" id="employee_id" required class="form-control">
                                            <option value="" selected disabled>Select Employee</option>
                                            @foreach ($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                        @error('employee_id')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- End col-md-6 --}}


                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Start Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="start_date" class="form-control" required>
                                    </div>
                                        @error('start_date')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- End col-md-6 --}}

                        </div> {{-- End row --}}


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Leave Purpose <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="leave_purpose_id" id="leave_purpose_id" required class="form-control">
                                            <option value="" selected disabled>Select Leave Purpose</option>
                                            @foreach ($leave_purpose as $leave)
                                            <option value="{{$leave->id}}">{{$leave->name}}</option>
                                            @endforeach
                                            <option value="0">New Purpose</option>

                                        </select>
                                        <input type="text" name="name" id="add_another" class="form-control d-none mt-2" placeholder="Write Purpose">
                                    </div>
                                        @error('leave_purpose_id')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- End col-md-6 --}}


                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>End Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="end_date" class="form-control" required>
                                    </div>
                                        @error('end_date')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- End col-md-6 --}}

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

  <script type="text/javascript">

    $(document).ready(function() {
        $(document).on("change", '#leave_purpose_id', function(e) {
             var leave_purpose_id = $(this).val();
             if(leave_purpose_id == 0){
                $('#add_another').removeClass('d-none');
             } else {
                $('#add_another').addClass('d-none');
             }
        })
    })

</script>


@endsection

