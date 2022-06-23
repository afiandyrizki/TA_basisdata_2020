<div class="list-jenis">
	<div class="row">
	 <div class="col-sm-12">
	  <section class="panel panel-default">
		<header class="panel-heading">LAPORAN PENJUALAN</header>
		<div class="panel-body">
		 <div class="table-responsive">
		  <table class="table table-bordered" id="example">
			<thead>
			 <tr>
			  <th>
			   Nomor
			  </th>
			  <th>
			   Customer
			  </th>
			  <th>
			   Film
			  </th>
			  <th>
			   Jadwal
			  </th>
			  <th>
			   Studio
			  </th>
			  <th>
			   Total
			  </th>
			  <th>
			   Tanggal
			  </th>
			 </tr>
			</thead>
			<tbody>
			<?php
			$no = 1;
			$select_transaksi = mysqli_query($koneksi, "SELECT customer.*, film.*, jadwal.*, studio.*, transaksi.* FROM transaksi INNER JOIN customer ON transaksi.id_customer = customer.id_customer INNER JOIN penayangan ON transaksi.id_penayangan = penayangan.id_penayangan INNER JOIN jadwal ON penayangan.id_jadwal = jadwal.id_jadwal INNER JOIN studio ON penayangan.id_studio = studio.id_studio INNER JOIN film ON jadwal.id_film = film.id_film");
			while($row_transaksi = mysqli_fetch_array($select_transaksi)){
			  echo '<tr>';
			  echo '<td>'.$no++.'</td>';
			  echo '<td>'.$row_transaksi['nama_customer'].'</td>';
			  echo '<td>'.$row_transaksi['judul_film'].'</td>';
			  echo '<td>'.$row_transaksi['tayang_jadwal'].'</td>';
			  echo '<td>'.$row_transaksi['nama_studio'].'</td>';
			  echo '<td>'.$row_transaksi['harga_transaksi'].'</td>';
			  echo '<td>'.$row_transaksi['tgl_transaksi'].'</td>';
			  echo '</tr>';
			 }
			?>
			</tbody>
			</table>
		 </div>
		</div>
	  </section>
	 </div>
	</div>
</div>