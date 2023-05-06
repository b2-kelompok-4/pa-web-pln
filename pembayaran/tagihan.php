<h2 align="center">Tagihan</h2>
<table class="mt-2">
    <tr>
        <th>No</th>
        <th>No Meter</th>
        <th>Nama</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>Pemakaian</th>
        <th>Status</th>
    </tr>
    <?php
     $no = 1;
   if (isset($_POST['cari'])) {
        $cari = $_POST['cari'];
        $sql = mysqli_query($conn, "SELECT * FROM tagihan INNER JOIN
            penggunaan ON tagihan.id_penggunaan=penggunaan.id_penggunaan INNER JOIN 
            meter ON penggunaan.no_meter=meter.no_meter WHERE meter.pemilik LIKE '%$cari%' OR meter.no_meter LIKE '%$cari%' ORDER BY bulan, tahun ASC");
    } else {
        $sql = my
        sqli_query($conn, "SELECT * FROM tagihan INNER JOIN
                penggunaan ON tagihan.id_penggunaan=penggunaan.id_penggunaan INNER JOIN 
                meter ON penggunaan.no_meter=meter.no_meter ORDER BY bulan, tahun ASC");
    }
    while ($row = mysqli_fetch_assoc($sql)) {
        $status = $row['status'];
        if ($status == 1) {
            $status = '<a class="blue">Sudah dibayar</a>';
        } else {
            $status = '<a class="red">Belum dibayar</a>';
        }
    ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $row['no_meter'] ?></td>
            <td><?php echo $row['pemilik'] ?></td>
            <td><?php echo bulan($row['bulan']) ?></td>
            <td><?php echo $row['tahun'] ?></td>
            <td><?php echo $row['jumlah_meter']; ?> KWH</td>
            <td><?php echo $status ?></td>
        </tr>
    <?php } ?>
</table>