<style>
    .edit{
        background-color: #008efc;
        color: #fff;
        padding: 3px 20px;
        border-radius: 5px;
        transition: 0.2s ease-in-out;
    }
    .edit:hover{
        background-color: #00cafc;
    }
    .hapus{
        background-color:#cd0000;
        color: #fff;
        padding: 3px 20px;
        border-radius: 5px;
        transition: 0.2s ease-in-out;
    }
    .hapus:hover{
        background-color:#ff2f2f;
    }
    h2{
        font-size: 42px;
        font-weight: 600;
    }
    h2 span{
        color: aqua;
    }
    .tambah_produk{
        background-color: #008efc;
        color: #fff;
        padding: 3px 20px;
        transition: 0.2s ease-in-out;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    .tambah_produk:hover{
        background-color: #00cafc;
    }
    table{
        margin-top: 20px;
    }
</style>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<?php
include "koneksi.php";
$query = mysqli_query($connect, "SELECT * FROM produk");
?>
<div class="kontainer-1 p-3">
<h2 class="mb-4">Data <span>Produk</span></h2>
<a href="dashboard.php?halaman=tambahproduk" class="tambah_produk">Tambah Produk +</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Id Produk</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>berat</th>
            <th>Deskripsi</th>
            <th>foto</th>
            <th>Stok</th>
            <th>aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php
        while ($data = mysqli_fetch_array($query)){
        
        ?>
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $data['id_produk'];?></td>
            <td><?php echo $data['nama_produk'];?></td>
            <td><?php echo $data['harga_produk'];?></td>
            <td><?php echo $data['berat'];?></td>
            <td><?php echo $data['deskripsi_produk'];?></td>
            <td> <img src="foto_produk/<?php echo $data['foto_produk'];?>" width="100"></td>
            <td><?php echo $data['stok_produk'];?></td>
            <td><a href="dashboard.php?halaman=editproduk&id=<?php echo $data['id_produk'];?>" class="edit"><i class="bi bi-pencil-square"></i></a>
            <a href="hapus_produk.php?id=<?php echo $data['id_produk'];?>" class="hapus" onclick="return confirm('Apakah yakin ingin menghapus ?')"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
    </tbody>
    <?php } ?>
</table>
</div>