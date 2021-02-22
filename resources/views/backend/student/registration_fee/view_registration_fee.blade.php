@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->



      <section class="content">
        <div class="row">

            <div class="col-12">

                <div class="box bb-3 border-warning">
                    <div class="box-header">
                    <h4 class="box-title">Student <strong>Registration Fee</strong></h4>
                    </div>

                    <div class="box-body">
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


                            {{-- ******************** Registration Fee Table ****************************--}}

                            <div class="row" >
                                <div class="col-md-12">
                                    <div id="documentResults">
                                        <script id="document-template" type="text/x-handlebars-template">
                                            <table class="table table-striped table-bordered" >
                                                <thead>
                                                    <tr>
                                                       @{{{thsource}}}
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @{{#each this}}
                                                    <tr>
                                                    @{{{tdsource}}}
                                                    </tr>
                                                    @{{/each}}
                                                </tbody>
                                            </table>

                                        </script>
                                    </div> {{-- documentResults --}}

                                </div>
                            </div>






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
                url: "{{ route('student.registration.fee.classWise') }}",
                type: 'GET',
                // dataType: "json",
                data: {'year_id': year_id, 'class_id': class_id},
                beforeSend: function(data) {

                },
                success: function(data){
                  var source = $("#document-template").html();
                  var template = Handlebars.compile(source);
                  var html = template(data);
                  $('#documentResults').html(html);
                  $('[data-toggle="tooltip"]').tooltip();
                },
                error: function( error )
                {
                    alert( error );
                }
            });
        });

    </script>
@endsection

