@extends('admin.layouts.app')

@section('headSection')

    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">

@endsection

@section('main-content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Titles</h3>
                        </div>
                    <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('visitor.update',$visitor->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="box-body">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name">Visitor Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $visitor->name }}">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('surname') ? ' has-error' : '' }}">
                                        <label for="surname">Visitor Surname</label>
                                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="{{ $visitor->surname }}">
                                        @if ($errors->has('surname'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('idnr') ? ' has-error' : '' }}">
                                        <label for="idnr">Visitor ID.nr</label>
                                        <input type="text" class="form-control" id="idnr" name="idnr" placeholder="Id.nr" value="{{ $visitor->idnr }}">
                                        @if ($errors->has('idnr'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('idnr') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="bootstrap-iso">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="">
                                                    <!-- Form code begins -->
                                                    <div class="form-group"> <!-- Date input -->
                                                        <label class="control-label" for="date">Birth Date</label>
                                                        <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" value="{{ $visitor->date }}" type="text"/>
                                                    </div>
                                                    <!-- Form code ends -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="selected disable">Gender</option>
                                            <option value="Male" @if($visitor->gender == 'Male') selected="selected"@endif>Male</option>
                                            <option value="Female" @if($visitor->gender == 'Female') selected="selected"@endif>>Female</option>
                                            <option value="Other" @if($visitor->gender == 'Other') selected="selected"@endif>>Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{ $visitor->state }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="visitor@domain.com" value="{{ $visitor->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number"  value="{{ $visitor->phone }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="comments">Visitor Comments</label>
                                        <input type="text" class="form-control" id="comments" name="comments" placeholder="Comments"  value="{{ $visitor->comments }}">
                                    </div>

                                </div>

                            </div>
                            <br>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('visitor.index') }}" class="btn btn-warning">Back</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection

@section('footerSection')
    <script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            var date_input=$('input[name="date"]'); //our date input has the name "date"
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            })
        })
    </script>
    <script>
        $(document).ready(function () {
            $(".select2").select2();
        });
    </script>
@endsection