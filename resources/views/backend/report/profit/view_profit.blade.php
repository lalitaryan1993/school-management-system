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
                    <h4 class="box-title">Manage <strong>Monthly/Yearly Profit</strong></h4>
                    </div>

                    <div class="box-body">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Start Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                                        </div>
                                            @error('start_date')
                                                <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                    </div>
                                </div>{{-- End col-md-4 --}}

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>End Date <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                                        </div>
                                            @error('end_date')
                                                <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                    </div>
                                </div>{{-- End col-md-4 --}}






                                <div class="col-md-4 pt-4">
                                    <a id="search" name="search" class="btn btn-rounded btn-dark mb-5">Search</a>
                                </div>{{-- col-md-4 end --}}


                            </div> {{-- 4th row end --}}


                            {{-- ******************** Monthly Salary Table ****************************--}}

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

                                                    <tr>
                                                    @{{{tdsource}}}
                                                    </tr>
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

            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();

            $.ajax({
                url: "{{ route('monthly.profit.dateWise') }}",
                type: 'GET',
                // dataType: "json",
                data: {
                    'start_date': start_date,
                    'end_date': end_date,

                },
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

