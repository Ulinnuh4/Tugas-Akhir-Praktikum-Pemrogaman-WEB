<?php
include "koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($connect, "DELETE FROM pelanggan WHERE id_pelanggan='$id'");
header("Location: dashboard.php?halaman=pelanggan");
echo "<script> alert('Data berhasil dihapus')</script>";
?>