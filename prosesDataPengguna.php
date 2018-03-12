<?php
session_start();
require 'config.php';
if (!isset($_SESSION['login'])) {
	header("Location: login.php");
}
//insert data pengguna baru
if (isset($_POST['simpanDataPengguna'])) {
	$username = $_POST['username'];
	$pass = $_POST['pass'];
	$jabatan = $_POST['jabatan'];
	$status = $_POST['status'];
	$kelamin = $_POST['kelamin'];
	$salt = date('d').".".date('Y');
	$saltPisah = explode(".", $salt);
	$p = md5($saltPisah[0].$pass.$saltPisah[1]);
	$sqlCek = "SELECT * FROM karyawan WHERE username = '$username'";
	$resultCek = mysqli_query($mysqli, $sqlCek);
	
	if (!$resultCek) { die("SQL Error : " . $sqlCek); }
	if (mysqli_num_rows($resultCek)) {
		die("Username Sudah Ada");
	} else {
		$a = explode(".", $_FILES['ktp']['name']);
		$foto = substr(md5($_FILES['ktp']['name'] . time()), 0, 10) . "." . $a[count($a) - 1];
		if (move_uploaded_file($_FILES['ktp']['tmp_name'], "f_ktp/" . $foto)) {
			echo "upload sukses";
		} else {
			echo "upload error";
		}
		$sql = "INSERT INTO karyawan (username, password, jabatan, status, kelamin, foto_ktp, salt) "
				. "VALUES ('$username', '$p', $jabatan, $status, $kelamin, '$foto', '$salt') ";
		$result = mysqli_query($mysqli, $sql);
		if ($result) {
			unset($_POST['simpanDataPengguna']);
			header("Location: pengguna.php");
		} else {
			die("SQL Error : " . $sql);
		}
	}
} //edit data pengguna
else if (isset($_POST['editDataPengguna'])) {
	$idUser = $_POST['idUser'];
	$nama = $_POST['namaLengkap'];
	$tempatLahir = $_POST['tempatLahir'];
	$tglLahir = $_POST['tglLahir'];
	$kelamin = $_POST['kelamin'];
	$alamat = $_POST['alamat'];
	$agama = $_POST['agama'];
	$statusPerkawinan = $_POST['statusPerkawinan'];
	$noTelp = $_POST['noTelp'];
	$jabatan = $_POST['jabatan'];
	$status = $_POST['status'];
	$username = $_POST['username'];
	
	$pass = $_POST['pass'];
	$salt = date('d').".".date('Y');
	$saltPisah = explode(".", $salt);
	$p = md5($saltPisah[0].$pass.$saltPisah[1]);
	
	$a = explode(".", $_FILES['ktp']['name']);
	$foto = substr(md5($_FILES['ktp']['name'] . time()), 0, 10) . "." . $a[count($a) - 1];
	
	$sqlCek = "SELECT * FROM karyawan WHERE username = '$username' AND id_user != $idUser";
	$resultCek = mysqli_query($mysqli, $sqlCek);
	
	if (!$resultCek) { die("SQL Error : " . $sqlCek); }
	if (mysqli_num_rows($resultCek)) {
		echo "<script>alert('Maaf, Data Belum TerUpdate. Karena USERNAME yang anda inputkan sudah terpakai')</script>";
		header("Location: pengguna.php");
	} else {
		$sql = "";
		if ($a[count($a) - 1] == ""){
			if ($pass == ""){
				$sql = "UPDATE karyawan SET username='$username', jabatan=$jabatan, status=$status, "
				."nama='$nama', tempat_lahir='$tempatLahir', tgl_lahir='$tglLahir', kelamin=$kelamin, alamat='$alamat', "
				."agama=$agama, status_perkawinan=$statusPerkawinan, no_telp='$noTelp' WHERE id_user=$idUser";
			} else {
				$sql = "UPDATE karyawan SET username='$username', jabatan=$jabatan, status=$status, password='$p', "
				."salt='$salt', nama='$nama', tempat_lahir='$tempatLahir', tgl_lahir='$tglLahir', kelamin=$kelamin, alamat='$alamat', "
				."agama=$agama, status_perkawinan=$statusPerkawinan, no_telp='$noTelp' WHERE id_user=$idUser";
			}
		} else {
			if (move_uploaded_file($_FILES['ktp']['tmp_name'], "f_ktp/" . $foto)) {
				echo "upload sukses";
			} else {
				echo "upload error";
			}
			if ($pass == ""){
				$sql = "UPDATE karyawan SET username='$username', jabatan=$jabatan, status=$status, "
				."foto_ktp='$foto', nama='$nama', tempat_lahir='$tempatLahir', tgl_lahir='$tglLahir', kelamin=$kelamin, alamat='$alamat', "
				."agama=$agama, status_perkawinan=$statusPerkawinan, no_telp='$noTelp' WHERE id_user=$idUser";
			} else {
				$sql = "UPDATE karyawan SET username='$username', jabatan=$jabatan, status=$status, password='$p', "
				."salt='$salt', foto_ktp='$foto', nama='$nama', tempat_lahir='$tempatLahir', tgl_lahir='$tglLahir', kelamin=$kelamin, alamat='$alamat', "
				."agama=$agama, status_perkawinan=$statusPerkawinan, no_telp='$noTelp' WHERE id_user=$idUser";
			}
		}
		
		$result = mysqli_query($mysqli, $sql);
		if ($result) {
			unset($_POST['editDataPengguna']);
			header("Location: pengguna.php");
		} else {
			die("SQL Error : " . $sql);
		}
	}
}//hapus data pengguna baru
if (isset($_POST['hapusDataPengguna'])) {
	$idUser = $_POST['idUser'];
	$sql = "DELETE FROM karyawan WHERE id_user=$idUser";
	$result = mysqli_query($mysqli, $sql);
	if ($result) {
		unset($_POST['simpanDataPengguna']);
		header("Location: pengguna.php");
	} else {
		die("SQL Error : " . $sql);
	}	
}



//edit profil pengguna
else if (isset($_POST['editProfilPengguna'])) {
	$idUser = $_POST['idUser'];
	$nama = $_POST['namaLengkap'];
	$tempatLahir = $_POST['tempatLahir'];
	$tglLahir = $_POST['tglLahir'];
	$kelamin = $_POST['kelamin'];
	$alamat = $_POST['alamat'];
	$agama = $_POST['agama'];
	$statusPerkawinan = $_POST['statusPerkawinan'];
	$noTelp = $_POST['noTelp'];
	$username = $_POST['username'];
	
	$pass = $_POST['pass'];
	$salt = date('d').".".date('Y');
	$saltPisah = explode(".", $salt);
	$p = md5($saltPisah[0].$pass.$saltPisah[1]);
	
	$sqlCek = "SELECT * FROM karyawan WHERE username = '$username' AND id_user != $idUser";
	$resultCek = mysqli_query($mysqli, $sqlCek);
	
	if (!$resultCek) { die("SQL Error : " . $sqlCek); }
	if (mysqli_num_rows($resultCek)) {
		echo "<script>alert('Maaf, Data Belum TerUpdate. Karena USERNAME yang anda inputkan sudah terpakai')</script>";
		header("Location: pengguna.php");
	} else {
		$sql = "";
		if ($pass == ""){
			$sql = "UPDATE karyawan SET username='$username', "
			."nama='$nama', tempat_lahir='$tempatLahir', tgl_lahir='$tglLahir', kelamin=$kelamin, alamat='$alamat', "
			."agama=$agama, status_perkawinan=$statusPerkawinan, no_telp='$noTelp' WHERE id_user=$idUser";
		} else {
			$sql = "UPDATE karyawan SET username='$username', password='$p', "
			."salt='$salt', nama='$nama', tempat_lahir='$tempatLahir', tgl_lahir='$tglLahir', kelamin=$kelamin, alamat='$alamat', "
			."agama=$agama, status_perkawinan=$statusPerkawinan, no_telp='$noTelp' WHERE id_user=$idUser";
		}
		$result = mysqli_query($mysqli, $sql);
		if ($result) {
			unset($_POST['editProfilPengguna']);
			header("Location: index.php");
		} else {
			die("SQL Error : " . $sql);
		}
	}
}


?>