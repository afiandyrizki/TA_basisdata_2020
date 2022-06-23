<?php
if(isset($_POST['daftar'])){
  if(!empty($_POST['nama_studio'])){

    $insert_studio = mysqli_query($koneksi,"INSERT INTO studio VALUES('','".$_POST['nama_studio']."')");

    if( $insert_studio ) {
		header('Location: ?hal=admin-master/studio/list-studio');
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
				$select_studio = mysqli_query($koneksi,"SELECT * FROM studio");
				echo mysqli_num_rows($select_studio);
			?>
		</div>
	 </div>
	 <div class="col-sm-10">
	  <section class="panel panel-default">
		<header class="panel-heading">LIST STUDIO</header>
		<div class="panel-body">	
		 <nav>
			<button type="button" data-target="#ModalAdd" data-toggle="modal" class="btn btn-warning">
			 <i class="fa fa-plus"></i> Tambah Studio Baru
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
			   Nama Studio
			  </th>
			  <th>
			   Aksi
			  </th>
			 </tr>
			</thead>
			<tbody>
			<?php
			$no = 1;
			while($row_studio = mysqli_fetch_array($select_studio)){
			  echo '<tr>';
			  echo '<td>'.$no++.'</td>';
			  echo '<td>'.$row_studio['nama_studio'].'</td>';
			  echo "<td><a href='?hal=admin-master/studio/edit-studio&id=".$row_studio['id_studio']."' class='btn btn-warning' role='button'><i class='glyphicon glyphicon-pencil'></i></a>
                        <a href='#modal_delete' data-id='".$row_studio['id_studio']."' data-toggle='modal' class='btn btn-danger buang' role='button'><i class='glyphicon glyphicon-trash'></i></a>
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
						<h4 class="modal-title">Tambah Studio</h4>
					</div>
					<div class="modal-body">
						<form action="" name="modal_popup" method="post">
							<br>
							<input name="nama_studio" type="text" class="form-control" placeholder="Masukkan nama studio" required />
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
    $('#delete_link').attr('href','?hal=admin-master/studio/delete-studio&id_studio='+id);
})
</script>

