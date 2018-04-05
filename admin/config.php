<?php 
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'kp_event_kediri';
$mysqli = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName)
        or die('Error Connecting to MySQL DataBase');

$i = 0;
if(isset($_SESSION['login'])){
	$i = $_SESSION['login'];
}

$sqlIdSekarang = "SELECT * FROM pengguna WHERE id_user = $i";
$resultIdSekarang = mysqli_query($mysqli, $sqlIdSekarang);
$rowIdSekarang = mysqli_fetch_array($resultIdSekarang);

?>
	  <!--Create Modal pengguna-->
	  <div id="myModal" class="modal modal-primary" role="dialog">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			  <h4 class="modal-title">Data Pengguna</h4>
			</div>
			<div class="modal-body" id="modal-body">
			  
			</div>
			<!--<div class="modal-footer">
			  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
			  <button type="button" class="btn btn-outline">Simpan</button>
			</div>-->
		  </div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	  </div><!-- /.modal -->
	  
	  <!--Create Modal event-->
	  <div id="myEvent" class="modal modal-success" role="dialog">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			  <h4 class="modal-title">Data Event</h4>
			</div>
			<div class="modal-body" id="modal-event">
			  
			</div>
			<!--<div class="modal-footer">
			  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
			  <button type="button" class="btn btn-outline">Simpan</button>
			</div>-->
		  </div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	  </div><!-- /.modal -->
	  
	  <!--Create Modal event Pendapatan & Pengeluaran-->
	  <div id="myPenPen" class="modal modal-success" role="dialog">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			  <h4 class="modal-title">Data Event</h4>
			</div>
			<div id="modal-penpen">
			  
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
		$("#modal-body").load("data_pengguna.php?idUserLogin="+id);
	  }
	 //  $(function () {
		// $('input').iCheck({
		//   checkboxClass: 'icheckbox_square-blue',
		//   radioClass: 'iradio_square-blue',
		//   increaseArea: '20%' // optional
		// });
	 //  });
	  /*
	  $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });*/
	  function bukatutupdropdownprofil(){
        // alert("function buka tutup dropdown");
        if($("#dropdownprofil").hasClass("open")){
          // alert("drop down terbuka");
          $("#dropdownprofil").removeClass("open")
        }else{
          // alert("drop down tertutup");
          $("#dropdownprofil").addClass("open")
        }
      }
	  </script>