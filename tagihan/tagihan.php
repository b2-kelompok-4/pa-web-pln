<?php
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'staff') : ?>
    <form method="POST" class="mt-2">
        <input type="search" name="cari" class="form-input" style="display: inline; width: 90%" placeholder="Cari No. Meter atau Nama...">
        <button type="submit" class="btn btn-hijau" style="margin-left: 40px;">Cari</button>
    </form>
<?php endif; ?>
<?php

$id_login = $_SESSION['id_login'];
$no = 1;
if (isset($_POST['cari'])) {
    $cari = $_POST['cari'];
    // QUERY UNTUK MENGAMBIL DATA TAGIHAN PENGGUNA BERDASARKAN PENCARIAN YANG DI INPUTKAN
    $sql = mysqli_query($conn, "SELECT meter.no_meter, meter.pemilik, penggunaan.bulan, penggunaan.tahun, tagihan.jumlah_meter, tagihan.status 
    FROM tagihan 
    INNER JOIN penggunaan ON tagihan.id_penggunaan=penggunaan.id_penggunaan 
    INNER JOIN meter ON penggunaan.no_meter=meter.no_meter 
    WHERE meter.pemilik LIKE '%$cari%' OR meter.no_meter LIKE '%$cari%' 
    ORDER BY bulan, tahun ASC");
} else {
    // QUERY UNTUK MENGAMBIL DATA TAGIHAN PENGGUNA DI ADMIN ATAU STAFF
    $sql = mysqli_query($conn, "SELECT tagihan.*, penggunaan.*, meter.no_meter, meter.pemilik FROM tagihan 
    INNER JOIN penggunaan ON tagihan.id_penggunaan=penggunaan.id_penggunaan 
    INNER JOIN meter ON penggunaan.no_meter=meter.no_meter 
    ORDER BY bulan, tahun ASC;");

    // QUERY UNTUK MENGAMBIL DATA TAGIHAN PENGGUNA DI USER
    $sql_user = mysqli_query($conn, "SELECT tagihan.*, penggunaan.*, meter.no_meter, meter.pemilik FROM tagihan 
    INNER JOIN penggunaan ON tagihan.id_penggunaan=penggunaan.id_penggunaan 
    INNER JOIN meter ON penggunaan.no_meter=meter.no_meter 
    WHERE meter.id_login = '$id_login' 
    ORDER BY bulan, tahun ASC;");
}
if ($_SESSION['role'] != 'user') {
    if (mysqli_num_rows($sql) > 0) {
        echo '<table class="mt-2">';
        echo '<tr>
                    <th>No</th>
                    <th>No Meter</th>
                    <th>Nama</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Pemakaian</th>
                    <th>Status</th>
                </tr>';
        while ($row = mysqli_fetch_assoc($sql)) {
            $status = $row['status'];
            if ($status == 1) {
                $status = '<a class="blue">Sudah dibayar</a>';
            } else {
                $status = '<a class="red">Belum dibayar</a>';
            }
            echo '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . $row['no_meter'] . '</td>
                    <td>' . $row['pemilik'] . '</td>
                    <td>' . bulan($row['bulan']) . '</td>
                    <td>' . $row['tahun'] . '</td>
                    <td>' . $row['jumlah_meter'] . ' KWH</td>
                    <td>' . $status . '</td>
                </tr>';
        }
        echo '</table>';
    } else {
        echo "<br>";
        echo "<h1>TIDAK ADA DI DAFTAR TAGIHAN</h1>";
    }
} else {
    if (mysqli_num_rows($sql_user) > 0) {
        $query = mysqli_query($conn, "SELECT meter.no_meter, meter.pemilik, meter.alamat, tarif.daya FROM tarif INNER JOIN meter ON tarif.id_tarif=meter.id_tarif WHERE meter.id_login='$id_login'");
        $result = mysqli_fetch_assoc($query);

        echo "<h1 align='center'>Cek Tagihan</h1>";
        echo "<br>";
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
        echo '</br>';
        echo '<h1 align="center">Detail Tagihan</h1>';
        echo '<table class="mt-2">';
        echo '<tr>
                    <th>No</th>
                    <th>No Meter</th>
                    <th>Nama</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Pemakaian</th>
                    <th>Status</th>
                </tr>';
        while ($row = mysqli_fetch_assoc($sql_user)) {
            $status = $row['status'];
            if ($status == 1) {
                $status = '<a class="blue">Sudah dibayar</a>';
            } else {
                $status = '<a class="red">Belum dibayar</a>';
            }
            echo '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . $row['no_meter'] . '</td>
                    <td>' . $row['pemilik'] . '</td>
                    <td>' . bulan($row['bulan']) . '</td>
                    <td>' . $row['tahun'] . '</td>
                    <td>' . $row['jumlah_meter'] . ' KWH</td>
                    <td>' . $status . '</td>
                </tr>';
        }
        echo '</table>';
    } else {
        echo "<h1>ANDA TIDAK MEMILIKI TAGIHAN</h1>";
    }
}
