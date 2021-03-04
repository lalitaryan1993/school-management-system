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
                    <h4 class="box-title">Manage <strong>Employee Attendance Report</strong></h4>
                    </div>

                    <div class="box-body">

                        <form action="{{ route('report.attendance.get')}}" method="get" target="_blank">
                            @csrf
                            <div class="row mb-3">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Employee Name</h5>
                                        <div class="controls">
                                            <select name="employee_id" id="employee_id" required class="form-control">
                                                <option value="" selected disabled>Select Employee</option>

                                                @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}" >{{ $employee->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                            @error('employee_id')
                                                <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                    </div>
                                </div>{{-- col-md-4 end --}}

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>ID No <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="date" class="form-control" required >
                                        </div>
                                            @error('date')
                                                <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                    </div>
                                </div>{{-- col-md-4 end --}}


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

