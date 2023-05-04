<?php
$meter = $_GET['meter'];
?>
<h2>Input Penggunaan</h2>
<form action="" method="POST">
    <label for="id">No. Meter</label>
    <input type="text" name="meter" class="form-input" id="id" value="<?php echo $meter ?>" readonly>
    <label for="bulan">Bulan</label>
    <input type="text" name="bulan" class="form-input" id="bulan" value="<?php echo bulan(date('m')) ?>" readonly>
    <label for="tahun">Tahun</label>
    <input type="text" name="tahun" class="form-input" id="tahun" value="<?php echo date('Y') ?>" readonly>
    <label for="mawal">Meter Awal</label>
    <input type="text" name="mawal" class="form-input" id="mawal" autofocus>
    <label for="makhir">Meter Akhir</label>
    <input type="text" name="makhir" class="form-input" id="makhir">
    <button type="submit" class="btn btn-biru mt-2" style="display: inline-flex;" name="simpan">Simpan</button>
    <button type="reset" class="btn btn-merah mt-2">Reset</button>
</form>
<?php
if (isset($_POST['simpan'])) {
    $meter = $_POST['meter'];
    $bulan = date('m');
    $tahun = $_POST['tahun'];
    $mawal = $_POST['mawal'];
    $makhir = $_POST['makhir'];
    $sql = mysqli_query($conn, "INSERT INTO penggunaan VALUES (null, '$meter', '$bulan', '$tahun', '$mawal', '$makhir')");
    if ($sql) { ?>
        <script>
            window.alert('Meter Akhir Berhasil ditambahkan');
            window.location = '<?php echo ($_SESSION['role'] == 'admin') ? 'admin.php?page=penggunaan' : 'staff.php?page=penggunaan' ?>';
        </script>
<?php } else {
        echo 'Gagal';
    }
}
?>