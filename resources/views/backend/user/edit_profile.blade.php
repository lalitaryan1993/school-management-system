@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->

	<!-- Main content -->
    <section class="content">

        <!-- Basic Forms -->
         <div class="box">
           <div class="box-header with-border">
             <h4 class="box-title">Manage Profile</h4>

           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                   <form action="{{ route('profile.store', [$editData->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                     <div class="row">
                       <div class="col-12">


                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>User Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" value="{{ $editData->name}}" required > </div>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <h5>User Email <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="email" name="email" class="form-control" required value="{{ $editData->email}}" > </div>
                                </div>
                            </div>



                        </div>


                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>User Mobile <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="tel" name="mobile" class="form-control" value="{{ $editData->mobile}}" required > </div>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <h5>User Address <span class="text-danger">*</span></h5>
                                    <div class="controls">

                                        <input type="text" name="address" class="form-control" required value="{{ $editData->address}}" > </div>
                                </div>
                            </div>



                        </div>


                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <h5>User Gender<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="gender" id="gender" required class="form-control">
                                            <option value="" selected disabled>Select Gender</option>
                                            <option value="Male" {{$editData->gender == 'Male' ? 'selected' : ''}}>Male</option>
                                            <option value="Female" {{$editData->gender == 'Female' ? 'selected' : ''}}>Female</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>User Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="image">
                                            <label class="custom-file-label" for="image">Choose Image</label>
                                        </div>

                                    </div>
                                 </div>

                                <div class="form-group mt-3">
                                    <div class="controls">
                                        <img id="showImage" src="{{ (!empty($user->image)) ? url('upload/user_images/'. $user->image) : asset('upload/no_image.jpg') }}" width="100" height="100"    alt="">

                                     </div>
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

<script type="text/javascript">

    $(document).ready(function() {
        $('#image').change(function(e) {
             var reader = new FileReader();
             reader.onload = function(e){
                 $('#showImage').attr('src',e.target.result);
             }
             reader.readAsDataURL(e.target.files[0]);
        })
    })

</script>

@endsection

