@extends('admin.layouts.app')

@section('headSection')

    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">

@endsection

@section('main-content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Text Editors
                <small>Advanced form element</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Editors</li>
            </ol>
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
                    @include('includes.messages')
                    <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('visitor.update',$visitor->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="box-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="title">Visitor Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $visitor->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="subtitle">Visitor Surname</label>
                                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="{{ $visitor->surname }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="idnr">Visitor ID.nr</label>
                                        <input type="text" class="form-control" id="idnr" name="idnr" placeholder="Id.nr" value="{{ $visitor->idnr }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="company">Company Name</label>
                                        <input type="text" class="form-control" id="company" name="company" placeholder="Company Name" value="{{ $visitor->company }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="birthdate">Visitor Birth Date</label>
                                        <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Birth Date" value="{{ $visitor->birthdate }}">
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
    <script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1');
            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
        });
    </script>
    <script>
        $(document).ready(function () {
            $(".select2").select2();
        });
    </script>
@endsection