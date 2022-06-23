<?php
 include 'koneksi.php';
 $today = date('Y-m-d H:i:s');

if (isset($_POST['kursi'])) {
	$_SESSION['kursi'] = $_POST['kursi'];
}
 if (isset($_POST['button'])) {
 		if ($_POST['action'] == 'proses') {
 			$last_id = null;
 			$check_customer = mysqli_query($koneksi, "SELECT * FROM customer WHERE nama_customer = '".$_POST['nama_customer']."'");
 			$row_customer = mysqli_fetch_array($check_customer);
 			$num_customer		= mysqli_num_rows($check_customer);
 			if ($num_customer > 0) {
 				$last_id = $row_customer['id_customer'];
 			}else{
 				mysqli_query($koneksi, "INSERT INTO customer VALUES('', '".$_POST['alamat_customer']."', '".$_POST['nama_customer']."', '".$_POST['ponsel']."')");
 				$last_id = mysqli_insert_id($koneksi);
 			}

 			$select_film = mysqli_query($koneksi, "SELECT film.* FROM penayangan INNER JOIN jadwal ON penayangan.id_jadwal = jadwal.id_jadwal INNER JOIN film ON jadwal.id_film = film.id_film");
 			$row_film = mysqli_fetch_array($select_film);

 			$harga_transaksi = count($_SESSION['kursi'])*$row_film['harga_film'];

 			mysqli_query($koneksi, "INSERT INTO transaksi VALUES(".$_SESSION['id_kasir'].", '', ".$last_id.", ".$_POST['id_penayangan'].", $harga_transaksi, '$today')")or die(mysqli_error());

 			$last_id = mysqli_insert_id($koneksi);

 			for ($a=0; $a < count($_SESSION['kursi']); $a++) { 
 				mysqli_query($koneksi, "INSERT INTO detail_transaksi VALUES('', ".$_SESSION['kursi'][$a].", $last_id)");
 			}

      echo "<script>alert('Pemesanan Tiket Berhasil');location.href='?hal=admin-master/laporan/penjualan';</script>";
      exit;
 		}
 }
?>

<div class="list-jenis">
  <div class="row">
   <div class="col-sm-12">
    <section class="panel panel-default">
    	<div class="panel panel-body">
     		<form action="" method="POST">
     			<div class="row">
     				<input type="hidden" name="action" value="proses">
     				<div class="col-md-6">
     					<label>Nama Customer</label>
     					<input type="text" name="nama_customer" class="form-control">
     					<br>
     					<label>Alamat</label>
     					<textarea name="alamat_customer" class="form-control"></textarea>
     					<br>
     					<label>Ponsel</label>
     					<input type="text" name="ponsel" class="form-control">
     				</div>
     				<div class="col-md-6">
     					<label>Film Yang Sedang Tayang</label>
     					<select name="id_penayangan" class="form-control">
     						<?php 
     							$select_penayangan = mysqli_query($koneksi, "SELECT film.*, penayangan.* FROM penayangan INNER JOIN jadwal ON penayangan.id_jadwal = jadwal.id_jadwal INNER JOIN film ON jadwal.id_film = film.id_film");
     							while ($row_penayangan = mysqli_fetch_array($select_penayangan)) {
     								echo "<option value='".$row_penayangan['id_penayangan']."'>".$row_penayangan['judul_film']."</option>";
     							}
     						?>
     					</select>
     				</div>
     			</div>
     			<div class="row">
     				<div class="col-md-12">
     					<button type="submit" class="btn btn-success btn-md pull-right" name="button">Pesan</button>
     				</div>
     			</div>
     		</form>
    	</div>
    </section>
   </div>
  </div>
</div>