<style>
    h2{
        font-size: 42px;
        font-weight: 600;
    }
    h2 span{
        color: aqua;
    }
    .form-group{
        margin-bottom: 20px;
    }
    label{
        font-weight: 600;
        font-size: 18px;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="kontainer-1 p-3">
<h2 class="mb-5">Tambah <span>Produk</span></h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Nama</label>
        <input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label for="">Harga (Rp)</label>
        <input type="number" class="form-control" name="harga">
    </div>
    <div class="form-group">
        <label for="">Berat (Gr)</label>
        <input type="text" class="form-control" name="berat">
    </div>
    <div class="form-group">
        <label for="">Deskripsi</label>
        <textarea name="deskripsi" id="" rows="10" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="">Stok</label>
        <input type="text" class="form-control" name="stok">
    </div>
    <div class="form-group">
        <label for="">Foto</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <button class="btn btn-primary" name="submit" onclick="">Simpan</button>
</form>
</div>
</body>
</html>
<?php
    include "koneksi.php";
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $berat = $_POST['berat'];
        $deskripsi = $_POST['deskripsi'];
        $stok = $_POST['stok'];
        $berkas =$_FILES['foto']['name'];
        $berkassementara =$_FILES['foto']['tmp_name'];
        // 
        $dirUpload = "foto_produk/";
        $foto_poduk = move_uploaded_file($berkassementara, $dirUpload.$berkas );
        //insert data ke dalam database
        $query = mysqli_query($connect, "INSERT INTO produk VALUES ('','$nama','$harga','$berat','$berkas','$deskripsi','$stok' )");
        echo "<script>alert('Data berhasil ditambahkan')</script>";
        echo "<meta http-equiv='refresh' content='1;url=dashboard.php?halaman=produk'>";
    }

?>

 