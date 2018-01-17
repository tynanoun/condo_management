<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Plugins css-->
    <link href="assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/plugins/switchery/switchery.min.css">
    <!-- Jquery filer css -->
    <link href="assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
    <link href="assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />

    <!-- Bootstrap fileupload css -->
    <link href="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css" rel="stylesheet" />
    <!-- DataTables -->
    <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>

    <!-- App css -->
    <!-- Custom box css -->
    <link href="assets/plugins/custombox/css/custombox.min.css" rel="stylesheet">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <script src="assets/js/modernizr.min.js"></script>


</head>


<body>

<div class="modal fade" id="yorkroup-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>

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
                            <img src="assets/images/logo.png" alt="" height="25">
                        </span>
                <i>
                    <img src="assets/images/logo_sm.png" alt="" height="28">
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
                            <img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle user-img"> Cheasarat
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                            <li><a href="javascript:void(0)">M Profile</a></li>
                            <li><a href="javascript:void(0)">Account Setting</a></li>
                            <li><a href="javascript:void(0)">Logout</a></li>
                        </ul>
                    </li>
                </ul> <!-- end navbar-right -->
            </div><!-- end container -->
        </div><!-- end navbar -->
    </div>
    <!-- Top Bar End -->

    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="slimscroll-menu" id="remove-scroll">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metisMenu nav in" id="side-menu">
                    <li>
                        <a href="customer.html"><i class="fa fa-user"></i><span class="badge badge-danger pull-right">59</span> <span> Customer </span></a>
                    </li>
                    <li>
                        <a href="report.html"><i class="fi-paper"></i></i><span> Report </span></a>
                    </li>

                    <li>
                        <a href="invoice.html"><i class="fa fa-book"></i><span> Invoice </span></a>
                    </li>

                    <li>
                        <a href="contract.html"><i class="fa fa-plane"></i><span> Contract </span></a>
                    </li>

                    <li class="">
                        <a href="javascript: void(0);" aria-expanded="false" class="active"><i class="fi-target"></i> <span>System Setting </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level nav collapse" aria-expanded="false" style="height: 0px;">
                            <li><a href="price-setting.html">Price Setting</a></li>
                            <li><a href="user.html">User Role</a></li>
                        </ul>
                    </li>
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
            @yield('container')
        </div> <!-- content -->
        <footer class="footer text-center">
            2017 © Onestoneinc.
        </footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->
</div>
<!-- END wrapper -->
<!-- jQuery  -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/metisMenu.min.js"></script>
<script src="assets/js/waves.js"></script>
<script src="assets/js/jquery.slimscroll.js"></script>

<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

<script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="assets/plugins/datatables/jszip.min.js"></script>
<script src="assets/plugins/datatables/pdfmake.min.js"></script>
<script src="assets/plugins/datatables/vfs_fonts.js"></script>
<script src="assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables/buttons.print.min.js"></script>
<script src="assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>
<script src="assets/plugins/datatables/dataTables.colVis.js"></script>
<script src="assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>

<!-- Parsley js -->
<script type="text/javascript" src="assets/plugins/parsleyjs/parsley.min.js"></script>
<!-- Init Js file -->
{{--<script type="text/javascript" src="assets/pages/jquery.form-advanced.init.js"></script>--}}

<!-- init -->
<script src="assets/pages/jquery.datatables.init.js"></script>
<!-- App js -->
<script src="assets/js/jquery.core.js"></script>
<script src="assets/js/jquery.app.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>
<script src="assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
<script src="assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

{{--<script type="text/javascript" src="assets/plugins/autocomplete/jquery.mockjax.js"></script>--}}
{{--<script type="text/javascript" src="assets/plugins/autocomplete/jquery.autocomplete.min.js"></script>--}}
{{--<script type="text/javascript" src="assets/plugins/autocomplete/countries.js"></script>--}}
{{--<script type="text/javascript" src="assets/pages/jquery.autocomplete.init.js"></script>--}}
<!-- time and color picker -->

<!-- plugin js -->
<script src="assets/plugins/moment/moment.js"></script>
<script src="assets/plugins/timepicker/bootstrap-timepicker.js"></script>
<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Jquery filer js -->
<script src="assets/plugins/jquery.filer/js/jquery.filer.min.js"></script>
<!-- Bootstrap fileupload js -->
<script src="assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<!-- page specific js -->
<script src="assets/pages/jquery.fileuploads.init.js"></script>
<!-- Init js -->
<script src="assets/pages/jquery.form-pickers.init.js"></script>

<!-- Modal-Effect -->
<script src="assets/plugins/custombox/js/custombox.min.js"></script>
<script src="assets/plugins/custombox/js/legacy.min.js"></script>
@yield("js")

<script type="text/javascript">
    $(document).ready(function () {
        $(document).ready(function() {
            $('form').parsley();
        });

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
            ajax: "assets/plugins/datatables/json/scroller-demo.json",
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
    TableManageButtons.init();

</script>
</body>
</html>