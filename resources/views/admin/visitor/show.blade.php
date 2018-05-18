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
                                    <th>More Info</th>
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
                                            <dt>Birthdate:</dt><dd>{{ $visitor->date }}</dd>
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
                                        @endcan
                                        <td>
                                            @can('users.delete',Auth::user())
                                                <a href="" data-visitid={{$visitor->id}} data-toggle="modal" data-target="#delete"><span
                                                            class="glyphicon glyphicon-trash"></span></a>

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
    <!-- Modal -->
    <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
                </div>
                <form action="{{route('visitor.destroy','test')}}" method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p class="text-center">
                            Are you sure you want to delete this?
                        </p>
                        <input type="hidden" name="visit_id" id="visit_id" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">No, Cancel</button>
                        <button type="submit" class="btn btn-warning">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


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
    <script>
        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var visit_id = button.data('visitid')
            var modal = $(this)
            modal.find('.modal-body #visit_id').val(visit_id);
        })
    </script>

@endsection