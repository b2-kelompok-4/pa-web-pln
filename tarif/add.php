<h2>Tambah Tarif</h2>
<form action="" method="POST">
    <label for="daya">Daya</label>
    <input type="text" name="daya" class="form-input" id="daya">
    <label for="kwh">Tarif per-KWH</label>
    <input type="text" name="kwh" class="form-input" id="kwh">
    <button type="submit" name="tambah" id="tambah" class="btn-xs btn-biru mt-2">Tambah</button>
</form>

<?php
if (isset($_POST['tambah'])) {
    $daya = htmlspecialchars($_POST['daya']);
    $kwh = htmlspecialchars($_POST['kwh']);
    mysqli_query($conn, "ALTER TABLE tarif AUTO_INCREMENT = 1");
    mysqli_query($conn, "INSERT INTO tarif VALUES (null,'$daya', '$kwh',0)");
?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        // Tampilkan Sweet Alert
        Swal.fire({
            title: 'Data Tarif Baru Berhasil Ditambahkan!',
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