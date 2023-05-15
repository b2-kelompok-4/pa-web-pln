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

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/volt.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="style.css">
    <title>PLN PPOB</title>
</head>

<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2>PLN PPOB</h2>
            <ul>
                <li><a href="staff.php?page=tarif">Tarif</a></li>
                <li><a href="staff.php?page=pelanggan">Pelanggan</a></li>
                <li><a href="staff.php?page=penggunaan">Penggunaan</a></li>
                <li><a href="b">Tagihan</a></li>
                <li><a href="staff.php?page=pembayaran">Pembayaran</a></li>
            </ul>
        </div>
        <div class="main_content">
            <div class="header">
                <div class="header-brand">Selamat datang <?php echo $nama; ?></div>
                <div class="header-item">
                    <a href="logout.php" class="btn-xs btn-biru">Logout</a>
                </div>
            </div>
            <div class="info"> -->
<?php
if (isset($_GET['page'])) {
    if ($_GET['page'] == 'tarif') {
        include 'tarif/tarif.php';
    } elseif ($_GET['page'] == 'deleteTarif') {
        include 'tarif/delete.php';
    } elseif ($_GET['page'] == 'pelanggan') {
        include 'pelanggan/pelanggan.php';
    } elseif ($_GET['page'] == 'activatePelanggan') {
        include 'pelanggan/aktifasi.php';
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
    } elseif ($_GET['page'] == 'laporan') {
        include 'laporan/laporan.php';
    } elseif ($_GET['page'] == 'addLaporan') {
        include 'laporan/add.php';
    } elseif ($_GET['page'] == 'editLaporan') {
        include 'laporan/edit.php';
    } elseif ($_GET['page'] == 'deleteLaporan') {
        include 'laporan/delete.php';
    }
} else {
    include 'tarif/tarif.php';
}
?>
<!-- </div>
        </div>
    </div>
    <div class="footer footer2">
        <p align="center">Copyright &copy; 2023 B2 Kelompok 4</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
</body>

</html> -->