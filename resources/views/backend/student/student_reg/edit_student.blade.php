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
             <h4 class="box-title">Edit Student </h4>

           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                   <form action="{{ route('student.registration.update', [$editData->student_id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" value="{{ $editData->id }}"/>
                     <div class="row">
                       <div class="col-12">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Student Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control" required autofocus value="{{ $editData->student->name}}">
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
                                        <input type="text" name="fname" class="form-control" required value="{{ $editData->student->fname}}">
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
                                        <input type="text" name="mname" class="form-control" required value="{{ $editData->student->mname}}">
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
                                        <input type="text" name="mobile" class="form-control" required value="{{ $editData->student->mobile}}">
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
                                        <input type="text" name="address" class="form-control" required value="{{ $editData->student->address}}">
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
                                            <option {{ $editData->student->gender=='Male'? 'selected' : ''}} value="Male">Male</option>
                                            <option {{ $editData->student->gender=='Female'? 'selected' : ''}} value="Female">Female</option>
                                            <option {{ $editData->student->gender=='Other'? 'selected' : ''}} value="Other">Other</option>

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
                                            <option {{ $editData->student->religion=='Hindu'? 'selected' : ''}} value="Hindu">Hindu</option>
                                            <option {{ $editData->student->religion=='Sikh'? 'selected' : ''}}  value="Sikh">Sikh</option>
                                            <option {{ $editData->student->religion=='Jain'? 'selected' : ''}} value="Jain">Jain</option>
                                            <option {{ $editData->student->religion=='Muslim'? 'selected' : ''}} value="Muslim">Muslim</option>
                                            <option {{ $editData->student->religion=='Buddhist'? 'selected' : ''}} value="Buddhist">Buddhist</option>
                                            <option {{ $editData->student->religion=='Christan'? 'selected' : ''}} value="Christan">Christan</option>

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
                                        <input type="date" name="dob" class="form-control" required value="{{ $editData->student->dob}}">
                                    </div>
                                        @error('dob')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Discount <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="discount" class="form-control" required value="{{ $editData->discount->discount}}">
                                    </div>
                                        @error('discount')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}


                        </div> {{-- 3rd row end --}}


                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Year <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="year_id" id="year_id" required class="form-control">
                                            <option value="" selected disabled>Select Year</option>

                                            @foreach ($years as $year)
                                            <option value="{{ $year->id }}" {{ $editData->year_id==$year->id ? 'selected' : ''}}>{{ $year->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                        @error('year')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}


                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Class <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="class_id" required class="form-control">
                                            <option value="" selected disabled>Select class</option>

                                            @foreach ($classes as $class)
                                            <option {{ $editData->class_id==$class->id ? 'selected' : ''}} value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                        @error('class_id')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}


                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Group <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="group_id" id="group_id" required class="form-control">
                                            <option value="" selected disabled>Select Group</option>

                                             @foreach ($groups as $group)
                                            <option {{ $editData->group_id==$group->id ? 'selected' : ''}} value="{{ $group->id }}">{{ $group->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                        @error('group_id')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}





                        </div> {{-- 4th row end --}}


                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Shift <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="shift_id" id="shift_id" required class="form-control">
                                            <option value="" selected disabled>Select shift</option>

                                            @foreach ($shifts as $shift)
                                            <option {{ $editData->shift_id==$shift->id ? 'selected' : ''}} value="{{ $shift->id }}">{{ $shift->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                        @error('shift')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                </div>
                            </div>{{-- col-md-4 end --}}


                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Class <span class="text-danger">*</span></h5>
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
                            </div>{{-- col-md-4 end --}}


                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="controls">
                                        <img id="showImage" src="{{ (!empty($editData->student->image)) ? url('upload/student_images/'. $editData->student->image) : asset('upload/no_image.jpg') }}" width="100" height="100"    alt="">

                                     </div>
                                </div>
                            </div>{{-- col-md-4 end --}}





                        </div> {{-- 5th row end --}}
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

