<h1>Cek Tagihan</h1>
<p class="mt-2">Masukkan Nomor Meter untuk melihat Tagihan</p>
<form action="" method="POST">
    <input type="text" class="form-input mt-2" name="meter" placeholder="Nomor Meter" style="height: 40px; font-size: 20px; display: inline-block" autofocus autocomplete="off">
    <button type="submit" name="btn_cari" class="btn btn-hijau" style="margin-left: 40px; width:100px; height: 30px">Cari</button>
</form>
<?php
if (isset($_POST['meter'])) {
    $query = mysqli_query($conn, "SELECT * FROM meter INNER JOIN tarif ON meter.id_tarif=tarif.id_tarif WHERE no_meter ='$_POST[meter]'");
    if (mysqli_num_rows($query) == 0) { ?>
        <script>
            window.alert('Nomor Meter Tidak Ada')
            window.location = 'index.php?page=tagihan'
        </script>;
    <?php }
}
if (isset($_POST['btn_cari'])) {
    $id = $_POST['meter'];
    $sql = mysqli_query($conn, "SELECT * FROM tarif INNER JOIN meter ON tarif.id_tarif=meter.id_tarif WHERE no_meter='$id'");
    $result = mysqli_fetch_assoc($sql);
    echo '</br>';
    echo
    "<table style='width: 100%;'>
            <tr>
                <td>&nbsp;</td>
                <td align='left'>Nomor Meter</td>
                <td><b>:</b></td>
                <td>$result[no_meter]</td>
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
    ?>
    <br>
    <h1 align='center'>Detail Tagihan</h1>
    <table class="mt-2">
        <tr>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Penggunaan</th>
            <th>Total Bayar</th>
            <th>Status</th>
            <!-- <th>Opsi</th> -->
        </tr>
        <?php
        $query = mysqli_query($conn, "SELECT * FROM tagihan INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan INNER JOIN meter ON meter.no_meter = penggunaan.no_meter INNER JOIN tarif ON meter.id_tarif=tarif.id_tarif WHERE meter.no_meter = '$id'");
        while ($row = mysqli_fetch_assoc($query)) {
            $tarif = $row['tarif_kwh'];
            $penggunaan = $row['jumlah_meter'];
            $tagihan = $tarif * $penggunaan;
            $total = $tagihan + 2000;
            $tagihan = $row['id_tagihan'];
            $status = $row['status'];
            if ($status == 1) {
                $status = "<a class='blue'>Sudah Bayar</a>";
                $button = "<a class='btn-xs btn-hijau' href='pembayaran/print.php?byr=$tagihan' target='_blank'>Print</a>";
            } else {
                $status = "<a class='red'>Belum Bayar</a>";
                $button = '---';
            }
        ?>
            <tr>
                <td><?php echo bulan($row['bulan']) ?></td>
                <td><?php echo $row['tahun'] ?></td>
                <td><?php echo $row['jumlah_meter'] ?>KWH</td>
                <td>Rp. <?php echo number_format($total) ?></td>
                <td><?php echo $status; ?></td>
                <!-- <td> -->
                <?php //echo $button; 
                ?>
                <!-- </td> -->
            </tr>
    <?php }
    }
    ?>
    </table>