<?php
session_start();
include "../koneksi.php";
if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
    echo "<script>alert('Silahkan Login dahulu')</script>";
    echo "<script>location='halaman-login-user.php';</script>";
    exit();
}
$id_pembelian = $_GET['id'];
$query = mysqli_query($connect, "SELECT * FROM pembelian WHERE id_pembelian = '$id_pembelian'");
$data = mysqli_fetch_assoc($query);

// 
if($data['status_pembayaran'] == 'Sudah bayar') {
    echo "<script>alert('Anda sudah melakukan pembayaran. Mohon tunggu Konfirmasi');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
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
          <a class="navbar-brand" href="#"><img src="../assets/logo.png" width="40">UFA</a>
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
              <a href="../user/halaman-login-user.php" class="sign-in">Sign In</a>
              <a href="../" class="sign-up">Sign Up</a>
            <?php endif ?>
          </div>
          </div>
        </div>
     </nav>
    <!-- navbar -->

    <div class="kontainer-1">
        <h3>Silahkan melakukan Pembayaran</h3>
        <div class="alert alert-info">Total tagihan Rp. <strong><?php echo number_format($data['total_pembelian']); ?></strong></div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Penyetor</label>
                <input type="text" class="form-control" name="nama">
            </div>
            <div class="form-group">
                <label>Bank</label>
                <input type="text" class="form-control" name="bank">
            </div>
            <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" >
            </div>
            <div class="form-group">
                <label>Foto bukti</label>
                <input type="file" class="form-control" name="bukti">
                <p class="text-primary">Kirim bukti disini</p>
            </div>
            <button class="btn btn-primary" name="kirim">Kirim</button>
        </form>
        

    </div>

<!-- KODE PHP -->
 <?php
    if(isset($_POST['kirim'])){
        $nama = $_POST['nama'];
        $bank = $_POST['bank'];
        $jumlah = $_POST['jumlah'];
        $tanggal = date("Y-m-d");

        $berkas =$_FILES['bukti']['name'];
        $lokasi = $_FILES['bukti']['tmp_name'];
       
        $direktori = "../bukti_pembayaran/";
        move_uploaded_file($lokasi, $direktori.$berkas);

        $kirimbukti = mysqli_query($connect, "INSERT INTO pembayaran VALUES ('', '$id_pembelian', '$nama', '$bank', '$jumlah', '$tanggal', '$berkas')");

        // UPDATE STATUS
        $status = mysqli_query($connect, "UPDATE pembelian SET status_pembayaran='Sudah bayar' WHERE id_pembelian= '$id_pembelian'");

        echo "<script>alert('Terima Kasih sudah Mengirimkan bukti pembayaran')</script>";
        echo "<script>location='riwayat.php';</script>";
    }
 ?>




    
</div>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>