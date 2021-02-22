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
                     <h3 class="box-title">Subject Details</h3>
                     <a href="{{ route('assign.subject.add')}}" class="btn btn-success btn-rounded mb-5 float-right">Add Assign Subject</a>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <h4 ><strong>Assign Subject: </strong> {{ $detailsData[0]->student_class->name }}</h4> </h4>
                       <div class="table-responsive">
                         <table  class="table table-bordered table-striped">
                           <thead class="thead-light">
                               <tr>
                                <th>SL</th>
                                <th>Subject</th>
                                <th>Full Mark</th>
                                <th>Pass Mark</th>
                                <th>Subjective Mark</th>
                               </tr>
                           </thead>
                           <tbody>
                            @foreach($detailsData as $key => $detail)
                            <tr>
                                   <td width="5%">{{ $key +1}}</td>
                                   <td>{{ $detail->school_subject->name }}</td>

                                   <td width="20%">
                                       {{ $detail->full_mark}}
                                   </td>
                                   <td width="20%">
                                       {{ $detail->pass_mark}}
                                   </td>
                                   <td width="20%">
                                       {{ $detail->subjective_mark}}
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

