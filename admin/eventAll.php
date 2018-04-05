<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AksesKSM | Event</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
	<link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<!--timepicker-->
	<link rel="stylesheet" type="text/css" href="timepicker/bootstrap-clockpicker.min.css">
	<style type="text/css">
	.input-group { width: 110px; margin-bottom: 10px; }
	.pull-center { margin-left: auto; margin-right: auto; }
	#ireng{ color:black; }
	.tabRegist1{ width:100%; align:center; height:100%; }
	td{ border:solid transparent; border-width:10px; }
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
  $idEvent=0;
  if (isset($_GET['idEvent'])) {
	  $idEvent=$_GET['idEvent'];
  }
  $sqlEvent = "";
  if($rowIdSekarang['jabatan'] == 1) { 
    $sqlEvent = "SELECT * FROM event WHERE s_hapus = 0"; 
  } else if($rowIdSekarang['jabatan'] == 2) { 
    header("Location: ../index.php"); 
  } else { 
    $sqlEvent = "SELECT * FROM event WHERE id_event = $idEvent AND s_hapus = 0"; 
  }
  $resultEvent = mysqli_query($mysqli, $sqlEvent);
  if (!$resultEvent) {
	die("SQL ERROR : " . mysqli_error($mysqli));
  }
  $rowEvent = mysqli_fetch_array($resultEvent);
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
			<?php if($rowIdSekarang['jabatan'] != 1 && $rowIdSekarang['jabatan'] != 2) { echo '<li><a href="admin.php">Pengguna</a></li>'; } ?>
			<li class="active"><a href="event.php">Event</a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">          
			<h1>Event : <?php echo $rowEvent['nama_event']; ?></h1>
			<ol class="breadcrumb" style="font-size:15px;">
				<li><a href="event.php">Daftar Event</a></li>
				<li class="active">Edit Event</li>
			</ol>
		</section>
        <!-- Main content -->
        <section class="content">
          <div class='row'>
            <div class='col-xs-12'>
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
				<?php $tab = 0;
				if(isset($_SESSION['tab'])){ 
				$tab = $_SESSION['tab'];
				unset($_SESSION['tab']);
				?>
				  <li><a href="#event" data-toggle="tab">Tentang</a></li>
				  <?php 
				  if($tab == 2) { echo '<li class="active"><a href="#tenspon" data-toggle="tab">Tenant & Sponsor</a></li>'; } 
				  else { echo '<li><a href="#tenspon" data-toggle="tab">Tenant & Sponsor</a></li>'; }
				  
				  if($tab == 3) { echo '<li class="active"><a href="#penpen" data-toggle="tab">Pendapatan & Pengeluaran</a></li>'; } 
				  else { echo '<li><a href="#penpen" data-toggle="tab">Pendapatan & Pengeluaran</a></li>'; }
				  
				  if($tab == 4) { echo '<li class="active"><a href="#kegiatan" data-toggle="tab">Kegiatan</a></li>'; } 
				  else { echo '<li><a href="#kegiatan" data-toggle="tab">Kegiatan</a></li>'; }
				  
				  if($tab == 5) { echo '<li class="active"><a href="#panitia" data-toggle="tab">Panitia</a></li>'; } 
				  else { echo '<li><a href="#panitia" data-toggle="tab">Panitia</a></li>'; }
				  ?>
				<?php } else { ?>
                  <li class="active"><a href="#event" data-toggle="tab">Tentang</a></li>
                  <li><a href="#tenspon" data-toggle="tab">Tenant & Sponsor</a></li>
				  <li><a href="#penpen" data-toggle="tab">Pendapatan & Pengeluaran</a></li>
				  <li><a href="#kegiatan" data-toggle="tab">Kegiatan</a></li>
				  <li><a href="#panitia" data-toggle="tab">Panitia</a></li>
				<?php } ?>
                </ul>
                <div class="tab-content">
                  
				  <!-- Tentang Event -->
                  <?php 
				  if($tab == 5 || $tab == 2) { echo '<div class="tab-pane" id="event" >'; } 
				  else { echo '<div class="tab-pane active" id="event" >'; }
				  ?>
                    <form action="eventProses.php" method="POST" enctype="multipart/form-data">
					  <div class="form-group has-feedback">
						<table class="tabRegist1">
						  <tr>
							<td><strong>Nama Event</strong></td>
							<td><strong> : </strong></td>
							<td colspan="3"><input type="text" class="form-control" name="event" value="<?php echo $rowEvent['nama_event']; ?>" required /></td>
						  </tr>
						  <tr>
							<td><strong>Diadakan Di</strong></td>
							<td><strong> : </strong></td>
							<td colspan="3">
							<textarea class="form-control" name="alamat" rows="2" placeholder="Alamat Lengkap Diselenggarakannya Event"><?php echo $rowEvent['alamat']; ?></textarea>
							</td>
						  </tr>
						  <tr>
							<td><strong>Koordinat Alamat</strong></td>
							<td><strong> : </strong></td>
							<td colspan="3"><input type="text" class="form-control" name="kordinat" value="<?php echo $rowEvent['kordinat']; ?>" placeholder="Ex: '-7.259194,112.745043'"/></td>
						  </tr>
						  <tr>
							<td><strong>Tanggal Diadakan<p/></strong></td>
							<td><strong> : <p/></strong></td>
							<td><input id="tglMulai" type="date" class="form-control" value="<?php echo $rowEvent['tgl_mulai']; ?>" name="tglMulai"/><small style="color:black;">*Tanggal Mulai</small></td>
							<td><strong> s/d <p/></strong></td>
							<td><input id="tglSelesai" type="date" class="form-control" value="<?php echo $rowEvent['tgl_selesai']; ?>" name="tglSelesai"/><small style="color:black;">*Tanggal Selesai</small></td>
						  </tr>
						  <tr>
							<td><strong>Diadakan pada Jam<p/></strong></td>
							<td><strong> : <p/></strong></td>
							<td>
								<input type="text" class="form-control clockpicker" value="<?php echo substr($rowEvent['jam_mulai'], 0, 5); ?>" 
								name="jamMulai" data-placement="left" data-align="top" data-autoclose="true">
								<small style="color:black;">*Jam Mulai</small>
							</td>
							<td><strong> s/d <p/></strong></td>
							<td>
								<input type="text" class="form-control clockpicker" value="<?php echo substr($rowEvent['jam_selesai'], 0, 5); ?>" 
								name="jamSelesai" data-placement="left" data-align="top" data-autoclose="true">
								<small style="color:black;">*Jam Selesai</small>
							</td>
						  </tr>
						  <tr>
							<td><strong>Jumlah dan Harga Tenant<p/></strong></td>
							<td><strong> : <p/></strong></td>
							<td><input type="text" class="form-control" value="<?php echo $rowEvent['jum_tenant']; ?>" name="jumTenant"/><small style="color:black;">*Jumlah Tenant yang dibuka pada event ini</small></td>
							<td></td>
							<td><input type="text" class="form-control" value="<?php echo $rowEvent['harga_tenant']; ?>" name="hargaTenant"/><small style="color:black;">*Harga Per Tenant dalam Rupiah</small></td>
						  </tr>
						  <tr>
							<td colspan="2"><p/><p/>
							<center>
							<a style="color:green;">*Logo Event Saat ini</a><br>
							<img src="foto/logo_event/<?php echo $rowEvent['logo_event']; ?>" style="width: 120px; height: 120px;"></center>
							<br>
							<center>
							<a style="color:red;">*Jika Logo ingin diubah,<br>Upload disini</a><br>
							<small><input type="file" name="logoEvent"/></small>
							</center>
							</td>
							<td colspan="3"><p/><p/>
							<strong>Keterangan Event : </strong>
							<textarea class="form-control" name="keterangan" rows="10" placeholder="Penjelasan Tentang Event Ini"><?php echo $rowEvent['keterangan']; ?></textarea>
							</td>
						  </tr>
						  <tr><td colspan="5"></p></p></td></tr>
						  <tr>
							<td><a style="color:green;">*Benner Event Saat ini</a></td>
							<td colspan="3"><a style="color:red; float:right;">*Jika Benner ingin diubah,Upload disini : </a></td>
							<td><small><input type="file" name="bennerEvent"/></small></td>
						  </tr>
						  <tr>
							<td colspan="5">
							<img src="foto/benner_event/<?php echo $rowEvent['benner']; ?>" style="width: 100%; height: 350px;">
							</td>
						  </tr>
						</table>
					  </div>
					  <div class="row">
						<div class="col-xs-8"></div>
						<div class="col-xs-4">
						  <input type="hidden" class="form-control" name="idEvent" value="<?php echo $idEvent; ?>"/>
						  <button type="submit" name="updateTentangEvent" class="btn btn-block btn-success">Simpan</button>
						</div><!-- /.col -->
					  </div>
					</form>
                  </div>	
				  
				  <!--Tenan & Suponsor-->
				  <?php 
				  if($tab == 2) { echo '<div class="tab-pane active" id="tenspon">'; } 
				  else { echo '<div class="tab-pane" id="tenspon">'; }
				  ?>
					<center>
					<p>
					  <div class="btn-group open">
						<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">+ Tambah Tenant/Sponsor &nbsp;&nbsp;
						  <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
						  <li><a onclick="eventTenantSponsorBaru(<?php echo $idEvent; ?>)" data-toggle="modal" data-target="#myEvent">Belum Pernah Berpartisipasi Sama Sekali</a></li> 
						  <li><a onclick="eventTenantSponsorLama(<?php echo $idEvent; ?>)" data-toggle="modal" data-target="#myEvent">Sudah Pernah Berpartisipasi Sebelumnya</a></li>
						</ul>
					  </div>
					</p>
					</center><br>
					<div class="box">
					  <div class="box-body">
					    <table style="width:100%;">
						<tr>
						<th style="width:50%;"><center>TENANT</center></th>
						<th style="width:50%;"><center>SPONSOR</center></th>
						</tr>
						<tr><td><center>
						<!--TENANT-->
						<table id="example1" class="table table-bordered table-striped">
						  <thead>
							<tr>
							  <th>TENANT</th>
							  <th>SEWA TENANT</th>
							  <th>PEMBAYARAN</th>
							  <th></th>
							</tr>
						  </thead>
						  <tbody>
							<?php
							$sqlTenant = "SELECT * FROM tenant_sponsor ts JOIN event_tenant_sponsor ets ON ts.id_tenant_sponsor = ets.id_tenant_sponsor 
							WHERE ets.id_event = $idEvent AND ets.job != 1";
							$resultTenant = mysqli_query($mysqli, $sqlTenant);
							if (!$resultTenant) {
							die("SQL Error : " . $sqlTenant);
							}
							while ($rowTenant = mysqli_fetch_object($resultTenant)) { ?>
							  <tr>
								<td><?php echo $rowTenant->nama_usaha; ?></td>
								<td><?php echo $rowTenant->jumlah_pinjam_tenant." tenant"; ?></td>
								<td><?php if($rowTenant->status_pembayaran == 0){ echo "Belum Lunas"; } else { echo "Sudah Lunas"; } ?></td>
								<td>
								  <center>
								    <div class="btn-group open">
									  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									    <span class="caret"></span>
									  </button>
									  <ul class="dropdown-menu">
									    <li><a onclick="eventTenantSponsorBaru(<?php echo $idEvent; ?>)" data-toggle="modal" data-target="#myEvent">Edit</a></li> 
									    <li><a onclick="eventTenantSponsorLama(<?php echo $idEvent; ?>)" data-toggle="modal" data-target="#myEvent">Edit Profil Tenant</a></li>
										<li><a onclick="eventTenantSponsorLama(<?php echo $idEvent; ?>)" data-toggle="modal" data-target="#myEvent">Keluarkan</a></li>
									  </ul>
									</div>
								  </center>
								</td>
							  </tr>
							<?php } ?>
						  </tbody>
						</table>
						</center></td><!--pemisah--><td><center>
						<table id="example1" class="table table-bordered table-striped">
						  <thead>
							<tr>
							  <th>NAMA</th>
							  <th>NO TELEPHON</th>
							  <th></th>
							</tr>
						  </thead>
						  <tbody>
							<?php
							$sqlSponsor = "SELECT * FROM tenant_sponsor ts INNER JOIN event_tenant_sponsor ets ON ts.id_tenant_sponsor = ets.id_tenant_sponsor 
							WHERE ets.id_event = $idEvent AND ets.job != 2";
							$resultSponsor = mysqli_query($mysqli, $sqlSponsor);
							if (!$resultSponsor) {
							die("SQL Error : " . $sqlSponsor);
							}
							while ($rowSponsor = mysqli_fetch_object($resultSponsor)) { ?>
							  <tr>
							    <td><?php echo $rowSponsor->nama_usaha; ?></td>
								<td><?php echo $rowSponsor->no_telp; ?></td>
								<td>
								  <center>
								    <div class="btn-group open">
									  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
									    <span class="caret"></span>
									  </button>
									  <ul class="dropdown-menu">
									    <li><a onclick="eventTenantSponsorBaru(<?php echo $idEvent; ?>)" data-toggle="modal" data-target="#myEvent">Belum Pernah Berpartisipasi Sama Sekali</a></li> 
									    <li><a onclick="eventTenantSponsorLama(<?php echo $idEvent; ?>)" data-toggle="modal" data-target="#myEvent">Sudah Pernah Berpartisipasi Sebelumnya</a></li>
									  </ul>
									</div>
								  </center>
								</td>  
							  </tr>
							<?php } ?>
						  </tbody>
						</table>
						<center></td></tr></table>						
					  </div><!-- /.box-body -->
					</div><!-- /.box -->
                  </div>
				  
				  <!--Pendapatan & Pengeluaran-->
                  <?php 
				  if($tab == 3) { echo '<div class="tab-pane active" id="penpen">'; } 
				  else { echo '<div class="tab-pane" id="penpen">'; }
				  ?>
					
                  </div>
				  
				  <!--Kegiatan-->
                  <?php 
				  if($tab == 4) { echo '<div class="tab-pane active" id="kegiatan">'; } 
				  else { echo '<div class="tab-pane" id="kegiatan">'; }
				  ?>
				  
					
                  </div>
				  
				  <!--Panitia-->
				  <?php 
				  if($tab == 5) { echo '<div class="tab-pane active" id="panitia">'; } 
				  else { echo '<div class="tab-pane" id="panitia">'; }
				  ?>
					<p>
					  <div class="btn-group open">
						<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">+ Tambah Anggota Panitia &nbsp;&nbsp;
						  <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
						  <li><a onclick="panitiaEventBaru(<?php echo $idEvent; ?>)" data-toggle="modal" data-target="#myEvent">Data Panitia Baru</a></li> 
						  <li><a onclick="panitiaEventLama(<?php echo $idEvent; ?>)" data-toggle="modal" data-target="#myEvent">Data Panitia yang Sudah Ada</a></li>
						</ul>
					  </div>
					</p>
					<?php 
					  $sqlPanitiaEvent = "SELECT * FROM pengguna p JOIN panitia_event pe ON p.id_user = pe.id_panitia 
					  JOIN event e ON pe.id_event = e.id_event WHERE e.id_event = $idEvent AND p.s_hapus = 0";
					  $resultPanitiaEvent = mysqli_query($mysqli, $sqlPanitiaEvent);
					  if (!$resultPanitiaEvent) {
						die("SQL Error : " . $sqlPanitiaEvent);
					  } 
					?>
					<div class="box">
					<!--<div class="box-header">
					  <h3 class="box-title">Data Table With Full Features</h3>
					</div> /.box-header -->
					  <div class="box-body">
						<table id="example1" class="table table-bordered table-striped">
						  <thead>
							<tr>
							  <th>E-MAIL</th>
							  <th>NAMA LENGKAP</th>
							  <th>NO HP</th>
							  <th></th>
							</tr>
						  </thead>
						  <tbody>
							<?php
							while ($rowPanitiaEvent = mysqli_fetch_object($resultPanitiaEvent)) { ?>
							  <tr>
								<td><?php echo $rowPanitiaEvent->email; ?></td>
								<td><?php echo $rowPanitiaEvent->nama; ?></td>
								<td><?php echo $rowPanitiaEvent->no_telp; ?></td>
								<td><?php if($rowIdSekarang['jabatan'] != 1 && $rowIdSekarang['jabatan'] != 2) { ?>
								<center><a href="eventProses.php?idOutPanitia=<?php echo $rowPanitiaEvent->id_user; ?>&idEvent=<?php echo $idEvent; ?>" 
								class="btn btn-xs btn-danger">keluarkan</a></center><?php } ?></td>
							  </tr>
							<?php } ?>
						  </tbody>
						</table>
					  </div><!-- /.box-body -->
					</div><!-- /.box -->
                  </div>

                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->
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
	<!--timepicker-->
	<script type="text/javascript" src="timepicker/bootstrap-clockpicker.min.js"></script>
	<script type="text/javascript">
	$('.clockpicker').clockpicker()
		.find('input').change(function(){
			console.log(this.value);
		});
	</script>
	<script>
		function eventTenantSponsorBaru(id){
			$("#modal-event").load("eventIsiModal.php?eventTenantSponsorBaru=0&idEvent="+id);
		} function eventTenantSponsorLama(id){
			$("#modal-event").load("eventIsiModal.php?eventTenantSponsorLama=0&idEvent="+id);
		} function panitiaEventBaru(id){
			$("#modal-event").load("eventIsiModal.php?panitiaEventBaru=0&idEvent="+id);
		} function panitiaEventLama(id){
			$("#modal-event").load("eventIsiModal.php?panitiaEventLama=0&idEvent="+id);
		} /*function dataEventRestore(){
			$("#modal-event").load("eventIsiModal.php?restorHapus=0");
		}*/
    </script>
  </body>
</html>