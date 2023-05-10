<h2 class="h2"><b>Data Tarif</b></h2>
<a href="<?= ($_SESSION['role'] == 'admin') ? 'admin.php' : 'staff.php' ?>?page=addTarif" class="btn-xs btn-biru ml-2">Tambah</a>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Daya</th>
            <th>Tarif per-KWH</th>
            <th>Opsi</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $sql = mysqli_query($conn, "SELECT * FROM tarif");
        while ($row = mysqli_fetch_assoc($sql)) {
            $status = $row['status'];
            if ($status == 1) {
                $status = '<a class="blue">ACTIVE</a>';
            } else {
                $status = '<a class="red">NOT ACTIVE</a>';
            }
        ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row['daya'] ?> VA</td>
                <td>Rp. <?php echo number_format($row['tarif_kwh']) ?></td>
                <td><a href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin.php?page=editTarif&id=' . $row['id_tarif'] : 'staff.php?page=editTarif&id=' . $row['id_tarif'] ?>" class="btn-xs btn-kuning">Edit</a>
                    <a href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin.php?page=deleteTarif&id=' . $row['id_tarif'] : 'staff.php?page=deleteTarif&id=' . $row['id_tarif'] ?>" class="btn-xs btn-merah delete-link" data-id="<?php echo $row['id_tarif']; ?>">Hapus</a>
                <td>
                    <?php echo $status ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<script>
    // Add a click event listener to the delete buttons
    document.querySelectorAll('.delete-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior

            // Get the data-id attribute value from the link
            const id = this.getAttribute('data-id');

            // Show the confirmation dialog using SweetAlert
            Swal.fire({
                title: 'Are you sure?',
                text: 'Apakah Anda Yakin Untuk Menghapus Data Tarif Ini!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                // If the user confirms the deletion, redirect to the delete page
                if (result.isConfirmed) {
                    Swal.fire({
                        timer: 3000, // Set the timer for 3 seconds
                        timerProgressBar: true, // Show a progress bar for the timer
                        title: 'Deleted!',
                        text: 'Tarif Berhasil Di Hapus.',
                        icon: 'success'
                    });
                    setTimeout(() => {
                        window.location.href = this.getAttribute('href');
                    }, 3000);
                }
            });
        });
    });
</script>