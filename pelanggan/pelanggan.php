<h2 class="h2"><b>Data Pelanggan</b></h2>
<a href="<?= ($_SESSION['role'] == 'admin') ? 'admin.php' : 'staff.php' ?>?page=addPelanggan" class="btn-xs btn-biru ml-2">Tambah</a>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>No. Meter</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No. Telp</th>
            <th>Daya</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $sql = mysqli_query($conn, "SELECT * FROM meter INNER JOIN tarif ON meter.id_tarif=tarif.id_tarif");
        while ($row = mysqli_fetch_assoc($sql)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['no_meter'] ?></td>
            <td><?php echo $row['pemilik'] ?></td>
            <td><?php echo $row['alamat'] ?></td>
            <td><?php echo $row['telp'] ?></td>
            <td><?php echo $row['daya'] ?></td>
            <td><a href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin.php?page=editPelanggan&id='.$row['id_meter'] : 'staff.php?page=editPelanggan&id='.$row['id_meter'] ?>" class="btn-xs btn-kuning">Edit</a>
                <a href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin.php?page=deletePelanggan&id='.$row['id_meter'] : 'staff.php?page=deletePelanggan&id='.$row['id_meter'] ?>" class="btn-xs btn-merah">Hapus</a>
            </tr>
<?php } ?>
</tbody>
</table>