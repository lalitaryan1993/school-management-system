@extends('admin.admin_master')

@section('admin')



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->

	<!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
         <div class="box">
           <div class="box-header with-border">
             <h4 class="box-title">Employee Salary Increment</h4>

           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                   <form action="{{ route('update.increment.store', $editData->id)}}" method="post" >
                    @csrf
                    @method('post')
                     <div class="row">
                       <div class="col-12">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Salary Amount <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="increment_salary" class="form-control" required autofocus>
                                    </div>
                                        @error('increment_salary')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- End col-md-6 --}}


                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Effected Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="effected_salary" class="form-control" required>
                                    </div>
                                        @error('effected_salary')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- End col-md-6 --}}

                        </div>

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



@endsection

