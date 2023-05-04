<?php
include 'include/config.php';
session_start();
if ($_SESSION['status'] != 'login' && $_SESSION['role'] != 'staff') {
    header('location: login.php?pesan=belum_login');
}

$username = $_SESSION['username'];
$sql = "SELECT nama FROM login WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$nama = $row['nama'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/volt.png">
    <link rel="stylesheet" href="style.css">
    <title>PLN PPOB</title>
</head>

<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2>PLN PPOB</h2>
            <ul>
                <li><a href="admin.php?page=tarif">Tarif</a></li>
                <li><a href="admin.php?page=pelanggan">Pelanggan</a></li>
                <li><a href="admin.php?page=penggunaan">Penggunaan</a></li>
                <li><a href="admin.php?page=tagihan">Tagihan</a></li>
                <li><a href="admin.php?page=pembayaran">Pembayaran</a></li>
                <li><a href="admin.php?page=listStaff">List Staff</a></li>

            </ul>
        </div>
        <div class="main_content">
            <div class="header">
                <div class="header-brand">Selamat Datang <?php echo $nama; ?></div>
                <div class="header-item">
                    <a href="logout.php" class="btn-xs btn-biru">Logout</a>
                </div>
            </div>
            <div class="info">
                <?php
                if (isset($_GET['page'])) {
                    if ($_GET['page'] == 'tarif') {
                        include 'tarif/tarif.php';
                    } elseif ($_GET['page'] == 'addTarif') {
                        include 'tarif/add.php';
                    } elseif ($_GET['page'] == 'editTarif') {
                        include 'tarif/edit.php';
                    } elseif ($_GET['page'] == 'deleteTarif') {
                        include 'tarif/delete.php';
                    } elseif ($_GET['page'] == 'pelanggan') {
                        include 'pelanggan/pelanggan.php';
                    } elseif ($_GET['page'] == 'addPelanggan') {
                        include 'pelanggan/add.php';
                    } elseif ($_GET['page'] == 'editPelanggan') {
                        include 'pelanggan/edit.php';
                    } elseif ($_GET['page'] == 'deletePelanggan') {
                        include 'pelanggan/delete.php';
                    } elseif ($_GET['page'] == 'penggunaan') {
                        include 'penggunaan/penggunaan.php';
                    } elseif ($_GET['page'] == 'tagihan') {
                        include 'tagihan/tagihan.php';
                    } elseif ($_GET['page'] == 'pembayaran') {
                        include 'pembayaran/pembayaran.php';
                    } elseif ($_GET['page'] == 'addPenggunaan') {
                        include 'penggunaan/add.php';
                    } elseif ($_GET['page'] == 'editPenggunaan') {
                        include 'penggunaan/edit.php';
                    } elseif ($_GET['page'] == 'addMakhir') {
                        include 'penggunaan/addMakhir.php';
                    } elseif ($_GET['page'] == 'bayar') {
                        include 'pembayaran/bayar.php';
                    } elseif ($_GET['page'] == 'history') {
                        include 'pembayaran/history.php';
                    } elseif ($_GET['page'] == 'petugas') {
                        include 'petugas/petugas.php';
                    } elseif ($_GET['page'] == 'addPetugas') {
                        include 'petugas/add.php';
                    } elseif ($_GET['page'] == 'listStaff') {
                        include 'list_staff/staff.php';
                    } elseif ($_GET['page'] == 'addStaff') {
                        include 'list_staff/add.php';
                    } elseif ($_GET['page'] == 'editStaff') {
                        include 'list_staff/edit.php';
                    } elseif ($_GET['page'] == 'deleteStaff') {
                        include 'list_staff/delete.php';
                    }
                } else {
                    include 'tarif/tarif.php';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="footer footer2">
        <p align="center">Copyright &copy; 2023 B2 Kelompok 4</p>
    </div>
</body>

</html>