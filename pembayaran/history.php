<h2 align="center">History Pembayaran</h2>
<table class="mt-2">
    <tr>
        <th>No</th>
        <th>No. Meter</th>
        <th>Nama</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>Tanggal Bayar</th>
        <th>Opsi</th>
    </tr>
    <?php
        $no = 1;
        $sql = mysqli_query($conn, "SELECT * FROM pembayaran INNER JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan INNER JOIN meter ON meter.no_meter = penggunaan.no_meter");
        while($row = mysqli_fetch_assoc($sql)){
    ?>
    <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $row['no_meter'] ?></td>
        <td><?php echo $row['pemilik'] ?></td>
        <td><?php echo bulan($row['bulan']) ?></td>
        <td><?php echo $row['tahun'] ?></td>
        <td><?php echo $row['tanggal_bayar'] ?></td>
        <td><a href="pembayaran/print.php?byr=<?php echo $row['id_tagihan'] ?>" class="btn-xs btn-hijau" target="_blank">Print</a></td>
    </tr>
        <?php } ?>
</table>