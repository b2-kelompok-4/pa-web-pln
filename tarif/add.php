<?php
session_start();
include '../include/config.php';

$daya = $_POST["daya"];
$kwh = $_POST["kwh"];
$kwh = preg_replace('/\D/', '', $kwh);
// menyiapkan query untuk menambahkan data ke dalam tabel
$sql = "INSERT INTO tarif VALUES (null,'$daya', '$kwh', 0)";

// mengeksekusi query untuk menambahkan data ke dalam tabel
if (mysqli_query($conn, $sql)) {
    //set session 
    $_SESSION["tambah"] = 'Tarif Baru Berhasil Di Tambahkan!';

    //redirect ke halaman index.php
    header('Location: ' . ($_SESSION['role'] == 'admin' ? '../admin.php?page=tarif' : '../staff.php?page=tarif'));
} else {
    //set session 
    $_SESSION["eror"] = 'Something went wrong!!';

    //redirect ke halaman index.php
    header('Location: ' . ($_SESSION['role'] == 'admin' ? '../admin.php?page=tarif' : '../staff.php?page=tarif'));
}
