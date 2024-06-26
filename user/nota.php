<?php
include "../koneksi.php";
session_start();
if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
  echo "<script>alert('Harus Login Terlebih dahulu')</script>";
  echo "<script>location='halaman-login-user.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../kumpulan_css/nota.css">
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

    <!-- KONTAINER -->
    <?php
        $id_pembelian_barusan = $_GET['id'];
        $ambil = mysqli_query($connect, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$id_pembelian_barusan'");
        $detail = $ambil -> fetch_assoc();
        

        ?>

        <style>
            h2{
                font-size: 42px;
                font-weight: 600;
            }
            h2 span{
                color: aqua;
            }
            
        </style>
        <div class="kontainer-1 p-3">
        <h2 class="mb-4">Detail <span>Pemesanan</span></h2>
        <p>
            Nama       : <strong> <?php echo $detail['nama_pelanggan'];?> <br> </strong>
            Telepon    : <strong> <?php echo $detail['telepon_pelanggan'];?> <br> </strong>
            Email      : <strong> <?php echo $detail['email_pelanggan'];?> <br> </strong>
            Tanggal    : <strong> <?php echo $detail['tanggal_pembelian'];?> <br> </strong>
            Total      : <strong> <?php echo $detail['total_pembelian'];?> <br> </strong>
            Nama Kota  : <strong> <?php echo $detail['kota'];?> <br> </strong>
            Tarif      : <strong> <?php echo $detail['tarif'];?> <br> </strong> 
            Alamat     : <strong> <?php echo $detail['alamat'];?> <br> </strong> 
        </p>
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor = 1;?>
            <?php
                $total_biaya = 0;
                $query = mysqli_query($connect, "SELECT * FROM  pembelian_produk JOIN produk ON pembelian_produk.id_produk = produk.id_produk WHERE pembelian_produk.id_pembelian= '$id_pembelian_barusan'");
                while ($data = mysqli_fetch_assoc($query)){
                $subtotal = $data['harga_produk'] * $data['jumlah'];
                $total_biaya += $subtotal;  
            ?>
          
            <tr>
                <td><?php echo $nomor++;?></td>
                <td><?php echo $data['nama_produk'];?></td>
                <td><?php echo $data['harga_produk'];?></td>
                <td><?php echo $data['jumlah'];?></td>
                <td><?php echo $subtotal;?></td>
            </tr>
            <?php }?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">Total Biaya</th>
                <th><?php echo $total_biaya;?></th>
            </tr>
            <tr>
                <th colspan="4">Ongkos Kirim</th>
                <th><?php echo $detail['tarif'];?></th>
            </tr>
            <tr>
                <th colspan="4">Total Keseluruhan</th>
                <th><?php echo $total_biaya + $detail['tarif'];?></th>
            </tr>
        </tfoot>
      </table>
        <div class="row">
            <div class="col-md-5">
                <div class="alert alert-info">
                    <p>
                        Silahkan Melakukan Pembayaran sebesar Rp.<?php echo number_format($detail['total_pembelian']);?> Ke <br>
                        <strong>BRI : 1234-5678-910 A/n Faizal Dwi Saputra</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- KONTAINER -->

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>