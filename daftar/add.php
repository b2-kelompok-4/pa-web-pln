<?php
session_start();
include '../include/config.php';

$nama = htmlspecialchars($_POST['nama']);
$alamat = htmlspecialchars($_POST['alamat']);
$telp = htmlspecialchars($_POST['telp']);
$tarif = htmlspecialchars($_POST['tarif']);
$id_login = htmlspecialchars($_POST['id_login']);

mysqli_query($conn, "ALTER TABLE meter AUTO_INCREMENT = 1");

if (mysqli_query($conn, "INSERT INTO meter VALUES (NULL, NULL, '$nama', '$alamat', '$telp', '$tarif','$id_login',0)")) {
    //set session 
    $_SESSION["tambah"] = 'Silahkan Tunggu Petugas Penyambungan PLN Datang Ke Tempat Anda!!';
    header("Location: ../user.php?page=daftar");
} else {
    //set session 
    $_SESSION["eror"] = 'Something went wrong!!';
    header("Location: ../user.php?page=daftar");
}
