<?php session_start(); ?>
<?php
include('includes/constant.php');
$register = 'register';
session_start();
$_SESSION['register'] = $register;
?>
<?php
if (isset($_SESSION['guest'])) {
    
} else {
    header("location:login");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bit Mine Pool </title>

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        <!-- JQVMap -->
        <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link rel="icon" href="images/favicon.ico" type="image/ico" sizes="32x32">
        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        <!--<link href="../build/css/dataTables.bootstrap.css" rel="stylesheet">-->

        <style type="text/css">
            <!--
            .style3 {color: #CC3300}
            -->
        </style>
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?php echo BASE_URL; ?>" class="site_title"> <span><img src="images/logo.png" alt="Bit-Mine-Pool" style="width: 95px;"></span></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile clearfix">
                            <div class="profile_pic">
                                <a href="<?php echo BASE_URL; ?>"><img src="images/img.jpg" alt="..." class="img-circle profile_img"></a>              </div>
                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2><?php
                                    if (isset($_SESSION['Username'])) {
                                        echo ' ' . $_SESSION['Username'];
                                    } else {
                                        header("location:login");
                                    }
                                    ?></h2>
                            </div>
                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <?php include('includes/guestmenu.php'); ?>

                        <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small">
                            <a data-toggle="tooltip" data-placement="top" title="Settings">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Lock">
                                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.php">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>

                <?php include('includes/guestheader.php'); ?>


                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3 class="style3">Support Tickets</h3>
                            </div>


                        </div>

                        <div class="clearfix"></div>

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>My Support Tickets</h2>

                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <table id="support-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>ID</th>
                                                    <th>Category</th>
                                                    <th>Username</th>
                                                    <th>Issue</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->

                <!-- footer content -->

                <!-- /footer content -->
            </div>
        </div>

        <!-- jQuery -->
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../vendors/nprogress/nprogress.js"></script>
        <!-- Chart.js -->
        <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
        <!-- gauge.js -->
        <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
        <!-- iCheck -->
        <script src="../vendors/iCheck/icheck.min.js"></script>
        <!-- Skycons -->
        <script src="../vendors/skycons/skycons.js"></script>
        <!-- Flot -->
        <script src="../vendors/Flot/jquery.flot.js"></script>
        <script src="../vendors/Flot/jquery.flot.pie.js"></script>
        <script src="../vendors/Flot/jquery.flot.time.js"></script>
        <script src="../vendors/Flot/jquery.flot.stack.js"></script>
        <script src="../vendors/Flot/jquery.flot.resize.js"></script>
        <!-- Flot plugins -->
        <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
        <!-- DateJS -->
        <script src="../vendors/DateJS/build/date.js"></script>
        <!-- JQVMap -->
        <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
        <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
        <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="../vendors/moment/min/moment.min.js"></script>
        <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>
        
        <script src="../build/js/jquery.dataTables.min.js"></script>

<script src="../build/js/dataTables.bootstrap.js"></script>
        <script src="../build/js/datatable.js"></script>
        <script type="text/javascript" language="javascript" >

            var handleTable = function () {

                grid = new Datatable();
                console.log('I am inside handleTable');
                console.log(grid);
                grid.init({
                    src: $('#support-grid'),
                    loadingMessage: 'Loading...',
                    dataTable: {
                        'language': {
                            'info': '<span class="seperator">|</span><b>Total _TOTAL_ record(s) found</b>',
                            'infoEmpty': '',
                        },
                        "bStateSave": false,
                        // "lengthMenu": siteObjJs.admin.commonJs.constants.gridLengthMenu,
                        "pageLength": 50,
                        "columns": [
                            {data: null, name: 'rownum', searchable: false},
                            {data: 'id', name: 'id', searchable: false},
                            {data: 'tittle', name: 'tittle'},
                            {data: 'description', name: 'description'},
                            {data: 'status', name: 'status'},
                            {data: 'action', name: 'action', orderable: false, searchable: false}
                        ],
                        "drawCallback": function (settings) {
                            var api = this.api();
                            var rows = api.rows({page: 'current'}).nodes();
                            var last = null;
                            var page = api.page();
                            var recNum = null;
                            var displayLength = settings._iDisplayLength;
                            var groupId = '';
                            api.column(0, {page: 'current'}).data().each(function (group, i) {
                                recNum = ((page * displayLength) + i + 1);
                                groupId = $(rows).eq(i).children('td:first').next('td').text();
                                $(rows).eq(i).attr('id', groupId).addClass('group_row').children('td:first').html(recNum);
                                $(rows).eq(i).children('td').addClass('group_row_td');
                                $(rows).eq(i).children('td:last').removeClass('group_row_td');
                            });
                            api.column(3, {page: 'current'}).data().each(function (group, i) {
                                var status = $(rows).eq(i).children('td:nth-child(5)').html();
                                var statusBtn = '';
                                if (status != 'Open') {
                                    statusBtn = '<span class="label label-sm label-success">' + status + '</span>';
                                } else {
                                    statusBtn = '<span class="label label-sm label-danger">' + status + '</span>';
                                }
                                $(rows).eq(i).children('td:nth-child(5)').html(statusBtn);
                            });
                        },
                        "ajax": {
                            "url": "support-grid-data.php",
                            "type": "GET"
                        },
                        "order": [
                            [2, "asc"]
                        ]// set first column as a default sort by asc
                    }
                });
                $('#data-search').keyup(function () {
                    grid.getDataTable().search($(this).val()).draw();
                });

                $(".form-filter-attr").keyup(function (e) {
                    var code = e.which; // recommended to use e.which, it's normalized across browsers
                    if (code == 13)
                        e.preventDefault();
                    if (code == 32 || code == 13 || code == 188 || code == 186) {
                        $('.filter-submit').click();
                    }
                });
                // For drop down filter
                $(".form-filter-select-attr").change(function () {
                    $('.filter-submit').click();
                })
            };
            $(document).ready(function () {
                console.log('I am inside ready');
                handleTable();
            });
        </script>

    </body>
</html>
