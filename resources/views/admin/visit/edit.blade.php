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
                                    <table class="table no-margin text-center">
                                        <thead>
                                        <tr>
                                            <th>Visitor ID</th>
                                            <th>Visitor Name</th>
                                            <th>Comming from</th>
                                            <th>Will meet</th>
                                        </tr>
                                        </thead>
                                        <tbody id="addVisitors">

                                        </tbody>
                                        {{--<input type="hidden" name="visitVisitors[]" value="5" />--}}
                                    </table>

                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target-id="1" data-target="#myModal">Add Visitors</button>

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
                                    <div class="bootstrap-iso">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="">
                                                    <!-- Form code begins -->
                                                    <div class="form-group"> <!-- Date input -->
                                                        <label class="control-label" for="date">Date</label>
                                                        <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" value="{{ $visit->date }}" type="text"/>
                                                    </div>
                                                    <!-- Form code ends -->
                                                </div>
                                            </div>
                                        </div>
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
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group" style="margin-top:18px;">
                        <label>Select Visitors</label>
                        <select class="form-control select2 select2-hidden-accessible" id="selectVisitor" data-placeholder="Select a Visitor" style="width: 100%;" tabindex="-1" aria-hidden="true" name="visitor">
                            <option></option>
                            @foreach ($visitors as $visitor)
                                <option value="{{ $visitor->id }}">{{ $visitor->name }} {{ $visitor->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="commingfrom">Coming from</label>
                        <input name="commingfrom" type="text" id="commingfrom" class="form-control" value="{{$visit->commingfrom}}" />
                    </div>
                    <div class="form-group">
                        <label>Will Meet</label>
                        <select name="companies" id="companies" class="form-control">
                            <option value=""> Select</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveVisitor">Save changes</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footerSection')
    <script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>

    <script>
        $('#saveVisitor').click( function () {
            var modal = $('#myModal');
            var visitorId = modal.find('#selectVisitor');
            var commingfrom = modal.find('#commingfrom');
            var companies = modal.find('#companies');

            $('#addVisitors').append('<tr><td>' + visitorId.val()+ '</td><td>' + visitorId.select2('data')[0].text + '</td><td>' + commingfrom.val() + '</td><td>' +companies.val() + '</td></tr>');
            $('#addVisitors').append('<input type="hidden" name=visitVisitors[] value="' + visitorId.val() + '"/>');
            visitorId.val('');
            commingfrom.val('');
            companies.val('');
            modal.modal('hide');
        })
    </script>

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