<?php
include "koneksi.php";
$id = $_GET['id'];
$ambil = mysqli_query($connect, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$id'");
$detail = $ambil -> fetch_assoc();

?>
<head>

<style>
    h2{
        font-size: 42px;
        font-weight: 600;
    }
    h2 span{
        color: aqua;
    }
    .data{
        background-color: #0e2238;
        padding: 20px 20px;
        margin-bottom: 20px;
        border-radius: 20px;
        color: #fff;
    }
    .data span{
        color: aqua;
    }
    strong{
        color: aqua;
    }
</style>
</head>

<div class="kontainer-1 p-3">
<h2 class="mb-4">Detail <span>Pemesanan</span></h2>
<div class="row gap-2">
<div class="col-md-4 data">
    <h1>Data <span>Pelanggan</span></h1>
    Nama       : <strong> <?php echo $detail['nama_pelanggan'];?> <br> </strong>
    Telepon    : <strong> <?php echo $detail['telepon_pelanggan'];?> <br> </strong>
    Email      : <strong> <?php echo $detail['email_pelanggan'];?> <br> </strong>
    Tanggal    : <strong> <?php echo $detail['tanggal_pembelian'];?> <br> </strong> 
</div>
<div class="col-md-4 data">
    <h1>Data <span>Pembelian</span></h1>
    Total      : <strong> <?php echo $detail['total_pembelian'];?> <br> </strong>
    Nama Kota  : <strong> <?php echo $detail['kota'];?> <br> </strong>
    Tarif      : <strong> <?php echo $detail['tarif'];?> <br> </strong> 
    Alamat     : <strong> <?php echo $detail['alamat'];?> <br> </strong>
</div>
</div>
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
            $query = mysqli_query($connect, "SELECT * FROM  pembelian_produk JOIN produk ON pembelian_produk.id_produk = produk.id_produk WHERE pembelian_produk.id_pembelian= '$id'");
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
</div>
