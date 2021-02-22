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
             <h4 class="box-title">Update Fee Amount</h4>

           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <div class="row">
               <div class="col">
                   <form action="{{ route('assign.subject.update',[$editData[0]->class_id])}}" method="post" >
                    @csrf
                     <div class="row">
                       <div class="col-12">
                            <div class="add_item">
                                <div class="form-group">
                                    <h5>Class Name<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="class_id" id="class_id" required class="form-control">
                                            <option value="" selected disabled>Select Class</option>
                                        @foreach($classes as $class)
                                            <option value="{{$class->id}}" {{ ($editData[0]->class_id == $class->id) ? 'selected' : '' }}>{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @foreach($editData as $edit)
                                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Student Subject<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="subject_id[]" id="subject_id" required class="form-control">
                                                        <option value="" selected disabled>Select Subject</option>
                                                    @foreach($subjects as $subject)
                                                        <option value="{{$subject->id}}" {{ ($edit->subject_id == $subject->id) ? 'selected' : '' }}  >{{ $subject->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div> {{-- end col-md-4 --}}

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <h5>Full Mark <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="full_mark[]" class="form-control" value="{{$edit->full_mark}}"  required autocomplete="">
                                                </div>
                                                @error('full_mark')
                                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> {{-- col-md-2 end --}}

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <h5>Pass Mark <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="pass_mark[]" class="form-control" value="{{$edit->pass_mark}}"  required >
                                                </div>
                                                @error('pass_mark')
                                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> {{-- col-md-2 end --}}

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <h5>Subjective Mark <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="subjective_mark[]" class="form-control" value="{{$edit->subjective_mark}}" required >
                                                </div>
                                                @error('subjective_mark')
                                                    <span class="text-danger" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div> {{-- col-md-2 end --}}

                                        <div class="col-md-2 mt-4 p-1">
                                            <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                                            <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>

                                        </div>


                                    </div> {{-- end Row --}}


                                </div> {{-- end delete_whole_extra_item_add --}}
                                @endforeach

                            </div> {{-- add_item --}}

                                    <div class="text-xs-right">
                                        <button type="submit" name="submit" class="btn btn-rounded btn-info">Update</button>
                                    </div>


                        </div> {{-- col-12 --}}
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

<div  style="visibility: hidden;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="form-row">

                <div class="col-md-4">
                    <div class="form-group">
                        <h5>Student Subject<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <select name="subject_id[]" id="subject_id" required class="form-control">
                                <option value="" selected disabled>Select Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{$subject->id}}" >{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div> {{-- end col-md-4 --}}

                <div class="col-md-2">
                    <div class="form-group">
                        <h5>Full Mark <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="full_mark[]" class="form-control"  required >
                        </div>
                        @error('full_mark')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div> {{-- col-md-2 end --}}

                <div class="col-md-2">
                    <div class="form-group">
                        <h5>Pass Mark <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="pass_mark[]" class="form-control"  required >
                        </div>
                        @error('pass_mark')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div> {{-- col-md-2 end --}}

                <div class="col-md-2">
                    <div class="form-group">
                        <h5>Subjective Mark <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" name="subjective_mark[]" class="form-control"  required >
                        </div>
                        @error('subjective_mark')
                            <span class="text-danger" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div> {{-- col-md-2 end --}}

                <div class="col-md-2 mt-4 p-1">
                    <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>
                    <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>
                </div>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        var counter = 0;
        $(document).on('click', '.addeventmore', function() {
            var whole_extra_item_add = $('#whole_extra_item_add').html();
            $(this).closest('.add_item').append(whole_extra_item_add);
            counter++;
        });

        $(document).on('click', '.removeeventmore', function() {
            $(this).closest('.delete_whole_extra_item_add').remove();
            counter--;
        })
    });
</script>
@endsection

