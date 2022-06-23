<?php

include("koneksi.php");

// kalau tidak ada id di query string
if( !isset($_GET['id']) ){
    header('?hal=admin-master/studio/list-studio');
}

// buat query untuk ambil data dari database
$select_studio	= mysqli_query($koneksi, "SELECT * FROM studio WHERE id_studio=".$_GET['id']);
$row_studio 	= mysqli_fetch_array($select_studio);

if(isset($_POST['simpan'])){

    $edit_studio = mysqli_query($koneksi,"UPDATE studio SET nama_studio='".$_POST['nama_studio']."' WHERE id_studio=".$_GET['id']);

    // apakah query update berhasil?
    if($edit_studio){
        header('Location: index.php?hal=admin-master/studio/list-studio');
    }else{
        header('Location: index.php?hal=dashboard');
    }
}
?>

<style>

select {
  width: 30%;
  padding: 16px 20px;
  border: none;
  border-radius: 4px;
  background-color: #f1f1f1;
}


input[type=number]{
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}

input[type=text] {
  width: 50%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}

</style>

<div class="row list-jenis">
	<div class="col-sm-12">
	 <section class="panel panel-default">
	  <header class="panel-heading">EDIT STUDIO</header>
	   <div class="panel-body">	
		<form action="" method="POST">
        <p>
            <label for="nama_studio">Nama Studio </label><br />
            <input type="text" name="nama_studio" placeholder="Nama Studio" value="<?php echo $row_studio['nama_studio']; ?>" required />
        </p>
        
        <p>
            <input type="submit" class="btn btn-success" value="SIMPAN" name="simpan" />
			<a href="index.php?hal=admin-master/studio/list-studio" class="btn btn-danger">BATAL</a>
		</p>
		</form>
	   </div>
	 </section>
	</div>
</div>

