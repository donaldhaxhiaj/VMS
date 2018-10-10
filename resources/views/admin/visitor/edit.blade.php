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
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('visitor.update',$visitor->id) }}" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="box-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Emri</label>
                                        <br><span readonly>{{ $visitor->name }}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('surname') ? ' has-error' : '' }}">
                                        <label for="surname">Mbiemri</label>
                                        <input type="text" class="form-control" id="surname" name="surname"
                                               placeholder="Surname" value="{{ $visitor->surname }}">
                                        @if ($errors->has('surname'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="idnr">Nr.id e vizitorit</label>
                                        <br><span>{{ $visitor->idnr }}</span>
                                    </div>
                                    <div class="bootstrap-iso">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="">
                                                    <!-- Form code begins -->
                                                    <div class="form-group"> <!-- Date input -->
                                                        <label class="control-label" for="date">Datelindja</label>
                                                        <br><span readonly>{{ $visitor->date }}</span>
                                                    </div>
                                                    <!-- Form code ends -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gjinia</label>
                                        <br><span readonly>{{ $visitor->gender }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="state">Shtetesia</label>
                                        <br><span readonly>{{ $visitor->state }}</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="visitor@domain.com" value="{{ $visitor->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Cel</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                               placeholder="Phone Number" value="{{ $visitor->phone }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="comments">Komente</label>
                                        @if($visitor->comments == null)
                                            <br>
                                            <span>Ska komente</span>
                                        @else
                                            <br>
                                            <pre>{{ $visitor->comments }}</pre>
                                    </div>
                                    @endif
                                </div>

                            <br>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Ruaj</button>
                                <a href="{{ route('visitor.index') }}" class="btn btn-warning">Mbrapa</a>
                            </div>
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
        $(function () {
            var date_input = $('input[name="date"]'); //our date input has the name "date"
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            })
        })
        $(".select2").select2();

    </script>
@endsection