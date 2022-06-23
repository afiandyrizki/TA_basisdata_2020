<?php
include 'koneksi.php';

if( isset($_GET['id_film']) ){

    // buat query hapus
    $sql = "DELETE FROM film WHERE id_film=".$_GET['id_film'];
    $query = mysqli_query($koneksi, $sql);

    if( $query ){
        header('Location: index.php?hal=admin-master/film/list-film');
    } else {
        echo "<script>alert('Hapus Film Gagal');location.href='?hal=admin-master/film/list-film';</script>";
    }

} else {
    die("akses dilarang...");
}
?>