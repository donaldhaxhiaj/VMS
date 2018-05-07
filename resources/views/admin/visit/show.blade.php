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
                    <h3 class="box-title">Visits</h3>
                    <a class='col-lg-offset-5 btn btn-success' href="{{ route('visit.create') }}">Add New</a>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
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
                                    <th>Company Name</th>
                                    <th>Will Meet</th>
                                    <th>Visitors</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Time</th>
                                    <th>End Time</th>
                                    @can('visits.update',Auth::user())
                                        <th>Edit</th>
                                    @endcan
                                    @can('visits.delete',Auth::user())
                                        <th>Delete</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($visits as $visit)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $visit->name }}</td>
                                        <td> @foreach ($visit->companies as $company)
                                                {{ $company->name }}
                                            @endforeach
                                        </td>
                                        <td> @foreach ($visit->visitors as $visitor)
                                                {{ $visitor->name }}
                                            @endforeach
                                        </td>
                                        <td>{{ $visit->type }}</td>
                                        <td>{{ $visit->status}}</td>
                                        <td>{{ $visit->time}}</td>
                                        <td>{{ $visit->endtime}}</td>
                                        @can('visits.update',Auth::user())
                                            <td><a href="{{ route('visit.edit',$visit->id) }}"><span
                                                            class="glyphicon glyphicon-edit"></span></a></td>
                                        @endcan
                                        @can('visits.delete',Auth::user())
                                            <td>
                                                <form id="delete-form-{{ $visit->id }}" method="post"
                                                      action="{{ route('visit.destroy',$visit->id) }}"
                                                      style="display: none">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                                <a href="" onclick="
                                                        if(confirm('Are you sure, You want to delete this?')){
                                                        event.preventDefault();
                                                        document.getElementById('delete-form-{{ $visit->id }}').submit();
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
        });
    </script>

@endsection