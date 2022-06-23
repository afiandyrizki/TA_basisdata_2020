<div class="container-fluid">
  <div class="jumbotron">
    <h1>Pilih Kursi Anda</h1>
    <p>Harap untuk memilih kursi sebelum masuk ke halaman transaksi.</p>
  </div>
<form action="?hal=admin-master/penjualan/penjualan" method="POST">
<div class="row">
	<?php 
		$query = mysqli_query($koneksi, "SELECT * FROM kursi");
		while ($row_kursi = mysqli_fetch_array($query)) {
	?>
	<div class="col-sm-2">
		<div class="panel panel-info">
			<div class="panel-body" style="padding: 10px;border-radius: 2px;">
	    		<div class="card">
	      			<div class="card-body">
	      				<center>
	      					<div class="alert alert-warning">
  <strong><i class="glyphicon glyphicon-bed"></i></strong><h1 class="card-title"><?=$row_kursi['nama_kursi']?></h1>
</div>
	        			
	        			<input type="checkbox" name="kursi[]" value="<?=$row_kursi['id_kursi']?>">
	        			</center>
	      			</div>
	    		</div>
	    	</div>
		</div>
	</div>
	<?php 
	}
	?>
</div>

<button type="submit" class="btn btn-info btn-md" name="pesan"><i class="	glyphicon glyphicon-shopping-cart"></i> Pesan Sekarang</button>
</form>
</div>