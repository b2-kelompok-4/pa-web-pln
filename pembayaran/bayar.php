<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tagihan INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan INNER JOIN meter ON meter.no_meter = penggunaan.no_meter INNER JOIN tarif ON tarif.id_tarif = meter.id_tarif WHERE tagihan.id_tagihan = '$id'");
$row = mysqli_fetch_assoc($query);
$tarif = $row['tarif_kwh'];
$penggunaan = $row['jumlah_meter'];
$tagihan = $tarif * $penggunaan;
$total = $tagihan + 2000;
?>
<h2>Bayar Tagihan</h2>
<h4 class="mt-2">Nomor Meter <?php echo $row['no_meter'] ?></h4>
<form action="" method="POST" style="display: inline">
    <label for="penggunaan">Penggunaan</label>
    <input type="text" id="penggunaan" class="form-input" readonly value="<?php echo $penggunaan ?> KWH">
    <label for="tagihan">Tagihan (Rp.)</label>
    <input type="text" id="tagihan" class="form-input" readonly value="<?php echo $tagihan ?>">
    <label for="biaya">Biaya Admin (Rp.)</label>
    <input type="text" id="biaya" class="form-input" readonly value="<?php echo 2000 ?>" name="biaya">
    <label for="total">Total (Rp.)</label>
    <input type="text" id="total" class="form-input" readonly value="<?php echo $total ?>" name="total">
    <button type="submit" name="btn_bayar" class="btn btn-biru mt-2">
        <b><?php echo ($_SESSION['role'] == 'user') ? 'Bayar' : 'Kirim' ?></b>
    </button>

</form>
<button type="submit" name="btn_kembali" class="btn btn-merah mt-2" onclick="window.location.href ='<?php echo ($_SESSION['role'] == 'user') ? 'user.php' : 'user.php' ?>'"><b>Kembali</b></button>


<?php
if (isset($_POST['btn_bayar'])) {
    $biaya = $_POST['biaya'];
    $total = $_POST['total'];
    $tanggal = date('Y-m-d');
    mysqli_query($conn, "ALTER TABLE pembayaran AUTO_INCREMENT = 1");
    mysqli_query($conn, "INSERT INTO pembayaran VALUES(null, 1, '$id', '$tanggal', '$biaya', '$total')");
    echo "<script>window.open('pembayaran/print.php?byr=$id', '_blank');</script>";
    exit();
}
?>