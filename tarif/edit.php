<?php
session_start();
include '../include/config.php';
$id = $_POST['id_tarif'];
$daya = $_POST['daya'];
$kwh = $_POST['kwh'];
$kwh = preg_replace('/\D/', '', $kwh);
$sql = "UPDATE tarif SET daya='$daya', tarif_kwh='$kwh' WHERE id_tarif='$id'";

// mengeksekusi query untuk menambahkan data ke dalam tabel
if (mysqli_query($conn, $sql)) {
    //set session sukses
    $_SESSION["update"] = 'Tarif Berhasil Di Update!';
    //redirect ke halaman index.php
    header('Location: ' . ($_SESSION['role'] == 'admin' ? '../admin.php?page=tarif' : '../staff.php?page=tarif'));
} else {
    //set session 
    $_SESSION["eror"] = 'Something went wrong!!';

    //redirect ke halaman index.php
    header('Location: ' . ($_SESSION['role'] == 'admin' ? '../admin.php?page=tarif' : '../staff.php?page=tarif'));
}
