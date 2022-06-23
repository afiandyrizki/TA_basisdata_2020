<?php
 session_start();
 include 'page/koneksi.php';
 
if(isset($_POST['login']) && !empty($_POST['login'])){
	 $nama_kasir 	= mysqli_real_escape_string($koneksi, $_POST['nama_kasir']);
	 $password		= mysqli_real_escape_string($koneksi, $_POST['password']);
	 
	 $select_kasir	= mysqli_query($koneksi, "SELECT * FROM kasir WHERE nama_kasir='$nama_kasir' AND password='$password'");
	 $num_kasir		= mysqli_num_rows($select_kasir);
	 $row_kasir		= mysqli_fetch_array($select_kasir);
	 if($num_kasir > 0){
		$_SESSION['nama_kasir'] = $row_kasir['nama_kasir'];
		$_SESSION['id_kasir'] = $row_kasir['id_kasir'];
		header('location: page/index.php');
	 }else{
?>
		<script type="text/javascript">
		 alert("Pengguna Tidak Ditemukan!");location.href="index.php";
		</script>
<?php
	 }
}else{
	var_dump("gagal");
}
?>