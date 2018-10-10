@extends('admin.layouts.app')

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

        </section>
        <style>
            .btn{
                margin-bottom: 37px;
            }
        </style>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Ndrysho passwordin</h3>
                        </div>
                    <!-- /.box-header -->
                        @if (Session::has('success'))
                            @include('includes.messages')
                            <div class="alert alert-success">{!! Session::get('success') !!}</div>
                        @endif
                        @if (Session::has('failure'))
                            @include('includes.messages')
                            <div class="alert alert-danger">{!! Session::get('failure') !!}</div>
                    @endif
                        <!-- form start -->
                        <form action="{{ route('admin.password.update') }}" method="post" role="form" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Paswordi vjeter</label>

                                <div class="col-md-4">
                                    <input id="password" type="password" class="form-control" name="old">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Paswordi ri</label>

                                <div class="col-md-4">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Konfirmo Paswordin</label>

                                <div class="col-md-4">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-1 col-md-offset-4">
                                    <button type="submit" class="btn btn-success form-control">Ruaj</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </section>
    </div>

@endsection