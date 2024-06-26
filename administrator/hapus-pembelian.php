<?php
include "koneksi.php";
$id = $_GET['id'];
mysqli_query($connect, "DELETE FROM pembelian WHERE id_pembelian = '$id'");
header("Location: dashboard.php?halaman=pembelian");
echo "<script> alert('Data berhasil dihapus')</script>";
?>