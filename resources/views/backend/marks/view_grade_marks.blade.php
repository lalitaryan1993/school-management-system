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
                     <h3 class="box-title">Grade Marks List</h3>
                     <a href="{{ route('marks.grade.add')}}" class="btn btn-success btn-rounded mb-5 float-right">Add Grade Mark</a>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="table-responsive">
                         <table id="example1" class="table table-bordered table-striped">
                           <thead>
                               <tr>
                                   <th width="5%">SL</th>
                                   <th >Grade Name</th>
                                   <th >Grade Point</th>
                                   <th >Start Marks</th>
                                   <th >End Marks</th>
                                   <th >Point Range</th>
                                   <th >Remarks</th>

                                   <th width="25%">Action</th>
                               </tr>
                           </thead>
                           <tbody>
                            @foreach($allData as $key => $value)
                            <tr>
                                   <td width="5%">{{ $key +1}}</td>
                                   <td>{{ $value->grade_name }}</td>
                                   <td>{{ $value->grade_point }}</td>
                                   <td>{{ $value->start_marks }}</td>
                                   <td>{{ $value->end_marks }}</td>
                                   <td>{{ $value->start_point }} - {{ $value->end_point }}</td>
                                   <td>{{ $value->remarks }}</td>

                                   <td width="15%">
                                       <a href="{{ route('marks.grade.edit', [$value->id])}}" class="btn btn-info">Edit</a>
                                       {{-- <a href="{{ route('employee.registration.details', [$employee->id])}}" class="btn btn-danger" target="_blank">Details</a> --}}
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

