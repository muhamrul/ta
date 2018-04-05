<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminKSM | Login</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
	<link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  </head>
  <body class="login-page">
    <?php 
    session_start();
    require 'config.php';
	if (isset($_POST['btnMasuk'])) {
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$sql = "SELECT * FROM pengguna WHERE username = '$user' OR email = '$user'";
        $result = mysqli_query($mysqli, $sql);
        if (!$result) {
            die("SQL ERROR : " . mysqli_error($mysqli));
        }
        // cek jumlah row / data yang terambil
        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_array($result);
			$salt = $row['salt'];
			$saltPisah = explode(".", $salt);
			$p = md5($saltPisah[0].$pass.$saltPisah[1]);
            if ($row['password'] == $p && $row['status'] == 1 && $row['jabatan'] != 2 && $row['s_hapus'] != 1) {
                echo "<script>alert('Masuk')</script>";
				$_SESSION['login'] = $row['id_user'];
                header("Location: index.php");
            } else if ($row['status'] == 0) {
				echo "<script>alert('Identitas Ini statusnya Non-Aktif')</script>";
			} else if ($row['jabatan'] == 2) {
				echo "<script>alert('Identitas ini ditolak')</script>";
			} else if ($row['s_hapus'] == 1) {
				echo "<script>alert('Identitas Ini telah terhapus')</script>";
			} else{
                echo "<script>alert('Password anda salah')</script>";
            }
        } else {
            echo "<script>alert('username atau email tidak ada')</script>";
        }
	} else if (isset($_SESSION['login'])) {
		header("Location: index.php");
	}
    ?>
    <div class="login-box">
      <div class="login-logo">
        <b>Admin/Panitia</b>KSM
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">LOGIN</p>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="user" placeholder="Username" required />
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="pass" placeholder="Password" required />
          </div>
          <div class="row">
            <div class="col-xs-8">                           
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" name="btnMasuk">Masuk</button>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
  </body>
</html>