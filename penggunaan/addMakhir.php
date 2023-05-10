<?php
$meter = $_GET['meter'];
?>
<h2>Input Meter Akhir</h2>
<form action="" method="POST">
    <?php if (isset($_GET['meter'])) {
        $pgn = mysqli_fetch_assoc(select_akhir_meter($_GET['meter']));
        $mter = $_GET['meter'];
        $bulan = bulan($pgn['bulan'] + 1);
        $bln = $pgn['bulan'] + 1;
        $tahun = $pgn['tahun'];
        if ($bln >= 13) {
            $bln = 1;
            $tahun = $pgn['tahun'] + 1;
        }
        $awal = $pgn['meter_akhir'];
        $tag = 'readonly';
        $tagthn = 'readonly';
        if (cek_penggunaan($_GET['meter'])) {
            $mter = $_GET['meter'];
            $bulan = bulan(1);
            $tahun = '2018';
            $awal = '';
            $bln = 1;
            $tag = 'required';
        }
    }
    ?>
    <label for="id">No. Meter</label>
    <input type="text" name="meter" class="form-input" id="id" value="<?php echo $mter ?>" readonly>
    <label for="bulan">Bulan</label>
    <?php if (cek_penggunaan($_GET['meter'])) { ?>
        <select name="bulan" class="inputext">
            <?php $i = 1;
            while ($i <= 12) {
                if ($bln == $i) $ini = 'selected';
                else $ini = '';
            ?>
                <option value="<?= $i ?>" <?= $ini ?>><?= bulan($i); ?></option>
            <?php $i++;
            } ?>
        </select>
    <?php } else { ?>
        <select name="bulan" class="form-input" disabled>
            <?php $i = 1;
            while ($i <= 12) {
                if ($bln == $i) $ini = 'selected';
                else $ini = ''; ?>
                <!-- <option value="<?= $i ?>" <?= $ini ?>><?= bulan($i); ?></option> -->
            <?php $i++;
            } ?>
            <option value="<?= $i ?>"><?php echo $bulan; ?></option>
        </select>
        <input type="hidden" name="" class="inputext" value="<?= $bulan ?>" readonly>
        <input type="hidden" name="bulan" class="inputext" value="<?= $bln ?>">
    <?php } ?>
    <label for="tahun">Tahun</label>
    <input type="text" name="tahun" class="form-input" id="tahun" value="<?php echo $tahun ?>" readonly>
    <label for="mawal">Meter Awal</label>
    <input type="text" name="mawal" class="form-input" id="mawal" value="<?php echo $awal ?>" readonly>
    <label for="makhir">Meter Akhir</label>
    <input type="number" name="makhir" class="form-input" id="makhir" autofocus required min="<?php echo $awal ?>">
    <button type="submit" class="btn btn-biru mt-2" style="display: inline-flex;" name="simpan">Simpan</button>
    <button type="reset" class="btn btn-merah mt-2">Reset</button>
</form>
<?php
if (isset($_POST['simpan'])) {
    $meter = $_POST['meter'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $mawal = $_POST['mawal'];
    $makhir = $_POST['makhir'];
    mysqli_query($conn, "ALTER TABLE penggunaan AUTO_INCREMENT = 1");
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