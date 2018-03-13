<?php 
require 'koneksidatabase.php';

$i = 0;
if(isset($_SESSION['login'])){
	$i = $_SESSION['login'];
}

$sqlIdSekarang = "SELECT * FROM karyawan WHERE id_user = $i"."";
$resultIdSekarang = mysqli_query($mysqli, $sqlIdSekarang);
$rowIdSekarang = mysqli_fetch_array($resultIdSekarang);

?>
	  <!--Create Modal-->
	  <div id="tambahPenggunaModal" class="modal modal-primary" role="dialog">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			  <h4 class="modal-title">Data Pengguna</h4>
			</div>
			<div class="modal-body" id="modalbody">
			  
			</div>
			<!--<div class="modal-footer">
			  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
			  <button type="button" class="btn btn-outline">Simpan</button>
			</div>-->
		  </div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	  </div><!-- /.modal -->
	  
	  <script>
	  function dataUserLogin(id){
		$(".modal-body").load("data_pengguna.php?idUserLogin="+id);
	  }
	  </script>