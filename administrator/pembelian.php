<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
 
<style>
    h2{
        font-size: 42px;
        font-weight: 600;
    }
    h2 span{
        color: aqua;
    }
    a{
        margin-right: 5px;
    }
</style>
</head>

<div class="kontainer-1 p-3">
<h2 class="mb-4">Data <span>Pembelian</span></h2>
<?php
include "koneksi.php";
$query = mysqli_query($connect, "SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan");
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Email Pelanggan</th>
            <th>Nama Pelanggan</th>
            <th>Tanggal</th>
            <th>Total</th>
            <th>Status</th>
            <th>aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php
        while ($data = mysqli_fetch_array($query)){
        ?>
        <tr>
            <td><?php echo $nomor++?></td>
            <td><?php echo $data['email_pelanggan'];?></td>
            <td><?php echo $data['nama_pelanggan'];?></td>
            <td><?php echo $data['tanggal_pembelian'];?></td>
            <td><?php echo $data['total_pembelian'];?></td>
            <td>
                <?php if($data['status_pembayaran']=='Belum Bayar'):?>
                   <p class="btn btn-warning"><?php echo $data['status_pembayaran'];?></p>
                <?php else: ?>
                    <p class="btn btn-success"><?php echo $data['status_pembayaran'];?></p>
                <?php endif ?>
            </td>
            <td><a href="dashboard.php?halaman=detail&id=<?php echo $data['id_pembelian'];?>" class="btn btn-secondary">Detail
                <?php if($data['status_pembayaran'] == 'Sudah bayar' OR $data['status_pembayaran'] == 'Proses'): ?>
                    <a href="dashboard.php?halaman=pembayaran&id=<?php echo $data['id_pembelian'];?>" class="btn btn-primary">Lihat Pembayaran</a>
                <?php endif ?>
               
                <a href="hapus-pembelian.php?&id=<?php echo $data['id_pembelian'];?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin menghapus pembelian ?');"><i class="bi bi-trash"></i>
            </a>
            </td>
        </tr>
    </tbody>
    <?php } ?>
</table>
</div>