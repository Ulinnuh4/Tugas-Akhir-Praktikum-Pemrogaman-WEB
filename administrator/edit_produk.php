<?php
    include "koneksi.php";
    $id = $_GET["id"];
    //mengambil data untuk ditampilkan pada form
    $query = mysqli_query($connect, "SELECT * FROM produk WHERE id_produk= '$id'");

    if(isset($_POST['submit'])){
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
        mysqli_query($connect, "UPDATE produk SET nama_produk='$nama',harga_produk='$harga', berat='$berat',  foto_produk='$berkas', deskripsi_produk='$deskripsi' WHERE id_produk= '$id'");
        echo "<script>alert('Data berhasil diubah')</script>";
        echo "<script>location='dashboard.php?halaman=produk'</script>";
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

</head>
<body>
<?php
while($data = mysqli_fetch_assoc($query)){
?>
<div class="kontainer-1 p-3">
<h2 class="mb-5">Edit <span>Produk</span></h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Id Produk</label>
        <input type="text" class="form-control" name="id" value="<?=$data['id_produk'];?>">
    </div>
    <div class="form-group">
        <label for="">Nama</label>
        <input type="text" class="form-control" name="nama" value="<?=$data['nama_produk'];?>">
    </div>
    <div class="form-group">
        <label for="">Harga (Rp)</label>
        <input type="number" class="form-control" name="harga" value="<?=$data['harga_produk'];?>">
    </div>
    <div class="form-group">
        <label for="">Berat (Gr)</label>
        <input type="text" class="form-control" name="berat" value="<?=$data['berat'];?>">
    </div>
    <div class="form-group">
        <label for="">Deskripsi</label>
        <textarea name="deskripsi" id="" rows="10" class="form-control"><?php echo $data['deskripsi_produk'];?></textarea>
    </div>
    <div class="form-group">
        <label for="">Stok</label>
        <input type="text" class="form-control" name="berat" value="<?=$data['stok_produk'];?>">
    </div>
    <div class="form-group">
        <img src="foto_produk/<?=$data['foto_produk'];?>" width="200" class="mb-2"><br>
        <?php echo $data['foto_produk'];?>
    </div>
    <div class="form-group">
        <label for="">Ganti Foto</label>
        <input type="file" class="form-control" name="foto" >
    </div>
    <button class="btn btn-primary" name="submit" onclick="">Simpan</button>
</form>
<?php }?>
</div>
</body>
</html>

 