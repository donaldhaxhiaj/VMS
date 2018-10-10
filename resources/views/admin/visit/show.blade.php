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
                    <h3 class="box-title">Vizitat</h3>
                    <a class='col-lg-offset-5 btn btn-success pull-right' href="{{ route('visit.create') }}"><span class="glyphicon glyphicon-plus"></span> Regjistro</a>
                </div>
                <div class="box-body">
                    <div class="box">
                        <div class="box-header">
                            @include('includes.messages')
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                        <div class="form-inline">
                            <div class="form-group ">
                                <label for="FilterStatus">Statusi</label>
                                <select name="FilterStatus" id="FilterStatus" class="form-control">
                                    <option value="">---Zgjidh---</option>
                                    <option value="Aktive">Aktive</option>
                                    <option value="Perfunduar">Perfunduar</option>
                                    <option value="Ne pritje">Ne pritje</option>
                                    <option value="Refuzuar">Refuzuar</option>
                                </select>
                            </div>
                        </div>
                            <br>
                            <table id="dtVisits" class="table table-condensed">
                                <thead>
                                <tr>
                                    <th>Id.nr</th>
                                    <th>Qellimi</th>
                                    {{--<th>Will Meet</th>--}}
                                    <th>Statusi</th>
                                    <th>Data</th>
                                    <th>Koha fillimit</th>
                                    <th>Koha mbarimit</th>
                                    <th>Me shume info
                                </tr>
                                </thead>
                                @foreach ($visits as $visit)
                                <tbody>

                                </tbody>
                                @endforeach

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
    <!-- Modal -->
    <!--Visit Modal-->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vizita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" action="{{ route('visit.EndVisit') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="visit_id" id="visit_id" value="" />
                    <div class="modal-body">
                        <h3>Jeni te sigurt qe doni te perfundoni viziten?</h3>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" name="finishVisit" id="end" value="finish-visit">Konfirmo</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Anullo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Info Modal-->
    <div class="modal fade" id="visitors" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Info per vizitoret</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <dl>
                        @foreach ($visit->visitors as $visitor)
                            <dt></dt><dd>{{ $visitor->name }} {{ $visitor->surname }}</dd>
                        @endforeach</dl>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Mbylle</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('footerSection')
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            var HasEditRights = false;
            @can('users.update',Auth::user())
                HasEditRights = true;
            @endcan
                var visitsTable = $('#dtVisits').DataTable({
                "language": {
                    "search": "Kerko:",
                    "sLengthMenu": "Shfaq _MENU_ Rreshta",
                    "info": "Duke shfaqur _START_ deri ne _END_ nga _TOTAL_ regjistrime",
                    "infoEmpty": "Duke shfaqur 0 deri ne 0 nga 0 regjistrimet",
                    "emptyTable":     "Nuk ka te dhena",
                    "infoFiltered": "(filtruar nga _MAX_ rregjistrime totale)",
                    "oPaginate": {
                        "sNext": "Para",
                        "sPrevious": "Mbrapa"
                    }
                },
                "processing": true,
                "serverSide": true,
                "targets": 'no-sort',
                "bSort": false,
                "order": [[0, "desc" ]],
                "ajax":{
                    "url": "{{ url('visit/ajaxList') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },
                "columns": [
                    { "data": "id"},
                    { "data": null,
                        orderable:false,
                        render: function (data, type, row) {
                            return row.purpose === 'Other'?row.purposetext:row.purpose;
                        }
                    },
                    { "data": "status"},
                    { "data": "date"},
                    { "data": "time"},
                    { "data": "endtime"},

                    { "data": "options",
                        orderable: false,
                        render: function(data, type,row){
                            return "<a href='#' data-toggle='modal' class=\"btn btn-sm btn-info\" data-target=\"#visitors\"  title='Vizitoret ne vizite' data-content='" + "'><span class='glyphicon glyphicon-info-sign'></span></a>"+
                                    (HasEditRights===true?"&nbsp;<a href='./visit/"+row.id+"/edit' title='Me shume info' class='btn btn-sm btn-warning'><span class='glyphicon glyphicon-edit'></span></a>":"")+"&nbsp;"+(row.status !== 'Aktive'?"":"<a href='#' data-toggle='modal' class=\"btn btn-sm btn-danger\" data-target=\"#exampleModal1\" data-visitId='" +row.id+ "'><span data-toggle=\"tooltip\" title=\"Perfundo Viziten\"\n" +
                                    "class=\"fa fa-hourglass-end\"></span></a>")


                        }
                    }],
                "createdRow": function( row, data, dataIndex) {
                    if (data['status'] == "Aktive") {
                        $(row).addClass('warning');
                    }
                    else if (data['status'] == "Perfunduar") {
                        $(row).addClass('success');
                    }
                    else if (data['status'] == "Refuzuar") {
                        $(row).addClass('danger');
                    }
                },
            });

            $('[data-toggle="tooltip"]').tooltip();

            $('#exampleModal1').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) ;
                var visitId = button.data('visitid') ;
                var modal = $(this);
                modal.find('#visit_id').val(visitId);
            });

            $('#FilterStatus'). on('change', function() {
                var val = $(this).val();
                visitsTable.columns(2).search(val).draw();
            });


        });

    </script>


@endsection