<?php
$id_login = $_SESSION['id_login'];

$cek_telah_daftar = mysqli_query($conn, "SELECT * FROM meter WHERE id_login = '$id_login'");

if (mysqli_num_rows($cek_telah_daftar) > 0) {
    $query = mysqli_query($conn, "SELECT meter.no_meter, meter.pemilik, meter.alamat, tarif.daya FROM tarif INNER JOIN meter ON tarif.id_tarif=meter.id_tarif WHERE meter.id_login='$id_login'");
    $result = mysqli_fetch_assoc($query);
    if ($result['no_meter'] == null) {
        $result['no_meter'] = "Tunggu Beberapa Saat Untuk Mendapatkan Nomor Meter Anda";
    }
    echo "<h1 align='center'>ANDA TELAH TERDAFTAR PADA LAYANAN PLN KAMI </h1>";
    echo "<br>";
    echo
    "<table style='width: 100%;'>
        <tr>
            <td>&nbsp;</td>
            <td align='left'>Nomor Meter</td>
            <td><b>:</b></td>
            <td> $result[no_meter]</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
            <td align='left'>Nama</td>
            <td><b>:</b></td>
            <td>$result[pemilik]</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
            <td align='left'>Alamat</td>
            <td><b>:</b></td>
            <td>$result[alamat]</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
        <td>&nbsp;</td>
            <td align='left'>Daya</td>
            <td><b>:</b></td>
            <td>$result[daya] VA</td>
            <td>&nbsp;</td>
        </tr>
    </table>";
    die;
}
?>


<h2>FORM PERMOHONAN PENDAFTARAN PLN</h2>
<form action="" method="POST">
    <label for="nama">Nama</label>
    <input type="text" name="nama" class="form-input" id="nama">
    <label for="alamat">Alamat</label>
    <input type="text" name="alamat" class="form-input" id="alamat">
    <label for="telp">No. Telepon</label>
    <input type="text" name="telp" class="form-input" id="telp">
    <label for="tarif">Tarif</label>
    <select name="tarif" id="tarif" class="form-input">
        <?php $sql = mysqli_query($conn, "SELECT * FROM tarif");
        while ($row = mysqli_fetch_assoc($sql)) { ?>
            <option value="<?php echo $row['id_tarif'] ?>"><?php echo $row['daya'] ?></option>
        <?php } ?>
    </select>
    <button type="submit" name="tambah" class="btn-xs btn-biru mt-2">Submit</button>
</form>
<?php
if (isset($_POST['tambah'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $telp = htmlspecialchars($_POST['telp']);
    $tarif = htmlspecialchars($_POST['tarif']);

    mysqli_query($conn, "ALTER TABLE meter AUTO_INCREMENT = 1");
    $add = mysqli_query($conn, "INSERT INTO meter VALUES (NULL, NULL, '$nama', '$alamat', '$telp', '$tarif','$id_login',0)");
    if ($add) { ?>
        <script>
            window.alert('Berhasil Silahkan Tunggu Petugas Penyambungan PLN Datang Ke Tempat Anda!')
            window.location.href = 'user.php?page=daftar';
        </script>;
<?php }
}
?>