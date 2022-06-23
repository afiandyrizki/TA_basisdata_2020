<?php

include("koneksi.php");

// kalau tidak ada id di query string
if( !isset($_GET['id']) ){
    header('?hal=admin-master/kursi/list-kursi');
}

// buat query untuk ambil data dari database
$select_kursi    = mysqli_query($koneksi, "SELECT * FROM kursi WHERE id_kursi=".$_GET['id']);
$row_kursi       = mysqli_fetch_array($select_kursi);

if(isset($_POST['simpan'])){
    
    $edit_kursi = mysqli_query($koneksi,"UPDATE kursi SET nama_kursi='".$_POST['nama_kursi']."' WHERE id_kursi=".$_GET['id']);

    // apakah query update berhasil?
    if($edit_kursi){
        header('Location: index.php?hal=admin-master/kursi/list-kursi');
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
            <label for="kategori">Nama Kursi </label><br />
            <input type="text" name="nama_kursi" placeholder="Nama Kursi" value="<?php echo $row_kursi['nama_kursi']; ?>" required />
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

