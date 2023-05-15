<?php
session_start();
include '../include/config.php';
$id_login = $_POST['id_login'];
$id_tagihan = $_POST['id_tagihan'];
$tanggal = date('Y-m-d');
$biaya_admin = $_POST['biaya_admin'];
$total = $_POST['total'];
mysqli_query($conn, "ALTER TABLE pembayaran AUTO_INCREMENT = 1");
if (mysqli_query($conn, "INSERT INTO pembayaran VALUES(null, '$id_login', '$id_tagihan', '$tanggal', '$biaya_admin', '$total')")) {
    //set session 
    $_SESSION["bayar"] = 'Pembayaran Berhasil Di Lakukan!';
    echo "<script>window.open('../pembayaran/print.php?byr=$id_tagihan', '_blank');
    history.back();
    </script>";
} else {
    //set session 
    $_SESSION["eror"] = 'Something went wrong!!';

    //redirect
    header('location: ' . ($_SESSION['role'] == 'admin' ? 'admin.php?page=pelanggan' : 'staff.php?page=pelanggan'));
}
