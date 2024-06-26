<?php
session_start();
include "../koneksi.php";
$id = $_GET['id'];
$query = mysqli_query($connect, "SELECT * FROM produk WHERE id_produk = '$id'");
$produk = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail_produk</title>
    <link rel="stylesheet" href="../kumpulan_css/detail.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="full-kontainer container ">
        <!-- navbar -->
    <nav class="navbar navbar-expand-lg" data-aos="fade-down" data-aos-duration="1000">
      
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
          <a class="nav-link keranjang" href="keranjang.php"><i class="bi bi-cart-dash "></i></a>
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

    <!-- KONTAINER -->
    <div class="container kontainer-2"data-aos="fade-in" data-aos-duration="2000">
      <div class="row justify-content-center">
        <div class="col-md-6 col-12 "data-aos="fade-right" data-aos-duration="1000">
            <img src="../assets/<?php echo $produk['foto_produk'];?>" >
        </div>
        <div class="deskripsi-produk col-md-4 col-12" data-aos="fade-left" data-aos-duration="1000">
            <h1 class="mb-3"><?php echo $produk['nama_produk'];?></h1>
            <p><?php echo $produk['deskripsi_produk'];?></p>
            <h3>Rp. <?php echo number_format($produk['harga_produk']);?></h3>
            <p>Stok : <?php echo $produk['stok_produk']; ?></p>
            <form action="" method="post" class="jumlahbeli">
              <div class="form-group">
                <div class="input-group">
                  <input type="number" name="jumlah" min="1" class="form-control" placeholder="Masukkan jumlah">
                </div>
                <button name="submit" class="beli">Beli</button>
              </div>
            </form>
            <!-- KODE PHP -->
            <?php
              if(isset($_POST['submit'])){
                $jumlah = $_POST['jumlah'];
                $_SESSION['keranjang'][$id] = $jumlah;

                echo"<script>alert('Produk dimasukkan ke keranjang')</script>";
                echo"<script>location='keranjang.php';</script>";

              }
            ?>

        </div>
      </div>
    </div>
    <!-- KONTAINER -->
     
    </div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>