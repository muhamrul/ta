<?php
session_start();
require 'config.php';
if (!isset($_SESSION['login'])) {
	header("Location: login.php");
}
?>
<style>
  #ireng{ color:black; }
  .tabRegist1{ width:100%; align:center; height:100%; }
  td{ border:solid transparent; border-width:10px; }
</style>
<!--Tambah Event-->
<?php
if(isset($_GET['eventTambah'])){ 
	echo "<p class='login-box-msg'><strong>Buat Data Event</strong></p>";
	?>
	<form action="eventProses.php" method="POST" enctype="multipart/form-data">
	  <div class="form-group has-feedback">
		<table class="tabRegist1">
		  <tr>
			<td><strong>Nama Event</strong></td>
			<td><strong> : </strong></td>
			<td colspan="3"><input type="text" class="form-control" name="event" required /></td>
		  </tr>
		  <tr>
			<td><strong>Diadakan Di</strong></td>
			<td><strong> : </strong></td>
			<td colspan="3"><textarea class="form-control" name="alamat" rows="2" placeholder="Alamat Lengkap Diselenggarakannya Event"></textarea></td>
		  </tr>
		  <tr>
			<td><strong>Koordinat Alamat</strong></td>
			<td><strong> : </strong></td>
			<td colspan="3"><input type="text" class="form-control" name="kordinat" placeholder="Ex: '-7.259194,112.745043'"/></td>
		  </tr>
		  <tr>
			<td><strong>Tanggal Diadakan<p/></strong></td>
			<td><strong> : <p/></strong></td>
			<td><input id="tglMulai" type="date" class="form-control" name="tglMulai"/><small style="color:black;">*Tanggal Mulai</small></td>
			<td><strong> s/d <p/></strong></td>
			<td><input id="tglSelesai" type="date" class="form-control" name="tglSelesai"/><small style="color:black;">*Tanggal Selesai</small></td>
		  </tr>
		</table>
	  </div>
	  <div class="row">
		<div class="col-xs-8"></div>
		<div class="col-xs-4">
		  <button type="submit" name="tambahEvent" class="btn btn-block btn-outline btn-success">Simpan</button>
		</div><!-- /.col -->
	  </div>
	</form>
<?php } ?>

<!--Tambah Panitia Event dengan Data Panitia Baru-->
<?php
if(isset($_GET['panitiaEventBaru'])){ 
	$idEvent = $_GET['idEvent'];
	$sqlEvent = "SELECT * FROM event WHERE id_event = $idEvent";
	$resultEvent = mysqli_query($mysqli, $sqlEvent);
	$rowEvent = mysqli_fetch_array($resultEvent);
	$namaEvent = $rowEvent['nama_event'];
	?>
	<img src="foto/logo_event/<?php echo $rowEvent['logo_event']; ?>" class="img-circle" alt="User Image" style="width:40px; height:40px;">
	<strong><?php echo " ".$rowEvent['nama_event']; ?></strong>
	<?php 
	$tm = substr($rowEvent['tgl_mulai'], 8, 2) . '-' . substr($rowEvent['tgl_mulai'], 5, 2) . '-' . substr($rowEvent['tgl_mulai'], 0, 4);
	$ts = substr($rowEvent['tgl_selesai'], 8, 2) . '-' . substr($rowEvent['tgl_selesai'], 5, 2) . '-' . substr($rowEvent['tgl_selesai'], 0, 4); 
	?>
	<strong style="float:right;"><p/><?php echo $tm." s/d ".$ts; ?></strong>
	<p class='login-box-msg'><strong>Data Panitia Baru Pengelola Event</strong></p>
	<form action="eventProses.php" method="POST" enctype="multipart/form-data">
	  <div class="form-group has-feedback">
		<table class="tabRegist1">
		  <tr>
			<td><strong>Username</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="username" placeholder="Username" required /></td>
		  </tr>
		  <tr>
			<td><strong>E-mail</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="email" placeholder="E-Mail" required /></td>
		  </tr>
		  <tr>
			<td><strong>Foto KTP</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="file" name="ktp"/></td>
		  </tr>
		  <input type="hidden" class="form-control" name="jabatan" value="1"/>
		  <tr>
			<td><strong>Status</strong></td>
			<td><strong> : </strong></td>
			<td><input type="radio" name="status" value="1" checked/>Aktif</td>
			<td><input type="radio" name="status" value="0"/>Non-Aktif</td>
		  </tr>
		  <tr>
			<td><strong>Kelamin</strong></td>
			<td><strong> : </strong></td>
			<td><input type="radio" name="kelamin" value="0" checked/>Perempuan</td>
			<td><input type="radio" name="kelamin" value="1"/>Laki-Laki</td>
		  </tr>
		  <tr>
			<td><strong>Kata Sandi</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="password" class="form-control" name="pass" placeholder="Password" required /></td>
		  </tr>
		</table>
	  </div>
	  <div class="row">
		<div class="col-xs-8"></div>
		<div class="col-xs-4">
		  <input type="hidden" class="form-control" name="idEvent" value="<?php echo $idEvent; ?>"/>
		  <button type="submit" name="tambahPanitiaEvent" class="btn btn-block btn-outline btn-success">Simpan</button>
		</div><!-- /.col -->
	  </div>
	</form>
<?php } ?>

<!--Tambah Panitia Event dengan Data Panitia yang Sudah Ada-->
<?php
if(isset($_GET['panitiaEventLama'])){ 
	$idEvent = $_GET['idEvent'];
	$sqlEvent = "SELECT * FROM event WHERE id_event = $idEvent";
	$resultEvent = mysqli_query($mysqli, $sqlEvent);
	$rowEvent = mysqli_fetch_array($resultEvent);
	$namaEvent = $rowEvent['nama_event'];
	?>
	<img src="foto/logo_event/<?php echo $rowEvent['logo_event']; ?>" class="img-circle" alt="User Image" style="width:40px; height:40px;">
	<strong><?php echo " ".$rowEvent['nama_event']; ?></strong>
	<?php 
	$tm = substr($rowEvent['tgl_mulai'], 8, 2) . '-' . substr($rowEvent['tgl_mulai'], 5, 2) . '-' . substr($rowEvent['tgl_mulai'], 0, 4);
	$ts = substr($rowEvent['tgl_selesai'], 8, 2) . '-' . substr($rowEvent['tgl_selesai'], 5, 2) . '-' . substr($rowEvent['tgl_selesai'], 0, 4); 
	?>
	<strong style="float:right;"><p/><?php echo $tm." s/d ".$ts; ?></strong>
	<p class='login-box-msg'><strong>Data Panitia yang Belum Mengelola Event Ini</strong></p>
	<?php 
	$sqlKaryawan = "SELECT * FROM pengguna WHERE jabatan = 1 AND s_hapus = 0 AND id_user NOT IN (SELECT id_panitia FROM panitia_event WHERE id_event = $idEvent)";
	$resultKaryawan = mysqli_query($mysqli, $sqlKaryawan);
	if (!$resultKaryawan) {
	  die("SQL Error : " . $sqlKaryawan);
	}
	?>
	  <table style="width:100%;">
		<thead>
		  <tr>
			<th>E-MAIL</th>
			<th>NAMA LENGKAP</th>
			<th>STATUS</th>
			<th></th>
		  </tr>
		</thead>
		<tbody>
		<?php
		while ($rowKaryawan = mysqli_fetch_object($resultKaryawan)) { ?>
		  <tr>
			<td><?php echo $rowKaryawan->email; ?></td>
			<td><?php echo $rowKaryawan->nama; ?></td>
			<td><?php if($rowKaryawan->status == 0){ echo "non-aktif"; } else { echo "aktif"; }?></td>
			<td><center><a href="eventProses.php?idTambahPanitiaEvent=<?php echo $rowKaryawan->id_user; ?>&idEvent=<?php echo $idEvent; ?>" 
			class="btn btn-xs btn-success btn-outline">tambahkan</a></center></td>
		  </tr>
		<?php } ?>
		</tbody>
	  </table>
<?php } ?>

<!--Tambah Tenant/Sponsor Event dengan Data Baru-->
<?php
if(isset($_GET['eventTenantSponsorBaru'])){ 
	$idEvent = $_GET['idEvent'];
	$sqlEvent = "SELECT * FROM event WHERE id_event = $idEvent";
	$resultEvent = mysqli_query($mysqli, $sqlEvent);
	$rowEvent = mysqli_fetch_array($resultEvent);
	$namaEvent = $rowEvent['nama_event'];
	?>
	<img src="foto/logo_event/<?php echo $rowEvent['logo_event']; ?>" class="img-circle" alt="User Image" style="width:40px; height:40px;">
	<strong><?php echo " ".$rowEvent['nama_event']; ?></strong>
	<?php 
	$tm = substr($rowEvent['tgl_mulai'], 8, 2) . '-' . substr($rowEvent['tgl_mulai'], 5, 2) . '-' . substr($rowEvent['tgl_mulai'], 0, 4);
	$ts = substr($rowEvent['tgl_selesai'], 8, 2) . '-' . substr($rowEvent['tgl_selesai'], 5, 2) . '-' . substr($rowEvent['tgl_selesai'], 0, 4); 
	?>
	<strong style="float:right;"><p/><?php echo $tm." s/d ".$ts; ?></strong>
	<p class='login-box-msg'><strong>Data Baru Tenant/Sponsor</strong></p>
	<form action="eventProses.php" method="POST" enctype="multipart/form-data">
	  <div class="form-group has-feedback">
		<table class="tabRegist1">
		  <tr>
			<td><strong>Sebagai</strong></td>
			<td><strong> : </strong></td>
			<td><input id="s" type="checkbox" name="sponsor" value="1" onclick="sp();" />Sponsor</td>
			<td><input type="checkbox" name="tenant" value="2"/>Tenant</td>
		  </tr>
		  <tr>
			<td><strong>Nama Usaha</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="usaha" placeholder="Nama Lengkap Perusahaan/UMKM" required /></td>
		  </tr>
		  <tr>
			<td><strong>Alamat Usaha</strong></td>
			<td><strong> : </strong></td>
			<td colspan="3"><textarea class="form-control" name="alamat" rows="2" placeholder="Alamat Lengkap Perusahaan/UMKM"></textarea></td>
		  </tr>
		  <tr>
			<td><strong>Sumbangan<p/></strong></td>
			<td><strong> : <p/></strong></td>
			<td colspan="2"><textarea id="s1" class="form-control" name="sumbangan" disabled="" rows="2" placeholder="ex: Dipinjami HT sejumlah 5 buah, dll"></textarea></td>
		  </tr>
		  <tr>
			<td><strong>Username</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="username" placeholder="Username"/></td>
		  </tr>
		  <tr>
			<td><strong>Kata Sandi</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="password" class="form-control" name="pass" placeholder="Password"/></td>
		  </tr>
		  <tr>
			<td><strong>Jumlah Tenant</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="jumTenant" value="0" placeholder="Jumlah tenant yang dipinjam oleh penyewa tenant"/></td>
		  </tr>
		  <tr>
			<td><strong>Status Pembayaran</strong></td>
			<td><strong> : </strong></td>
			<td><input type="radio" name="sBayar" value="1"/>Sudah Lunas</td>
			<td><input type="radio" name="sBayar" value="0" checked/>Belum Lunas</td>
		  </tr>
		  <tr>
			<td><strong>Nomer HP Aktif</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="noTelp"/></td>
		  </tr>
		</table>
	  </div>
	  <div class="row">
		<div class="col-xs-8"></div>
		<div class="col-xs-4">
		  <input type="hidden" class="form-control" name="idEvent" value="<?php echo $idEvent; ?>"/>
		  <button type="submit" name="tambahEventTenantSponsorBaru" class="btn btn-block btn-outline btn-success">Simpan</button>
		</div><!-- /.col -->
	  </div>
	</form>
	<script>
		// alert();
	function sp(){
		if(document.getElementById("s").checked == false){
			document.getElementById("s1").disabled = true;
			// alert();
		} else {
			document.getElementById("s1").disabled = false;
		}
	}
	</script>
<?php } ?>

<!--Tambah Tenant/Sponsor Event dengan Data yang Sudah Ada-->
<?php
if(isset($_GET['eventTenantSponsorLama'])){ 
	$idEvent = $_GET['idEvent'];
	$sqlEvent = "SELECT * FROM event WHERE id_event = $idEvent";
	$resultEvent = mysqli_query($mysqli, $sqlEvent);
	$rowEvent = mysqli_fetch_array($resultEvent);
	$namaEvent = $rowEvent['nama_event'];
	?>
	<img src="foto/logo_event/<?php echo $rowEvent['logo_event']; ?>" class="img-circle" alt="User Image" style="width:40px; height:40px;">
	<strong><?php echo " ".$rowEvent['nama_event']; ?></strong>
	<?php 
	$tm = substr($rowEvent['tgl_mulai'], 8, 2) . '-' . substr($rowEvent['tgl_mulai'], 5, 2) . '-' . substr($rowEvent['tgl_mulai'], 0, 4);
	$ts = substr($rowEvent['tgl_selesai'], 8, 2) . '-' . substr($rowEvent['tgl_selesai'], 5, 2) . '-' . substr($rowEvent['tgl_selesai'], 0, 4); 
	?>
	<strong style="float:right;"><p/><?php echo $tm." s/d ".$ts; ?></strong>
	<p class='login-box-msg'><strong>Data Tenant/Sponsor yang Sudah Ada</strong></p>
	<form action="eventProses.php" method="POST" enctype="multipart/form-data">
	  <div class="form-group has-feedback">
		<table class="tabRegist1">
		  <tr>
			<td><strong>Tenant & Sponsor</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2">
			  <?php 
				$sqlTenSpo = "SELECT * FROM tenant_sponsor WHERE id_tenant_sponsor NOT IN (SELECT id_tenant_sponsor FROM event_tenant_sponsor WHERE id_event = $idEvent)";
				$resultTenSpo = mysqli_query($mysqli, $sqlTenSpo);
				if (!$resultTenSpo) {
				  die("SQL Error : " . $sqlTenSpo);
				}
			  ?>
			  <select id="tenSpo" class="form-control" name="tenSpo" onchange="tampilkan()">
			    <?php while ($rowTenSpo = mysqli_fetch_object($resultTenSpo)) { ?>
				  <option value="<?php echo $rowTenSpo->id_tenant_sponsor; ?>"><?php echo $rowTenSpo->nama_usaha.'() - '.$rowTenSpo->alamat_usaha; ?></option>
				<?php } ?>
			  </select>
			</td>
		  </tr>
		  <tr>
			<td><strong>Sebagai</strong></td>
			<td><strong> : </strong></td>
			<td><input type="checkbox" name="sponsor" value="1"/>Sponsor</td>
			<td><input type="checkbox" name="tenant" value="2"/>Tenant</td>
		  </tr>
		  <tr>
			<td><strong>Sumbangan<p/></strong></td>
			<td><strong> : <p/></strong></td>
			<td colspan="2"><textarea id="s1" class="form-control" name="sumbangan" rows="2" placeholder="ex: Dipinjami HT sejumlah 5 buah, dll"></textarea></td>
		  </tr>
		  <tr>
			<td><strong>Username</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="username" placeholder="Username" id="nama" /></td>
		  </tr>
		  <tr>
			<td><strong>Kata Sandi</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="password" class="form-control" name="pass" placeholder="Password"/></td>
		  </tr>
		  <tr>
			<td><strong>Jumlah Tenant</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="jumTenant" value="0" placeholder="Jumlah tenant yang dipinjam oleh penyewa tenant"/></td>
		  </tr>
		  <tr>
			<td><strong>Status Pembayaran</strong></td>
			<td><strong> : </strong></td>
			<td><input type="radio" name="sBayar" value="1"/>Sudah Lunas</td>
			<td><input type="radio" name="sBayar" value="0" checked/>Belum Lunas</td>
		  </tr>
		</table>
	  </div>
	  <div class="row">
		<div class="col-xs-8"></div>
		<div class="col-xs-4">
		  <input type="hidden" class="form-control" name="idEvent" value="<?php echo $idEvent; ?>"/>
		  <button type="submit" name="tambahEventTenantSponsorLama" class="btn btn-block btn-outline btn-success">Simpan</button>
		</div><!-- /.col -->
	  </div>
	</form>
	<script>
	function sp(){
		if(document.getElementById("etsl").s.checked == false){
			document.getElementById("etsl").s1.disabled = true;
		} else {
			document.getElementById("etsl").s1.disabled = false;
		}
	}
	function tampilkan(){
	  var id_user=document.getElementById("tenSpo").value;
	  document.getElementById("nama").value = 'Joko';
	 
	$.ajax({
  	url: "tes.php?",
  	context: document.body
	}).done(function(response) {
		alert(response);
		document.getElementById("nama").value = response;
	});
	  // document.getElementById("email").value = 'joko@gmail.com'; 
	}
	</script>
<?php } ?>

<!--Tambah Pendapatan dan Pengeluaran Event-->
<?php
if(isset($_GET['eventPendapatanPengeluaran'])){ 
	$idEvent = $_GET['idEvent'];
	$sqlEvent = "SELECT * FROM event WHERE id_event = $idEvent";
	$resultEvent = mysqli_query($mysqli, $sqlEvent);
	$rowEvent = mysqli_fetch_array($resultEvent);
	$namaEvent = $rowEvent['nama_event'];
	?>
	<img src="foto/logo_event/<?php echo $rowEvent['logo_event']; ?>" class="img-circle" alt="User Image" style="width:40px; height:40px;">
	<strong><?php echo " ".$rowEvent['nama_event']; ?></strong>
	<?php 
	$tm = substr($rowEvent['tgl_mulai'], 8, 2) . '-' . substr($rowEvent['tgl_mulai'], 5, 2) . '-' . substr($rowEvent['tgl_mulai'], 0, 4);
	$ts = substr($rowEvent['tgl_selesai'], 8, 2) . '-' . substr($rowEvent['tgl_selesai'], 5, 2) . '-' . substr($rowEvent['tgl_selesai'], 0, 4); 
	?>
	<strong style="float:right;"><p/><?php echo $tm." s/d ".$ts; ?></strong>
	<p class='login-box-msg'><strong>Data Tenant/Sponsor yang Sudah Ada</strong></p>
	<form action="eventProses.php" method="POST" enctype="multipart/form-data">
	  <div class="form-group has-feedback">
		<table class="tabRegist1">
		  <tr>
			<td><strong>Status Pembayaran</strong></td>
			<td><strong> : </strong></td>
			<td><input type="radio" name="sBayar" value="1"/>Sudah Lunas</td>
			<td><input type="radio" name="sBayar" value="0" checked/>Belum Lunas</td>
		  </tr>
		</table>
	  </div>
	  <div class="row">
		<div class="col-xs-8"></div>
		<div class="col-xs-4">
		  <input type="hidden" class="form-control" name="idEvent" value="<?php echo $idEvent; ?>"/>
		  <button type="submit" name="tambahPendapatanPengeluaran" class="btn btn-block btn-outline btn-success">Simpan</button>
		</div><!-- /.col -->
	  </div>
	</form>
<?php } ?>