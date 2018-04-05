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
<?php 




// Detail data pengguna
if(isset($_GET['idDetail'])){
	$id=$_GET['idDetail'];
	unset($_GET['idDetail']);
	$sqlKaryawan = "SELECT * FROM pengguna WHERE id_user = $id";
	$resultKaryawan = mysqli_query($mysqli, $sqlKaryawan);
	if (!$resultKaryawan) {
		die("SQL Error : " . $sqlKaryawan);
	}
	$rowKaryawan = mysqli_fetch_array($resultKaryawan); 
?>
	<?php 
	if($_GET['user'] == 0){ echo '<p class="login-box-msg">Detail Data Admin</p>'; } 
	else if($_GET['user'] == 1){ echo '<p class="login-box-msg">Detail Data Panitia</p>'; }
	else if($_GET['user'] == 2){ echo '<p class="login-box-msg">Detail Data Pengunjung</p>'; }
	?>
	<div class="form-group has-feedback">
		<table class="tabRegist1">
		  <tr>
			<td><strong>Nama Lengkap</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['nama']; ?></td>
		  </tr>
		  <tr>
			<td><strong>Tempat/Tgl Lahir</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['tempat_lahir'].", "
			.substr($rowKaryawan['tgl_lahir'], 8, 2).'-'.substr($rowKaryawan['tgl_lahir'], 5, 2).'-'.substr($rowKaryawan['tgl_lahir'], 0, 4); ?></td>
		  </tr>
		  <tr>
			<td><strong>Kelamin</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['kelamin']==1){ ?>
			<td>Laki-Laki</td>
			<?php } else { ?>
			<td>Perempuan</td>
			<?php } ?>
		  </tr>
		  <tr>
			<td><strong>Alamat Lengkap</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['alamat']; ?></td>
		  </tr>
		  <tr>
			<td><strong>Agama</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['agama']; ?></td>
		  </tr>
		  <tr>
			<td><strong>Status Perkawinan</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['status_perkawinan']==1){ ?>
			<td>Sudah Pernah Menikah</td>
			<?php } else if($rowKaryawan['status_perkawinan']==0){ ?>
			<td>Belum Pernah Menikah</td>
			<?php } ?>
		  <tr>
			<td><strong>Nomer HP Aktif</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['no_telp']; ?></td>
		  </tr>
		  <tr>
			<td><strong>E-mail:</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['email']; ?></td>
		  </tr>
		  <tr>
			<td><strong>Username</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['username']; ?></td>
		  </tr>
		  <tr>
		    <td><strong>Jabatan</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['jabatan']==0){ ?>
			<td>Admin</td>
			<?php } else if($rowKaryawan['jabatan']==1){ ?>
			<td>Panitia</td>
			<?php } else if($rowKaryawan['jabatan']==2){ ?>
			<td>Pengunjung</td>
			<?php } ?>
		  </tr>
		  <tr>
		    <td><strong>Status</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['status']==1){ ?>
			<td>Aktif</td>
			<?php } else { ?>
			<td>Non-Aktif</td>
			<?php } ?>
		  </tr>
		</table>
		<center><img src="f_ktp/<?php echo $rowKaryawan['foto_ktp']; ?>" style="width:400px; height:200px;"/></center>
	  </div>
<?php
}



// Edit Data Pengguna
else if(isset($_GET['idEdit'])){
	$id=$_GET['idEdit'];
	unset($_GET['idEdit']);
	$sqlKaryawan = "SELECT * FROM pengguna WHERE id_user = $id";
	$resultKaryawan = mysqli_query($mysqli, $sqlKaryawan);
	if (!$resultKaryawan) {
		die("SQL Error : " . $sqlKaryawan);
	}
	$rowKaryawan = mysqli_fetch_array($resultKaryawan); 
?>
	<?php 
	if($_GET['user'] == 0){ echo '<p class="login-box-msg">Edit Data Admin</p>'; } 
	else if($_GET['user'] == 1){ echo '<p class="login-box-msg">Edit Data Panitia</p>'; }
	else if($_GET['user'] == 2){ echo '<p class="login-box-msg">Edit Data Pengunjung</p>'; }
	?>
	<form action="prosesDataPengguna.php" method="POST" enctype="multipart/form-data">
	  <div class="form-group has-feedback">
		<table class="tabRegist1">
		  <tr>
			<td><strong>Nama Lengkap</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="namaLengkap" value="<?php echo $rowKaryawan['nama']; ?>"/></td>
		  </tr>
		  <tr>
			<td><strong>Tempat/Tgl Lahir</strong></td>
			<td><strong> : </strong></td>
			<td><input type="text" class="form-control" name="tempatLahir" placeholder="Tempat" value="<?php echo $rowKaryawan['tempat_lahir']; ?>"/></td>
			<td><input id="tglLahir" type="date" class="form-control" name="tglLahir" value="<?php echo $rowKaryawan['tgl_lahir']; ?>"/></td>
		  </tr>
		  <tr>
			<td><strong>Kelamin</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['kelamin']==1){ ?>
			<td><input type="radio" name="kelamin" value="0"/>Perempuan</td>
			<td><input type="radio" name="kelamin" value="1" checked/>Laki-Laki</td>
			<?php } else { ?>
			<td><input type="radio" name="kelamin" value="0" checked/>Perempuan</td>
			<td><input type="radio" name="kelamin" value="1"/>Laki-Laki</td>	
			<?php } ?>
		  </tr>
		  <tr>
			<td><strong>Alamat Lengkap</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="alamat" value="<?php echo $rowKaryawan['alamat']; ?>"/></td>
		  </tr>
		  <tr>
			<td><strong>Agama</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="agama" value="<?php echo $rowKaryawan['agama']; ?>"/></td>
		  </tr>
		  <tr>
			<td><strong>Status Perkawinan</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['status_perkawinan']==1){ ?>
			<td><input type="radio" name="statusPerkawinan" value="1" checked/>Sudah Pernah Menikah</td>
			<td><input type="radio" name="statusPerkawinan" value="0"/>Belum Pernah Menikah</td>
			<?php } else { ?>
			<td><input type="radio" name="statusPerkawinan" value="1"/>Sudah Pernah Menikah</td>
			<td><input type="radio" name="statusPerkawinan" value="0" checked/>Belum Pernah Menikah</td>
			<?php } ?>
		  </tr>
		  <tr><td colspan="4"></td></tr>
		  <tr><td colspan="4"></td></tr>
		  <tr>
			<td><strong><?php if($_GET['user'] == 2){ echo "Foto Profil"; } else { echo "Foto KTP"; } ?></strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="file" name="ktp"/></td>
		  </tr>
		  <tr>
			<td><strong>Nomer HP Aktif</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="noTelp" value="<?php echo $rowKaryawan['no_telp']; ?>"/></td>
		  </tr>
		  <input type="hidden" class="form-control" name="jabatan" value="<?php echo $_GET['user']; ?>"/>
		  <tr>
		    <td><strong>Status</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['status']==1){ ?>
			<td><input type="radio" name="status" value="1" checked/>Aktif</td>
			<td><input type="radio" name="status" value="0"/>Non-Aktif</td>
			<?php } else { ?>
			<td><input type="radio" name="status" value="1"/>Aktif</td>
			<td><input type="radio" name="status" value="0" checked/>Non-Aktif</td>
			<?php } ?>
		  </tr>
		  <tr>
			<td><strong>E-Mail</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="email" value="<?php echo $rowKaryawan['email']; ?>" required /></td>
		  </tr>
		  <tr>
			<td><strong>Username</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="username" value="<?php echo $rowKaryawan['username']; ?>" required /></td>
		  </tr>
		  <tr>
			<td><strong>Kata Sandi</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input id="pass" type="password" class="form-control" name="pass"  disabled="true" /></td>
		  </tr>
		</table>
	  </div>
	  <div class="row">
		<div class="col-xs-8">
		  <input type="button" class="btn btn-warning" style="float:right;" onclick="aktifLabelPass()" value="Ubah Password"/>
		</div>
		<div class="col-xs-4">
		  <input type="hidden" class="form-control" name="idUser" value="<?php echo $rowKaryawan['id_user']; ?>"/>
		  <button type="submit" name="editDataPengguna" class="btn btn-block btn-success">Simpan</button>
		</div><!-- /.col -->
	  </div>
	</form>
<?php
}



//Hapus Data Pengguna 
else if(isset($_GET['idHapus'])){
	$id=$_GET['idHapus'];
	unset($_GET['idHapus']);
	$sqlKaryawan = "SELECT * FROM pengguna WHERE id_user = $id";
	$resultKaryawan = mysqli_query($mysqli, $sqlKaryawan);
	if (!$resultKaryawan) {
		die("SQL Error : " . $sqlKaryawan);
	}
	$rowKaryawan = mysqli_fetch_array($resultKaryawan); 
?>
	<?php if($_GET['user'] == 0){ echo '<p class="login-box-msg">Apa Anda Yakin Ingin menghapus data ADMIN ini?</p>'; } 
	else if($_GET['user'] == 1){ echo '<p class="login-box-msg">Apa Anda Yakin Ingin menghapus data PANITIA ini?</p>'; }
	else if($_GET['user'] == 2){ echo '<p class="login-box-msg">Apa Anda Yakin Ingin menghapus data PENGUNJUNG ini?</p>'; } ?>
	<div class="form-group has-feedback">
		<table class="tabRegist1">
		  <tr>
			<td><strong>Nama Lengkap</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['nama']; ?></td>
		  </tr>
		  <tr>
			<td><strong>Tempat/Tgl Lahir</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['tempat_lahir'].", ".$rowKaryawan['tgl_lahir']; ?></td>
		  </tr>
		  <tr>
			<td><strong>Kelamin</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['kelamin']==1){ ?>
			<td>Laki-Laki</td>
			<?php } else { ?>
			<td>Perempuan</td>
			<?php } ?>
		  </tr>
		  <tr>
			<td><strong>Alamat Lengkap</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['alamat']; ?></td>
		  </tr>
		  <tr>
			<td><strong>Agama</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['agama']; ?></td>
		  </tr>
		  <tr>
			<td><strong>Status Perkawinan</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['status_perkawinan']==1){ ?>
			<td>Sudah Pernah Menikah</td>
			<?php } else if($rowKaryawan['status_perkawinan']==0){ ?>
			<td>Belum Pernah Menikah</td>
			<?php } ?>
		  <tr>
			<td><strong>Nomer HP Aktif</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['no_telp']; ?></td>
		  </tr>
		  <tr>
			<td><strong>E-mail:</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['email']; ?></td>
		  </tr>
		  <tr>
			<td><strong>Username</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['username']; ?></td>
		  </tr>
		  <tr>
		    <td><strong>Jabatan</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['jabatan']==0){ ?>
			<td>Admin</td>
			<?php } else if($rowKaryawan['jabatan']==1){ ?>
			<td>Panitia</td>
			<?php } else if($rowKaryawan['jabatan']==2){ ?>
			<td>Pengunjung</td>
			<?php } ?>
		  </tr>
		  <tr>
		    <td><strong>Status</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['status']==1){ ?>
			<td>Aktif</td>
			<?php } else { ?>
			<td>Non-Aktif</td>
			<?php } ?>
		  </tr>
		</table>
	  </div>
	<form action="prosesDataPengguna.php" method="POST" enctype="multipart/form-data">
	  <div class="row">
		<div class="col-xs-8"></div>
		<div class="col-xs-4">
		  <input type="hidden" class="form-control" name="jabatan" value="<?php echo $rowKaryawan['jabatan']; ?>"/>
		  <input type="hidden" class="form-control" name="idUser" value="<?php echo $rowKaryawan['id_user']; ?>"/>
		  <button type="submit" name="hapusDataPengguna" class="btn btn-block btn-danger">Hapus</button>
		</div><!-- /.col -->
	  </div>
	</form>
<?php
} 



// Edit Data Pada button profil	
else if(isset($_GET['idUserLogin'])){
	$id=$_GET['idUserLogin'];
	unset($_GET['idUserLogin']);
	$sqlKaryawan = "SELECT * FROM pengguna WHERE id_user = $id";
	$resultKaryawan = mysqli_query($mysqli, $sqlKaryawan);
	if (!$resultKaryawan) {
		die("SQL Error : " . $sqlKaryawan);
	}
	$rowKaryawan = mysqli_fetch_array($resultKaryawan); 
?>
	<p class="login-box-msg">Profil Pengguna</p>
	<form action="prosesDataPengguna.php" method="POST" enctype="multipart/form-data">
	  <div class="form-group has-feedback">
		<table class="tabRegist1">
		  <tr>
			<td><strong>Nama Lengkap</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="namaLengkap" value="<?php echo $rowKaryawan['nama']; ?>"/></td>
		  </tr>
		  <tr>
			<td><strong>Tempat/Tgl Lahir</strong></td>
			<td><strong> : </strong></td>
			<td><input type="text" class="form-control" name="tempatLahir" placeholder="Tempat" value="<?php echo $rowKaryawan['tempat_lahir']; ?>"/></td>
			<td><input id="tglLahir" type="date" class="form-control" name="tglLahir" value="<?php echo $rowKaryawan['tgl_lahir']; ?>"/></td>
		  </tr>
		  <tr>
			<td><strong>Kelamin</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['kelamin']==1){ ?>
			<td><input type="radio" name="kelamin" value="0"/>Perempuan</td>
			<td><input type="radio" name="kelamin" value="1" checked/>Laki-Laki</td>
			<?php } else { ?>
			<td><input type="radio" name="kelamin" value="0" checked/>Perempuan</td>
			<td><input type="radio" name="kelamin" value="1"/>Laki-Laki</td>	
			<?php } ?>
		  </tr>
		  <tr>
			<td><strong>Alamat Lengkap</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="alamat" value="<?php echo $rowKaryawan['alamat']; ?>"/></td>
		  </tr>
		  <tr>
			<td><strong>Agama</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="agama" value="<?php echo $rowKaryawan['agama']; ?>"/></td>
		  </tr>
		  <tr>
			<td><strong>Status Perkawinan</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['status_perkawinan']==1){ ?>
			<td><input type="radio" name="statusPerkawinan" value="1" checked/>Sudah Pernah Menikah</td>
			<td><input type="radio" name="statusPerkawinan" value="0"/>Belum Pernah Menikah</td>
			<?php } else { ?>
			<td><input type="radio" name="statusPerkawinan" value="1"/>Sudah Pernah Menikah</td>
			<td><input type="radio" name="statusPerkawinan" value="0" checked/>Belum Pernah Menikah</td>
			<?php } ?>
		  </tr>
		  <tr>
			<td><strong>Nomer HP Aktif</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="noTelp" value="<?php echo $rowKaryawan['no_telp']; ?>"/></td>
		  </tr>
		  <tr>
			<td><strong>Email</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="email" value="<?php echo $rowKaryawan['email']; ?>" required /></td>
		  </tr>
		  <tr>
			<td><strong>Username</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="username" value="<?php echo $rowKaryawan['username']; ?>" required /></td>
		  </tr>
		  <tr>
			<td><strong>Kata Sandi</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input id="pass" type="password" class="form-control" name="pass"  disabled="true" /></td>
		  </tr>
		</table>
	  </div>
	  <div class="row">
		<div class="col-xs-8">
		  <input type="button" class="btn btn-warning" style="float:right;" onclick="aktifLabelPass()" value="Ubah Password"/>
		</div>
		<div class="col-xs-4">
		  <input type="hidden" class="form-control" name="idUser" value="<?php echo $rowKaryawan['id_user']; ?>"/>
		  <button type="submit" name="editProfilPengguna" class="btn btn-block btn-success">Simpan</button>
		</div><!-- /.col -->
	  </div>
	</form>
<?php
}



//Tambah Baru data Pengguna
else if(isset($_GET['idTambah'])){ ?>
	<!--Create Modal-->
	<?php 
	if($_GET['user'] == 0){ echo '<p class="login-box-msg">Pendaftaran Admin Baru</p>'; } 
	else if($_GET['user'] == 1){ echo '<p class="login-box-msg">Pendaftaran Panitia Baru</p>'; }
	else if($_GET['user'] == 2){ echo '<p class="login-box-msg">Pendaftaran Pengunjung Baru</p>'; }
	?>
	<form action="prosesDataPengguna.php" method="POST" enctype="multipart/form-data">
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
			<td><strong><?php if($_GET['user'] == 2){ echo "Foto Profil"; } else { echo "Foto KTP"; } ?></strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="file" name="ktp"/></td>
		  </tr>
		  <input type="hidden" class="form-control" name="jabatan" value="<?php echo $_GET['user']; ?>"/>
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
		  <button type="submit" name="simpanDataPengguna" class="btn btn-block btn-success">Simpan</button>
		</div><!-- /.col -->
	  </div>
	</form>
<?php 
} 



//restor data
else if(isset($_GET['restorHapus'])){ ?>
	<!--Create Modal-->
	<?php 
	if($_GET['user'] == 0){ echo '<p class="login-box-msg">Data Admin yang dihapus</p>'; } 
	else if($_GET['user'] == 1){ echo '<p class="login-box-msg">Data Panitia yang dihapus</p>'; }
	else if($_GET['user'] == 2){ echo '<p class="login-box-msg">Data Pengunjung yang dihapus</p>'; }
	$jabatan = $_GET['user'];
	$sqlKaryawan = "SELECT * FROM pengguna WHERE jabatan = $jabatan AND s_hapus = 1";
	$resultKaryawan = mysqli_query($mysqli, $sqlKaryawan);
	if (!$resultKaryawan) {
	  die("SQL Error : " . $sqlKaryawan);
	}
	?>
	  <table style="width:100%;">
		<thead>
		  <tr>
			<th>USERNAME</th>
			<th>NAMA LENGKAP</th>
			<th>E-MAIL</th>
			<th colspan="2"><center>LANJUTAN</center></th>
		  </tr>
		</thead>
		<tbody>
		<?php
		while ($rowKaryawan = mysqli_fetch_object($resultKaryawan)) { ?>
		  <tr>
			<td><?php echo $rowKaryawan->username; ?></td>
			<td><?php echo $rowKaryawan->nama; ?></td>
			<td><?php echo $rowKaryawan->email; ?></td>
			<td><center><a href="prosesDataPengguna.php?idRestorHapus=<?php echo $rowKaryawan->id_user; ?>&jabatan=<?php echo $rowKaryawan->jabatan; ?>" 
			class="btn btn-xs bg-maroon">kembalikan</a></center></td>
			<td><center><a href="prosesDataPengguna.php?idDropId=<?php echo $rowKaryawan->id_user; ?>&jabatan=<?php echo $rowKaryawan->jabatan; ?>" 
			class="btn btn-xs btn-danger">hapus permanent</a></center></td>
		  </tr>
		<?php } ?>
		</tbody>
	  </table>
<?php 
}
?>




<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
<script>
  var i=0;
  function aktifLabelPass (){
	if(i == 0){
	  document.getElementById("pass").disabled = false;
	  i = 1;
	} else{
	  document.getElementById("pass").disabled = true;
	  i = 0;
	}
  }
</script>