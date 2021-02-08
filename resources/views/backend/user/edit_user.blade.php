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
             <h4 class="box-title">Update User</h4>

           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                   <form action="{{ route('user.update', [$editData->id])}}" method="post">
                    @csrf
                    @method('PATCH')
                     <div class="row">
                       <div class="col-12">

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <h5>User Role<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="user_type" id="user_type" required class="form-control">
                                            <option value="" selected disabled>Select Role</option>
                                            <option value="Admin" {{$editData->user_type == 'Admin' ? 'selected' : ''}}>Admin</option>
                                            <option value="User" {{$editData->user_type == 'User' ? 'selected' : ''}}>User</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>User Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" value="{{ $editData->name}}" required > </div>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <h5>User Email <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="email" name="email" class="form-control" required value="{{ $editData->email}}" > </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- <div class="form-group">
                                    <h5>User Password <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="password" name="password" class="form-control" required > </div>
                                </div> --}}
                            </div>

                        </div>




                       <div class="text-xs-right">
                           <button type="submit" name="submit" class="btn btn-rounded btn-info">Update</button>
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

