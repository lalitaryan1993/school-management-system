@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->



      <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box bb-3 border-warning">
                    <div class="box-header">
                    <h4 class="box-title">Manage <strong>Student ID Card</strong></h4>
                    </div>

                    <div class="box-body">

                        <form action="{{ route('report.student.IDCard.get')}}" method="get" target="_blank">
                            @csrf
                            <div class="row mb-3">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Year</h5>
                                        <div class="controls">
                                            <select name="year_id" id="year_id" required class="form-control">
                                                <option value="" selected disabled>Select Year</option>

                                                @foreach ($years as $year)
                                                <option value="{{ $year->id }}" >{{ $year->name }}</option>
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
                                            <select name="class_id" id="class_id" required class="form-control">
                                                <option value="" selected disabled>Select Class</option>

                                                @foreach ($classes as $class)
                                                <option value="{{ $class->id }}" >{{ $class->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                            @error('class_id')
                                                <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                    </div>
                                </div>{{-- col-md-4 Class end --}}



                                <div class="col-md-4 pt-4">
                                    <button type="submit" id="search" name="search" class="btn btn-rounded btn-dark mb-5">Search</button>
                                </div>{{-- col-md-4 end --}}


                            </div> {{-- 4th row end --}}


                        </form>

                    </div>
                </div>
            </div> {{-- col-12 end --}}





        </div>
    </section>


    </div>
  </div>


@endsection

