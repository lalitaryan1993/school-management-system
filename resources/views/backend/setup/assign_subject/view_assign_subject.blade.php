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
                     <h3 class="box-title">Assign Subject List</h3>
                     <a href="{{ route('assign.subject.add')}}" class="btn btn-success btn-rounded mb-5 float-right">Add Assign Subject </a>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="table-responsive">
                         <table id="example1" class="table table-bordered table-striped">
                           <thead>
                               <tr>
                                   <th>SL</th>
                                   <th>Class Name</th>
                                   <th>Action</th>
                               </tr>
                           </thead>
                           <tbody>
                            @foreach($allData as $key => $assign)
                            <tr>
                                   <td width="5%">{{ $key +1}}</td>
                                   <td>{{ $assign->student_class->name }}</td>

                                   <td width="25%">
                                       <a href="{{ route('assign.subject.edit', [$assign->class_id])}}" class="btn btn-info">Edit</a>
                                       <a href="{{ route('assign.subject.details', [$assign->class_id])}}" class="btn btn-primary" >Details</a>
                                   </td>
                               </tr>
                            @endforeach

                           </tbody>
                           {{-- <tfoot>
                               <tr>
                                <th>SL</th>
                                <th>Class Name</th>
                                <th>Action</th>
                            </tr>
                           </tfoot> --}}
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

