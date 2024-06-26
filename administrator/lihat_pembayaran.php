<?php
include "koneksi.php";
$id_pembelian = $_GET['id'];
$query =  mysqli_query($connect, "SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
$detail = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Pembayaran</title>
</head>
<body>
    <div class="kontainer-1 p-3">
        <div class="row">
            <div class="col-md-6">
            <h1>Informasi Pembayaran</h1>
                <table class="table">
                    <tr>
                        <th>Nama : </th>
                        <td><?php echo $detail['nama'];?></td>
                    </tr>
                    <tr>
                        <th>Bank : </th>
                        <td><?php echo $detail['bank'];?></td>
                    </tr>
                    <tr>
                        <th>Jumlah : </th>
                        <td>Rp. <?php echo number_format($detail['jumlah']);?></td>
                    </tr>
                    <tr>
                        <th>Tanggal : </th>
                        <td><?php echo $detail['tanggal'];?></td>
                    </tr>
                </table>
                <form action="" method="post" enctype="multipart/form-data">
                    <button name="konfirmasi" class="btn btn-primary">Konfirmasi</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Bukti Pembayaran</h2>
                <img src="../bukti_pembayaran/<?php echo $detail['bukti'];?>" alt="" width="500">
            </div>
        </div>
    </div>
    <?php
    if(isset($_POST['konfirmasi'])){
        $update = mysqli_query($connect, "UPDATE pembelian SET status_pembayaran='Proses' WHERE id_pembelian='$id_pembelian'");
        echo "<script>alert('Konfirmasi berhasil')</script>";
        echo "<script>location='dashboard.php?halaman=pembelian';</script>";
    }
    ?>
</body>
</html>
