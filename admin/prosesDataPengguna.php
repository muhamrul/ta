<?php
session_start();
require 'config.php';
if (!isset($_SESSION['login'])) {
	header("Location: login.php");
}
//insert data pengguna baru
if (isset($_POST['simpanDataPengguna'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$jabatan = $_POST['jabatan'];
	$status = $_POST['status'];
	$kelamin = $_POST['kelamin'];
	$salt = date('d').".".date('Y');
	$saltPisah = explode(".", $salt);
	$p = md5($saltPisah[0].$pass.$saltPisah[1]);
	$a = explode(".", $_FILES['ktp']['name']);
	$foto = substr(md5($_FILES['ktp']['name'] . time()), 0, 10) . "." . $a[count($a) - 1];
	
	$sqlCek = "SELECT * FROM pengguna WHERE username = '$username' OR email = '$email'";
	$resultCek = mysqli_query($mysqli, $sqlCek);
	
	if (!$resultCek) { die("SQL Error : " . $sqlCek); }
	if (mysqli_num_rows($resultCek)) {
		die("Username atau E-mail Sudah Ada");
		if($jabatan == 0){ header("Location: admin.php"); }
		else if($jabatan == 1){ header("Location: panitia.php"); }
		else if($jabatan == 2){ header("Location: pengunjung.php"); }
	} else {
		$sql = "";
		if ($a[count($a) - 1] == ""){
			$sql = "INSERT INTO pengguna (email, username, password, jabatan, status, kelamin, salt) " 
			. "VALUES ('$email', '$username', '$p', $jabatan, $status, $kelamin, '$salt') ";
		} else {
			if (move_uploaded_file($_FILES['ktp']['tmp_name'], "f_ktp/" . $foto)) {
				echo "upload sukses";
			} else {
				echo "upload error";
			}
			$sql = "INSERT INTO pengguna (email, username, password, jabatan, status, kelamin, foto_ktp, salt) " 
			. "VALUES ('$email', '$username', '$p', $jabatan, $status, $kelamin, '$foto', '$salt') ";
		}
		$result = mysqli_query($mysqli, $sql);
		if ($result) {
			unset($_POST['simpanDataPengguna']);
			if($jabatan == 0){ header("Location: admin.php"); }
			else if($jabatan == 1){ header("Location: panitia.php"); }
			else if($jabatan == 2){ header("Location: pengunjung.php"); }
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
	$email = $_POST['email'];
	$username = $_POST['username'];
	
	$pass = $_POST['pass'];
	$salt = date('d').".".date('Y');
	$saltPisah = explode(".", $salt);
	$p = md5($saltPisah[0].$pass.$saltPisah[1]);
	
	$a = explode(".", $_FILES['ktp']['name']);
	$foto = substr(md5($_FILES['ktp']['name'] . time()), 0, 10) . "." . $a[count($a) - 1];
	
	$sqlCek1 = "SELECT * FROM pengguna WHERE username = '$username' AND id_user != $idUser";
	$resultCek1 = mysqli_query($mysqli, $sqlCek1);
	if (!$resultCek1) { die("SQL Error : " . $sqlCek1); }
	
	$sqlCek2 = "SELECT * FROM pengguna WHERE email = '$email' AND id_user != $idUser";
	$resultCek2 = mysqli_query($mysqli, $sqlCek2);
	if (!$resultCek2) { die("SQL Error : " . $sqlCek2); }
	
	if (mysqli_num_rows($resultCek1)) {
		echo "<script>alert('Maaf, Data Belum TerUpdate. Karena USERNAME yang anda inputkan sudah terpakai')</script>";
		if($jabatan == 0){ header("Location: admin.php"); }
		else if($jabatan == 1){ header("Location: panitia.php"); }
		else if($jabatan == 2){ header("Location: pengunjung.php"); }
	} else if (mysqli_num_rows($resultCek2)) {
		echo "<script>alert('Maaf, Data Belum TerUpdate. Karena EMAIL yang anda inputkan sudah terpakai')</script>";
		if($jabatan == 0){ header("Location: admin.php"); }
		else if($jabatan == 1){ header("Location: panitia.php"); }
		else if($jabatan == 2){ header("Location: pengunjung.php"); }
	} else {
		$sql = "";
		if ($a[count($a) - 1] == ""){
			if ($pass == ""){
				$sql = "UPDATE pengguna SET email='$email', username='$username', jabatan=$jabatan, status=$status, "
				."nama='$nama', tempat_lahir='$tempatLahir', tgl_lahir='$tglLahir', kelamin=$kelamin, alamat='$alamat', "
				."agama='$agama', status_perkawinan=$statusPerkawinan, no_telp='$noTelp' WHERE id_user=$idUser";
			} else {
				$sql = "UPDATE pengguna SET email='$email', username='$username', jabatan=$jabatan, status=$status, password='$p', "
				."salt='$salt', nama='$nama', tempat_lahir='$tempatLahir', tgl_lahir='$tglLahir', kelamin=$kelamin, alamat='$alamat', "
				."agama='$agama', status_perkawinan=$statusPerkawinan, no_telp='$noTelp' WHERE id_user=$idUser";
			}
		} else {
			if (move_uploaded_file($_FILES['ktp']['tmp_name'], "f_ktp/" . $foto)) {
				echo "upload sukses";
			} else {
				echo "upload error";
			}
			if ($pass == ""){
				$sql = "UPDATE pengguna SET email='$email', username='$username', jabatan=$jabatan, status=$status, "
				."foto_ktp='$foto', nama='$nama', tempat_lahir='$tempatLahir', tgl_lahir='$tglLahir', kelamin=$kelamin, alamat='$alamat', "
				."agama='$agama', status_perkawinan=$statusPerkawinan, no_telp='$noTelp' WHERE id_user=$idUser";
			} else {
				$sql = "UPDATE pengguna SET email='$email', username='$username', jabatan=$jabatan, status=$status, password='$p', "
				."salt='$salt', foto_ktp='$foto', nama='$nama', tempat_lahir='$tempatLahir', tgl_lahir='$tglLahir', kelamin=$kelamin, alamat='$alamat', "
				."agama='$agama', status_perkawinan=$statusPerkawinan, no_telp='$noTelp' WHERE id_user=$idUser";
			}
		}
		
		$result = mysqli_query($mysqli, $sql);
		if ($result) {
			unset($_POST['editDataPengguna']);
			if($jabatan == 0){ header("Location: admin.php"); }
			else if($jabatan == 1){ header("Location: panitia.php"); }
			else if($jabatan == 2){ header("Location: pengunjung.php"); }
		} else {
			die("SQL Error : " . $sql);
		}
	}
}//hapus data pengguna
else if (isset($_POST['hapusDataPengguna'])) {
	$idUser = $_POST['idUser'];
	$jabatan = $_POST['jabatan'];
	$sql = "UPDATE pengguna SET s_hapus=1 WHERE id_user=$idUser";
	$result = mysqli_query($mysqli, $sql);
	if ($result) {
		unset($_POST['hapusDataPengguna']);
		if($jabatan == 0){ header("Location: admin.php"); }
		else if($jabatan == 1){ header("Location: panitia.php"); }
		else if($jabatan == 2){ header("Location: pengunjung.php"); }
	} else {
		die("SQL Error : " . $sql);
	}	
}//edit profil pengguna
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
	$email = $_POST['email'];
	$username = $_POST['username'];
	
	$pass = $_POST['pass'];
	$salt = date('d').".".date('Y');
	$saltPisah = explode(".", $salt);
	$p = md5($saltPisah[0].$pass.$saltPisah[1]);
	
	$sqlCek1 = "SELECT * FROM pengguna WHERE username = '$username' AND id_user != $idUser";
	$resultCek1 = mysqli_query($mysqli, $sqlCek1);
	if (!$resultCek1) { die("SQL Error : " . $sqlCek1); }
	
	$sqlCek2 = "SELECT * FROM pengguna WHERE email = '$email' AND id_user != $idUser";
	$resultCek2 = mysqli_query($mysqli, $sqlCek2);
	if (!$resultCek2) { die("SQL Error : " . $sqlCek2); }
	
	if (mysqli_num_rows($resultCek1)) {
		echo "<script>alert('Maaf, Data Belum TerUpdate. Karena USERNAME yang anda inputkan sudah terpakai')</script>";
		header("Location: index.php");
	} else if (mysqli_num_rows($resultCek2)) {
		echo "<script>alert('Maaf, Data Belum TerUpdate. Karena EMAIL yang anda inputkan sudah terpakai')</script>";
		header("Location: index.php");
	} else {
		$sql = "";
		if ($pass == ""){
			$sql = "UPDATE pengguna SET username='$username', email='$email', "
			."nama='$nama', tempat_lahir='$tempatLahir', tgl_lahir='$tglLahir', kelamin=$kelamin, alamat='$alamat', "
			."agama='$agama', status_perkawinan=$statusPerkawinan, no_telp='$noTelp' WHERE id_user=$idUser";
		} else {
			$sql = "UPDATE pengguna SET username='$username', email='$email', password='$p', "
			."salt='$salt', nama='$nama', tempat_lahir='$tempatLahir', tgl_lahir='$tglLahir', kelamin=$kelamin, alamat='$alamat', "
			."agama='$agama', status_perkawinan=$statusPerkawinan, no_telp='$noTelp' WHERE id_user=$idUser";
		}
		$result = mysqli_query($mysqli, $sql);
		if ($result) {
			unset($_POST['editProfilPengguna']);
			header("Location: index.php");
		} else {
			die("SQL Error : " . $sql);
		}
	}
}//kembalikan yang sudah dihapus
else if (isset($_GET['idRestorHapus'])) {
	$idUser = $_GET['idRestorHapus'];
	$jabatan = $_GET['jabatan'];
	$sql = "UPDATE pengguna SET s_hapus=0 WHERE id_user=$idUser";
	$result = mysqli_query($mysqli, $sql);
	if ($result) {
		unset($_GET['idRestorHapus']);
		if($jabatan == 0){ header("Location: admin.php"); }
			else if($jabatan == 1){ header("Location: panitia.php"); }
			else if($jabatan == 2){ header("Location: pengunjung.php"); }
	} else {
		die("SQL Error : " . $sql);
	}	
}//hapus permanent
else if (isset($_GET['idDropId'])) {
	$idUser = $_GET['idDropId'];
	$jabatan = $_GET['jabatan'];
	$sql = "DELETE FROM pengguna WHERE id_user=$idUser";
	$result = mysqli_query($mysqli, $sql);
	$sqlPanitiaEvent = "DELETE FROM panitia_event WHERE id_panitia=$idUser";
	$resultPanitiaEvent = mysqli_query($mysqli, $sqlPanitiaEvent);
	if (!$resultPanitiaEvent) {
		die("SQL Error : " . $sqlPanitiaEvent);
	} 
	if ($result) {
		unset($_GET['idRestorHapus']);
		if($jabatan == 0){ header("Location: admin.php"); }
			else if($jabatan == 1){ header("Location: panitia.php"); }
			else if($jabatan == 2){ header("Location: pengunjung.php"); }
	} else {
		die("SQL Error : " . $sql);
	}	
}


?>