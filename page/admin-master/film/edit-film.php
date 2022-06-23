<?php
// kalau tidak ada id di query string
if( !isset($_GET['id']) ){
    header('?hal=admin-master/film/list-film');
}

// buat query untuk ambil data dari database
$select_film    = mysqli_query($koneksi, "SELECT * FROM film WHERE id_film=".$_GET['id']);
$row_film       = mysqli_fetch_array($select_film);

if(isset($_POST['simpan'])){
    
    $edit_film = mysqli_query($koneksi, "UPDATE film SET judul_film='".$_POST['judul_film']."', harga_film=".$_POST['harga_film']." WHERE id_film=".$_GET['id']);

    if($edit_film){
        header('Location: index.php?hal=admin-master/film/list-film');
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
      <header class="panel-heading">EDIT KURSI</header>
       <div class="panel-body"> 
        <form action="" method="POST">
        <p>
            <label for="judul_film">Nama Kursi </label><br />
            <input type="text" name="judul_film" placeholder="Judul Film" value="<?php echo $row_film['judul_film']; ?>" required />
        </p>

        <p>
            <label for="harga_film">Harga Film </label><br />
            <input type="text" name="harga_film" placeholder="Harga Film" value="<?php echo $row_film['harga_film']; ?>" required />
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

