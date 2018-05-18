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
                            <h3 class="box-title">Visitors</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('visitor.store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name">Visitor Name<sup>*</sup></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('surname') ? ' has-error' : '' }}">
                                    <label for="surname">Visitor Surname<sup>*</sup></label>
                                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="{{ old('surname') }}">
                                    @if ($errors->has('surname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label for="idnr">Visitor ID.nr<sup>*</sup></label>
                                <div class="input-group input-group-sm {{ $errors->has('idnr') ? ' has-error' : '' }}">
                                    <input type="text" class="form-control" id="idnr" name="idnr" placeholder="Id.nr" value="{{ old('idnr') }}">
                                        @if ($errors->has('idnr'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('idnr') }}</strong>
                                            </span>
                                        @endif
                                    <span class="input-group-btn">
                                      <button type="button" id="read-manual-btn" class="btn btn-info btn-flat">Start Scanning</button>
                                    </span>
                                </div>
                                <br>
                                <div class="form-group"> <!-- Date input -->
                                    <label class="control-label" for="date">Birth Date</label>
                                    <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
                                </div>
                                <div class="form-group">
                                      <label for="gender">Gender</label>
                                      <select name="gender" id="gender" class="form-control">
                                            <option value="Not Specified">Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                      </select>
                                </div>
                                <div class="form-group">
                                      <label for="state">State</label>
                                      <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{ old('state') }}">
                                </div>
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="visitor@domain.com" value="{{ old('email') }}">
                                </div>
                                <br>
                                <div class="form-group">
                                      <label for="phone">Phone</label>
                                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                                </div>
                                <div class="form-group">
                                      <label for="comments">Visitor Comments</label>
                                      <input type="text" class="form-control" id="comments" name="comments" placeholder="Comments" value="{{ old('comments') }}">
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

    <script src="{{ asset('admin/plugins/CPScanID/src/jquery.cpscanid.js') }}"></script>

    <script>
        $(document).ready(function () {
            try{
                $.CPScanID.init({
                    callbackReadSuccess: function (data) {
                        console.log("SUCCESS: ", data);

                        if (data[10102].Value) {
                            $('#name').val(data[10102].Value);
                        }

                        if (data[10103].Value) {
                            $('#surname').val(data[10103].Value);
                        }

                        if (data[10161].Value) {
                            $('#idnr').val(data[10161].Value);
                        }

                        if (data[10113].Value) {
                            var datestr = data[10113].Value;
                        }
                        var year        = datestr.substring(0,2);
                        var month       = datestr.substring(2,4);
                        var day         = datestr.substring(4,6);

                        year = year > (new Date()).getFullYear().toString().substring(2,4) ? '19' + year : '20' + year;

                        $('#date').val(day + '/' + month + '/' + year);

                    },
                    callbackReadFail: function (data) {
                        console.log("Fail: ", data);
                        alert("There is an error");

                    },
                    callbackDisconnect: function () {
                        console.log("Disconnected");
                    }
                });
            } catch(err){
                switch(err){
                    case "IS_INITIATED": alert("Eshte inicializuar nje here!");break;
                    case "EXTENSION_NOT_FOUND": alert("Duhet instaluar extension, vizitoni url-ne: "+$.CPScanID.getExtensionUrl());break;
                    default: alert("Ka ndodhur nje gabim");
                }
            }

            $("#read-manual-btn").on("click", function () {
                try{
                    $.CPScanID.read();
                } catch(err){
                    if(err=="NOT_INITIATED"){
                        alert("Libraria nuk eshte inicializuar ende");
                    }
                }
            });

        })
    </script>
@endsection