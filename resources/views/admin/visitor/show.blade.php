@extends('admin.layouts.app')

@section('headSection')
    <link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <h3 class="box-title">Vizitoret</h3>
                        <a class='btn btn-success pull-right' href="{{ route('visitor.create') }}"><span class="glyphicon glyphicon-plus"></span> Regjistro</a>
                </div>
                <div class="box-body">
                    <div class="box">
                        <div class="box-header">
                            @include('includes.messages')
                        </div>

                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-condensed">
                                <thead>
                                <tr>
                                    <th>Nr. Vizitorit</th>
                                    <th>Emri Mbiemri</th>
                                    <th>Veprime
                                    </th>

                                </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Modal -->



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
            $('#example2').on( 'draw.dt', function () {

                $('[data-toggle="popover"]').popover({ html: true, trigger: 'focus' });
            });

            $('#example2').DataTable({
                "language": {
                    "search": "Kerko:",
                    "sLengthMenu": "Shfaq _MENU_ Rreshta",
                    "info": "Duke shfaqur _START_ deri ne _END_ nga _TOTAL_ regjistrime",
                    "infoEmpty": "Duke shfaqur 0 deri ne 0 nga 0 regjistrimet",
                    "emptyTable":     "Nuk ka te dhena",
                    "oPaginate": {
                        "sNext": "Para",
                        "sPrevious": "Mbrapa"
                    }
                },
                "processing": true,
                "serverSide": true,
                "targets": 'no-sort',
                "bSort": false,
                "order": [],
                "ajax":{
                    "url": "{{ url('visitor/ajaxList') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{csrf_token()}}"}
                },

                "columns": [
                    { "data": "id", orderable:false},
                    { "data": null,
                        orderable:false,
                        render: function (data, type, row) {
                            var details = row.name + " " + row.surname;
                            return details;
                        }
                    },

                    { "data": "options",
                        orderable:false,
                        render: function(data, type,row){
                            return "<a href=\"javascript://\" class='btn btn-sm btn-info' data-toggle='popover' data-placement='left' title='Info per vizitorin' data-content='" +
                                "                                            <dl>" +
                                "                                            <dt>Gjinia:</dt><dd>"+row.gender+"</dd>" +
                                "                                            <dt>Nr.identiteti:</dt><dd>"+row.idnr +"</dd>" +
                                "                                            <dt>Datelindja:</dt><dd>"+row.date +"</dd>" +
                                "                                            <dt>Shtetesia:</dt><dd>"+row.state +"</dd>" +
                                "                                            <dt>Email:</dt><dd>"+row.email +"</dd>" +
                                "                                            <dt>Cel:</dt><dd>"+row.phone +"</dd>" +
                                "                                            <dt>Komente:</dt><dd>"+row.comments +"</dd>" +
                                "                                            <dt>Statusi:</dt><dd>"+row.status +"</dd>" +
                                "                                            <dt>Ndodhet ne Vizite?:</dt><dd>"+row.actual_visit +"</dd>" +
                                "                                                    </dl>" +
                                "'>" +
                                "                                                <span class='glyphicon glyphicon-info-sign'></span></a>"+
                                (HasEditRights===true?"&nbsp;<a href='./visitor/"+row.id+"/edit' title='Modifiko' class='btn btn-sm btn-warning'><span class='glyphicon glyphicon-edit'></span></a>":"")+
                                "&nbsp;"+(row.status==='Inaktiv'?"<button onclick='changeStatus(this);' data-status='"+row.status+"' data-visitor-id='"+row.id+"' class='btn btn-sm btn-success'> <i class='fa fa-eye'></i></button>"
                                    :"<button onclick='changeStatus(this);' data-status='"+row.status+"' data-visitor-id='"+row.id+"' class='btn btn-sm btn-danger'> <i class='fa fa-eye-slash'></i></button>");

                        }
                    }],
                createdRow: function (row, data) {
                    if (data['status'] == "Inaktiv") {
                        $(row).addClass('danger');
                    }
                }

            });


        });

        function changeStatus(button) {
            var status =$(button).data("status"),
                id = $(button).data("visitor-id"),
                tr = $(button).closest("tr");
            $.ajax({
                type: 'POST',
                url: "../visitor/ChangeStatus",
                data: {id: id},
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    if(data.success) {
                        $(button).find('i').remove();
                        if (status === 'Inaktiv') {
                            $(button).removeClass("btn-info").addClass("btn-danger").html($('<i/>', {class: 'fa fa-eye-slash'}));//.append(' Caktivizo');
                            $(tr).removeClass("danger");
                        }
                        else {
                            $(button).removeClass("btn-danger").addClass("btn-success").html($('<i/>', {class: 'fa fa-eye'}));//.append(' Aktivizo');
                            $(tr).addClass("danger");
                        }
                        $(button).data("status", status === 'Aktiv' ? 'Inaktiv' : 'Aktiv');
                    }else{
                        alert("GABIM");
                    }
                },
                error: function (err) {
                    alert("GABIM")
                }
            });


        }
    </script>



@endsection