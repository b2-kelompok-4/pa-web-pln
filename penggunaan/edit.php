<?php
    $id = $_GET['id'];
    $meter = $_GET['meter'];
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
    $mawal = $_GET['mawal'];
    $makhir = $_GET['makhir'];
?>
<h2>Edit Penggunaan</h2>
<form action="" method="POST">
    <label for="id">No. Meter</label>
    <input type="text" name="id" class="form-input" id="id" value="<?php echo $meter ?>" readonly>
    <label for="bulan">Bulan</label>
    <input type="text" name="bulan" class="form-input" id="bulan" value="<?php echo bulan($bulan) ?>" readonly>
    <label for="tahun">Tahun</label>
    <input type="text" name="tahun" class="form-input" id="tahun" value="<?php echo $tahun ?>" readonly>
    <label for="mawal">Meter Awal</label>
    <input type="text" name="mawal" class="form-input" id="mawal" value="<?php echo $mawal ?>" readonly>
    <label for="makhir">Meter Akhir</label>
    <input type="text" name="makhir" class="form-input" id="makhir" value="<?php echo $makhir ?>" autofocus>
    <button type="submit" class="btn btn-biru mt-2" style="display: inline-flex;" name="simpan">Simpan</button>
    <button type="reset" class="btn btn-merah mt-2">Reset</button>
</form>
<?php
    if (isset($_POST['simpan'])) {
        $m_akhir = $_POST['makhir'];
        $sql = mysqli_query($conn, "UPDATE penggunaan SET meter_akhir='$m_akhir' WHERE id_penggunaan='$id'");
        if ($sql) { ?>
            <script>
                window.alert('Meter Akhir Berhasil diubah');
                window.location = '<?php echo ($_SESSION['role'] == 'admin') ? 'admin.php?page=penggunaan' : 'staff.php?page=penggunaan' ?>';
            </script>
        <?php } else {
            echo 'gagal';
        }
    }
?>