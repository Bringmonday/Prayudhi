<!DOCTYPE html>
<html>
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
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="<?php echo base_url()?>assets/sweetalert/dist/sweetalert.css">
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
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
                <?php if (!empty($avatar)): ?>
                <?php foreach ($avatar as $a): ?>
                    <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" class="user-image" alt="User Image">
                <?php endforeach; ?>
                <?php endif; ?>
                <span class="hidden-xs" style="color: white;"><?=$this->session->userdata('name')?></span>
            </a>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header" style="background-color: #66a5ad">
                <?php if (!empty($avatar)): ?>
                    <?php foreach ($avatar as $a): ?>
                    <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" class="img-circle" alt="User Image">
                    <?php endforeach; ?>
                <?php endif; ?>
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
            <li class="active"><a  onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black;font-weight: bold" href="<?= base_url('admin/tabel_datapo')?>"><i class="fa fa-square-o" style="font-weight: bold;"></i> Data Purchase Order</a></li>
            <li><a onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black"  href="<?= base_url('admin/tabel_datadelv')?>"><i class="fa fa-square-o"></i> Data Actual Delivery</a></li>
            <li><a  onmouseover="this.style.backgroundColor='#B1B5BA';" onmouseout="this.style.backgroundColor='#DFE2E6';" style="color: black;" href="<?= base_url('admin/tabel_akumulasi')?>"><i class="fa fa-square-o"></i> Akumulasi Delivery Part</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Purchase Order
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('admin/index')?>"><i class="fa fa-bookmark"></i> Home</a></li>
        <li><a href="<?=base_url('admin/form_datadelv')?>">Tables</a></li>
        <li>Data Purchase Order</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <!-- /.box -->
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-table" aria-hidden="true" style="margin-right:5px"></i>Detail Purchase Order</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <?php if($this->session->flashdata('msg_berhasil_masuk')){ ?>
                <div class="alert alert-success alert-dismissible" style="width:100%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil_masuk');?>
               </div>
              <?php } ?>

              <?php if($this->session->flashdata('msg_berhasil_keluar')){ ?>
                <div class="alert alert-success alert-dismissible" style="width:100%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil_keluar');?>
               </div>
              <?php } ?>
              
              <form  method="post" action="<?= base_url('admin/cari_po') ?>" style="display: flex;">
              <a type="button" class="btn btn-default" style="flex: 0; margin-left: 10px; margin-right: 10px; margin-top: 25px;  height:35px;"  href="<?=base_url('admin/tabel_datapo')?>" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>

              <div class="form-group">
                <label for="nama_part">Nama Part:</label>
                <select class="form-control" name="nama_part" id="nama_part_select" required style="margin-left: 0px; margin-right: 35px; width: 100%;">
                <option value="" disabled selected>Pilih Nama Part</option>
                <?php foreach ($list_part as $s) { ?>
                  <option value="<?= $s->nama_part ?>" data-nama-part=<?= $s->nomor_part ?>><?= $s->nama_part ?></option>
                <?php } ?>
              </select>
              </div>
              <div class="form-group" style="margin-left: 10px;">
                <label for="nomor_part">Nomor Part:</label>
                <input type="text" style= "margin-left: 1px; width: 100%;" class="form-control" id="nomor_part" name="nomor_part" placeholder="Nama Part Customer" readonly="true">
              </div>
              <div class="form-group" style="margin-left: 10px;">
                <label for="nomor_po">Nomor PO:</label>
                <select class="form-control" name="nomor_po" id="nomor_po" style="margin-left: 0px; margin-right: 35px; width: 100%;">
                    <option value="" disabled selected>Pilih Nomor PO</option>
                    <?php foreach ($list_part_po as $s) { ?>
                        <option value="<?= $s->nomor_po ?>" data-bulan="<?= $s->bulan ?>"><?= $s->nomor_po ?></option>
                    <?php } ?>
                  </select>
              </div>
              <div class="form-group" style="margin-left: 10px;">
                <label for="bulan">Bulan:</label>
                <input type="text" style= "margin-left: 1px; width: 100%;" class="form-control" id="bulan" name="bulan" placeholder="Bulan" readonly="true">
              </div>

              
              <script>
                  document.addEventListener("DOMContentLoaded", function () {
                      var namaPartSelect = document.getElementById("nama_part_select");
                      var nomorPartInput = document.getElementById("nomor_part");
                      var bulanSelect = document.getElementById('bulan');
                      var nomorPoSelect = document.getElementById('nomor_po');

                      namaPartSelect.addEventListener("change", function () {
                          var selectedOption = this.options[this.selectedIndex];

                          var nomorPartValue = selectedOption.getAttribute("data-nama-part");

                          nomorPartInput.value = nomorPartValue;
                      });

                      nomorPoSelect.addEventListener("change", function () {
                          var selectedOption = this.options[this.selectedIndex];

                          var bulanValue = selectedOption.getAttribute("data-bulan");

                          bulanSelect.value = bulanValue;
                      });
                  });
              </script>

              <button type="submit" class="btn btn-sm btn-primary" style="flex: 0; margin-left: 10px; margin-top: 25px; width: 150px; height: 35px;">Search</button>
            </form>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Customer</th>
                  <th>No Purchase Order</th>
                  <th>Bulan</th>
                  <th>Tanggal Input</th>
                  <th>Nama Part</th>
                  <th>Nomor Part</th>
                  <th>Satuan</th>
                  <th>Qty Purchase Order</th>
                  <th>Harga Part</th>
                  <th>Keterangan</th>
                  <th style="text-align: center;">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <?php if(is_array($list_data)){ ?>
                  <?php $no = 1;?>
                  <?php foreach($list_data as $dd): ?>
                    <td><?=$dd->nama_customer?></td>
                    <td><?=$dd->nomor_po?></td>
                    <td><?=$dd->bulan?></td>
                    <td><?=$dd->tanggal_masuk?></td>
                    <td><?=$dd->nomor_part?></td>
                    <td><?=$dd->nama_part?></td>
                    <td><?=$dd->satuan?></td>
                    <td><?=$dd->jumlah?></td>
                    <td><?=$dd->harga?></td>
                    <td><?=$dd->keterangan?></td>
                    <td align="center">
                        <a type="button" title="Update" class="btn btn-info"  href="<?=base_url('admin/update_data_po/'.$dd->id_po)?>" name="btn_update" style="margin-right:5px;"><i class="fa fa-pencil" aria-hidden="true"></i></a> 
                        <a type="button" title="Delete" class="btn btn-danger btn-delete"  href="<?=base_url('admin/delete_data_po/'.$dd->id_po)?>" name="btn_delete" style="margin:2px;margin-left:-4px;"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        <a type="button" title="Tambah" class="btn btn-warning btn-tambah"  href="<?=base_url('admin/input_datapo/'.$dd->id_po)?>" name="btn_tambah" style="margin:1px;margin-left:-4px;" background-color:orange;><i class="fa fa-plus-square" aria-hidden="true"></i></a>
                    </td>
                </tr>
              <?php $no++; ?>
              <?php endforeach;?>
              <?php }else { ?>
                    <td colspan="7" align="center"><strong>Data Kosong</strong></td>
              <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <footer class="main-footer">
    <strong>Copyright PT Mada Wikri Tunggal &copy; <?=date('Y')?></strong>
    
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>

<!-- jQuery 3 -->
<script src="<?php echo base_url()?>assets/web_admin/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/sweetalert/dist/sweetalert.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url()?>assets/web_admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/web_admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url()?>assets/web_admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>assets/web_admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>assets/web_admin/dist/js/demo.js"></script>
<!-- page script -->
<script>
jQuery(document).ready(function($){
      $('.btn-delete').on('click',function(){
          var getLink = $(this).attr('href');
          swal({
                  title: 'Delete Data Part',
                  text: 'Apakah Anda Ingin Menghapus Data?',
                  html: true,
                  confirmButtonColor: '#d9534f',
                  showCancelButton: true,
                  },function(){
                  window.location.href = getLink
              });
          return false;
      });
  });

  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
});



</script>
</body>
</html>
