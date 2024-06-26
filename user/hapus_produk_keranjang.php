<?php
session_start();
$id_produk = $_GET['id'];
unset($_SESSION['keranjang'][$id_produk]);

echo "<script>alert('Produk telah dihapus')</script>";
echo "<script>location='keranjang.php';</script>"
?>
<pre>
    <?php print_r($_SESSION['keranjang'][$id_produk]);?>
</pre>