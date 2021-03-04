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
                    <h4 class="box-title">Add <strong>Employee Salary</strong></h4>
                    </div>

                    <div class="box-body">


                            <div class="row mb-3">




                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Date </h5>
                                        <div class="controls">
                                            <input type="date" name="date" id="date" class="form-control" required>
                                        </div>

                                            @error('date')
                                                <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                    </div>
                                </div>{{-- col-md-3 Class end --}}



                                <div class="col-md-6 pt-3">
                                    <a id="search" name="search" class="btn btn-rounded btn-dark mb-5">Search</a>
                                </div>{{-- col-md-3 end --}}


                            </div> {{-- 4th row end --}}


                            {{-- ******************** Add Employee Salary Table ****************************--}}


                             <div class="row" >
                                <div class="col-md-12">
                                    <div id="documentResults">
                                        <script id="document-template" type="text/x-handlebars-template">
                                            <form action="{{ route('account.salary.store') }}" method="post">
                                                @csrf
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
                                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                            </form>
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

        var date = $('#date').val();

        $.ajax({
            url: "{{ route('account.salary.getEmployee') }}",
            type: 'GET',
            // dataType: "json",
            data: {  'date': date },
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

