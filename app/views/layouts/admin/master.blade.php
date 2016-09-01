<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('title')
    </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/frontend/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/frontend/font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/frontend/adminres/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/frontend/adminres/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/frontend/adminres/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="/frontend/adminres/plugins/morris/morris.css">
    <link rel="stylesheet" href="/frontend/adminres/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="/frontend/adminres/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="/frontend/adminres/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/frontend/adminres/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    {{ HTML::style('/frontend/font-awesome/css/font-awesome.min.css') }}

    <script src="/js/jquery-1.11.0.min.js"></script>
    {{ HTML::script('/frontend/js/html5shiv.js') }}
    {{ HTML::script('/frontend/js/respond.min.js') }}
    @yield('head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="/admin" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>P</b>VK</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>PROVEEK</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <ul class="sidebar-menu">
                <!-- ITEMS FOR `CONTENT_EDITOR` -->
                @if(AdminController::IF_ADMIN_IS(['ADMINISTRATOR'], Auth::user()->id))
                    <li class="header">ADMINISTRATOR</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>Manage User Accounts</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/subadmin/pending_users"><i class="text-red fa fa-circle-o"></i> Pending Users</a></li>
                            <li><a href="/subadmin/workers"><i class="text-green fa fa-circle-o"></i> Workers</a></li>
                            <li><a href="/subadmin/employers"><i class="text-blue fa fa-circle-o"></i> Employers</a></li>
                        </ul>
                    </li>
                    <li><a href="/subadmin/jobads"><i class="fa fa-briefcase"></i> <span>Manage Job Ads</span></a></li>
                @elseif(AdminController::IF_ADMIN_IS(['SUPPORT'], Auth::user()->id))
                    <li class="header">SUPPORT</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>View User Accounts</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/subadmin/view_pending_users"><i class="text-red fa fa-circle-o"></i> Pending Users</a></li>
                            <li><a href="/subadmin/view_workers"><i class="text-green fa fa-circle-o"></i> Workers</a></li>
                            <li><a href="/subadmin/view_employers"><i class="text-blue fa fa-circle-o"></i> Companies</a></li>
                        </ul>
                    </li>
                    <li><a href="/subadmin/view_jobads"><i class="fa fa-briefcase"></i> <span>View Job Ads</span></a></li>
                @endif

                @if(AdminController::IF_ADMIN_IS(['CONTENT_EDITOR'], Auth::user()->id))
                    <li class="header">CONTENT EDITOR</li>
                    <li><a href="/subadmin/terms_of_service"><i class="fa fa-gavel"></i> <span>Terms Of Service</span></a></li>
                    <li><a href="#"><i class="fa fa-eye"></i> <span>Policy</span></a></li>
                @endif
                <li><a href="/logout"><i class="fa fa-power-off text-red"></i> <span>Logout</span></a></li>

                <!--
                @if(AdminController::IF_ADMIN_IS(['SUPPORT'], Auth::user()->id))
                    <li class="header">SUPPORT</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>View User Accounts</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="text-red fa fa-circle-o"></i> Pending Users</a></li>
                            <li><a href="#"><i class="text-green fa fa-circle-o"></i> Workers</a></li>
                            <li><a href="#"><i class="text-blue fa fa-circle-o"></i> Companies</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-briefcase"></i> <span>View Job Ads</span></a></li>
                @endif
                -->
                <!--
                <li>
                <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span>
                <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
                </span>
                </a>
                </li>
                <li class="treeview">
                <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Charts</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                <li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                <li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                </ul>
                </li>
                <li>
                <a href="pages/calendar.html">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <span class="pull-right-container">
                <small class="label pull-right bg-red">3</small>
                <small class="label pull-right bg-blue">17</small>
                </span>
                </a>
                </li>
                <li class="header">LABELS</li>
                <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
                <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
                <li class="header">LABELS</li>
                <li>
                <a href="pages/widgets.html">
                <i class="fa fa-th"></i> <span>Widgets</span>
                <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
                </span>
                </a>
                </li>
                -->
            </ul>
        </section>
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
            @yield('content_header')
        </section>
        <section class="content">
            @yield('body')
        </section>
    </div>
    <!--
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.3.6
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong>
        All rights reserved.
    </footer>
    -->
</div>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="/frontend/adminres/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="/frontend/adminres/plugins/morris/morris.min.js"></script>
<script src="/frontend/adminres/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="/frontend/adminres/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/frontend/adminres/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/frontend/adminres/plugins/knob/jquery.knob.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="/frontend/adminres/plugins/daterangepicker/daterangepicker.js"></script>
<script src="/frontend/adminres/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/frontend/adminres/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="/frontend/adminres/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="/frontend/adminres/plugins/fastclick/fastclick.js"></script>
<script src="/frontend/adminres/dist/js/app.min.js"></script>
    {{ HTML::script('js/taskminator.js') }}
</body>
</html>
