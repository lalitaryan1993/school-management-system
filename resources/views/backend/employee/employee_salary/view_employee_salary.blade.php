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
                     <h3 class="box-title">Employee Salary List</h3>
                     <a href="{{ route('employee.registration.add')}}" class="btn btn-success btn-rounded mb-5 float-right">Add Employee Salary</a>
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

                                   <th width="25%">Action</th>
                               </tr>
                           </thead>
                           <tbody>
                            @foreach($allData as $key => $value)
                            <tr>
                                   <td width="5%">{{ $key +1}}</td>
                                   <td>{{ $value->name }}</td>
                                   <td>{{ $value->id_no }}</td>
                                   <td>{{ $value->mobile }}</td>
                                   <td>{{ $value->gender }}</td>
                                   <td>{{ date('d-m-Y', strtotime($value->join_date)) }}</td>
                                   <td>{{ $value->salary }}</td>

                                   <td width="15%">
                                       <a title="Increment" href="{{ route('employee.salary.increment', [$value->id])}}" class="btn btn-info"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                       <a title="Details" href="{{ route('employee.salary.details', [$value->id])}}" class="btn btn-danger" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
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

