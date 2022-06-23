<?php
include 'koneksi.php';

if( isset($_GET['id_kursi']) ){

    // buat query hapus
    $sql = "DELETE FROM kursi WHERE id_kursi=".$_GET['id_kursi'];
    $query = mysqli_query($koneksi, $sql);

    if( $query ){
        header('Location: index.php?hal=admin-master/kursi/list-kursi');
    } else {
        echo "<script>alert('Hapus Kursi Gagal');location.href='?hal=admin-master/kursi/list-kursi';</script>";
    }

} else {
    die("akses dilarang...");
}
?>