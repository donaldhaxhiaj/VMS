@extends('admin.layouts.app')

@section('headSection')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

@endsection

@section('main-content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Blank page
                <small>it all starts here</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Visitors</h3>
                        <a class='col-lg-offset-5 btn btn-success' href="{{ route('visitor.create') }}">Add New</a>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>

                    </div>
                </div>
                <div class="box-body">
                    <div class="box">
                        <div class="box-header">
                            @include('includes.messages')
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>Other Info</th>
                                    @can('users.update',Auth::user())
                                    <th>Edit</th>
                                    @endcan
                                    @can('users.delete',Auth::user())
                                    <th>Delete</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($visitors as $visitor)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $visitor->name }}</td>
                                        <td>{{ $visitor->surname }}</td>
                                        <td>
                                            <a href="#" data-toggle="popover" title="Visitor Info" data-content="
                                            <dl>
                                            <dt>Gender:</dt><dd>{{ $visitor->gender }}</dd>
                                            <dt>Idnumber:</dt><dd>{{ $visitor->idnr }}</dd>
                                            <dt>Birthdate:</dt><dd>{{ $visitor->birthdate }}</dd>
                                            <dt>State:</dt><dd>{{ $visitor->state }}</dd>
                                            <dt>Email:</dt><dd>{{ $visitor->email }}</dd>
                                            <dt>Phone:</dt><dd>{{ $visitor->phone }}</dd>
                                            <dt>Comments:</dt><dd>{{ $visitor->comments }}</dd>
                                            </dl>
                                            ">
                                                <span class="glyphicon glyphicon-info-sign"></span></a>
                                        </td>
                                        @can('users.update',Auth::user())
                                            <td><a href="{{ route('visitor.edit',$visitor->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                                        <td>
                                            @endcan
                                            @can('users.delete',Auth::user())
                                            <form id="delete-form-{{ $visitor->id }}" method="post" action="{{ route('visitor.destroy',$visitor->id) }}" style="display: none">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                            <a href=""onclick="
                                                    if(confirm('Are you sure, You want to delete this?')){
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{ $visitor->id }}').submit();
                                                    }
                                                    else{
                                                        event.preventDefault();
                                                    }"><span class="glyphicon glyphicon-trash"></span></a>
                                        </td>
                                            @endcan


                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    Footer
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection

@section('footerSection')
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
            $('[data-toggle="popover"]').popover({ html: true });
        });
    </script>

@endsection