<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM tarif WHERE id_tarif='$id'");
while ($row = mysqli_fetch_assoc($sql)) {
?>
    <form action="" method="POST" id="edit-form">
        <label for="daya">Daya</label>
        <input type="text" name="daya" class="form-input" id="daya" value="<?php echo $row['daya'] ?>">
        <label for="kwh">Tarif per-KWH</label>
        <input type="text" name="kwh" class="form-input" id="kwh" value="<?php echo $row['tarif_kwh'] ?>">
        <button type="submit" name="edit" id="edit" class="btn-xs btn-hijau mt-2">Simpan</button>
    </form>
<?php
}
if (isset($_POST['edit'])) {
    $daya = $_POST['daya'];
    $kwh = $_POST['kwh'];
    mysqli_query($conn, "UPDATE tarif SET daya='$daya', tarif_kwh='$kwh' WHERE id_tarif='$id'");
?>
    <script>
        // Tampilkan Sweet Alert
        Swal.fire({
            title: 'Data Tarif Baru Berhasil Disimpan!',
            icon: 'success',
            confirmButtonText: 'OK',
            timer: 2000, // Set the timer for 2 seconds
            timerProgressBar: true, // Show a progress bar for the timer
        }).then((result) => {

            // Redirect to the appropriate page after the Sweet Alert is closed
            window.location.href = "<?php echo ($_SESSION['role'] == 'admin' ? 'admin.php?page=tarif' : 'staff.php?page=tarif') ?>";
        });
    </script>
<?php
}
?>