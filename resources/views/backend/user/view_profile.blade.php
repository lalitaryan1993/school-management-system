@extends('admin.admin_master')

@section('admin')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->



        <section class="content">
            <div class="row">

                <div class="col-12">

                    <!-- /.box -->
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-black" style="background: {{asset(url('images/gallery/full/10.jpg'))}} center center;">
                            <h3 class="widget-user-username">User Name: {{ $user->name }}</h3>
                            <a href="{{ route('profile.edit')}}" class="btn btn-success btn-rounded mb-5 float-right">Edit Profile</a>
                            <h6 class="widget-user-desc">User Type: {{ $user->user_type }}</h6>
                            <h6 class="widget-user-desc">User Email: {{ $user->email }}</h6>

                        </div>
                        <div class="widget-user-image">
                        <img class="rounded-circle" src="{{ (!empty($user->image)) ? url('upload/user_images/'. $user->image) : asset('upload/no_image.jpg') }}" alt="User Avatar" >
                        </div>
                        <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">Mobile</h5>
                                <span class="description-text">{{ $user->mobile}}</span>
                            </div>
                            <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 br-1 bl-1">
                            <div class="description-block">
                                <h5 class="description-header">Address</h5>
                                <span class="description-text">{{ $user->address}}</span>
                            </div>
                            <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">Gender</h5>
                                <span class="description-text">{{ $user->gender}}</span>
                            </div>
                            <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        </div>
                    </div>

                </div>
            </div>
        </section> {{-- content --}}


    </div>{{-- container-full --}}
  </div> {{-- content-wrapper --}}

@endsection

