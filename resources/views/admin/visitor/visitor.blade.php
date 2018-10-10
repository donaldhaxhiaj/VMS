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
                            <h3 class="box-title">Vizitoret</h3>
                            <button type="button" id="read-manual-btn" data-loading-text="Duke skanuar..." class="btn btn-info pull-right"><i class="fa fa-id-card" aria-hidden="true"></i>
                                Lexo nga Skaner</button>
                        </div>

                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('visitor.store') }}" method="post" id="visitor_form">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name">Emri<sup style="color: red">*</sup></label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Emri" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('surname') ? ' has-error' : '' }}">
                                    <label for="surname">Mbiemri<sup style="color: red">*</sup></label>
                                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="{{ old('surname') }}">
                                    @if ($errors->has('surname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                    <div class="form-group {{ $errors->has('idnr') ? ' has-error' : '' }}">
                                        <label for="idnr">Nr.id e vizitorit<sup style="color: red">*</sup></label>
                                        <input type="text" class="form-control" id="idnr" name="idnr" placeholder="Numri i kartes identitetit" value="{{ old('idnr') }}">
                                        @if ($errors->has('idnr'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('idnr') }}</strong>
                                    </span>
                                        @endif
                                    </div>

                                <div class="form-group">
                                      <label for="gender">Gjinia</label>
                                      <select name="gender" id="gender" class="form-control">
                                            <option value="None">-- Zgjidhni gjinine --</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Tjeter</option>
                                      </select>
                                </div>
                                <div class="form-group">
                                      <label for="state">Shtetesia</label>
                                      <input type="text" class="form-control" id="state" name="state" placeholder="State" value="{{ old('state') }}">
                                </div>
                                <label for="email">Email</label>
                                <div class="input-group">
                                    <span class="input-group-addon">@</span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="visitor@domain.com" value="{{ old('email') }}">
                                </div>
                                <br>
                                <div class="form-group">
                                      <label for="phone">Cel</label>
                                      <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                                </div>

                                <div class="form-group">
                                      <label for="comments">Komente</label>
                                    <textarea name="comments" id="comments" class="xlarge form-control"
                                              style="margin: 0px 332.656px 0px 0px;"></textarea>
                                </div>

                                    <div class="form-group hidden">
                                        <label for="confirm_passowrd">Status</label>
                                        <div class="checkbox">
                                            <label ><input type="checkbox" name="status" @if (old('status') == 0)
                                                checked
                                                           @endif value="1">Status</label>
                                        </div>
                                    </div>

                            </div>
                            </div>
                            <br>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Ruaj</button>
                                <a href="{{ route('visitor.index') }}" class="btn btn-warning">Mbrapa</a>
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
    <script src="{{ asset('admin/plugins/CPScanID/src/jquery.cpscanid.js') }}"></script>
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
        });

        $(function(){
            $("input[name=name]")[0].oninvalid = function () {
                this.setCustomValidity("Kerkohet emri.");
                this.setCustomValidity("");
            };
        });


            $(".select2").select2();


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

                        if(data[10120].Value){
                            $('#gender').val(data[10120].Value == "M"? "Male":data[10120].Value == "F"?"Female":"None")
                        }

                        if(data[10132].Value){
                            $('#state').val(Nationalities[data[10132].Value]?Nationalities[data[10132].Value]:data[10132].Value);
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
                        alert("Ka ndodhur nje gabim");

                    },
                    callbackDisconnect: function () {
                        console.log("Skaneri u shkeput");
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
                var btn = $(this);
                btn.button('loading');
                setTimeout(function () {
                    btn.button('reset');
                }, 2000);
                try{
                    $('#visitor_form')[0].reset();

                    $.CPScanID.read();
                } catch(err){
                    if(err=="NOT_INITIATED"){
                        alert("Libraria nuk eshte inicializuar ende");
                    }
                }
        })



    </script>
@endsection