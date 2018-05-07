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
                        <form role="form" action="{{ route('visit.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Company Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Visit Individuals</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="selected disable">Visit Individuals</option>
                                            <option value="Individual">Individual</option>
                                            <option value="Group">Group</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="purpose">Visit Purpose</label>
                                        <select name="purpose" id="purpose" class="form-control">
                                            <option value="selected disable">Visit Purpose</option>
                                            <option value="Queries regarding products and services">Queries regarding products and services</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Complaints">Complaints</option>
                                            <option value="Job Meetings">Job Meetings</option>
                                            <option value="Bussines Meetings">Bussines Meetings</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <label for="other">Other Purpose</label>
                                        <input type="text" class="form-control" id="otherpurpose" name="otherpurpose" placeholder="Purpose">
                                    </div>
                                    <label>Will Meet</label>
                                    <select name="companies" id="companies" class="form-control">
                                        <option value=""> Select</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="form-group" style="margin-top:18px;">
                                        <label>Select Visitors</label>
                                        <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true" name="tags[]">
                                            @foreach ($visitors as $visitor)
                                                <option value="{{ $visitor->id }}">{{ $visitor->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="plan">Visit Plan</label>
                                        <select name="plan" id="plan" class="form-control">
                                            <option value="selected disable">Visit Plan</option>
                                            <option value="Planned">Planned</option>
                                            <option value="Unplanned">Unplanned</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Visit Status</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="selected disable">Visit Status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Ongoing">Ongoing</option>
                                            <option value="Refused">Refused</option>
                                            <option value="Finished">Finished</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="time">Visit Starting Time</label>
                                        <input type="time" class="form-control" id="time" name="time">
                                        <label for="endtime">Visit Ending Time</label>
                                        <input type="time" class="form-control" id="endtime" name="endtime">
                                    </div>
                                    <div class="form-group">
                                        <label for="comments">Visit Comments</label>
                                        <input type="text" class="form-control" id="comments" name="comments" placeholder="Comments">
                                    </div>

                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="submit" class="btn btn-primary" name="startVisit"  value="start-visit" style="background-color: #5ab738">Submit & Start</button>
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
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>
@endsection