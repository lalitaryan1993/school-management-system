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
                     <h3 class="box-title">Fee Amount Details</h3>
                     <a href="{{ route('fee.amount.add')}}" class="btn btn-success btn-rounded mb-5 float-right">Add Fee Amount</a>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <h4 ><strong>Fee Category: </strong> {{ $detailsData[0]->fee_category->name }}</h4> </h4>
                       <div class="table-responsive">
                         <table  class="table table-bordered table-striped">
                           <thead class="thead-light">
                               <tr>
                                <th>SL</th>
                                <th>Class Name</th>
                                <th>Amount</th>
                               </tr>
                           </thead>
                           <tbody>
                            @foreach($detailsData as $key => $detail)
                            <tr>
                                   <td width="5%">{{ $key +1}}</td>
                                   <td>{{ $detail->student_class->name }}</td>

                                   <td width="25%">
                                       {{ $detail->amount}}
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

