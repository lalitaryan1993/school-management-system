@extends('admin.admin_master')

@section('admin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->



      <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box bb-3 border-warning">
                    <div class="box-header">
                    <h4 class="box-title">Student <strong>Search</strong></h4>
                    </div>

                    <div class="box-body">

                        <form action="{{ route('student.year.class.wise')}}" method="get">

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Year</h5>
                                        <div class="controls">
                                            <select name="year_id" id="year_id" required class="form-control">
                                                <option value="" selected disabled>Select Year</option>

                                                @foreach ($years as $year)
                                                <option value="{{ $year->id }}" {{ $year->id == $year_id ? 'selected' : '' }}>{{ $year->name }}</option>
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
                                        <h5>Class </h5>
                                        <div class="controls">
                                            <select name="class_id" required class="form-control">
                                                <option value="" selected disabled>Select class</option>

                                                @foreach ($classes as $class)
                                                <option value="{{ $class->id }}" {{ $class->id == $class_id ? 'selected' : '' }}>{{ $class->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                            @error('class_id')
                                                <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                    </div>
                                </div>{{-- col-md-4 end --}}


                                <div class="col-md-4 pt-4">
                                    <button type="submit" name="search" class="btn btn-rounded btn-dark mb-5">Search</button>
                                </div>{{-- col-md-4 end --}}





                            </div> {{-- 4th row end --}}
                        </form>

                    </div>
                </div>
            </div> {{-- col-12 end --}}




            <div class="col-12">

                <div class="box">
                   <div class="box-header with-border">
                     <h3 class="box-title">Student List</h3>
                     <a href="{{ route('student.registration.add')}}" class="btn btn-success btn-rounded mb-5 float-right">Add Student</a>
                   </div>
                   <!-- /.box-header -->
                   <div class="box-body">
                       <div class="table-responsive">

                        @if (!@search)
                         <table id="example1" class="table table-bordered table-striped">
                           <thead>
                               <tr>
                                   <th>SL</th>
                                   <th>Name</th>
                                   <th>Id.No</th>
                                   <th>Roll</th>
                                   <th>Year</th>
                                   <th>Class</th>
                                   <th>Image</th>
                                   @if(Auth::user()->role == 'Admin')
                                   <th>Code</th>
                                   @endif
                                   <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allData as $key => $value)
                                <tr>
                                    <td width="5%">{{ $key +1}}</td>
                                    <td>{{ $value->student->name }}</td>
                                    <td>{{ $value->student->id_no }}</td>
                                    <td>{{ $value->roll }}</td>
                                    <td>{{ $value->student_year->name }}</td>
                                    <td>{{ $value->student_class->name }}</td>
                                    <td><img src="{{ (!empty($value->student->image)) ? url('upload/student_images/'. $value->student->image) : asset('upload/no_image.jpg') }}" width="50" height="50"    alt="">
                                    </td>
                                    <td>{{ $value->student->code }}</td>

                                    <td width="25%">
                                        <a title="Edit" href="{{ route('student.registration.edit', [$value->student_id]) }}" class="btn btn-info">Edit</a>
                                        <a title="Promotion" href="{{ route('student.registration.promotion', [$value->student_id]) }}" class="btn btn-success" ><i class="fa fa-check" aria-hidden="true"></i></a>
                                         <a target="_blank" title="Details" href="{{ route('student.registration.details', [$value->student_id]) }}" class="btn btn-warning" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>

                         </table>

                         @else
                         <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Id.No</th>
                                    <th>Roll</th>
                                    <th>Year</th>
                                    <th>Class</th>
                                    <th>Image</th>
                                    @if(Auth::user()->role == 'Admin')
                                    <th>Code</th>
                                    @endif
                                    <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach($allData as $key => $value)
                                 <tr>
                                     <td width="5%">{{ $key +1}}</td>
                                     <td>{{ $value->student->name }}</td>
                                     <td>{{ $value->student->id_no }}</td>
                                     <td>{{ $value->roll }}</td>
                                     <td>{{ $value->student_year->name }}</td>
                                     <td>{{ $value->student_class->name }}</td>
                                     <td><img src="{{ (!empty($value->student->image)) ? url('upload/student_images/'. $value->student->image) : asset('upload/no_image.jpg') }}" width="50" height="50"    alt="">
                                     </td>
                                     <td>{{ $value->student->code }}</td>

                                     <td width="25%">
                                         <a title="Edit" href="{{ route('student.registration.edit', [$value->student_id]) }}" class="btn btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                         <a title="Promotion" href="{{ route('student.registration.promotion', [$value->student_id]) }}" class="btn btn-success" ><i class="fa fa-check" aria-hidden="true"></i></a>
                                         <a target="_blank" title="Details" href="{{ route('student.registration.details', [$value->student_id]) }}" class="btn btn-warning" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                                     </td>
                                 </tr>
                                 @endforeach

                             </tbody>

                          </table>
                         @endif
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

