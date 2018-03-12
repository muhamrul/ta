<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminG56 | Pengguna</title>
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
  $sqlKaryawan = "SELECT * FROM karyawan";
  $resultKaryawan = mysqli_query($mysqli, $sqlKaryawan);
  if (!$resultKaryawan) {
    die("SQL Error : " . $sqlKaryawan);
  }
  ?>
	<div class="wrapper">
      <header class="main-header">
        <a href="index2.html" class="logo"><b>Admin</b>G56</a>
        <nav class="navbar navbar-static-top" role="navigation">
		  <img src="dist/img/sidebar.png" style="width:50px; height:50px;" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu" id="dropdownprofil">
                  <a href="#" onclick="bukatutupdropdownprofil();">
                  <?php 
					if($rowIdSekarang['jabatan'] == 0) {
					  echo '<img src="dist/img/boss.jpg" class="user-image" alt="User Image" />';   
					} else if($rowIdSekarang['jabatan'] == 1 && $rowIdSekarang['kelamin'] == 0){
					  echo '<img src="dist/img/karPr.png" class="user-image" alt="User Image" />';  
					} else {
					  echo '<img src="dist/img/karLk.png" class="user-image" alt="User Image" />';  
					}?>
                  <span class="hidden-xs"><?php echo $rowIdSekarang['username']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
					<?php 
					if($rowIdSekarang['jabatan'] == 0) {
					  echo '<img src="dist/img/boss.jpg" class="img-circle" alt="User Image" />';   
					} else if($rowIdSekarang['jabatan'] == 1 && $rowIdSekarang['kelamin'] == 0){
					  echo '<img src="dist/img/karPr.png" class="img-circle" alt="User Image" />';  
					} else {
					  echo '<img src="dist/img/karLk.png" class="img-circle" alt="User Image" />';  
					}?>
                    <p>
                      <?php if($rowIdSekarang['jabatan'] == 0) {
						echo $rowIdSekarang['nama']." - BOSS";   
					  } else {
						echo $rowIdSekarang['nama']." - Karyawan";  
					  } ?>
                      <small>Hp : <?php echo $rowIdSekarang['no_telp']; ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a class="btn btn-default btn-flat" onclick="dataUserLogin(<?php echo $rowIdSekarang['id_user']; ?>)" data-toggle="modal" data-target="#tambahPenggunaModal">Profile</a>
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
            <li><a href="index.php">Nota Jual</a></li>
			<li class="active"><a href="pengguna.php">Pengguna</a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Semua Pengguna
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
		  <div class="row">
            <div class="col-xs-12">
			  <p><button type="button" class="btn btn-primary" onclick="dataPenggunaTambah()" data-toggle="modal" data-target="#tambahPenggunaModal">+ Tambah Boss/Staff</button></p>
          
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
                        <th>JABATAN</th>
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
						<td><?php if($rowKaryawan->jabatan == 0){ echo "BOSS"; } else { echo "Karyawan"; }?></td>
						<td><?php if($rowKaryawan->status == 0){ echo "non-aktif"; } else { echo "aktif"; }?></td>
						<td><center><a class="btn btn-xs btn-info" onclick="dataPenggunaDetail(<?php echo $rowKaryawan->id_user; ?>)" data-toggle="modal" data-target="#tambahPenggunaModal">detail</a></center></td>
						<td><center><a class="btn btn-xs bg-maroon" onclick="dataPenggunaEdit(<?php echo $rowKaryawan->id_user; ?>)" data-toggle="modal" data-target="#tambahPenggunaModal">edit</a></center></td>
						<td><center><a class="btn btn-xs btn-danger" onclick="dataPenggunaHapus(<?php echo $rowKaryawan->id_user; ?>)" data-toggle="modal" data-target="#tambahPenggunaModal">hapus</a></center></td>
					  </tr>
					<?php } ?>
                    </tbody>
                    <tfoot>
					  <tr>
                        <th>USERNAME</th>
                        <th>NAMA LENGKAP</th>
                        <th>JABATAN</th>
                        <th>STATUS</th>
                        <th colspan="3"><center>ALAT</center></th>
                      </tr>
                    </tfoot>
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
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
	<!-- page script -->
      
      $(function(){
        $('#example1').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
            });
        });
        
        function dataPenggunaDetail(id){
			$(".modal-body").load("data_pengguna.php?idDetail="+id);
		} function dataPenggunaEdit(id){
			$(".modal-body").load("data_pengguna.php?idEdit="+id);
		} function dataPenggunaHapus(id){
			$(".modal-body").load("data_pengguna.php?idHapus="+id);
		} function dataPenggunaTambah(){
			$(".modal-body").load("data_pengguna.php");
		}

    function bukatutupdropdownprofil(){
      // alert("function buka tutup dropdown");
      if($("#dropdownprofil").hasClass("open")){
        // alert("drop down terbuka");
        $("#dropdownprofil").removeClass("open")
      }else{
        // alert("drop down tertutup");
        $("#dropdownprofil").addClass("open")
      }
    }
    </script>
  </body>
</html>