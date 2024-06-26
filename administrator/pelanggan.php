<style>
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
</style>
<div class="kontainer-1 p-3">
<h2 class="mb-4">Data <span>Pelanggan</span></h2>
<?php
include "koneksi.php";
$query = mysqli_query($connect, "SELECT * FROM pelanggan");
?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($data = mysqli_fetch_array($query)){
        $nomor = 1;
        ?>
        <tr>
            <td><?php echo $nomor++?></td>
            <td><?php echo $data['nama_pelanggan'];?></td>
            <td><?php echo $data['email_pelanggan'];?></td>
            <td><?php echo $data['telepon_pelanggan'];?></td>
            <td><a href="hapus_pelanggan.php?id=<?php echo $data['id_pelanggan'];?>" class="hapus" onclick="return confirm('Yakin ingin menghapus ?');">Hapus</a>
            </td>
        </tr>
    </tbody>
    <?php } ?>
</table>
</div>