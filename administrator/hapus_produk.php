<?php
include "koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($connect, "DELETE FROM produk WHERE id_produk='$id'");
header("Location: dashboard.php?halaman=produk");
echo "<script> alert('Data berhasil dihapus')</script>";
?>