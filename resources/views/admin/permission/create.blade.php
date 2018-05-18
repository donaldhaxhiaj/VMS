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
                            <h3 class="box-title">Permissions</h3>
                        </div>
                    @include('includes.messages')
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('permission.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="col-lg-offset-3 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Permission</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Permission">
                                    </div>

                                    <div class="form-group">
                                        <label for="for">Permission for</label>
                                        <select name="for" id="for" class="form-control">
                                            <option value="selected disable">Select Permission for</option>
                                            <option value="user">User</option>
                                            <option value="visitor">Visitor</option>
                                            <option value="companies">Visit</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('permission.index') }}" class="btn btn-warning">Back</a>
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