<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Plugins css-->
    <link href="/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/plugins/switchery/switchery.min.css">
    <!-- Jquery filer css -->
    <link href="/assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
    <link href="/assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

    <!-- Bootstrap fileupload css -->
    <link href="/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" />
    <!-- DataTables -->
    <link href="/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>

    <!-- App css -->
    <!-- Custom box css -->
    <link href="/assets/plugins/custombox/css/custombox.min.css" rel="stylesheet">

    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/styles.css" rel="stylesheet" type="text/css" />

</head>


<body>
<?php
        use App\Libs\Helpers;
?>
<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <!--<a href="index.html" class="logo"><span>Code<span>Fox</span></span><i class="mdi mdi-layers"></i></a>-->
            <!-- Image logo -->
            <a href="#" class="logo">
                        <span>
                            <img src="/assets/images/logo.png" alt="" height="25">
                        </span>
                <i>
                    <img src="/assets/images/logo_sm.png" alt="" height="28">
                </i>
            </a>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">

                <!-- Navbar-left -->
                <ul class="nav navbar-nav navbar-left nav-menu-left">
                    <li>
                        <button type="button" class="button-menu-mobile open-left waves-effect">
                            <i class="dripicons-menu"></i>
                        </button>
                    </li>
                </ul>
                <!-- Right(Notification) -->
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown user-box">
                        <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                            @if(Auth::user()->image != null && Auth::user()->image != '')
                            <img src="/images/{{Auth::user()->image}}" alt="user-img" class="img-circle user-img">
                            @else
                                <i class="fa fa-user-circle-o user-profile-img" aria-hidden="true"></i>
                            @endif
                            {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul> <!-- end navbar-right -->
            </div><!-- end container -->
        </div><!-- end navbar -->
    </div>
    <!-- Top Bar End -->
<?php
$customerList = Helpers::getTenants();
$staffs = Helpers::getStaffs();
$isTenantDisplay = Auth::user()->hasRole('admin') || Auth::user()->can('tenantView') || Auth::user()->can('tenantInsert') || Auth::user()->can('tenantDelete') || Auth::user()->can('tenantUpdate');
$isStaffDisplay = Auth::user()->hasRole('admin') || Auth::user()->can('staffView') || Auth::user()->can('staffInsert') || Auth::user()->can('staffDelete') || Auth::user()->can('staffUpdate');
$isBuildingDisplay = Auth::user()->hasRole('admin') || Auth::user()->can('buildingView') || Auth::user()->can('buildingEdit');
$isLeaseDisplay = Auth::user()->hasRole('admin') || Auth::user()->can('leaseView') || Auth::user()->can('leaseInsert') || Auth::user()->can('leaseDelete') || Auth::user()->can('leaseUpdate');
$isMaintenanceDiplay = Auth::user()->hasRole('admin') || Auth::user()->can('maintenanceView') || Auth::user()->can('maintenanceEdit');
$isPriceSettingDisplay = Auth::user()->hasRole('admin') || Auth::user()->can('priceSettingView') || Auth::user()->can('priceSettingEdit');
$isRoleDisplay = Auth::user()->hasRole('admin') || Auth::user()->can('roleView') || Auth::user()->can('roleInsert') || Auth::user()->can('roleUpdate');
$is
?>
    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="slimscroll-menu" id="remove-scroll">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metisMenu nav in" id="side-menu">
                    <li>
                        <a href="/usage/reports"><i class="fi-paper"></i></i><span> Report </span></a>
                    </li>

                    <li>
                        <a href="/usage"><i class="fa fa-book"></i><span> Invoice </span></a>
                    </li>
                    @if($isTenantDisplay || $isStaffDisplay)
                    <li>
                        <a href="javascript: void(0);" aria-expanded="false"><i class="fa fa-users" aria-hidden="true"></i></i> <span>Users </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level nav" aria-expanded="true">
                            @if($isTenantDisplay)
                                <li><a href="/user/false"><i class="fa fa-user"></i><span class="badge badge-danger pull-right">{{count($customerList)}}</span> <span> Tenant </span></a></li>
                            @endif
                            @if($isStaffDisplay)
                                <li><a href="/user/true"><i class="fa fa-user"></i><span class="badge badge-danger pull-right">{{count($staffs)}}</span> <span> Staff </span></a></li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if($isBuildingDisplay || $isLeaseDisplay || $isMaintenanceDiplay || $isPriceSettingDisplay || $isRoleDisplay)
                    <li>
                        <a href="javascript: void(0);" aria-expanded="true"><i class="fa fa-cog" aria-hidden="true"></i> <span> SETTINGS </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level nav" aria-expanded="true">
                            @if($isBuildingDisplay)
                                <li><a href="/building">Building</a></li>
                            @endif
                            @if($isLeaseDisplay)
                                <li><a href="/lease">Lease</a></li>
                            @endif
                            @if($isMaintenanceDiplay)
                                <li><a href="/maintenances">Maintenance</a></li>
                            @endif
                            @if($isPriceSettingDisplay)
                                <li><a href="/pricesetting">Price Setting</a></li>
                            @endif
                            @if($isRoleDisplay)
                                <li><a href="/role">User Role</a></li>
                            @endif
                            @if($isRoleDisplay)
                                <li><a href="/room">Room</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                </ul>
            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <div class="row">
                                        @yield('breadcrumbs')
                                        <div class="col-lg-3 text-center">
                                            <p class="text-muted">{{Helpers::getTenantsNumber()}} / Tenant(s)</p>

                                            <i class="mdi mdi-account-multiple widget-two-icon"></i>
                                        </div>

                                        <div class="col-lg-3 text-center">
                                            <p class="text-muted">{{Helpers::getInvoiceNumber()}} / Outstanding Invoice(s)</p>

                                            <i class="mdi mdi-calendar-multiple-check"></i>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                @yield('content')
            </div>
        </div>
    </div>
    <div class="modal fade" id="yorkroup-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
</div>
    <!-- END wrapper -->
    <!-- jQuery  -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/metisMenu.min.js"></script>
    <script src="/assets/js/waves.js"></script>
    <script src="/assets/js/jquery.slimscroll.js"></script>
    <script src="/assets/js/jquery.form.js"></script>

    <!-- Data table -->
    <script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.bootstrap.js"></script>

    <script src="/assets/plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="/assets/plugins/datatables/buttons.bootstrap.min.js"></script>
    <script src="/assets/plugins/datatables/jszip.min.js"></script>
    <script src="/assets/plugins/datatables/pdfmake.min.js"></script>
    <script src="/assets/plugins/datatables/vfs_fonts.js"></script>
    <script src="/assets/plugins/datatables/buttons.html5.min.js"></script>
    <script src="/assets/plugins/datatables/buttons.print.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.keyTable.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables/responsive.bootstrap.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.scroller.min.js"></script>
    <script src="/assets/plugins/datatables/dataTables.colVis.js"></script>
    <script src="/assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>

    <!-- Parsley js -->
    <script src="/assets/plugins/parsleyjs/parsley.min.js"></script>

    <!-- Init Js file -->
    {{--<script type="text/javascript" src="/assets/pages/jquery.form-advanced.init.js"></script>--}}

    <!-- init -->
    <script src="/assets/pages/jquery.datatables.init.js"></script>
    <!-- App js -->
    <script src="/assets/js/jquery.core.js"></script>
    <script src="/assets/js/jquery.app.js"></script>
    <script src="/assets/plugins/switchery/switchery.min.js"></script>
    <script src="/assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

    {{--<script type="text/javascript" src="/assets/plugins/autocomplete/jquery.mockjax.js"></script>--}}
    {{--<script type="text/javascript" src="/assets/plugins/autocomplete/jquery.autocomplete.min.js"></script>--}}
    {{--<script type="text/javascript" src="/assets/plugins/autocomplete/countries.js"></script>--}}
    {{--<script type="text/javascript" src="/assets/pages/jquery.autocomplete.init.js"></script>--}}
    <!-- time and color picker -->

    <!-- plugin js -->
    <script src="/assets/plugins/moment/moment.js"></script>
    <script src="/assets/plugins/timepicker/bootstrap-timepicker.js"></script>
    <script src="/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- Jquery filer js -->
    <script src="/assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>
    <script src="/assets/js/jquery.form.js"></script>

    <!-- Bootstrap fileupload js -->
    <script src="/assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
    <!-- page specific js -->
    <script src="/assets/pages/jquery.fileuploads.init.js"></script>

    <!--Chartist Chart-->
    {{--<script src="/assets/plugins/chartist/js/chartist.min.js"></script>--}}
    {{--<script src="/assets/plugins/chartist/js/chartist-plugin-tooltip.min.js"></script>--}}
    {{--<script src="/assets/pages/jquery.chartist.init.js"></script>--}}

    <!-- Modal-Effect -->
    <script src="/assets/plugins/custombox/js/custombox.min.js"></script>
    <script src="/assets/plugins/custombox/js/legacy.min.js"></script>
     @yield('js')

    <script type="text/javascript">
        $(document).ready(function () {
//            $(document).ready(function() {
//                $('form').parsley();
//            });
//        $(function () {
//            $('#demo-form').parsley().on('field:validated', function () {
//                var ok = $('.parsley-error').length === 0;
//                $('.alert-info').toggleClass('hidden', !ok);
//                $('.alert-warning').toggleClass('hidden', ok);
//            })
//                .on('form:submit', function () {
//                    return false; // Don't submit form for this demo
//                });
//        });

            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({keys: true});
            $('#datatable-responsive').DataTable();
            $('#datatable-colvid').DataTable({
                "dom": 'l<"clear">lfrtip',
                "colVis": {
                    "buttonText": "Change columns"
                }
            });
            $('#datatable-scroller').DataTable({
                ajax: "/assets/plugins/datatables/json/scroller-demo.json",
                deferRender: true,
                scrollY: 380,
                scrollCollapse: true,
                scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
            var table = $('#datatable-fixed-col').DataTable({
                scrollY: "300px",
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                fixedColumns: {
                    leftColumns: 1,
                    rightColumns: 1
                }
            });
        });
        $("#datepicker").datepicker();
        TableManageButtons.init();

        $( ".delete-row" ).click(function(event) {
            event.preventDefault();
            var url = $(this).attr('href')
            $.ajax({
                url: url,
                type: 'GET',
                context: document.body,
                success: function(data) {
                    $('.modal-content').html(data);
                    $('#yorkroup-modal').modal('toggle');
                }
            });
        });

        $( ".add-new-customer" ).click(function(event) {
            event.preventDefault();
            var url = $(this).attr('data-url');
            $.ajax({
                url: url,
                type: 'GET',
                context: document.body,
                success: function(data) {
                    $('.modal-content').html(data);
                    $('#yorkroup-modal').modal('toggle');
                }
            });
        });

        $( ".add-new-room" ).click(function(event) {
            event.preventDefault();
            $.ajax({
                url: "room/create",
                type: 'GET',
                context: document.body,
                success: function(data) {
                    $('.modal-content').html(data);
                    $('#yorkroup-modal').modal('toggle');
                }
            });
        });

        $( ".add-new-role" ).click(function(event) {
            event.preventDefault();
            $.ajax({
                url: "role/create",
                type: 'GET',
                context: document.body,
                success: function(data) {
                    $('.modal-content').html(data);
                    $('#yorkroup-modal').modal('toggle');
                }
            });
        });

        $('.edit-row').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'GET',
                context: document.body,
                success: function (data) {
                    $('.modal-content').html(data);
                    $('#yorkroup-modal').modal('toggle');
                },
                error: function (err) {
                    console.log('ok');
                }
            });
            return false;
        });

        $(".invoice-comment").blur(function(e) {
            event.preventDefault();
            var frm = $('.customer-form');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: frm.attr('method'),
                url: frm.attr('action'),
                dataType : 'json',
                data: frm.serialize(),
                success: function (data) {
                    $(".invoice-comment").html(data['comments']);
                },
                error: function (xhr, status, error) {
                    $('.modal-content').html(xhr.responseText);
                }
            });

            return false;
        });

        $('.invoice-paid-btn').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'GET',
                context: document.body,
                success: function (data) {
                    location.reload();
                },
                error: function (err) {
                    console.log('ok');
                }
            });
            return false;
        });

        $('.paid-button').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'GET',
                context: document.body,
                success: function (data) {
                    location.reload();
                },
                error: function (err) {
                    console.log('ok');
                }
            });
            return false;
        });

    </script>
</body>
</html>