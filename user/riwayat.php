<?php
session_start();
include "../koneksi.php";

if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
  echo "<script>alert('Silahkan Login dahulu')</script>";
  echo "<script>location='halaman-login-user.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian</title>
    <link rel="stylesheet" href="../kumpulan_css/riwayat.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="full-kontainer container">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg " data-aos="fade-down" data-aos-duration="1000">
      
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

    <h1>Riwayat Pembelian <?php echo $_SESSION['pelanggan']['nama_pelanggan'];?></h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Total</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <!-- id Pelanggan yang login -->
            <?php  ?>
            <?php $nomor=1;?>
            <?php 
            $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
            $query = mysqli_query($connect, "SELECT * FROM pembelian WHERE id_pelanggan = '$id_pelanggan'");
            while ($data = mysqli_fetch_assoc($query)){    
            ?>
            <tr>
                <td><?php echo $nomor++;?></td>
                <td><?php echo $data['tanggal_pembelian'];?></td>
                <td>
                  <?php if($data['status_pembayaran']=='Belum Bayar'):?>
                    <p class="btn btn-warning"><?php echo $data['status_pembayaran'];?></p>
                  <?php else: ?>
                      <p class="btn btn-success"><?php echo $data['status_pembayaran'];?></p>
                  <?php endif ?>
                  </td>
                <td><?php echo $data['total_pembelian'];?></td>
                <td><a href="nota.php?id=<?php echo $data['id_pembelian'];?>" class="btn btn-warning">Nota</a>
                    <a href="bayar.php?id=<?php echo $data['id_pembelian'];?>" class="btn btn-primary">Bayar</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>


</div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>
