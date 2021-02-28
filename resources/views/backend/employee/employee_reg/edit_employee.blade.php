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
             <h4 class="box-title">Edit Employee </h4>

           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                   <form action="{{ route('employee.registration.update', [$editData->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                     <div class="row">
                       <div class="col-12">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Employee Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" required autofocus value="{{ $editData->name }}">
                                    </div>
                                        @error('name')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Father Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="fname" class="form-control" required value="{{ $editData->fname }}">
                                    </div>
                                        @error('fname')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Mother Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mname" class="form-control" required value="{{ $editData->mname }}">
                                    </div>
                                        @error('mname')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}

                        </div> {{-- 1 row end --}}


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Mobile <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="mobile" class="form-control" required value="{{ $editData->mobile }}">
                                    </div>
                                        @error('mobile')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Address <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="address" class="form-control" value="{{ $editData->address }}" required >
                                    </div>
                                        @error('address')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Gender <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="gender" id="gender" required class="form-control">
                                            <option value="" selected disabled>Select Gender</option>
                                            <option  {{ $editData->gender == 'Male' ? 'selected' : ''}} value="Male">Male</option>
                                            <option {{ $editData->gender == 'Female' ? 'selected' : ''}} value="Female">Female</option>
                                            <option {{ $editData->gender == 'Other' ? 'selected' : ''}} value="Other">Other</option>

                                        </select>
                                    </div>
                                        @error('gender')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}

                        </div> {{--2nd row end --}}
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Religion <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="religion" id="religion" required class="form-control">
                                            <option value="" selected disabled>Select Religion</option>
                                            <option {{ $editData->religion=='Hindu'? 'selected' : ''}} value="Hindu">Hindu</option>
                                            <option {{ $editData->religion=='Sikh'? 'selected' : ''}}  value="Sikh">Sikh</option>
                                            <option {{ $editData->religion=='Jain'? 'selected' : ''}} value="Jain">Jain</option>
                                            <option {{ $editData->religion=='Muslim'? 'selected' : ''}} value="Muslim">Muslim</option>
                                            <option {{ $editData->religion=='Buddhist'? 'selected' : ''}} value="Buddhist">Buddhist</option>
                                            <option {{ $editData->religion=='Christan'? 'selected' : ''}} value="Christan">Christan</option>
                                        </select>
                                    </div>
                                        @error('religion')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}


                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Date of Birth <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="dob" class="form-control" required value="{{ $editData->dob}}">
                                    </div>
                                        @error('dob')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}


                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Designation <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="designation_id" id="designation_id" required class="form-control">
                                            <option value="" selected disabled>Select designation</option>

                                            @foreach ($designation as $desi)
                                            <option {{ $editData->designation_id == $desi->id ? 'selected' : ''}} value="{{ $desi->id }}">{{ $desi->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                        @error('designation_id')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}


                        </div> {{-- 3rd row end --}}


                        <div class="row">
                            @if (!@editData)
                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Salary <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="salary" class="form-control" value="{{ $editData->salary }}" required >
                                    </div>
                                        @error('salary')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-3 end --}}
                            @endif

                            @if (!@editData)

                            <div class="col-md-3">
                                <div class="form-group">
                                    <h5>Joining Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="join_date" class="form-control" value="{{ $editData->join_date }}" required >

                                    </div>
                                        @error('join_date')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-3 end --}}
                            @endif



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
                                        <img id="showImage" src="{{ (!empty($editData->image)) ? url('upload/employee_images/'. $editData->image) : asset('upload/no_image.jpg') }}" width="100" height="100"    alt="">

                                     </div>
                                </div>
                            </div>{{-- col-md-3 end --}}



                        </div> {{-- 4th row end --}}

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

