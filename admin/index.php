<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AksesKSM | Beranda</title>
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
  if($rowIdSekarang['jabatan'] == 2) { header("Location: ../index.php"); }
  $_SESSION['tabEvent'] = 0;
  ?>
    <div class="wrapper">
      <header class="main-header">
        <a class="logo"><b><?php if($rowIdSekarang['jabatan'] == 1){ echo 'Panitia'; } 
		else { echo 'Admin'; } ?></b>KSM</a>
        <nav class="navbar navbar-static-top" role="navigation">
            <span class="sr-only">Toggle navigation</span>
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
					} ?>
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
            <li class="active"><a href="index.php">Beranda</a></li>
			<?php if($rowIdSekarang['jabatan'] != 1 && $rowIdSekarang['jabatan'] != 2) { echo '<li><a href="admin.php">Pengguna</a></li>'; } ?>
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
            Beranda
            <small></small>
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
              <!-- Chat box -->
              <div class="box box-success">
                <div class="box-header">
                  <i class="fa fa-comments-o"></i>
                  <h3 class="box-title">Kritik & Saran</h3>
                </div>
                <div class="box-body chat" id="chat-box">
                  <!-- chat item -->
                  <div class="item">
                    <img src="dist/img/boss.jpg" alt="user image" class="online"/>
                    <p class="message">
                      <a href="#" class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                        Mike Doe
                      </a>
                      I would like to meet you to discuss the latest news about
                      the arrival of the new theme. They say it is going to be one the
                      best themes on the market
                    </p>
                  </div><!-- /.item -->
                  <!-- chat item -->
                  <div class="item">
                    <img src="dist/img/boss.jpg" alt="user image" class="offline"/>
                    <p class="message">
                      <a href="#" class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
                        Alexander Pierce
                      </a>
                      I would like to meet you to discuss the latest news about
                      the arrival of the new theme. They say it is going to be one the
                      best themes on the market
                    </p>
                  </div><!-- /.item -->
                  <!-- chat item -->
                  <div class="item">
                    <img src="dist/img/boss.jpg" alt="user image" class="offline"/>
                    <p class="message">
                      <a href="#" class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
                        Susan Doe
                      </a>
                      I would like to meet you to discuss the latest news about
                      the arrival of the new theme. They say it is going to be one the
                      best themes on the market
                    </p>
                  </div><!-- /.item -->
                </div><!-- /.chat -->
                <div class="box-footer">
                  <div class="input-group">
                    <input class="form-control" placeholder="Type message..."/>
                    <div class="input-group-btn">
                      <button class="btn btn-success"><i class="fa fa-plus">SEND</i></button>
                    </div>
                  </div>
                </div>
              </div><!-- /.box (chat box) -->
            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

              <!-- Map box -->
              <div>
              <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6" style="width:100%; float:none;">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>0</h3>
                  <p>Viewer</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6" style="width:100%;">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>0</h3>
                  <p>Jumlah Pengunjung yang terdaftar</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div><!-- ./col -->
			  </div>
              <!-- /.box -->
            </section><!-- right col -->
          </div><!-- /.row (main row) -->

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
  </body>
</html>