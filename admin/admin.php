<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AksesKSM | Pengguna</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
	<link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<style>
	  .modal-body{ overflow-y:scroll; height:570px; }
	</style>
  </head>
  <body class="skin-green layout-boxed">
  <?php 
  session_start();
  require 'config.php';
  if (!isset($_SESSION['login'])) {
	  header("Location: login.php");
  }
  if($rowIdSekarang['jabatan'] == 1) { header("Location: index.php"); }
  else if($rowIdSekarang['jabatan'] == 2) { header("Location: ../index.php"); }
  $_SESSION['tabEvent'] = 0;
  $sqlKaryawan = "SELECT * FROM pengguna WHERE jabatan = 0 AND s_hapus = 0";
  $resultKaryawan = mysqli_query($mysqli, $sqlKaryawan);
  if (!$resultKaryawan) {
    die("SQL Error : " . $sqlKaryawan);
  }
  ?>
	<div class="wrapper">
      <header class="main-header">
        <a href="index2.html" class="logo"><b><?php if($rowIdSekarang['jabatan'] == 1 || $rowIdSekarang['jabatan'] == 2){ echo 'Panitia'; } 
		else { echo 'Admin'; } ?></b>KSM</a>
        <nav class="navbar navbar-static-top" role="navigation">
		  <img src="dist/img/sidebar.png" style="width:50px; height:50px;" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu" id="dropdownprofil">
                  <a href="#" onclick="bukatutupdropdownprofil();">
                  <?php 
					if($rowIdSekarang['jabatan'] == 1 && $rowIdSekarang['kelamin'] == 1) { 
					  echo '<img src="dist/img/karLk.png" class="user-image" alt="User Image" />';
					} else if($rowIdSekarang['jabatan'] == 1 && $rowIdSekarang['kelamin'] == 0){
					  echo '<img src="dist/img/karPr.png" class="user-image" alt="User Image" />';  
					} else {
					  echo '<img src="dist/img/boss.jpg" class="user-image" alt="User Image" />';  
					} ?>
                  <span class="hidden-xs"><?php echo $rowIdSekarang['username']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
					<?php 
					if($rowIdSekarang['jabatan'] == 1 && $rowIdSekarang['kelamin'] == 1) { 
					  echo '<img src="dist/img/karLk.png" class="img-circle" alt="User Image" />';
					} else if($rowIdSekarang['jabatan'] == 1 && $rowIdSekarang['kelamin'] == 0){
					  echo '<img src="dist/img/karPr.png" class="img-circle" alt="User Image" />';  
					} else {
					  echo '<img src="dist/img/boss.jpg" class="img-circle" alt="User Image" />';  
					}?>
                    <p>
                      <?php if($rowIdSekarang['jabatan'] == 1 || $rowIdSekarang['jabatan'] == 2) {
						echo $rowIdSekarang['nama']." - Panitia";   
					  } else {
						echo $rowIdSekarang['nama']." - Admin";  
					  } ?>
                      <small>Hp : <?php echo $rowIdSekarang['no_telp']; ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a class="btn btn-default btn-flat" onclick="dataUserLogin(<?php echo $rowIdSekarang['id_user']; ?>)" data-toggle="modal" data-target="#myModal">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="index.php">Beranda</a></li>
			<li class="treeview active">
              <a href="admin.php">Pengguna</a>
              <ul class="treeview-menu">
                <li class="active"><a href="admin.php">Admin</a></li>
                <li><a href="panitia.php">Panitia</a></li>
				<li><a href="pengunjung.php">Pengunjung</a></li>
              </ul>
            </li>
			<li><a href="event.php">Event</a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Semua Admin
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
		  <div class="row">
            <div class="col-xs-12">
			  <p>
			  <button type="button" class="btn btn-primary" onclick="dataPenggunaTambah()" data-toggle="modal" data-target="#myModal">+ Tambah Admin</button>
			  &nbsp;&nbsp;&nbsp;
			  <a class="btn btn-warning" onclick="dataPenggunaRestore()" data-toggle="modal" data-target="#myModal">
			  <span class="glyphicon glyphicon-trash"></span>
			  </a>
			  </p>
          
			  <div class="box">
                <!--<div class="box-header">
                  <h3 class="box-title">Data Table With Full Features</h3>
                </div> /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>USERNAME</th>
                        <th>NAMA LENGKAP</th>
                        <th>STATUS</th>
                        <th colspan="3"><center>ALAT</center></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
					while ($rowKaryawan = mysqli_fetch_object($resultKaryawan)) { ?>
					  <tr>
						<td><?php echo $rowKaryawan->username; ?></td>
						<td><?php echo $rowKaryawan->nama; ?></td>
						<td><?php if($rowKaryawan->status == 0){ echo "non-aktif"; } else { echo "aktif"; }?></td>
						<td><center><a class="btn btn-xs btn-info" onclick="dataPenggunaDetail(<?php echo $rowKaryawan->id_user; ?>)" data-toggle="modal" data-target="#myModal">detail</a></center></td>
						<td><center><a class="btn btn-xs bg-maroon" onclick="dataPenggunaEdit(<?php echo $rowKaryawan->id_user; ?>)" data-toggle="modal" data-target="#myModal">edit</a></center></td>
						<td><center><a class="btn btn-xs btn-danger" onclick="dataPenggunaHapus(<?php echo $rowKaryawan->id_user; ?>)" data-toggle="modal" data-target="#myModal">hapus</a></center></td>
					  </tr>
					<?php } ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			<div class="row">
          <div class="col-xs-12">  
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2014-2015 Almsaeed Studio.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->
	<!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
	<!-- DATA TABES SCRIPT -->
    <script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
	<script>
        function dataPenggunaDetail(id){
			$("#modal-body").load("data_pengguna.php?idDetail="+id+"&user=0");
		} function dataPenggunaEdit(id){
			$("#modal-body").load("data_pengguna.php?idEdit="+id+"&user=0");
		} function dataPenggunaHapus(id){
			$("#modal-body").load("data_pengguna.php?idHapus="+id+"&user=0");
		} function dataPenggunaTambah(){
			$("#modal-body").load("data_pengguna.php?idTambah='A'&user=0");
		} function dataPenggunaRestore(){
			$("#modal-body").load("data_pengguna.php?restorHapus='A'&user=0");
		}
    </script>
  </body>
</html>