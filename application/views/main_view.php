<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | APLIKASI KEHADIRAN SISWA</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>css/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="<?php echo base_url() ?>css/skin/skin-blue.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>css/plugin/datepicker/datepicker.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- jQuery 2.2.3 -->
  <script src="<?php echo base_url() ?>js/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>js/app.min.js"></script>
  
  <script src="<?php echo base_url() ?>js/datepicker/bootstrap-datepicker.js"></script>
  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!-- Main Header -->
  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Presence</b>APP</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo base_url() ?>img/avatar5.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $this->session->userdata('staff_name') ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo base_url() ?>img/avatar5.png" class="user-image" alt="User Image"><br/>
                <p>
                  <?php echo $this->session->userdata('staff_name') ?>
                  <small><?php echo $this->session->userdata('role') ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <!--
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div> -->
                <div class="pull-right">
                  <a href="<?php echo base_url() ?>index.php/auth/end_session" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
            <img src="<?php echo base_url() ?>img/avatar5.png" class="user-image" alt="User Image"><br/>
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('staff_name') ?></p>
        </div>
      </div>
      
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MENU UTAMA</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="<?php echo site_url('user') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Pengguna</span></a></li>
        <li><a href="<?php echo site_url('role') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Peran</span></a></li>
        <li><a href="<?php echo site_url('staff') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Staff</span></a></li>
        <li><a href="<?php echo site_url('student') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Siswa</span></a></li>
        <li><a href="<?php echo site_url('student_group') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Kelas</span></a></li>
        <li><a href="<?php echo site_url('student_presence') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Absensi Siswa</span></a></li>
        <li><a href="<?php echo site_url('staff_presence') ?>"><i class="fa fa-circle-o text-aqua"></i> <span>Absensi Staff</span></a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Laporan Absensi Siswa</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><?php echo anchor('report/student', 'Rekap Bulanan') ?></li>
            <li><?php echo anchor('report/student_daily', 'Rekap Harian') ?></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Laporan Absensi Staff</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><?php echo anchor('report/staff', 'Rekap Bulanan') ?></li>
            <li><?php echo anchor('report/staff_daily', 'Rekap Harian') ?></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Aplikasi Absensi 
        <!--
        <small>Optional description</small>
        -->
      </h1>
    </section>

    <!-- Main content -->
    <div class="content body">
      <!-- Your Page Content Here -->
        <?php 
          if (isset($content_view)) {
            $this->load->view($content_view);
          } else {
            echo "<h2>Content View Not Found Or Empty</h2>";  
          }
        ?>
    </div>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Tanggal : <?php echo date('d/m/Y') ?>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
