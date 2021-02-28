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
                     <h3 class="box-title">Employee <strong>Monthly Salary</strong></h3>
                     <a href="{{ route('employee.attendance.add')}}" class="btn btn-success btn-rounded mb-5 float-right">Add Monthly Salary</a>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="table-responsive">
                         <table id="example1" class="table table-bordered table-striped">
                           <thead>
                               <tr>
                                   <th>SL</th>
                                   <th>Date</th>
                                   <th>Action</th>
                               </tr>
                           </thead>
                           <tbody>
                            @foreach($allData as $key => $value)
                            <tr>
                                   <td width="5%">{{ $key +1}}</td>
                                   <td>{{ date('d-m-Y',strtotime($value->date)) }}</td>
                                   <td width="25%">
                                       <a href="{{route('employee.attendance.edit', $value->date)}}" class="btn btn-info">Edit</a>
                                       <a href="{{route('employee.attendance.details', $value->date)}}" class="btn btn-danger">Details</a>
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

