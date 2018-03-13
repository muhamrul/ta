<?php
session_start();
require 'koneksidatabase.php';
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
	$sqlKaryawan = "SELECT * FROM karyawan WHERE id_user = $id";
	$resultKaryawan = mysqli_query($mysqli, $sqlKaryawan);
	if (!$resultKaryawan) {
		die("SQL Error : " . $sqlKaryawan);
	}
	$rowKaryawan = mysqli_fetch_array($resultKaryawan); 
?>
	<p class="login-box-msg">Detail Data Pengguna</p>
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
			<?php if($rowKaryawan['agama']==1){ ?>
			<td>Muslim</td>
			<?php } else { ?>
			<td>Non-Muslim</td>
			<?php } ?>
		  </tr>
		  <tr>
			<td><strong>Status Perkawinan</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['status_perkawinan']==1){ ?>
			<td>Sudah Menikah</td>
			<?php } else { ?>
			<td>Belum Menikah</td>
			<?php } ?>
		  <tr>
			<td><strong>Nomer HP Aktif</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['no_telp']; ?></td>
		  </tr>
		  <tr>
			<td><strong>Username</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['username']; ?></td>
		  </tr>
		  <tr>
		    <td><strong>Jabatan</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['jabatan']==1){ ?>
			<td>Karyawan</td>
			<?php } else { ?>
			<td>Pemilik</td>
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
	$sqlKaryawan = "SELECT * FROM karyawan WHERE id_user = $id";
	$resultKaryawan = mysqli_query($mysqli, $sqlKaryawan);
	if (!$resultKaryawan) {
		die("SQL Error : " . $sqlKaryawan);
	}
	$rowKaryawan = mysqli_fetch_array($resultKaryawan); 
?>
	<p class="login-box-msg">Edit Data Pengguna</p>
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
			<?php if($rowKaryawan['agama']==1){ ?>
			<td><input type="radio" name="agama" value="1" checked/>Islam</td>
			<td><input type="radio" name="agama" value="0"/>Non-Islam</td>
			<?php } else { ?>
			<td><input type="radio" name="agama" value="1"/>Islam</td>
			<td><input type="radio" name="agama" value="0" checked/>Non-Islam</td>
			<?php } ?>
		  </tr>
		  <tr>
			<td><strong>Status Perkawinan</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['status_perkawinan']==1){ ?>
			<td><input type="radio" name="statusPerkawinan" value="1" checked/>Sudah Menikah</td>
			<td><input type="radio" name="statusPerkawinan" value="0"/>Belum Menikah</td>
			<?php } else { ?>
			<td><input type="radio" name="statusPerkawinan" value="1"/>Sudah Menikah</td>
			<td><input type="radio" name="statusPerkawinan" value="0" checked/>Belum Menikah</td>
			<?php } ?>
		  </tr>
		  <tr><td colspan="4"></td></tr>
		  <tr><td colspan="4"></td></tr>
		  <tr>
			<td><strong>Foto KTP</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="file" name="ktp"/></td>
		  </tr>
		  <tr>
			<td><strong>Nomer HP Aktif</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="noTelp" value="<?php echo $rowKaryawan['no_telp']; ?>"/></td>
		  </tr>
		  <tr>
		    <td><strong>Jabatan</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['jabatan']==1){ ?>
			<td><input type="radio" name="jabatan" value="1" checked/>Karyawan</td>
			<td><input type="radio" name="jabatan" value="0"/>Pemilik</td>
			<?php } else { ?>
			<td><input type="radio" name="jabatan" value="1"/>Karyawan</td>
			<td><input type="radio" name="jabatan" value="0" checked/>Pemilik</td>
			<?php } ?>
		  </tr>
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
	$sqlKaryawan = "SELECT * FROM karyawan WHERE id_user = $id";
	$resultKaryawan = mysqli_query($mysqli, $sqlKaryawan);
	if (!$resultKaryawan) {
		die("SQL Error : " . $sqlKaryawan);
	}
	$rowKaryawan = mysqli_fetch_array($resultKaryawan); 
?>
	<p class="login-box-msg">APAKAH ANDA YAKIN UNTUK MENGHAPUS DATA BERIKUT?</p>
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
			<?php if($rowKaryawan['agama']==1){ ?>
			<td>Muslim</td>
			<?php } else { ?>
			<td>Non-Muslim</td>
			<?php } ?>
		  </tr>
		  <tr>
			<td><strong>Status Perkawinan</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['status_perkawinan']==1){ ?>
			<td>Sudah Menikah</td>
			<?php } else { ?>
			<td>Belum Menikah</td>
			<?php } ?>
		  <tr>
			<td><strong>Nomer HP Aktif</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['no_telp']; ?></td>
		  </tr>
		  <tr>
			<td><strong>Username</strong></td>
			<td><strong> : </strong></td>
			<td><?php echo $rowKaryawan['username']; ?></td>
		  </tr>
		  <tr>
		    <td><strong>Jabatan</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['jabatan']==1){ ?>
			<td>Karyawan</td>
			<?php } else { ?>
			<td>Pemilik</td>
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
	$sqlKaryawan = "SELECT * FROM karyawan WHERE id_user = $id";
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
			<?php if($rowKaryawan['agama']==1){ ?>
			<td><input type="radio" name="agama" value="1" checked/>Islam</td>
			<td><input type="radio" name="agama" value="0"/>Non-Islam</td>
			<?php } else { ?>
			<td><input type="radio" name="agama" value="1"/>Islam</td>
			<td><input type="radio" name="agama" value="0" checked/>Non-Islam</td>
			<?php } ?>
		  </tr>
		  <tr>
			<td><strong>Status Perkawinan</strong></td>
			<td><strong> : </strong></td>
			<?php if($rowKaryawan['status_perkawinan']==1){ ?>
			<td><input type="radio" name="statusPerkawinan" value="1" checked/>Sudah Menikah</td>
			<td><input type="radio" name="statusPerkawinan" value="0"/>Belum Menikah</td>
			<?php } else { ?>
			<td><input type="radio" name="statusPerkawinan" value="1"/>Sudah Menikah</td>
			<td><input type="radio" name="statusPerkawinan" value="0" checked/>Belum Menikah</td>
			<?php } ?>
		  </tr>
		  <tr>
			<td><strong>Nomer HP Aktif</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="noTelp" value="<?php echo $rowKaryawan['no_telp']; ?>"/></td>
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
else { ?>
	<!--Create Modal-->
	<p class="login-box-msg">Pendaftaran Pengguna Baru</p>
	<form action="prosesDataPengguna.php" method="POST" enctype="multipart/form-data">
	  <div class="form-group has-feedback">
		<table class="tabRegist1">
		  <tr>
			<td><strong>Username</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="text" class="form-control" name="username" placeholder="Username" required /></td>
		  </tr>
		  <tr>
			<td><strong>Foto KTP</strong></td>
			<td><strong> : </strong></td>
			<td colspan="2"><input type="file" name="ktp"/></td>
		  </tr>
		  <tr>
			<td><strong>Jabatan</strong></td>
			<td><strong> : </strong></td>
			<td><input type="radio" name="jabatan" value="1" checked/>Karyawan</td>
			<td><input type="radio" name="jabatan" value="0"/>Pemilik</td>
		  </tr>
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
<?php } ?>
<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
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