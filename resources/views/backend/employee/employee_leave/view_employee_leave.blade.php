@extends('admin.admin_master')

@section('admin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->



      <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box">
                   <div class="box-header with-border">
                     <h3 class="box-title">Employee Leave</h3>
                     <a href="{{ route('employee.leave.add')}}" class="btn btn-success btn-rounded mb-5 float-right">Add Employee Leave</a>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="table-responsive">
                         <table id="example1" class="table table-bordered table-striped">
                           <thead>
                               <tr>
                                   <th>SL</th>
                                   <th>Name</th>
                                   <th>ID No</th>
                                   <th>Purpose</th>
                                   <th>Start Date</th>
                                   <th>End Date</th>
                                   <th>Action</th>
                               </tr>
                           </thead>
                           <tbody>
                            @foreach($allData as $key => $leave)
                            <tr>
                                   <td width="5%">{{ $key +1}}</td>
                                   <td>{{ $leave->user->name }}</td>
                                   <td>{{ $leave->user->id_no }}</td>
                                   <td>{{ $leave->purpose->name }}</td>
                                    <td>{{ date('d-m-Y',strtotime($leave->start_date)) }}</td>
                                    <td>{{ date('d-m-Y',strtotime($leave->end_date)) }}</td>

                                   <td width="25%">
                                       <a href="{{ route('employee.leave.edit', [$leave->id])}}" class="btn btn-info">Edit</a>
                                       <a href="{{ route('employee.leave.delete', [$leave->id])}}" class="btn btn-danger" id="delete">Delete</a>
                                   </td>
                               </tr>
                            @endforeach

                           </tbody>

                         </table>
                       </div>
                   </div>
                   <!-- /.box-body -->
                 </div>
                 <!-- /.box -->


               </div>
        </div>
    </section>


    </div>
  </div>

@endsection

