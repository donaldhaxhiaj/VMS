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
                            <h3 class="box-title">Visits</h3>
                        </div>
                    @include('includes.messages')
                    <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('visit.update',$visit->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="box-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Company Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $visit->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Visit Individuals</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="selected disable">Visit Individuals</option>
                                            <option value="Individual" @if($visit->type == 'Individual') selected="selected"@endif>Individual</option>
                                            <option value="Group" @if($visit->type == 'Group') selected="selected"@endif>Group</option>
                                            <label for="group">Grup Name</label>
                                            <input type="text" class="form-control" id="group" name="group" placeholder="Group Name" value="{{ $visit->group,$visit->type }}">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="purpose">Visit Purpose</label>
                                        <select name="purpose" id="purpose" class="form-control">
                                            <option value="selected disable">Visit Purpose</option>
                                            <option value="Queries regarding products and services">Queries regarding products and services</option>
                                            <option value="Marketing" @if($visit->purpose == 'Marketing') selected="selected"@endif>Marketing</option>
                                            <option value="Complaints" @if($visit->purpose == 'Complaints') selected="selected"@endif>Complaints</option>
                                            <option value="Job Meetings" @if($visit->purpose == 'Job Meetings') selected="selected"@endif>Job Meetings</option>
                                            <option value="Business Meetings" @if($visit->purpose == 'Business Meetings') selected="selected"@endif>Business Meetings</option>
                                            <option value="Other" @if($visit->purpose == 'Other') selected="selected"@endif>Other</option>
                                        </select>
                                        <label for="other">Other Purpose</label>
                                        <input type="text" class="form-control" id="other" name="other" placeholder="Other" value="{{ $visit->other }}">
                                    </div>
                                    <label>Will Meet</label>
                                    <select name="companies" id="companies" class="form-control">
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}"  {{ (isset($company->id) || old('id'))? "selected":"" }}>{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    <label>Add visitors</label>
                                    <select name="visitors" id="visitors" class="form-control">
                                        <option value="">Add Visitors</option>
                                        @foreach ($visitors as $visitor)
                                            <option value="{{ $visitor->id }}"  {{ (isset($visitor->id) || old('id'))? "selected":"" }}>{{ $visitor->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-group">
                                        <label for="plan">Visit Plan</label>
                                        <select name="plan" id="plan" class="form-control">
                                            <option value="selected disable">Visit Plan</option>
                                            <option value="Planned" @if($visit->plan == 'Planned') selected="selected"@endif>Planned</option>
                                            <option value="Unplanned" @if($visit->plan == 'Unplaanned') selected="selected"@endif>Unplanned</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Visit Status</label>
                                        <select name="status" id="status" class="form-control" value="{{ $visit->status }}">
                                            <option value="selected disable">Visit Status</option>
                                            <option value="Pending" @if($visit->status == 'Pending') selected="selected"@endif>Pending</option>
                                            <option value="Ongoing" @if($visit->status == 'Ongoing') selected="selected"@endif>Ongoing</option>
                                            <option value="Refused" @if($visit->status == 'Refused') selected="selected"@endif>Refused</option>
                                            <option value="Finished" @if($visit->status == 'Finished') selected="selected"@endif>Finished</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="time">Visit Starting Time</label>
                                        <input type="time" class="form-control" id="time" name="time" value="{{ $visit->time }}">
                                        <label for="endtime">Visit Ending Time</label>
                                        <input type="time" class="form-control" id="endtime" name="endtime" value="{{ $visit->endtime }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="comments">Visit Comments</label>
                                        <input type="text" class="form-control" id="comments" name="comments" placeholder="Comments" value="{{ $visit->comments }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <br>
                                    </div>
                                    <br>

                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('visit.index') }}" class="btn btn-warning">Back</a>
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