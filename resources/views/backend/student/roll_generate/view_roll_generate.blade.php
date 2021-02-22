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
                    <h4 class="box-title">Student <strong>Roll Generator</strong></h4>
                    </div>

                    <div class="box-body">

                        <form action="{{ route('roll.generate.store')}}" method="post">
                            @csrf
                            <div class="row">

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
                                                <option value="" selected disabled>Select class</option>

                                                @foreach ($classes as $class)
                                                <option value="{{ $class->id }}" >{{ $class->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                            @error('class_id')
                                                <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                    </div>
                                </div>{{-- col-md-4 end --}}


                                <div class="col-md-4 pt-4">
                                    <a id="search" name="search" class="btn btn-rounded btn-dark mb-5">Search</a>
                                </div>{{-- col-md-4 end --}}


                            </div> {{-- 4th row end --}}


                            {{-- ******************** Roll Generate Table ****************************--}}

                            <div class="row d-none" id="roll-generate">
                                <div class="col-md-12">

                                    <table class="table table-striped table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>ID No</th>
                                                <th>Student Name</th>
                                                <th>Father Name</th>
                                                <th>Gender</th>
                                                <th>Roll</th>
                                            </tr>
                                        </thead>
                                        <tbody id="roll-generate-tr">
                                            <tr>
                                                <td scope="row"></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td scope="row"></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-info">Roll Generator</button>



                        </form>

                    </div>
                </div>
            </div> {{-- col-12 end --}}





        </div>
    </section>


    </div>
  </div>

    <script type="text/javascript">
        $(document).on('click', '#search', function() {

            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();

            $.ajax({
                url: "{{ route('student.registration.getStudents') }}",
                type: 'GET',
                // dataType: "json",
                data: {'year_id': year_id, 'class_id': class_id},
                success: function(data){
                    $('#roll-generate').removeClass('d-none');
                    var html = '';

                    // alert(data);
                    // // $.each((data), function(key, v){
                    // //     alert('hiii');

                    // // });
                    // data.forEach((key,v) => console.log(key, v))
                    // console.log(data);
                        data.forEach((v, key) => {
                            html += `
                                    <tr>
                                        <td>${v.student.id_no} <input type="hidden" name="student_id[]" value="${v.student_id}"></td>
                                        <td>${v.student.name}</td>
                                        <td>${v.student.fname}</td>
                                        <td>${v.student.gender}</td>
                                        <td><input type="text" name="roll[]" value="${v.roll}" class="form-control form-control-sm"></td>
                                        </tr>
                                    `;

                        });
                    html = $('#roll-generate-tr').html(html);
                },
                error: function( error )
                {
                    alert( error );
                }
            });
        });

    </script>
@endsection

