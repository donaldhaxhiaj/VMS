@extends('admin.layouts.app')

@section('headSection')

    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

@endsection

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
                            <h3 class="box-title">Vizitat</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <p id="errorMsgVisits" class="alert alert-danger" style="display: none;"></p>


                        <form role="form" action="{{ route('visit.store') }}" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="col-lg-6">
                                    <div class="form-group {{ $errors->has('purpose') ? ' has-error' : '' }}">
                                        <label for="purposes">Qellimi vizites</label>
                                        <select name="purposes" id="purposes" class="form-control">
                                            <option value=""> --Zgjidh--</option>
                                            @foreach ($purposes as $purpose)
                                                <option value="{{ $purpose->name }}">{{ $purpose->name }}</option>
                                            @endforeach
                                            <option value="Other">Tjeter</option>
                                        </select>
                                        @if ($errors->has('purpose'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('purpose') }}</strong>
                                    </span>
                                        @endif
                                        <div id="purpose-block" style="display: none;">
                                            <label for="purposetext">Qellim tjeter</label>
                                            <input type="text" class="form-control" id="purpose" name="purposetext"
                                                   placeholder="Purpose">
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('companies') ? ' has-error' : '' }}">
                                        <label for="companies">Do Takoj</label>
                                        <select name="companies" id="companies" class="form-control">
                                            <option value=""> --Zgjidh--</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('companies'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('companies') }}</strong>
                                    </span>
                                            @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="comments">Komentet e vizites</label>
                                        <textarea name="comments" id="comments" class="xlarge form-control"
                                                  style="margin: 0px 332.656px 0px 0px;"></textarea>
                                    </div>

                                        <div class="row">
                                            <div class="col-xs-11 col-xs-offset-1">
                                                <button type="button"
                                                        class="btn btn-success load-ajax-modal"
                                                        role="button"
                                                        data-toggle="modal" data-target="#select-visitor-modal">
                                                    <span class="glyphicon glyphicon-plus-sign"></span> Shto vizitoret
                                                </button>
                                            </div>
                                        </div>


                                        <table id="dtVisits" class="table table-condensed">
                                            <thead>
                                            <tr>
                                                <th>Vizitori</th>
                                                <th>Perfaqeson</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>

                                            </thead>
                                            <tbody id="addVisitors">

                                            </tbody>
                                            {{--<input type="hidden" name="visitVisitors[]" value="4,1"/>--}}
                                        </table>
                                    </div>
                                </div>


                        <div class="box-footer">
                            <button type="button" class="btn btn-primary" id="start" data-toggle="modal" data-target="#visitSave" value="">Ruaj</button>
                            <button type="button" class="btn btn-success" id="start" data-toggle="modal" data-target="#startVisit"  value="">Fillo viziten</button>
                            <a href="{{ route('visit.index') }}" class="btn btn-warning">Mbrapa</a>
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

    <div class="modal fade" id="visitSave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vizita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" id="visitForm" action="{{ route('visit.store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="purpose" id="purpose" value="" />
                    <input type="hidden" name="purposetext" id="purposetext" value="" />
                    <input type="hidden" name="comments" id="comments" value="" />
                    <input type="hidden" name="companies" id="companies" value="" />
                    <input type="hidden" name="commingfrom" id="commingfrom" value="" />
                    <div class="modal-body">
                        Jeni te sigurt qe doni te ruani viziten
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" >Konfirmo</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Anullo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Visit Modal-->
    <div class="modal fade" id="startVisit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vizita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form role="form" action="{{ route('visit.StartVisit2') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="purpose" id="purpose" value="" />
                    <input type="hidden" name="purposetext" id="purposetext" value="" />
                    <input type="hidden" name="comments" id="comments" value="" />
                    <input type="hidden" name="companies" id="companies" value="" />
                    <input type="hidden" name="commingfrom" id="commingfrom" value="" />
                    <div class="modal-body">
                        Jeni te sigurt qe doni te filloni viziten
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" name="finishVisit" id="end" value="finish-visit">Konfirmo</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Anullo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Shto vizitoret</h4>
                </div>

                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Mbylle</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="select-visitor-modal" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Shto Vizitoret</h3>
                        </div>
                        <!-- /.box-header -->
                        <p id="errorMsg" class="alert alert-danger" style="display: none;"></p>
                        <!-- form start -->

                            <div class="box-body">
                                <div class="form-group">
                                    <button type="button" id="read-manual-btn" data-loading-text="Duke skanuar..." class="btn btn-info"><i class="fa fa-id-card" aria-hidden="true"></i>
                                          Lexo nga Skaner</button>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" id="zgjidh" href="#search">Zgjidh</a></li>
                                    <li><a data-toggle="tab" id="new" href="#create_new">Krijo te ri</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="search" class="tab-pane fade in active">
                                        <div class="form-group" style="margin-top:18px;">
                                            <p id="errorMsgVisitor" class="alert alert-danger" style="display: none;"><strong>Ky vizitor eshte perzgjedhur</strong></p>
                                            <label>Zgjidh Vizitoret</label>
                                            <select class="form-control select2 select2-hidden-accessible" id="selectVisitor"
                                                    data-placeholder="Zgjidh nje vizitor" style="width: 100%;" tabindex="-1"
                                                    aria-hidden="true" name="visitor">
                                                <option></option>
                                                @foreach ($visitors as $visitor)
                                                    <option value="{{ $visitor->id }}">{{ $visitor->name }} {{ $visitor->surname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="commingfrom">Perfaqeson</label>
                                            <input name="commingfrom" type="text" id="commingfrom" class="form-control"/>
                                        </div>

                                        <div class="form-group">
                                            <!--<input type="checkbox" name="check" id="check" checked />-->
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary" id="saveVisitor">Zgjidh visitor</button>
                                        </div>

                                    </div>
                                    <div id="create_new" class="tab-pane fade">
                                        <form role="form" action="{{ route('visitor.ajaxStore') }}" method="post" id="visit_form"
                                              enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="col-lg-10" style="padding: 30px">
                                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <label for="name">Emri<sup style="color: red">*</sup></label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                                                    @if ($errors->has('name'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group {{ $errors->has('surname') ? ' has-error' : '' }}">
                                                    <label for="surname">Mbiemri<sup style="color: red">*</sup></label>
                                                    <input type="text" class="form-control" id="surname" name="surname"
                                                           placeholder="Surname">
                                                    @if ($errors->has('surname'))
                                                        <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                                <label for="idnr">Nr.id e vizitorit<sup style="color: red">*</sup></label>
                                                <div class="form-group {{ $errors->has('idnr') ? ' has-error' : '' }}">
                                                    <input type="text" class="form-control" id="idnr" name="idnr"
                                                           placeholder="Id.nr" >
                                                    @if ($errors->has('idnr'))
                                                        <span class="help-block">
                                                <strong>{{ $errors->first('idnr') }}</strong>
                                            </span>
                                                    @endif
                                                </div>
                                                <div class="form-group"> <!-- Date input -->
                                                    <label class="control-label" for="date">Datelindja</label>
                                                    <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY"
                                                           type="text"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="gender">Gjinia</label>
                                                    <select name="gender" id="gender" class="form-control">
                                                        <option value="Not Specified">Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="state">Shtetesia</label>
                                                    <input type="text" class="form-control" id="state" name="state"
                                                           placeholder="State" value="{{ old('state') }}">
                                                </div>
                                                <label for="email">Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">@</span>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                           placeholder="visitor@domain.com">
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label for="phone">Cel</label>
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                           placeholder="Phone Number">
                                                </div>
                                                <div class="form-group">
                                                    <label for="comments">Komentet per vizitorin</label>
                                                    <input type="text" class="form-control" id="comments" name="comments"
                                                           placeholder="Comments">
                                                </div>
                                                <div class="form-group">
                                                    <label for="commingfrom">Perfaqeson</label>
                                                    <input name="commingfrom" type="text" id="commingfrom" class="form-control"/>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" id="addVisitor" class="btn btn-primary">Shto vizitor</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footerSection')
    <script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/CPScanID/src/jquery.cpscanid.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>


    <script>
        function removeVisitorItem(currId) {
            $('tr#tr-visitor-' + currId).remove();
            $("#visitorHidden" + currId).remove();
        }

        function InitializeEvents(){
            $('#purposes').on('change', function () {
                if (this.value === 'Other')
                    $('#purpose-block').show();
                else {
                    $('#purpose-block').hide();
                }
            });

            var selectVisitorModal = $('#select-visitor-modal');
            var formVisitorModal = selectVisitorModal.find('form');
            var errorMsg = selectVisitorModal.find('#errorMsg');

            selectVisitorModal.on("show.bs.modal", function (e) {
                var id = $(e.relatedTarget).data('target-id');
                $.get("/controller/" + id, function (data) {
                    $(".modal-body").html(data.html);
                });
                formVisitorModal[0].reset();
                $('#errorMsgVisitor').css("display", "none");
            });


            formVisitorModal.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: formVisitorModal.attr('method'),
                    url: formVisitorModal.attr('action'),
                    data: formVisitorModal.serialize(),
                    success: function (data) {
                        console.log('Submission was successful.');
                        var newVisitorVal = data.id;
                        if ($("#selectVisitor").find("option[value=" + newVisitorVal + "]").length) {
                            $("#selectVisitor").val(newVisitorVal).trigger("change");
                        } else {
                            var newVisitor = new Option(data.name + " " + data.surname, newVisitorVal, true, true);
                            $("#selectVisitor").append(newVisitor).trigger('change');
                        }
                        modal.modal('toggle');
                    },
                    error: function (data) {
                        errorMsg.css("display", "block");
                        errorMsg.html("<strong>" + data.responseJSON.message + "</strong>");
                        $.each($.parseJSON(data.responseText).errors, function (index, error) {
                            var errorInput = formVisitorModal.find('[name="' + index + '"]').parent();
                            errorInput.addClass('has-error');
                            errorInput.append('<span class="help-block">' + error + '<span>');
                        });
                    }
                });
            });

            $('#saveVisitor').click(function () {
                $('#errorMsgVisitor').css("display", "none");
                var modal = $('#select-visitor-modal');
                var visitorId = modal.find('#selectVisitor');
                var commingfrom = modal.find('#commingfrom');

                var visitorIdValue = visitorId.val();

                var commingfromValue = commingfrom.val();
                if(!visitorIdValue){
                    return false;
                }

                if (!$('#tr-visitor-' + visitorIdValue).length) {
                    $('#addVisitors').append('<tr id="tr-visitor-' + visitorIdValue + '"><td>' + visitorId.select2('data')[0].text + '</td><td>' + commingfromValue + '</td><td>Regjistruar</td><td>' +
                        '<button type="button" class="btn btn-xs btn-danger" role="button" onclick="removeVisitorItem(' + visitorIdValue + ')">' +
                        '<span class="glyphicon glyphicon-remove"></span>' +
                        '</button>' +
                        '<input type ="hidden" name="commingfrom[]" value="' + commingfromValue + '">' +
                        '</td></tr>');

                    $('#visitSave form').append('<input type ="hidden" name="visitorIds[]" value="' + visitorIdValue + '">');
                    $('#startVisit form').append('<input type ="hidden" name="visitorIds[]" value="' + visitorIdValue + '">');


                    visitorId.val('').trigger('change.select2');
                    commingfrom.val('');
                    $("#mymodal").on("hidden.bs.modal", function () {
                        $("select-visitor-modal").html("");
                    });


                } else {
                    $('#errorMsgVisitor').css("display", "block");
                }

            });

            $("#read-manual-btn").on("click", function () {

                var btn = $(this);
                btn.button('loading');
                setTimeout(function () {
                    btn.button('reset');
                }, 2000);

                try {
                    $('#visit_form')[0].reset();
                    $.CPScanID.read();
                } catch (err) {
                    if (err == "NOT_INITIATED") {
                        alert("Libraria nuk eshte inicializuar ende");
                    }
                }
            });

            $('#startVisit').on('show.bs.modal', function (event) {
                var comments = $('#comments').val() ;
                var purpose = $('#purposes').val() ;
                var purposetext = $('#purpose').val() ;
                var company = $('#companies').val() ;
                var visitorId = $('#visitorIds').val() ;
                var modal = $(this);
                modal.find('#comments').val(comments);
                modal.find('#purpose').val(purpose);
                modal.find('#purposetext').val(purposetext);
                modal.find('#companies').val(company);
                modal.find('#visitorIds').val(visitorId);
                modal.find('#commingfrom').val(commingfrom);
            });

            $('#visitSave').on('show.bs.modal', function (event) {
                var comments = $('#comments').val() ;
                var purpose = $('#purposes').val() ;
                var purposetext = $('#purpose').val() ;
                var company = $('#companies').val() ;
                var visitorId = $('#visitorIds').val() ;
                var modal = $(this);
                modal.find('#comments').val(comments);
                modal.find('#purpose').val(purpose);
                modal.find('#purposetext').val(purposetext);
                modal.find('#companies').val(company);
                modal.find('#visitorIds').val(visitorId);
                modal.find('#commingfrom').val(commingfrom);
            });
        }

        function InitializeComponents(){
            try {
                $.CPScanID.init({
                    callbackReadSuccess: function (data) {
                        console.log("SUCCESS: ", data);

                        if (data[10102].Value) {
                            $('#name').val(data[10102].Value);
                        }

                        if (data[10103].Value) {
                            $('#surname').val(data[10103].Value);
                        }

                        if (data[10161].Value) {
                            $('#idnr').val(data[10161].Value);
                        }

                        if (data[10113].Value) {
                            var datestr = data[10113].Value;
                        }
                        var year = datestr.substring(0, 2);
                        var month = datestr.substring(2, 4);
                        var day = datestr.substring(4, 6);

                        year = year > (new Date()).getFullYear().toString().substring(2, 4) ? '19' + year : '20' + year;

                        $('#date').val(day + '/' + month + '/' + year);

                    },
                    callbackReadFail: function (data) {
                        console.log("Fail: ", data);
                        alert("Ka ndodhur nje gabim");

                    },
                    callbackDisconnect: function () {
                        console.log("Disconnected");
                    }
                });
            } catch (err) {
                switch (err) {
                    case "IS_INITIATED":
                        alert("Eshte inicializuar nje here!");
                        break;
                    case "EXTENSION_NOT_FOUND":
                        $('#errorMsgVisits').css("display", "block").html("<strong>Duhet instaluar extension, vizitoni url-ne: <a href='" + $.CPScanID.getExtensionUrl()+"'>" + $.CPScanID.getExtensionUrl()+"</a></strong>");
                        break;
                    default:
                        alert("Ka ndodhur nje gabim");
                }
            }

            $(".select2").select2({
                dropdownCssClass: 'custom-dropdown'
            });

            $('#dtVisits').DataTable({searching: false, paging: false, bInfo:false,"language": {
                    "emptyTable": "Vizitoret e zgjedhur:"
                }});
        }

        $(function () {
            InitializeComponents();
            InitializeEvents();
        });



    </script>


@endsection