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
                            <h3 class="box-title">Perdoruesit</h3>
                        </div>
                    @include('includes.messages')
                    <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('user.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="col-lg-offset-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Emri</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="User Name" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Cel</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Paswordi</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation">Konfirmo Paswordin</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="confirm password">
                                    </div>

                                    <div class="form-group">
                                      <label for="confirm_passowrd">Statusi</label>
                                      <div class="checkbox">
                                        <label ><input type="checkbox" name="status" @if (old('status') == 1)
                                          checked
                                          @endif value="1">Status</label>
                                      </div>
                                  </div>

                                    

                                    <div class="form-group">
                                        <label>Zgjidh Rolin</label>
                                        <div class="row">
                                            @foreach ($roles as $role)
                                                <div class="col-lg-3">
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="role[]" value="{{ $role->id }}"> {{ $role->name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Ruaj</button>
                                        <a href="{{ route('user.index') }}" class="btn btn-warning">Mbrapa</a>
                                    </div>


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