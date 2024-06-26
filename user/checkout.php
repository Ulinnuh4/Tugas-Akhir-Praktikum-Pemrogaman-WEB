<?php
session_start();
include "../koneksi.php";
if(!isset($_SESSION['pelanggan'])){
  echo "<script>alert('Silahkan Login dahulu')</script>";
  echo "<script>location='halaman-login-user.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../kumpulan_css/check.out.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    </style>
  </head>
<body>

<div class="full-kontainer container">
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
     
    <div class="kontainer-1 p-3">
    <h2 class="mb-4">Keranjang <span></span></h2>
    <table class="table table-bordered"  data-aos="fade-in" data-aos-duration="2000">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>      
            </tr>
        </thead>
        <tbody>
          <?php 
           if (!isset($_SESSION['keranjang'])) {
            $_SESSION['keranjang'] = array();
          }
          $nomor=1;?>
          <?php $totalbelanja = 0;?>
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
            </tr>
            <?php $nomor++; ?>
            <?php $totalbelanja+=$subtotal;?>
            <?php endforeach ?>
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4">Total Belanja</th>
            <th class="col span-4">Rp. <?php echo number_format($totalbelanja);?></td>
          </tr>
        </tfoot>

    </table>
      <form action="" method="post" enctype="multipart/form-data">
        <h3>Informasi Pelanggan</h3>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
                <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan'];?>" class="form-control">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
                <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan'];?>" class="form-control">
            </div>
          </div>

          <div class="col-md-4">
            <select name="id_ongkir" id="" class="form-control">
                <option >Pilih Kota</option>
                <?php 
                  $query = mysqli_query($connect, "SELECT * FROM ongkir");
                  while ($data = mysqli_fetch_assoc($query)){
                ?>
                <option value="<?php echo $data['id_ongkir'];?>">
                    <?php echo $data['kota'];?> -
                    <?php echo $data['tarif'];?> 
                </option>
                <?php }?>
            </select>
        </div>
        </div>
        <div class="form-group my-4">
          <label class="mb-2">Alamat Lengkap Pengiriman</label>
          <textarea name="alamat" id="" placeholder="Masukkan alamat lengkap (Kode pos)" class="form-control"></textarea>
        </div>
        <button class="btn btn-primary mt-3" name="checkout">Checkout</button>

    </form>

    <?php 
      if(isset($_POST['checkout'])){
        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
        $id_ongkir = $_POST['id_ongkir'];
        $tanggal_pembelian = date("Y-m-d");
        $alamat = $_POST['alamat'];

          // MENGAMBIL TARIF ONGKIR DAN KOTA 
          $sql = mysqli_query($connect, "SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
          $tarif = mysqli_fetch_assoc($sql);

          $tarif_ongkir = $tarif['tarif'];
          $nama_kota = $tarif['kota'];
          // 
          $status = 'Belum Bayar';
          
          $total_pembelian = $totalbelanja + $tarif_ongkir;
          $tambah_pembelian = mysqli_query($connect, "INSERT INTO  pembelian VALUES ('','$id_pelanggan', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian','$nama_kota', '$tarif_ongkir', '$alamat', '$status' )");
          
          // id pembelian barusan terjadi
          $id_pembelian_barusan = $connect-> insert_id;

          foreach($_SESSION['keranjang'] as $id_produk => $jumlah){
            $connect->query("INSERT INTO pembelian_produk VALUES ('','$id_pembelian_barusan','$id_produk','$jumlah')");
          }

          // UPDATE STOK
          mysqli_query($connect, "UPDATE produk SET stok_produk = stok_produk -$jumlah WHERE id_produk = '$id_produk'");

          // Mengkosongkan keranjang
          unset($_SESSION['keranjang']);

          echo "<script>alert('Pembelian Sukses')</script>";
          echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";

          
        }
        
    ?>  

    </div>
    <!-- Kontainer-1 -->
         

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>