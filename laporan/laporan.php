<h2 class="h2"><b>Data Staff</b></h2>
<a href="admin.php?page=addLaporan" class="btn-xs btn-biru ml-2"">Tambah</a>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Role</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $no = 1;
            $sql = mysqli_query($conn, "SELECT id_login, nama, role FROM login WHERE role='staff'");
            while($row = mysqli_fetch_assoc($sql)){
        ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $row['nama'] ?></td>
            <td><?php echo $row['role'] ?></td>
            <td><a href="admin.php?page=deleteLaporan&id=<?php echo $row['id_login'] ?>" class="btn-xs btn-merah">Hapus</a></td>
        </tr>
            <?php } ?>
    </tbody>
</table>
