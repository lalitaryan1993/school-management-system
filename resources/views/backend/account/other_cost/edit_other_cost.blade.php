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
             <h4 class="box-title">Edit Other Cost </h4>

           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                   <form action="{{ route('other.cost.update', $editData->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                     <div class="row">
                       <div class="col-12">

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Amount <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="amount" class="form-control" value="{{ $editData->amount }}" required >
                                    </div>
                                        @error('amount')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-3 end --}}


                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5> Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="date" class="form-control" value="{{ $editData->date }}" required >

                                    </div>
                                        @error('date')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-3 end --}}



                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="image">
                                            <label class="custom-file-label" for="image">Choose Image</label>
                                        </div>
                                    </div>
                                        @error('image')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-3 end --}}
                                <div class="col-md-3">
                                <div class="form-group">
                                    <div class="controls">
                                        <img id="showImage" src="{{ (!empty($editData->image)) ? url('upload/other_images/'. $editData->image) : asset('upload/no_image.jpg') }}" width="100" height="100"    alt="">

                                     </div>
                                </div>
                            </div>{{-- col-md-3 end --}}



                        </div> {{-- 1st row end --}}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>Description <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea class="form-control" name="description" id="description" rows="3">{{ $editData->description }}</textarea>
                                    </div>
                                </div>
                            </div> {{-- col-md-12 end --}}
                        </div>{{-- 2nd row end --}}

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

