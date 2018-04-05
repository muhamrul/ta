<?php
session_start();
require 'config.php';
if (!isset($_SESSION['login'])) {
	header("Location: login.php");
}
//insert data event
if (isset($_POST['tambahEvent'])) {
	$event = $_POST['event'];
	$alamat = $_POST['alamat'];
	$kordinat = $_POST['kordinat'];
	$tglMulai = $_POST['tglMulai'];
	$tglSelesai = $_POST['tglSelesai'];
	$sql = "INSERT INTO event (nama_event, alamat, kordinat, tgl_mulai, tgl_selesai) " 
	. "VALUES ('$event', '$alamat', '$kordinat', '$tglMulai', '$tglSelesai') ";
	$result = mysqli_query($mysqli, $sql);
	if ($result) {
		unset($_POST['tambahEvent']);
		header("Location: event.php"); 
	} else {
		die("SQL Error : " . $sql);
	}
	
}
// Updaate data utama event
else if (isset($_POST['updateTentangEvent'])) {
	$idEvent = $_POST['idEvent'];
	$event = $_POST['event'];
	$alamat = $_POST['alamat'];
	$kordinat = $_POST['kordinat'];
	$tglMulai = $_POST['tglMulai'];
	$tglSelesai = $_POST['tglSelesai'];
	$jamMulai = $_POST['jamMulai'];
	$jamSelesai = $_POST['jamSelesai'];
	$jumTenant = $_POST['jumTenant'];
	$hargaTenant = $_POST['hargaTenant'];
	$keterangan = $_POST['keterangan'];
	$logoEvent = explode(".", $_FILES['logoEvent']['name']);
	$fotoLogoEvent = substr(md5($_FILES['logoEvent']['name'] . time()), 0, 10) . "." . $logoEvent[count($logoEvent) - 1];
	$bennerEvent = explode(".", $_FILES['bennerEvent']['name']);
	$fotoBennerEvent = substr(md5($_FILES['bennerEvent']['name'] . time()), 0, 10) . "." . $bennerEvent[count($bennerEvent) - 1];
	
	$sql = "";
	if ($logoEvent[count($logoEvent) - 1] == ""){
		if ($bennerEvent[count($bennerEvent) - 1] == ""){
			$sql = "UPDATE event SET nama_event = '$event', keterangan = '$keterangan', alamat = '$alamat', kordinat = '$kordinat', tgl_mulai = '$tglMulai', 
			tgl_selesai = '$tglSelesai', jam_mulai = '$jamMulai', jam_selesai = '$jamSelesai', jum_tenant = $jumTenant, harga_tenant = $hargaTenant WHERE id_event = $idEvent";
		} else {
			if (move_uploaded_file($_FILES['bennerEvent']['tmp_name'], "foto/benner_event/" . $fotoBennerEvent)) {
				echo "upload sukses";
			} else {
				echo "upload error";
			}
			$sql = "UPDATE event SET nama_event = '$event', keterangan = '$keterangan', alamat = '$alamat', kordinat = '$kordinat', tgl_mulai = '$tglMulai', 
			tgl_selesai = '$tglSelesai', jam_mulai = '$jamMulai', jam_selesai = '$jamSelesai', benner = '$fotoBennerEvent', jum_tenant = $jumTenant, harga_tenant = $hargaTenant 
			WHERE id_event = $idEvent";
		}
	} else {
		if (move_uploaded_file($_FILES['logoEvent']['tmp_name'], "foto/logo_event/" . $fotoLogoEvent)) {
			echo "upload sukses";
		} else {
			echo "upload error";
		}
		if ($bennerEvent[count($bennerEvent) - 1] == ""){
			$sql = "UPDATE event SET nama_event = '$event', keterangan = '$keterangan', alamat = '$alamat', kordinat = '$kordinat', tgl_mulai = '$tglMulai', 
			tgl_selesai = '$tglSelesai', jam_mulai = '$jamMulai', jam_selesai = '$jamSelesai', logo_event = '$fotoLogoEvent', jum_tenant = $jumTenant, harga_tenant = $hargaTenant 
			WHERE id_event = $idEvent";
		} else {
			if (move_uploaded_file($_FILES['bennerEvent']['tmp_name'], "foto/benner_event/" . $fotoBennerEvent)) {
				echo "upload sukses";
			} else {
				echo "upload error";
			}
			$sql = "UPDATE event SET nama_event = '$event', keterangan = '$keterangan', alamat = '$alamat', kordinat = '$kordinat', tgl_mulai = '$tglMulai', 
			tgl_selesai = '$tglSelesai', jam_mulai = '$jamMulai', jam_selesai = '$jamSelesai', logo_event = '$fotoLogoEvent', benner = '$fotoBennerEvent', jum_tenant = $jumTenant, 
			harga_tenant = $hargaTenant WHERE id_event = $idEvent";
		}
	}
	$result = mysqli_query($mysqli, $sql);
	if ($result) {
		unset($_POST['updateTentangEvent']);
		header("Location: eventAll.php?idEvent=$idEvent"); 
	} else {
		die("SQL Error : " . $sql);
	}
} 
//insert data baru untuk panitia event
else if (isset($_POST['tambahPanitiaEvent'])) {
	$idEvent = $_POST['idEvent'];
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
			$sqlIdUser = "SELECT * FROM pengguna WHERE username = '$username' AND email = '$email'";
			$resultIdUser = mysqli_query($mysqli, $sqlIdUser);
			$rowIdUser = mysqli_fetch_array($resultIdUser);
			$idPanitia = $rowIdUser['id_user'];
			
			$sqlIdUser = "INSERT INTO panitia_event (id_event, id_panitia) VALUES ($idEvent, $idPanitia)";
			$resultIdUser = mysqli_query($mysqli, $sqlIdUser);
			$_SESSION['tab'] = 5;
			header("Location: eventAll.php?idEvent=$idEvent");
		} else {
			die("SQL Error : " . $sql);
		}
	}
}
//insert data lama untuk panitia event
else if (isset($_GET['idTambahPanitiaEvent'])) {
	$idEvent = $_GET['idEvent'];
	$idPanitia = $_GET['idTambahPanitiaEvent'];
	$sqlIdUser = "INSERT INTO panitia_event (id_event, id_panitia) VALUES ($idEvent, $idPanitia)";
	$resultIdUser = mysqli_query($mysqli, $sqlIdUser);
	header("Location: eventAll.php?idEvent=$idEvent");
	$_SESSION['tab'] = 5;
}
//mengeluarkan panitia dari event
else if (isset($_GET['idOutPanitia'])) {
	$idEvent = $_GET['idEvent'];
	$idPanitia = $_GET['idOutPanitia'];
	$sqlIdUser = "DELETE FROM panitia_event WHERE id_event = $idEvent AND id_panitia = $idPanitia";
	$resultIdUser = mysqli_query($mysqli, $sqlIdUser);
	$_SESSION['tab'] = 5;
	header("Location: eventAll.php?idEvent=$idEvent");
}
//tambah data tenant/sponsor baru dan didaftarkan ke event yng diikuti
else if (isset($_POST['tambahEventTenantSponsorBaru'])) {
	$idEvent = $_POST['idEvent'];
	$job = $_POST['sponsor'] + $_POST['tenant'];
	$sumbangan = $_POST['sumbangan'];
	$jumTenant = $_POST['jumTenant'];
	$sBayar = $_POST['sBayar'];
	$usaha = $_POST['usaha'];
	$alamat = $_POST['alamat'];
	$noTelp = $_POST['noTelp'];
	$username = $_POST['username'];
	$pass = $_POST['pass'];
	$salt = date('Y').".".date('d');
	$saltPisah = explode(".", $salt);
	$p = md5($saltPisah[0].$pass.$saltPisah[1]);
	
	$sqlCek = "SELECT * FROM tenant_sponsor WHERE nama_usaha = '$usaha'";
	$resultCek = mysqli_query($mysqli, $sqlCek);
	if (mysqli_num_rows($resultCek)) {
		die("Perusahaan/UMKM yang Anda inputkan Sudah Ada, coba firut <strong>Tambah Tenant/Sponsor >> Sudah Pernah Berpartisipasi Sebelumnya </strong>");
	} else {	
		$sqlInsertTenSpo = "INSERT INTO tenant_sponsor (username, password, salt, nama_usaha, alamat_usaha, no_telp) VALUES ('$username', '$p', '$salt', '$usaha', '$alamat', '$noTelp')";
		$resultInsertTenSpo = mysqli_query($mysqli, $sqlInsertTenSpo);
		if (!$resultInsertTenSpo) { echo "SQL Error : " . $sqlInsertTenSpo; }
		
		$sqlIdTenSpo = "SELECT * FROM tenant_sponsor WHERE nama_usaha = '$usaha' AND no_telp = '$noTelp'";
		$resultIdTenSpo = mysqli_query($mysqli, $sqlIdTenSpo);
		if (!$resultIdTenSpo) { echo "SQL Error : " . $sqlIdTenSpo; }
		$rowIdTenSpo = mysqli_fetch_array($resultIdTenSpo);
		$idTenSpo = $rowIdTenSpo['id_tenant_sponsor'];
		
		$sqlEventTenantSponsor = "INSERT INTO event_tenant_sponsor (id_event, id_tenant_sponsor, job, jumlah_pinjam_tenant, status_pembayaran, sumbangan) 
		VALUES ($idEvent, $idTenSpo, $job, $jumTenant, $sBayar, '$sumbangan')";
		$resultEventTenantSponsor = mysqli_query($mysqli, $sqlEventTenantSponsor);
		if (!$resultEventTenantSponsor) { echo "SQL Error : " . $sqlEventTenantSponsor; }
		$_SESSION['tab'] = 2;
		header("Location: eventAll.php?idEvent=$idEvent");
	}
}
//tambah data tenant/sponsor Lama dan didaftarkan ke event yng diikuti
else if (isset($_POST['tambahEventTenantSponsorLama'])) {
	$idEvent = $_POST['idEvent'];
	$job = $_POST['sponsor'] + $_POST['tenant'];
	$sumbangan = $_POST['sumbangan'];
	$jumTenant = $_POST['jumTenant'];
	$sBayar = $_POST['sBayar'];
	$usaha = $_POST['usaha'];
	$alamat = $_POST['alamat'];
	$noTelp = $_POST['noTelp'];
	$username = $_POST['username'];
	$pass = $_POST['pass'];
	$salt = date('Y').".".date('d');
	$saltPisah = explode(".", $salt);
	$p = md5($saltPisah[0].$pass.$saltPisah[1]);
	
	$sqlCek = "SELECT * FROM tenant_sponsor WHERE nama_usaha = '$usaha'";
	$resultCek = mysqli_query($mysqli, $sqlCek);
	if (mysqli_num_rows($resultCek)) {
		die("Perusahaan/UMKM yang Anda inputkan Sudah Ada, coba firut <strong>Tambah Tenant/Sponsor >> Sudah Pernah Berpartisipasi Sebelumnya </strong>");
	} else {	
		$sqlInsertTenSpo = "INSERT INTO tenant_sponsor (username, password, salt, nama_usaha, alamat_usaha, no_telp) VALUES ('$username', '$p', '$salt', '$usaha', '$alamat', '$noTelp')";
		$resultInsertTenSpo = mysqli_query($mysqli, $sqlInsertTenSpo);
		if (!$resultInsertTenSpo) { echo "SQL Error : " . $sqlInsertTenSpo; }
		
		$sqlIdTenSpo = "SELECT * FROM tenant_sponsor WHERE nama_usaha = '$usaha' AND no_telp = '$noTelp'";
		$resultIdTenSpo = mysqli_query($mysqli, $sqlIdTenSpo);
		if (!$resultIdTenSpo) { echo "SQL Error : " . $sqlIdTenSpo; }
		$rowIdTenSpo = mysqli_fetch_array($resultIdTenSpo);
		$idTenSpo = $rowIdTenSpo['id_tenant_sponsor'];
		
		$sqlEventTenantSponsor = "INSERT INTO event_tenant_sponsor (id_event, id_tenant_sponsor, job, jumlah_pinjam_tenant, status_pembayaran, sumbangan) 
		VALUES ($idEvent, $idTenSpo, $job, $jumTenant, $sBayar, '$sumbangan')";
		$resultEventTenantSponsor = mysqli_query($mysqli, $sqlEventTenantSponsor);
		if (!$resultEventTenantSponsor) { echo "SQL Error : " . $sqlEventTenantSponsor; }
		$_SESSION['tab'] = 2;
		header("Location: eventAll.php?idEvent=$idEvent");
	}
}

?>