<?php
if(isset($_POST['daftar'])){
  if(!empty($_POST['id_film']) && !empty($_POST['id_studio']) && !empty($_POST['tayang_jadwal'])){

    $tayang_jadwal = date("Y-m-d H:i:s",strtotime($_POST['tayang_jadwal']));

    $select_film = mysqli_query($koneksi, "SELECT * FROM film WHERE judul_film = '".$_POST['id_film']."'");
    $row_film = mysqli_fetch_array($select_film);
    $select_studio = mysqli_query($koneksi, "SELECT * FROM studio WHERE nama_studio = '".$_POST['id_studio']."'");
    $row_studio = mysqli_fetch_array($select_studio);

    mysqli_query($koneksi, "INSERT INTO jadwal VALUES('', '$tayang_jadwal', ".$row_film['id_film'].")");

    $last_id = mysqli_insert_id($koneksi);
    $insert_penayangan = mysqli_query($koneksi,"INSERT INTO penayangan VALUES('', $last_id, ".$row_studio['id_studio'].")");

    if( $insert_penayangan ) {
    header('Location: ?hal=admin-master/penayangan/list-penayangan');
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

ul.ui-autocomplete {
width: auto;
border: none;
}

ul.ui-autocomplete li.ui-menu-item {
font-size: 15px;
padding: 3px;
border: none;
}

ul.ui-autocomplete li.ui-menu-item:hover {
border: none;
}

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
     <div class="panel panel-heading">Total Penayangan</div>
    <div class="panel panel-body">
      Total Penayangan <b>:</b>
      <?php 
        $select_penayangan = mysqli_query($koneksi,"SELECT jadwal.*, studio.*, film.*, penayangan.* FROM penayangan INNER JOIN studio ON penayangan.id_studio = studio.id_studio INNER JOIN jadwal ON penayangan.id_jadwal=jadwal.id_jadwal INNER JOIN film ON jadwal.id_film=film.id_film");
        echo mysqli_num_rows($select_penayangan);
      ?>
    </div>
   </div>
   <div class="col-sm-10">
    <section class="panel panel-default">
    <header class="panel-heading">LIST KURSI</header>
    <div class="panel-body">  
     <nav>
      <button type="button" data-target="#ModalAdd" data-toggle="modal" class="btn btn-info">
       <i class="fa fa-plus"></i> Tambah Penayangan Baru
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
         Jadwal Tayang
        </th>
        <th>
         Nama Studio
        </th>
        <th>
         Harga Film
        </th>
        <th>
         Aksi
        </th>
       </tr>
      </thead>
      <tbody>
      <?php
      $no = 1;
      while($row_penayangan = mysqli_fetch_array($select_penayangan)){
        echo '<tr>';
        echo '<td>'.$no++.'</td>';
        echo '<td>'.$row_penayangan['judul_film'].'</td>';
        echo '<td>'.$row_penayangan['tayang_jadwal'].'</td>';
        echo '<td>'.$row_penayangan['nama_studio'].'</td>';
        echo '<td>'.$row_penayangan['harga_film'].'</td>';
        echo "<td><a href='?hal=admin-master/penayangan/edit-penayangan&id=".$row_penayangan['id_penayangan']."' class='btn btn-warning' role='button'><i class='glyphicon glyphicon-pencil'></i></a>
                  <a href='#modal_delete' data-id='".$row_penayangan['id_penayangan']."' data-toggle='modal' class='btn btn-danger buang' role='button'><i class='glyphicon glyphicon-trash'></i></a>
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
            <h4 class="modal-title">Tambah Penayangan</h4>
          </div>
          <div class="modal-body">
            <form action="" name="modal_popup" method="post">
              <br>
              <select name="id_film" class="form-control">
                <?php 
                  $select_film = mysqli_query($koneksi, "SELECT * FROM film");
                  while ($row_film = mysqli_fetch_array($select_film)) {
                    echo "<option value-'".$row_film['id_film']."'>".$row_film['judul_film']."</option>";
                  }
                ?>
              </select>
              <br>
              <input name="tayang_jadwal" type="datetime-local" class="form-control" required />
              <br>
              <select name="id_studio" class="form-control">
                <?php 
                  $select_studio = mysqli_query($koneksi, "SELECT * FROM studio");
                  while ($row_studio = mysqli_fetch_array($select_studio)) {
                    echo "<option value-'".$row_studio['id_studio']."'>".$row_studio['nama_studio']."</option>";
                  }
                ?>
              </select>
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
    $('#delete_link').attr('href','?hal=admin-master/penayangan/delete-penayangan&id_penayangan='+id);
})
</script>

