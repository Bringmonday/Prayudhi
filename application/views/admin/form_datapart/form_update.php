<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PT Mada Wikri Tunggal</title>
  <link rel="shortcut icon" href="https://i.ibb.co/Xs09T1p/logo-removebg-preview.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url('admin')?>" class="logo" style="background-color: #07575b">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <img src="https://i.ibb.co/5nWNK5X/logo-2-removebg-preview.png" width="100%">
      <!-- logo for regular state and mobile devices -->
      <img src="https://i.ibb.co/5nWNK5X/logo-2-removebg-preview.png" width="100%">
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color: #07575b">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="color: white;">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php foreach($avatar as $a){ ?>
              <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" class="user-image" alt="User Image">
              <?php } ?>
              <span class="hidden-xs" style="color: white;"><?=$this->session->userdata('name')?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" style="background-color: #66a5ad">
                <?php foreach($avatar as $a){ ?>
                <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" class="img-circle" alt="User Image">
                <?php } ?>
                <p>
                  <?=$this->session->userdata('name')?> - Web Developer
                  <small>Last Login : <?=$this->session->userdata('last_login')?></small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer" style="background-color: #C4dfe6">
                <div class="pull-left">
                  <a href="<?= base_url('admin/profile')?>" class="btn btn-default btn-flat" style="margin-left:20px"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?= base_url('admin/sigout')?>" class="btn btn-default btn-flat" style="margin-right:20px"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a>
                </div>
              </li>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->

  <aside class="main-sidebar" style="background-color: #DFE2E6;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php foreach($avatar as $a){ ?>
          <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" class="img-circle" alt="User Image">
          <?php } ?>
        </div>
        <div class="pull-left info">
          <p></p>
          <p style="color: black;"><?=$this->session->userdata('name')?></p>
        </div>
      </div>
      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <style> a:hover {background-color: #B1B5BA;}</style>
      <ul class="sidebar-menu" data-widget="tree">
      <li class="header" style="background-color: #B1B5BA;">HOME</li>
        <link rel="assets" href="style.css">
        <li>
          <a onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black;" href="<?= base_url('admin')?>">
            <i class="fa fa-desktop"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <!-- <i class="fa fa-angle-left pull-right"></i> -->
            </span>
          </a>
          <!-- <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>assets/web_admin/index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="<?php echo base_url('admin')?>"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul> -->
        </li>

        <li class="treeview" style="background-color: #DFE2E6;">
          <a onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black;" href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu" style="background-color: #DFE2E6;">
            <li><a onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black;" href="<?= base_url('admin/form_datapart')?>"><i class="fa fa-square-o"></i> Input Data Part</a></li>
          </ul>
        </li>
        <li class="treeview active">
          <a style="background-color: #DFE2E6;color: black;" onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu" style="background-color: #DFE2E6;">
            <li class="active"><a onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black;font-weight: bold;" href="<?= base_url('admin/tabel_datapart')?>"><i class="fa fa-square-o" style="font-weight: bold;"></i> Data Part Customer</a></li>
            <li><a onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black;"  href="<?= base_url('admin/tabel_datapo')?>"><i class="fa fa-square-o"></i> Data Purchase Order</a></li>
            <li><a onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black;"  href="<?= base_url('admin/tabel_datadelv')?>"><i class="fa fa-square-o"></i> Data Actual Delivery</a></li>
            <li><a  onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black;" href="<?= base_url('admin/tabel_akumulasi')?>"><i class="fa fa-square-o"></i> Akumulasi Delivery Part</a></li>
          </ul>
        </li>
        <li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update Data Part
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('admin/index')?>"><i class="fa fa-bookmark"></i> Home</a></li>
        <li><a href="<?=base_url('admin/tabel_datapart')?>">Tables</a></li>
        <li class="active">Data Part Customer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="container">
            <!-- general form elements -->
          <div class="box box-success" style="width:90%;">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-share-square-o" aria-hidden="true" style="margin-right:5px"></i> Update Data Part</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="container">
            <form action="<?=base_url('admin/proses_tambah_dataPart_update')?>" role="form" method="post">

              <?php if(validation_errors()){ ?>
                <div class="alert alert-warning alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
                </div>
              <?php } ?>

              <div class="box-body">
                <div class="form-group">
                <?php foreach($data_part_update as $d){ ?>
                  <label for="nama_customer"style="margin-left:220px;display:inline;">Nama Customer</label>
                  <select class="form-control" name="nama_customer" id="customer" required style="margin-left: 49px; margin-right: 35px; width: 20%; display: inline;">
                      <option value="" disabled selected>Pilih Customer</option>
                      <?php foreach($list_customer as $s){ ?>
                      <option value="<?=$s->nama_customer?>"><?=$s->nama_customer?></option>
                      <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="nomor_part"style="margin-left:220px;display:inline;">Nomor Part</label>
                  <input autocomplete="off" type="text" name="nomor_part" required style="margin-left:76px;width:20%;display:inline;" class="form-control" id="nomor_part" value="<?=$d->nomor_part?>">
                </div>
                <div class="form-group" style="display:inline">
                  <label for="nama_part" style="margin-left:220px;display:inline;">Nama Part</label>
                  <input type="text" name="nama_part" required style="margin-left:82px;margin-right:35px;width:20%;display:inline;" class="form-control" id="nama_part" value="<?=$d->nama_part?>">
                </div>
                <div class="form-group" style="display:inline-block;">
                  <button type="reset" class="btn btn-default" name="btn_reset" style="width:90px;margin-right:10px;"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
                </div>
                <div class="form-group">
                  <label for="id_part" style="margin-left:220px;display:inline;"></label>
                  <input type="hidden" name="id_part" style="margin-left:106px;width:20%;display:inline;" class="form-control" readonly="readonly" value="<?=$d->id_part?>">
                </div>
                <?php } ?>
              <!-- /.box-body -->

              <div class="box-footer" style="width:89%;">
                <a type="button" class="btn btn-default" style="width:10%" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                <button type="submit" style="width:20%;margin-left:660px;" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>&nbsp;&nbsp;&nbsp;
              </div>
            </form>
          </div>
          </div>
          <!-- /.box -->

          <!-- Form Element sizes -->

          <!-- /.box -->


          <!-- /.box -->

          <!-- Input addon -->

          <!-- /.box -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <!-- <div class="col-md-6">
          <!-- Horizontal Form -->

          <!-- /.box -->
          <!-- general form elements disabled -->

          <!-- /.box -->

        </div>
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright PT Mada Wikri Tunggal &copy; <?=date('Y')?></strong>
    
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
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

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
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

  <!-- jQuery 3 -->
  <script src="<?php echo base_url()?>assets/web_admin/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url()?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url()?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url()?>assets/web_admin/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url()?>assets/web_admin/dist/js/demo.js"></script>
  </body>
  </html>
