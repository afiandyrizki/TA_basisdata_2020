<?php
// kalau tidak ada id di query string
if( !isset($_GET['id']) ){
    header('?hal=admin-master/penayangan/list-penayangan');
}

if(isset($_POST['simpan'])){

		$tayang_jadwal			= date('Y-m-d H:i:s', strtotime($_POST['tayang_jadwal']));

    $select_penayangan 	= mysqli_query($koneksi, "SELECT * FROM penayangan WHERE id_penayangan = ".$_GET['id']);
    $row_penayangan 		= mysqli_fetch_array($select_penayangan);

    $select_jadwal 			= mysqli_query($koneksi, "SELECT * FROM jadwal WHERE id_jadwal = ".$row_penayangan['id_jadwal']);
    $row_jadwal					= mysqli_fetch_array($select_jadwal);

    $edit_jadwal				= mysqli_query($koneksi, "UPDATE jadwal SET tayang_jadwal='$tayang_jadwal', id_film=".$_POST['id_film']." WHERE id_jadwal = ".$row_jadwal['id_jadwal']);

    $edit_penayangan		= mysqli_query($koneksi, "UPDATE penayangan SET id_studio=".$_POST['id_studio']." WHERE id_penayangan=".$_GET['id']);

    if($edit_jadwal && $edit_penayangan){
        header('Location: index.php?hal=admin-master/penayangan/list-penayangan');
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

input[type=datetime-local] {
  width: 30%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}

</style>

<div class="row list-jenis">
    <div class="col-sm-12">
     <section class="panel panel-default">
      <header class="panel-heading">EDIT PENAYANGAN</header>
       <div class="panel-body"> 
        <form action="" method="POST">
        <p>
            <label for="film">Nama Film</label><br />
            <select name="id_film">
            	<?php 
            		$select_film    = mysqli_query($koneksi, "SELECT * FROM film");
            		while ($row_film = mysqli_fetch_array($select_film)) {
            			echo "<option value='".$row_film['id_film']."'>".$row_film['judul_film']."</option>";
            		}
            	?>
            </select>
        </p>

        <p>
            <label for="tayang_jadwal">Jadwal Tayang</label><br />
            <input name="tayang_jadwal" type="datetime-local" required />
        </p>

        <p>
            <label for="film">Nama Studio</label><br />
            <select name="id_studio">
            	<?php 
            		$select_studio    = mysqli_query($koneksi, "SELECT * FROM studio");
            		while ($row_studio = mysqli_fetch_array($select_studio)) {
            			echo "<option value='".$row_studio['id_studio']."'>".$row_studio['nama_studio']."</option>";
            		}
            	?>
            </select>
        </p>
        
        <p>
            <input type="submit" class="btn btn-success" value="SIMPAN" name="simpan" />
            <a href="index.php?hal=admin-master/kursi/list-kursi" class="btn btn-danger">BATAL</a>
        </p>
        </form>
       </div>
     </section>
    </div>
</div>

