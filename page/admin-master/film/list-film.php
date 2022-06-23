<?php
if(isset($_POST['daftar'])){
  if(!empty($_POST['judul_film']) && !empty($_POST['harga_film'])){

    $insert_film = mysqli_query($koneksi,"INSERT INTO film VALUES('','".$_POST['judul_film']."', '".$_POST['harga_film']."')");

    if( $insert_film ) {
		header('Location: ?hal=admin-master/film/list-film');
    }else{
        header('Location: index.php');
    }
  }else{
	echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	       <strong>Input gagal</strong></div>';  
  }
} 
?>
<style>

input[type=text] {
  background-color: white;
  padding: 5px 5px 5px 10px;
  margin-bottom: 8px;
  
}

input[type=number] {
  background-color: white;
  padding: 5px 5px 5px 10px;
  margin-bottom: 8px;
  
}


</style>
<div class="list-jenis">
	<div class="row">
	 <div class="col-sm-2">
	  <section class="panel panel-default">
	   <div class="panel panel-heading">Total Studio</div>
		<div class="panel panel-body">
			Total Studio <b>:</b>
			<?php 
				$select_film = mysqli_query($koneksi,"SELECT * FROM film");
				echo mysqli_num_rows($select_film);
			?>
		</div>
	 </div>
	 <div class="col-sm-10">
	  <section class="panel panel-default">
		<header class="panel-heading">LIST FILM</header>
		<div class="panel-body">	
		 <nav>
			<button type="button" data-target="#ModalAdd" data-toggle="modal" class="btn btn-primary">
			 <i class="fa fa-plus"></i> Tambah Film Baru
			</button>
		 </nav>
		 <br>
		 <div class="table-responsive">
		  <table class="table table-bordered" id="example">
			<thead>
			 <tr>
			  <th>
			   Nomor
			  </th>
			  <th>
			   Nama Film
			  </th>
			  <th>
			   Harga
			  </th>
			  <th>
			   Aksi
			  </th>
			 </tr>
			</thead>
			<tbody>
			<?php
			$no = 1;
			while($row_film = mysqli_fetch_array($select_film)){
			  echo '<tr>';
			  echo '<td>'.$no++.'</td>';
			  echo '<td>'.$row_film['judul_film'].'</td>';
			  echo '<td>'.$row_film['harga_film'].'</td>';
			  echo "<td><a href='?hal=admin-master/film/edit-film&id=".$row_film['id_film']."' class='btn btn-warning' role='button'><i class='glyphicon glyphicon-pencil'></i></a>
                        <a href='#modal_delete' data-id='".$row_film['id_film']."' data-toggle='modal' class='btn btn-danger buang' role='button'><i class='glyphicon glyphicon-trash'></i></a>
					</td>";
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
 
		<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Film</h4>
					</div>
					<div class="modal-body">
						<form action="" name="modal_popup" method="post">
							<br>
							<input name="judul_film" type="text" class="form-control" placeholder="Masukkan Judul Film" required />
							<br>
							<input name="harga_film" type="text" class="form-control" placeholder="Masukkan Harga Film" required />
							<br>
							<div class="modal-footer">
								<button class="btn btn-default" name="daftar" type="submit">
									Tambah
								</button>
								<button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
									Batal
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="modal fade" id="modal_delete">
			<div class="modal-dialog">
				<div class="modal-content" style="margin-top:100px;">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" style="text-align:center;">Apa anda yakin ingin menghapus data ini?</h4>
					</div>
                    <div class="modal-body">
					  <div class="alert alert-warning">Data yang sudah dihapus
					  <br> tidak akan bisa dikembalikan lagi!</div>
					</div>					
					<div class="modal-footer" style="margin:0px; border-top:0px; text-align:right;">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<a href="#" role="button" class="btn btn-danger" id="delete_link">Delete</a>
					</div>
				</div>
			</div>
		</div>
		


<script src="jquery/jquery.min.js"></script>		
<script src="js/bootstrap.min.js"></script>
<script>
$('.buang').click(function(){
    var id=$(this).data('id');
    $('#delete_link').attr('href','?hal=admin-master/film/delete-film&id_film='+id);
})
</script>

