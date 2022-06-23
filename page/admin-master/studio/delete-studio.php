<?php

if(isset($_GET['id_studio'])){

	$delete_studio = mysqli_query($koneksi, "DELETE FROM studio WHERE id_studio=".$_GET['id_studio']);

    // apakah query hapus berhasil?
    if( $delete_studio ){
        header('Location: index.php?hal=admin-master/studio/list-studio');
    } else {
        die("gagal menghapus...");
    }

} else {
    die("akses dilarang...");
}
?>