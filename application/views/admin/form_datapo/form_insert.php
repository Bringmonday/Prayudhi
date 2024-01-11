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
  <link rel="stylesheet" href="<?php echo base_url()?>assets/datetimepicker/css/bootstrap-datetimepicker.css">
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
                  <?=$this->session->userdata('name')?> - PT Mada Wikri Tunggal
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
            <li class="active"><a href="<?= base_url('admin') ?>"><i class="fa fa-circle-o"></i> Dashboard</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul> -->
        </li>

        <li class="treeview">
          <a style="background-color: #DFE2E6;color: black;" onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu" style="background-color: #DFE2E6;">
            <li><a onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black;" href="<?= base_url('admin/form_datapart')?>"><i class="fa fa-square-o"></i>Input Data Part</a></li>
            <li><a onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black;" href="<?= base_url('admin/form_customer')?>"><i class="fa fa-square-o"></i> Input Data Customer</a></li>
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
            <li><a  onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black;" href="<?= base_url('admin/tabel_datapart')?>"><i class="fa fa-square-o"></i> Data Part Customer</a></li>
            <li><a  onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black;;font-weight: bold" href="<?= base_url('admin/tabel_datapo')?>"><i class="fa fa-square-o" style="font-weight: bold;"></i> Data Purchase Order</a></li>
            <li><a onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black;"  href="<?= base_url('admin/tabel_datadelv')?>"><i class="fa fa-square-o"></i> Data Actual Delivery</a></li>
            <li><a  onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black;" href="<?= base_url('admin/tabel_akumulasi')?>"><i class="fa fa-square-o"></i> Akumulasi Delivery Part</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <style> a:hover {background-color: #B1B5BA;}</style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Purchase Order
      </h1>
      <ol class="breadcrumb">
        <li><a href="index"><i class="fa fa-bookmark"></i>Home</a></li>
        <li><a href="form_datadelv">Forms</a></li>
        <li class="active">Data Purchase Order</li>
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
              <h3 class="box-title"><i class="fa fa-pencil-square-o" aria-hidden="true" style="margin-right:5px"></i>Purchase Order</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="container">
            <form action="<?=base_url('admin/proses_tambah_dataPo_insert')?>" id="data_po" role="form" method="post">

              <?php if($this->session->flashdata('msg_error')){ ?>
                <div class="alert alert-error alert-dismissible" style="width:91%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong><br> <?php echo $this->session->flashdata('msg_error');?>
                </div>
              <?php } ?>

              <?php if($this->session->flashdata('msg_berhasil')){ ?>
                <div class="alert alert-success alert-dismissible" style="width:91%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
                </div>
              <?php } ?>

              <?php if(validation_errors()){ ?>
              <div class="alert alert-warning alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
              </div>
              <?php } ?>

              <div class="box-body">
              <?php foreach ($data_part_input as $d) { ?>
                    <div class="form-group">
                      <label for="nama_customer" style="margin-left:220px;display:inline;">Nama Customer</label>
                      <input type="text" name="nama_customer" style="margin-left:35px;margin-right:20px;width:20%;display:inline;" class="form-control" readonly="true" id="nama_customer" value="<?= $d->nama_customer ?>">
                    </div>
                    <div class="form-group">
                      <label for="bulan" style="margin-left: 218px; display: inline;">Bulan</label>
                      <select class="form-control" name="bulan" id="bulan" required style="margin-left: 98px; margin-right: 35px; width: 20%; display: inline;">
                          <option value="" disabled selected>Pilih Bulan</option> 
                          <?php foreach($list_bulan as $bulan) { ?>
                          <option value="<?= $bulan->bulan ?>"><?= $bulan->bulan ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="tanggal_masuk" style="margin-left:220px;display:inline;">Tanggal Input</label> 
                      <input type="datetime-local" name="tanggal_masuk" required style="margin-left:47px;width:20%;display:inline;" class="form-control" required="" placeholder="Klik Disini">
                    </div>
                    <div class="form-group">
                      <label for="nomor_po" style="margin-left:220px;display:inline;">No Purchase Order</label>
                      <input autocomplete="off" type="text" name="nomor_po" required style="margin-left:18px;margin-right:35px;width:20%;display:inline;" class="form-control" id="nomor_po" placeholder="Nomor Purchase Order">
                    </div>
                    <div class="form-group">
                      <label for="nomor_part" style="margin-left:220px;display:inline;">Nomor Part</label>
                      <input type="text" name="nomor_part" style="margin-left:62px;margin-right:35px;width:20%;display:inline;"  readonly="true" class="form-control" id="nomor_part" value="<?= $d->nomor_part ?>">
                    </div>
                    <div class="form-group">
                      <label for="nama_part" style="margin-left:220px;display:inline;">Nama Part</label>
                      <input type="text" name="nama_part" style="margin-left:68px;margin-right:35px;width:20%;display:inline;"  readonly="true" class="form-control" id="nama_part" value="<?= $d->nama_part ?>">
                    </div>
                    <div class="form-group">
                      <label for="satuan" style="margin-left:220px;display:inline;">Satuan</label>
                      <input type="text" name="satuan" style="margin-left:90px;margin-right:35px;width:20%;display:inline;"  readonly="true" class="form-control" id="satuan" value="Pcs">
                    </div>
                    <div class="form-group">
                    <label for="jumlah" style="margin-left:220px;display:inline;">Jumlah</label>
                    <input autocomplete="off" type="number" name="jumlah" required style="margin-left:87px;margin-right:35px;width:20%;display:inline;" class="form-control" id="jumlah" placeholder="Qty Purchase Order">
                  </div>
                  <div class="form-group">
                    <label for="harga" style="margin-left:220px;display:inline;">Harga</label>
                    <input autocomplete="off" type="number" name="harga" required style="margin-left:97px;margin-right:35px;width:20%;display:inline;" class="form-control" id="harga" placeholder="Harga Part">
                  </div>
                  <div class="form-group" style="display:inline">
                    <label for="keterangan" style="margin-left:220px;display:inline;">Keterangan</label>
                    <input autocomplete="off" type="text" name="keterangan" required style="margin-left:63px;margin-right:35px;width:20%;display:inline;" class="form-control" placeholder="Keterangan">
                  </div>
                  <div class="form-group" style="display:inline-block;">
                    <button type="reset" class="btn btn-default" name="btn_reset" style="width:90px;margin-right:10px;"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
                  </div>
                  <div class="form-group">
                      <label for="id_po" style="margin-left:220px;display:inline;"></label>
                      <input autocomplete="off" type="hidden" name="id_po" required style="margin-left:68px;width:20%;display:inline;" class="form-control" readonly="true"
                    value="MWT-<?=date("Ymd");?><?=random_string('numeric', 3);?>">
                    </div>
                <?php } ?>
              <!-- /.box-body -->
              
              <div class="box-footer" style="width:89%;">
                <a type="button" class="btn btn-default" style="width:10%;margin-right:26%" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                <a type="button" class="" style="width:20%;margin-right:52%" href="<?=base_url('admin/tabel_datadelv')?>" name="btn_listbarang"><i class="" aria-hidden="true"></i></a>
                <button type="submit" style="width:10%" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
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
  <script src="<?php echo base_url()?>assets/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url()?>assets/web_admin/dist/js/demo.js"></script>

  <script type="text/javascript">
      $(".form_datetime").datetimepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayBtn: true,
        pickTime: false,
        minView: 2,
        maxView: 4,
      });
  </script>
  </body>
  </html>