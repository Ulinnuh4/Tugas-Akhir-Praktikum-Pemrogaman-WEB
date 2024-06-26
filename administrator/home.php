<?php
include "koneksi.php";
// PRODUK
$query = mysqli_query($connect, "SELECT * FROM produk ");
$tampilkan = mysqli_num_rows($query);

// PELANGGAN
$query1 = mysqli_query($connect, "SELECT * FROM pelanggan ");
$tampilkan1 = mysqli_num_rows($query1);

// PEMBELIAN
$query2 = mysqli_query($connect, "SELECT * FROM pembelian ");
$tampilkan2 = mysqli_num_rows($query2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home admin</title>
    <link rel="stylesheet" href="../kumpulan_css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
   </head>
<body>
    <div class="kontainer-1 container-fluid p-4">
       <div class="row">
        <div class="col-lg-4 produk text-center">
            <div class="kartu ">
                <h1><i class="bi bi-archive mx-3"></i>Data <span>Produk</span></h1>
                <h3><?php echo $tampilkan;?></h3>
            </div>
        </div>
        <div class="col-lg-4 pelanggan text-center">
            <div class="kartu">
                <h1><i class="bi bi-person-check mx-3"></i>Data <span>Pelanggan</span></h1>
                <h3><?php echo $tampilkan1;?></h3>
            </div>
        </div>
        <div class="col-lg-4  pembelian text-center">
            <div class="kartu">
                <h1><i class="bi bi-currency-dollar mx-3"></i>Data <span>Pembelian</span></h1>
                <h3><?php echo $tampilkan2;?></h3>
            </div>
        </div>
        
       </div>
    </div>
</body>
</html>
