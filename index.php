<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminG56 | Nota Jual</title>
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
  ?>
    <div class="wrapper">
      <header class="main-header">
        <a href="index2.html" class="logo"><b>Admin</b>G56</a>
        <nav class="navbar navbar-static-top" role="navigation">
            <span class="sr-only">Toggle navigation</span>
			<img src="dist/img/sidebar.png" style="width:50px; height:50px;" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
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
            <li class="treeview active">
              <a href="index.php">Nota Jual</a>
              <ul class="treeview-menu">
                <li class="active"><a href="index.php">Hari Ini</a></li>
                <li><a href="#">Semua</a></li>
              </ul>
            </li>
			<?php if($rowIdSekarang['jabatan'] == 0) { echo '<li><a href="pengguna.php">Pengguna</a></li>'; } ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Nota Jual
            <small>Hari ini</small>
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
		  <p><button class="btn btn-primary">+ Tambah Nota Jual</button></p>
          <div class="box">
                <!--<div class="box-header">
                  <h3 class="box-title">Data Table With Full Features</h3>
                </div> /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Trident</td>
                        <td>Internet
                          Explorer 4.0</td>
                        <td>Win 95+</td>
                        <td> 4</td>
                        <td>X</td>
                      </tr>
                      <tr>
                        <td>Gecko</td>
                        <td>Firefox 1.0</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.7</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Webkit</td>
                        <td>S60</td>
                        <td>S60</td>
                        <td>413</td>
                        <td>A</td>
                      </tr>
                      <tr>
                        <td>Presto</td>
                        <td>Nintendo DS browser</td>
                        <td>Nintendo DS</td>
                        <td>8.5</td>
                        <td>C/A<sup>1</sup></td>
                      </tr>
                      <tr>
                        <td>KHTML</td>
                        <td>Konqureror 3.1</td>
                        <td>KDE 3.1</td>
                        <td>3.1</td>
                        <td>C</td>
                      </tr>
                      <tr>
                        <td>Tasman</td>
                        <td>Internet Explorer 4.5</td>
                        <td>Mac OS 8-9</td>
                        <td>-</td>
                        <td>X</td>
                      </tr>
                      <tr>
                        <td>Misc</td>
                        <td>Links</td>
                        <td>Text only</td>
                        <td>-</td>
                        <td>X</td>
                      </tr>
                      <tr>
                        <td>Other browsers</td>
                        <td>All others</td>
                        <td>-</td>
                        <td>-</td>
                        <td>U</td>
                      </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
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
    <!-- page script -->
    <script type="text/javascript">
	  $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>
  </body>
</html>