@extends('admin.layouts.app')

@section('headSection')

    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">

@endsection

@section('main-content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @include('admin.layouts.pagehead')
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
                            <h3 class="box-title">Visitors</h3>
                        </div>
                        @include('includes.messages')
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('visitor.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="title">Visitor Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="subtitle">Visitor Surname</label>
                                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname">
                                </div>
                                <div class="form-group">
                                      <label for="idnr">Visitor ID.nr</label>
                                      <input type="text" class="form-control" id="idnr" name="idnr" placeholder="Id.nr">
                                </div>
                                <div class="form-group">
                                      <label for="birthdate">Visitor Birth Date</label>
                                      <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Birth Date">
                                </div>
                                <div class="form-group">
                                      <label for="gender">Gender</label>
                                      <select name="gender" id="gender" class="form-control">
                                            <option value="selected disable">Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                      </select>
                                </div>
                                <div class="-group">
                                      <label for="state">State</label>
                                      <input type="text" class="form-control" id="state" name="state" placeholder="State">
                                </div>
                                <div class="input-group-addon">
                                      <label for="email">Email</label>
                                         <span class="input-group-addon">@</span>
                                      <input  type="email" class="form-control" id="email" name="email"  placeholder="visitor@domain.com">
                                </div>
                                    <br>
                                <div class="form-group">
                                      <label for="phone">Phone</label>
                                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                      <label for="comments">Visitor Comments</label>
                                      <input type="text" class="form-control" id="comments" name="comments" placeholder="Comments">
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