<?php

if( isset($_GET['id_penayangan']) ){

    // buat query hapus
    $sql = "DELETE FROM penayangan WHERE id_penayangan=".$_GET['id_penayangan'];
    $query = mysqli_query($koneksi, $sql);

    if( $query ){
        header('Location: index.php?hal=admin-master/penayangan/list-penayangan');
    } else {
        echo "<script>alert('Hapus Penayangan Gagal');location.href='?hal=admin-master/penayangan/list-penayangan';</script>";
    }

} else {
    die("akses dilarang...");
}
?>