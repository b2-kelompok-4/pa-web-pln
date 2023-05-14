<?php
session_start();
include '../include/config.php';
$id = $_POST['id_meter'];
$kwh = $_POST['nomor_meter'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telp = $_POST['telp'];
$tarif = $_POST['tarif'];

// mengeksekusi query untuk menambahkan data ke dalam tabel
if (mysqli_query($conn, "UPDATE meter SET no_meter='$kwh', pemilik='$nama', alamat='$alamat', telp='$telp', id_tarif='$tarif' WHERE id_meter='$id'")) {
    //set session 
    $_SESSION["update"] = 'Data Pelanggan Berhasil Di Ubah!';

    //redirect
    header('location: ' . ($_SESSION['role'] == 'admin' ? '../admin.php?page=pelanggan' : '../staff.php?page=pelanggan'));
} else {
    //set session 
    $_SESSION["eror"] = 'Something went wrong!!';

    //redirect
    header('location: ' . ($_SESSION['role'] == 'admin' ? '../admin.php?page=pelanggan' : '../staff.php?page=pelanggan'));
}
