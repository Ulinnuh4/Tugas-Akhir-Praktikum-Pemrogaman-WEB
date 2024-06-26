<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lets Shopping</title>
    <link rel="stylesheet" href="../kumpulan_css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body class="boy">
    <div class="full-kontainer container">
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg " data-aos="fade-down" data-aos-duration="1000" >
      
      <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="../assets/logo.png" width="40"><strong>ManWear</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 " >
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#produk">Produk</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#tentang">Tentang Kami</a>
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
            <?php if(isset($_SESSION["pelanggan"])):?>
                <a href="./logout-user.php" class="logout">Logout</a>
           <?php else: ?>
              <a href="../user/halaman-login-user.php" class="sign-in">Login</a>
              <a href="../user/halaman-daftar-user.php" class="sign-up">Daftar</a>
            <?php endif ?>
          </div>
          </div>
        </div>
     
     
  </nav>
    <!-- navbar -->

    <!-- Kontainer-1 -->
    <div id="carouselExampleCaptions" class="carousel slide mx-lg-5 kontainer-carosel" data-bs-interval="2000" data-bs-ride="carousel"  data-aos="fade-in" data-aos-duration="2000">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="../assets/baba.jpg" class="d-block " alt="...">
          <div class="carousel-caption d-none d-md-block">
          <h5>Sweater Black</h5>
          <p>Tampil stylish disetiap hari</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="../assets/bibi.jpg" class="d-block " alt="...">
          <div class="carousel-caption d-none d-md-block">
          <h5>Hoodie Black Jaws</h5>
          <p>Bikin Jalan-jalan anti mainstream</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="../assets/bebe.jpg" class="d-block" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Kaos Polos</h5>
            <p>Yang murah belum tentu bikin gerah</p>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- Kontainer-1 -->

     <!-- PRODUK TERBARU -->
    <div class="produk-terbaru mx-lg-5" id="produk">
      <h1 class="pt-5 pb-4">Produk <span>Terbaru</span></h1>
      <div class="row" data-aos="fade-in" data-aos-duration="1000">
        <?php 
          include "../koneksi.php";
          $query = mysqli_query($connect, "SELECT * FROM produk ");
          while($data = mysqli_fetch_assoc($query)){
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-2">
          <div class="kartu mb-2">
            <a href="detail.php?id=<?php echo $data['id_produk'];?>">
              <div class="gambar-produk">
                <img src="../administrator/foto_produk/<?=$data['foto_produk'];?>" alt="" class="produk py-3 mb-3">
              </div>
            </a>
            <div class="deskripsi-produk px-4 py-2">
              <h3><?=$data['nama_produk'];?></h3>
              <h6 class="pb-3">Rp.<?=$data['harga_produk'];?></h6>
              <p>Stok : <?=$data['stok_produk'];?></p>
              <a href="beli.php?id=<?php echo $data['id_produk'];?>" class="pesan"><i class="bi bi-cart-plus"></i></a>
            </div>
          </div>
        </div>
        <?php }?>
      </div>
    </div>
     <!-- PRODUK TERBARU -->

    <!-- ABOUT US -->
     <div class="kontainer-about mx-lg-5 mb-5 " id="tentang">
     <h1 class="pt-5 pb-4">Tentang <span>Kami</span></h1>
        <div class="row">
          <div class="col-lg-4 col-6">
           <div class="kartu-about" data-aos="fade-in" data-aos-duration="1000">
            <div class="gambar-about" style="display: flex; justify-content: center;">
              <img src="../assets/faizal.jpg" alt="" class="profil my-4" style="border-radius: 50%;" >
            </div>
            <div class="deskripsi-about text-center py-4">
              <h3>Faizal Dwi Saputra</h3>
              <p>L200220257</p>
              <p>"hoahoahoahoahoa"</p>
            </div>
           </div>
          </div>

          <div class="col-lg-4 col-6">
           <div class="kartu-about" data-aos="fade-in" data-aos-duration="1000">
            <div class="gambar-about" style="display: flex; justify-content: center;">
              <img src="../assets/faizal.jpg" alt="" class="profil my-4" style="border-radius: 50%;" >
            </div>
            <div class="deskripsi-about text-center py-4">
              <h3>Faizal Dwi Saputra</h3>
              <p>L200220261</p>
              <p>"hoahoahoahoahoa"</p>
            </div>
           </div>
          </div>

          <div class="col-lg-4 col-6">
           <div class="kartu-about" data-aos="fade-in" data-aos-duration="1000">
            <div class="gambar-about" style="display: flex; justify-content: center;">
              <img src="../assets/faizal.jpg" alt="" class="profil my-4" style="border-radius: 50%;" >
            </div>
            <div class="deskripsi-about text-center py-4">
              <h3>Faizal Dwi Saputra</h3>
              <p>L200220265</p>
              <p>"hoahoahoahoahoa"</p>
            </div>
           </div>
          </div>

          
        </div>
     </div>

    <!-- FOOTER -->
    <footer class="bg-secondary my-3 mx-lg-5">
      <p class="text-center">Copyright &copy; <strong>ManWear</strong></p>
    </footer>
</div>

    </div>    
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>