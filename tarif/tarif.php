<h2 class="h2"><b>Data Tarif</b></h2>
<a href="admin.php?page=addTarif" class="btn-xs btn-biru ml-2"">Tambah</a>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Daya</th>
            <th>Tarif per-KWH</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $no = 1;
            $sql = mysqli_query($conn, "SELECT * FROM tarif");
            while($row = mysqli_fetch_assoc($sql)){
        ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $row['daya'] ?> VA</td>
            <td>Rp. <?php echo number_format($row['tarif_kwh']) ?></td>
            <td><a href="admin.php?page=editTarif&id=<?php echo $row['id_tarif'] ?>" class="btn-xs btn-kuning">Edit</a>
                <a href="admin.php?page=deleteTarif&id=<?php echo $row['id_tarif'] ?>" class="btn-xs btn-merah">Hapus</a></td>
        </tr>
            <?php } ?>
    </tbody>
</table>