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
                            <h4 class="box-title">Student <strong>Marks Edit</strong></h4>
                        </div>

                        <div class="box-body">

                            <form action="{{ route('marks.entry.update')}}" method="post">
                                @csrf
                                <div class="row mb-3">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Year</h5>
                                            <div class="controls">
                                                <select name="year_id" id="year_id" required class="form-control">
                                                    <option value="" selected disabled>Select Year</option>

                                                    @foreach ($years as $year)
                                                    <option value="{{ $year->id }}">{{ $year->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            @error('year')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>{{-- col-md-3 end --}}


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Class </h5>
                                            <div class="controls">
                                                <select name="class_id" id="class_id" required class="form-control">
                                                    <option value="" selected disabled>Select Class</option>

                                                    @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            @error('class_id')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>{{-- col-md-3 Class end --}}


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Subject </h5>
                                            <div class="controls">
                                                <select name="assign_subject_id" id="assign_subject_id" required
                                                    class="form-control">
                                                    <option selected>Select Subject</option>
                                                </select>
                                            </div>
                                            @error('assign_subject_id')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>{{-- col-md-3 end --}}


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Exam Type </h5>
                                            <div class="controls">
                                                <select name="exam_type_id" id="exam_type_id" required
                                                    class="form-control">
                                                    <option value="" selected disabled>Select Exam Type</option>

                                                    @foreach ($exam_type as $exam)
                                                    <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            @error('exam_type_id')
                                            <span class="text-danger" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>{{-- col-md-3 Class end --}}


                                    <div class="col-md-3 pt-3">
                                        <a id="search" name="search" class="btn btn-rounded btn-dark mb-5">Search</a>
                                    </div>{{-- col-md-3 end --}}


                                </div> {{-- 4th row end --}}


                                {{-- ******************** Mark Entry Table ****************************--}}

                                <div class="row d-none" id="marks-entry">
                                    <div class="col-md-12">

                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID No</th>
                                                    <th>Student Name</th>
                                                    <th>Father Name</th>
                                                    <th>Gender</th>
                                                    <th>Marks</th>
                                                </tr>
                                            </thead>
                                            <tbody id="marks-entry-tr">
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

                                        <button type="submit" name="submit"
                                            class="btn btn-primary btn-round">Update</button>
                                    </div>
                                </div>





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
            var assign_subject_id = $('#assign_subject_id').val();
            var exam_type_id = $('#exam_type_id').val();

            $.ajax({
                url: "{{ route('student.edit.getStudents') }}",
                type: 'GET',
                // dataType: "json",
                data: {
                    'year_id': year_id,
                    'class_id': class_id,
                    'assign_subject_id': assign_subject_id,
                    'exam_type_id': exam_type_id,

                },
                success: function(data){
                    $('#marks-entry').removeClass('d-none');
                    var html = '';

                        data.forEach((v, key) => {
                            html += `
                                    <tr>
                                        <td>${v.student.id_no} <input type="hidden" name="student_id[]" value="${v.student_id}"> <input type="hidden" name="id_no[]" value="${v.student.id_no}"></td>
                                        <td>${v.student.name}</td>
                                        <td>${v.student.fname}</td>
                                        <td>${v.student.gender}</td>
                                        <td><input type="text" name="marks[]" value="${v.marks}" class="form-control form-control-sm"></td>
                                        </tr>
                                    `;

                        });
                    html = $('#marks-entry-tr').html(html);
                },
                error: function( error )
                {
                    alert( error );
                }
            });
        });

</script>

{{-- Get Student Subjects --}}
<script type="text/javascript">
    $(function(){
            $(document).on('change', '#class_id', function(){
                var class_id = $('#class_id').val();
                $.ajax({
                    url: "{{ route('marks.getSubject') }}",
                    type: "GET",
                    data: {class_id: class_id},
                    success: function(data){
                        var html = '<option value="">Select Subject</option>';
                        $.each(data, function(key, v){
                            html +=  `<option value="${v.id}">${v.school_subject.name}</option>`;
                        });
                        $('#assign_subject_id').html(html);
                    }
                })
            });
        });






</script>
@endsection
