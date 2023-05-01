<h2 style="display:inline-flex;">Pembayaran</h2>
<form action="" method="POST">
    <input type="text" class="form-input mt-2" name="meter" placeholder="Nomor Meter" style="height: 40px; font-size: 20px; display: inline-block" autofocus list="input" autocomplete="off" onchange="submit()">
    <datalist id="input">
        <?php
        $query = mysqli_query($conn, "SELECT * FROM meter");
        while ($row = mysqli_fetch_assoc($query)) {
        ?>
            <option value="<?php echo $row['no_meter'] ?>"><?php echo $row['pemilik'] ?></option>
        <?php } ?>
    </datalist>
    <a href="admin.php?page=history" class="btn-xs btn-hijau" style="margin-left: 200px;">History</a>
</form>

<table class="mt-5">
    <tr>
        <th>No. Meter</th>
        <th>Nama</th>
        <th>Penggunaan</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>Status</th>
        <th>Opsi</th>
    </tr>
    <?php
    if (isset($_POST['meter'])) {
        $query = mysqli_query($conn, "SELECT * FROM meter INNER JOIN tarif ON meter.id_tarif=tarif.id_tarif WHERE no_meter ='$_POST[meter]'");
        if (mysqli_num_rows($query) == 0) { ?>
            <script>
                window.alert('Nomor Meter Tidak Ada')
                window.location = 'admin.php?page=pelanggan'
            </script>;
        <?php }
        $meter = $_POST['meter'];
        $query = mysqli_query($conn, "SELECT * FROM tagihan INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan INNER JOIN meter ON meter.no_meter = penggunaan.no_meter WHERE meter.no_meter = '$meter' AND status!='1'");

        while ($row = mysqli_fetch_assoc($query)) {
            // var_dump($row);
            // die;
            $status = $row['status'];
            if ($status == 1) {
                $status = 'Sudah Bayar';
            } else {
                $status = 'Belum Bayar';
                $button = "<a href='admin.php?page=bayar&id=$row[id_tagihan]' class='btn-xs btn-biru'>Bayar</a>";
            } ?>
            <tr>
                <td><?php echo $row['no_meter'] ?></td>
                <td><?php echo $row['pemilik'] ?></td>
                <td><?php echo $row['jumlah_meter'] ?>KWH</td>
                <td><?php echo 'bulan'($row['bulan']) ?></td>
                <td><?php echo $row['tahun'] ?></td>
                <td><?php echo $status; ?></td>
                <td><?php echo $button; ?></td>
            </tr>
    <?php
        }
    } ?>
</table>