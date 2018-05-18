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
                            <h3 class="box-title">Roles</h3>
                        </div>
                    @include('includes.messages')
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('role.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="col-lg-offset-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Role Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Role Name">
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-4">
                                        <label for="name">Visitors Permissions</label>
                                        @foreach ($permissions as $permission)
                                            @if ($permission->for == 'visitor')
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>

                                    <div class="col-lg-4">
                                        <label for="name">User Permissions</label>
                                        @foreach ($permissions as $permission)
                                            @if ($permission->for == 'user')
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                            @endif
                                        @endforeach

                                    </div>

                                    <div class="col-lg-4">
                                        <label for="name">Other Permissions</label>
                                        @foreach ($permissions as $permission)
                                            @if ($permission->for == 'other')
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Visit Permissions</label>
                                        @foreach ($permissions as $permission)
                                            @if ($permission->for == 'visit')
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('role.index') }}" class="btn btn-warning">Back</a>
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