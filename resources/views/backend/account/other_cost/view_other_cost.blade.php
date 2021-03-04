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
                     <h3 class="box-title">Other Cost List</h3>
                     <a href="{{ route('other.cost.add')}}" class="btn btn-success btn-rounded mb-5 float-right">Add Other Cost</a>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="table-responsive">
                         <table id="example1" class="table table-bordered table-striped">
                           <thead>
                               <tr>
                                   <th width="5%">SL</th>
                                   <th>Date</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Action</th>

                               </tr>
                           </thead>
                           <tbody>
                            @foreach($allData as $key => $value)
                            <tr>
                                   <td width="5%">{{ $key +1}}</td>
                                   <td>{{ date('d-m-Y', strtotime($value->date)) }}</td>
                                   <td>{{ $value->amount }}</td>
                                   <td>{{ $value->description }}</td>
                                   <td><img src="{{ (!empty($value->image)) ? url('upload/other_images/'. $value->image) : asset('upload/no_image.jpg') }}" alt="" height="100px" width="100px"></td>

                                   <td><a title="Edit" href="{{ route('other.cost.edit', [$value->id])}}" class="btn btn-info">Edit</a></td>


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

