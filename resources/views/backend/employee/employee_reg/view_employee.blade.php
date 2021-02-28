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
                     <h3 class="box-title">Employee List</h3>
                     <a href="{{ route('employee.registration.add')}}" class="btn btn-success btn-rounded mb-5 float-right">Add Employee</a>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="table-responsive">
                         <table id="example1" class="table table-bordered table-striped">
                           <thead>
                               <tr>
                                   <th width="5%">SL</th>
                                   <th >Name</th>
                                   <th >ID No</th>
                                   <th >Mobile</th>
                                   <th >Gender</th>
                                   <th >Join Date</th>
                                   <th >Salary</th>
                                   @if(Auth::user()->role == 'Admin')

                                   <th >Code</th>

                                    @endif
                                   <th width="25%">Action</th>
                               </tr>
                           </thead>
                           <tbody>
                            @foreach($allData as $key => $employee)
                            <tr>
                                   <td width="5%">{{ $key +1}}</td>
                                   <td>{{ $employee->name }}</td>
                                   <td>{{ $employee->id_no }}</td>
                                   <td>{{ $employee->mobile }}</td>
                                   <td>{{ $employee->gender }}</td>
                                   <td>{{ $employee->join_date }}</td>
                                   <td>{{ $employee->salary }}</td>

                                   @if(Auth::user()->role == 'Admin')

                                   <td>{{ $employee->code }}</td>
                                    @endif

                                   <td width="15%">
                                       <a href="{{ route('employee.registration.edit', [$employee->id])}}" class="btn btn-info">Edit</a>
                                       <a href="{{ route('employee.registration.details', [$employee->id])}}" class="btn btn-danger" target="_blank">Details</a>
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

