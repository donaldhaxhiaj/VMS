@extends('admin.layouts.app')

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
                            <h3 class="box-title">Edito Kompanine</h3>
                        </div>
                    @include('includes.messages')
                    <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('company.update',$company->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="box-body">
                                <div class="col-lg-offset-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Emri kompanise</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Company Name" value="{{ $company->name }}">
                                    </div>

                                    <div class="form-group {{ $errors->has('ptm') ? ' has-error' : '' }}">
                                        <label for="ptm">Personi qe do takoj</label>
                                        <input type="text" class="form-control" id="ptm" name="ptm" placeholder="Person To Meet" value="{{ $company->ptm }}">
                                        @if ($errors->has('ptm'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('ptm') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="cel">Cel</label>
                                        <input type="number" class="form-control" id="cel" name="cel" value="{{ $company->cel }}">
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Ruaj</button>
                                        <a href="{{ route('company.index') }}" class="btn btn-warning">Mbrapa</a>
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