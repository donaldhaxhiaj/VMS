@extends('admin.layouts.app')

@section('headSection')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
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
                    <h3 class="box-title">Qellimet e vizites</h3>
                    <a class='col-lg-offset-5 btn btn-success pull-right' href="{{ route('purpose.create') }}">Krijo</a>
                </div>
                 <div class="box-body">
                    <div class="box">
                        <div class="box-header">
                            @include('includes.messages')
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-condensed">
                                <thead>
                                <tr>
                                    <th>Id.nr</th>
                                    <th>Emri qellimit</th>
                                    <th>Edito</th>
                                    <th>Fshi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($purposes as $purpose)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $purpose->name }}</td>
                                    <td><a href="{{ route('purpose.edit',$purpose->id) }}" class="btn btn-sm btn-warning"><span
                                                    class="glyphicon glyphicon-edit"></span></a></td>
                                    <td>
                                        <a href="" data-visitid={{$purpose->id}} data-toggle="modal" data-target="#delete" class="btn btn-sm btn-danger"><span
                                                    class="glyphicon glyphicon-trash"></span></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box-body -->

                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="myModalLabel">Konfirmim</h4>
                </div>
                <form action="{{route('purpose.destroy','test')}}" method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p class="text-center">
                            Jeni te sigurt qe doni ta fshini?
                        </p>
                        <input type="hidden" name="visit_id" id="visit_id" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Anullo</button>
                        <button type="submit" class="btn btn-danger">Konfirmo</button>
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
            $("#example1").DataTable({
                "language": {
                    "search": "Kerko:",
                    "sLengthMenu": "Shfaq _MENU_ Rreshta",
                    "info": "Duke shfaqur _START_ deri ne _END_ nga _TOTAL_ regjistrime",
                    "oPaginate": {
                        "sNext": "Para",
                        "sPrevious": "Mbrapa"
                    }
                }
            });
        });
    </script>

    <script>
        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var visit_id = button.data('visitid');
            var modal = $(this);
            modal.find('.modal-body #visit_id').val(visit_id);
        })
    </script>

@endsection