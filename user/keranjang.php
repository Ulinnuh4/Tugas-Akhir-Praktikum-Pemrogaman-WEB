<?php 
session_start();
include "../koneksi.php";
if(empty($_SESSION['keranjang'])){
  echo "<script>alert('Keranjang Kosong')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../kumpulan_css/keranjang.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="full-kontainer container">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg  " data-aos="fade-down" data-aos-duration="1000">
      
      <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="../assets/logo.png" width="40">ManWear</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 " >
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?#produk">Produk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Tentang Kami</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="riwayat.php">Cek Pembelian</a>
            </li>
            <li class="nav-item">
            <li class="nav-item">
              <a class="nav-link" href="checkout.php"><i class="bi-bag-check px-2"></i>Checkout</a>
            </li>
            </li>
          </ul>
          <a class="nav-link keranjang" href="keranjang.php"><i class="bi bi-cart-dash"></i></a>
          <div class="login d-flex">
            <?php if(isset($_SESSION['pelanggan'])):?>
                <a href="./logout-user.php" class="logout">Logout</a>
           <?php else: ?>
              <a href="../user/halaman-login-user.php" class="sign-in">Login</a>
              <a href="../" class="sign-up">Daftar</a>
            <?php endif ?>
          </div>
          </div>
        </div>
    </nav>
    <!-- navbar -->

    <!-- Kontainer-1 -->
    <div class="kontainer-1 p-3">
    <h2 class="mb-4">Keranjang <span></span></h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>        
            </tr>
        </thead>
        <tbody>
          <?php 
           if (!isset($_SESSION['keranjang'])) {
            $_SESSION['keranjang'] = array();
          }
          $nomor=1;?>
          <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah):?>
            <?php
              $query = mysqli_query($connect, "SELECT * FROM produk WHERE id_produk= '$id_produk'");
              $tampilkan = mysqli_fetch_assoc($query);
              $subtotal = $tampilkan['harga_produk']*$jumlah;
            ?>
            <tr>
                <td><?php echo $nomor;?></td>
                <td><?php echo $tampilkan['nama_produk'];?></td>
                <td>Rp. <?php echo number_format($tampilkan['harga_produk']);?></td>
                <td><?php echo $jumlah;?></td>
                <td>Rp. <?php echo number_format($subtotal);?></td>
                <td><a href="hapus_produk_keranjang.php?id=<?php echo $id_produk;?>"class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
            </tr>
            <?php $nomor++; ?>
            <?php endforeach ?>
        </tbody>

    </table>
    <div class="tombol">
      <a href="checkout.php" class="check">Checkout</a>
      <a href="index.php" class="beli">Beli Lainya  <i class="bi bi-arrow-right"></i></a>
    </div>
    </div>
        <!-- Kontainer-1 -->

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>