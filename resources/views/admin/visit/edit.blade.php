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
                            <h3 class="box-title">Visits</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('visit.update',$visit->id) }}" method="post"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="box-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="purpose">Visit Purpose</label>
                                        @if ($visit->status !== "Pending")
                                        <br><span readonly>{{ $visit->purpose }}</span>
                                            @else
                                            <select name="purpose" id="purpose" class="form-control">
                                                <option value="selected disable" disabled>Visit Purpose</option>
                                                <option value="Queries regarding products and services" @if($visit->purpose == 'Queries regarding products and services') selected="selected"@endif disabled>Queries regarding
                                                    products and services
                                                </option>
                                                <option value="Marketing"  @if($visit->purpose == 'Marketing') selected="selected"@endif>Marketing</option>
                                                <option value="Complaints"  @if($visit->purpose == 'Complaints') selected="selected"@endif>Complaints</option>
                                                <option value="Job Meetings"  @if($visit->purpose == 'Job Meetings') selected="selected"@endif>Job Meetings</option>
                                                <option value="Bussines Meetings"  @if($visit->purpose == 'Bussines Meetings') selected="selected"@endif>Bussines Meetings</option>
                                                <option value="Other"  @if($visit->purpose == 'Other') selected="selected"@endif disabled>Other</option>
                                            </select>
                                            <div id="purpose-block" style="display: none;">
                                                <label for="purposetext">Other Purpose</label>
                                                <input type="text" class="form-control" id="purpose" name="purposetext"
                                                       placeholder="Purpose" value="{{ $visit->purposetext }}">
                                            </div>
                                        @endif

                                    </div>

                                    <div class="form-group">
                                        <label>Do Takoj</label>
                                        @if ($visit->status !== "Pending")
                                            <br><span>
                                                {{ $visit->company->name }}</span>
                                        @else
                                        <select name="companies" id="companies" class="form-control">
                                            <option value=""> Select</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}"
                                                    @if ($company->id == $visit->company_id)
                                                         selected
                                                    @endif
                                                >{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif


                                    <div class="form-group">
                                        <label for="comments">Visit Comments</label>
                                        @if ($visit->status !== 'Pending')
                                            <br><pre>{{ $visit->comments }}</pre>
                                        @else
                                        <textarea name="comments" id="comments" class="xlarge form-control" readonly
                                                  style="margin: 0px 332.656px 0px 0px;">{{ old('comments',$visit->comments) }}</textarea>
                                            @endif
                                    </div>

                                    <div class="jumbotron">
                                        <div class="row">
                                            <div class="col-xs-11 col-xs-offset-1">
                                                <button type="button"
                                                        class="btn btn-success load-ajax-modal"
                                                        role="button"
                                                        data-toggle="modal" data-target="#dynamic-modal">
                                                    <span class="glyphicon glyphicon-plus-sign"></span> Add Visitor
                                                </button>
                                            </div>
                                        </div>


                                        <table class="table no-margin text-center">
                                            <thead>
                                            <tr>
                                                <th>Vizitori</th>
                                                <th>Perfaqeson</th>
                                                <th>Status</th>
                                                <th></th>
                                                <th></th>
                                            </tr>

                                            </thead>
                                            <tbody id="addVisitors">
                                                @foreach ($visit->visitors as $visitor)
                                                     <tr>
                                                         <td>{{ $visitor->name }}</td>
                                                         <td>{{ $visitor->commingfrom }}</td>
                                                         <td>{{ $visitor->status }}</td>
                                                         <td>
                                                             <div class="btn-group" role="group">
                                                                 <button type="button" class="btn btn-xs btn-danger" role="button" onclick="removeVisitorItem({{$visitor->id}})">
                                                                     <span class="glyphicon glyphicon-remove"></span>
                                                                 </button>
                                                                 @if ($visitor->checked_out == 0)
                                                                     <button type="button" class="btn btn-xs btn-success" role="button">
                                                                         <span class="glyphicon glyphicon-check"></span> Checkout
                                                                     </button>
                                                                     <input type="hidden" name="visitorIds[]" value="{{$visitor->id}}">
                                                                     <input type="hidden" name="commingfrom[]" value="{{$visitor->commingfrom}}">
                                                                     <input type="hidden" name="checkedOut[]" value="{{$visitor->checkedOut}}">
                                                                 @endif
                                                             </div>
                                                         </td>
                                                     </tr>
                                                    @endforeach
                                            </tbody>
                                            {{--<input type="hidden" name="visitVisitors[]" value="4,1"/>--}}
                                        </table>
                                    </div>
                                </div>

                            </div>


                            <div class="box-footer">
                                @if ($visit->status == "Ongoing")
                                    @elseif($visit->status == "Refused")
                                @elseif($visit->status == "Finished")

                                @else
                                    <button type="submit" class="btn btn-primary" name="startVisit" id="submit-button" value="start-visit"
                                            style="background-color: #5ab738">Fillo Viziten
                                    </button>

                                @endif
                                    @if ($visit->status == "Refused")
                                        @elseif($visit->status == "Finished")
                                    @elseif($visit->status == "Ongoing")

                                    @else
                                <button class="btn btn-danger" name="endVisit" id="button" value="end-visit" >Anullo Viziten</button>
                                    @endif
                                    @if ($visit->status == "Finished")
                                        @elseif($visit->status == "Refused")

                                    @else
                                <button class="btn btn-warning" name="finishVisit" id="end" value="finish-visit">Perfundo Viziten</button>
                                        @endif
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

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Visitors</h4>
                </div>

                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="dynamic-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
                                <button type="button" id="read-manual-btn" class="btn btn-info"><i class="fa fa-id-card" aria-hidden="true"></i>
                                    Lexo nga Skaner</button>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" id="zgjidh" href="#search">Zgjidh</a></li>
                                <li><a data-toggle="tab" id="new" href="#create_new">Krijo te ri</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="search" class="tab-pane fade in active">
                                    <div class="form-group" style="margin-top:18px;">
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
                                    <form role="form" action="{{ route('visitor.ajaxStore') }}" method="post"
                                          enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="col-lg-10" style="padding: 30px">
                                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label for="name">Visitor Name<sup style="color: red">*</sup></label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                                       value="{{ old('name') }}">
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group {{ $errors->has('surname') ? ' has-error' : '' }}">
                                                <label for="surname">Visitor Surname<sup style="color: red">*</sup></label>
                                                <input type="text" class="form-control" id="surname" name="surname"
                                                       placeholder="Surname" value="{{ old('surname') }}">
                                                @if ($errors->has('surname'))
                                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                            <label for="idnr">Visitor ID.nr<sup style="color: red">*</sup></label>
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
                                                <label class="control-label" for="date">Birth Date</label>
                                                <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY"
                                                       type="text"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="Not Specified">Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <input type="text" class="form-control" id="state" name="state"
                                                       placeholder="State" value="{{ old('state') }}">
                                            </div>
                                            <label for="email">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">@</span>
                                                <input type="email" class="form-control" id="email" name="email"
                                                       placeholder="visitor@domain.com" value="{{ old('email') }}">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone"
                                                       placeholder="Phone Number" value="{{ old('phone') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="comments">Visitor Comments</label>
                                                <input type="text" class="form-control" id="comments" name="comments"
                                                       placeholder="Comments" value="{{ old('comments') }}">
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
    <script>
        $(document).ready(function () {
            $(".select2").select2({
                dropdownCssClass: 'custom-dropdown'
            });
            $('#purpose').on('change', function () {
                if (this.value === 'Other')
                    $('#purpose-block').show();
                else {
                    $('#purpose-block').hide();
                }
            })
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#dynamic-modal").on("show.bs.modal", function (e) {
                var id = $(e.relatedTarget).data('target-id');
                $.get("/controller/" + id, function (data) {
                    $(".modal-body").html(data.html);
                });

            });
        });
    </script>
    <script>
        $(document).ready(function () {
            var date_input = $('input[name="date"]'); //our date input has the name "date"
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            })
        })
    </script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
        $('#saveVisitor').click(function () {
            var modal = $('#dynamic-modal');
            var visitorId = modal.find('#selectVisitor');
            var commingfrom = modal.find('#commingfrom');

            var visitorIdValue = visitorId.val();
            var commingfromValue = commingfrom.val();
//visitorId.val()
            if(!$('#tr-visitor-'+visitorIdValue).length) {
                $('#addVisitors').append('<tr id="tr-visitor-' + visitorIdValue + '"><td>' + visitorId.select2('data')[0].text + '</td><td>' + commingfromValue + '</td><td>Regjistruar</td><td>' +
                    '<button type="button" class="btn btn-xs btn-danger" role="button" onclick="removeVisitorItem(' + visitorIdValue + ')">' +
                    '<span class="glyphicon glyphicon-remove"></span>' +
                    '</button>' +
                    '<input type ="hidden" name="visitorIds[]" value="'+visitorIdValue+'">' +
                    '<input type ="hidden" name="commingfrom[]" value="'+commingfromValue+'">' +
                    '</td></tr>');
                // $('#addVisitors').append('<input type="hidden" id="visitorHidden'+visitorId.val()+'" name=visitVisitors[] value="' + visitorId.val() + '"/>');
                // $('#addVisitors').append('<input type="hidden" name=visitCompanies[] value="' + companies.val() + '"/>');

                visitorId.val('').trigger('change.select2');
                commingfrom.val('');
                modal.modal('hide');
            }else{
                alert("Eshte zgjedhur njehere ky vizitor")//duhet bere me popup
            }
        });


        function removeVisitorItem(currId) {
            $('tr#tr-visitor-'+currId).remove();
            $("#visitorHidden"+currId).remove();
        }

    </script>




    <script>
        // loaded on doc creation ???
        // duhet kur shtyp butonin save
        $(document).ready(function () {
            var modal = $('#dynamic-modal');
            var form = modal.find('form');
            var errorMsg = modal.find('#errorMsg');

            form.submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: form.attr('method'),
                    url: form.attr('action'),
                    data: form.serialize(),
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
                            var errorInput = form.find('[name="' + index + '"]').parent();
                            errorInput.addClass('has-error');
                            errorInput.append('<span class="help-block">' + error + '<span>');
                        });
                    }
                });
            });
        })
    </script>
    <script src="{{ asset('admin/plugins/CPScanID/src/jquery.cpscanid.js') }}"></script>

    <script>
        $(document).ready(function () {
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
                        alert("Duhet instaluar extension, vizitoni url-ne: " + $.CPScanID.getExtensionUrl());
                        break;
                    default:
                        alert("Ka ndodhur nje gabim");
                }
            }

            $("#read-manual-btn").on("click", function () {
                try {
                    $.CPScanID.read();
                } catch (err) {
                    if (err == "NOT_INITIATED") {
                        alert("Libraria nuk eshte inicializuar ende");
                    }
                }
            });

        })
    </script>

@endsection