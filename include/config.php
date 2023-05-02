<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_pln');

function bulan($angka)
{
    if ($angka >= 13) $angka = 1;
    switch ($angka) {
        case 1:
            $bulan = "Januari";
            break;
        case 2:
            $bulan = "Februari";
            break;
        case 3:
            $bulan = "Maret";
            break;
        case 4:
            $bulan = "April";
            break;
        case 5:
            $bulan = "Mei";
            break;
        case 6:
            $bulan = "Juni";
            break;
        case 7:
            $bulan = "Juli";
            break;
        case 8:
            $bulan = "Agustus";
            break;
        case 9:
            $bulan = "September";
            break;
        case 10:
            $bulan = "Oktober";
            break;
        case 11:
            $bulan = "November";
            break;
        case 12:
            $bulan = "Desember";
            break;
        default:
            $bulan = "Error";
    }
    return $bulan;
}

function penggunaan_meter_bln($meter)
{
    global $conn;
    $meter = mysqli_real_escape_string($conn, $meter);
    $query = "SELECT * FROM penggunaan INNER JOIN tagihan ON tagihan.id_penggunaan = penggunaan.id_penggunaan WHERE no_meter='$meter";
    $result = mysqli_query($conn, $query);
    return $result;
}

function select_akhir_meter($meter)
{
    global $conn;
    $query = "SELECT * FROM penggunaan INNER JOIN tagihan ON tagihan.id_penggunaan = penggunaan.id_penggunaan WHERE penggunaan.no_meter='$meter' ORDER BY penggunaan.id_penggunaan DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}

function penggunaan_meter($meter)
{
    global $conn;
    $meter = mysqli_real_escape_string($conn, $meter);
    $query = "SELECT * FROM penggunaan INNER JOIN tagihan ON tagihan.id_penggunaan = penggunaan.id_penggunaan WHERE no_meter='$meter' ORDER BY penggunaan.id_penggunaan DESC";
    $result = mysqli_query($conn, $query);
    return $result;
}

function cek_penggunaan($meter)
{
    global $conn;
    //$meter = mysqli_real_escape_string($conn, $meter);
    $query = "SELECT * FROM penggunaan WHERE no_meter='$meter' ORDER BY id_penggunaan DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result = mysqli_query($conn, $query)) {
        if (mysqli_num_rows($result) == 0) return true;
        else return false;
    }
}

// $browser = $_SERVER['HTTP_USER_AGENT'];
// $chrome = '/Chrome/';
// $firefox = '/Firefox/';
// $ie = '/Firefox/';
// if (preg_match($chrome, $browser))
//     $data = "Chrome";
// if (preg_match($firefox, $browser))
//     $data = "Firefox";
// if (preg_match($ie, $browser))
//     $data = "IE";

// $ipaddress = $_SERVER['REMOTE_ADDR'] . "";
// $browser = $data;
// $tanggal = date('Y-m-d');
// $kunjungan = 1;

// if (!isset($_SESSION['visitor'])) {
//     $_SESSION['visitor'] = $ipaddress;
//     mysqli_query($conn, "INSERT INTO visitor VALUES ('', '$tanggal', '$ipaddress', '$kunjungan', '$browser')");
// }

// $kemarin = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));
// $hari_ini     = mysqli_fetch_array(mysqli_query($conn, 'SELECT sum(counter) AS hari_ini FROM visitor WHERE tanggal="' . date("Y-m-d") . '"'));
// $kemarin    = mysqli_fetch_array(mysqli_query($conn, 'SELECT sum(counter) AS kemarin FROM visitor WHERE tanggal="' . $kemarin . '"'));
// $sql = mysqli_fetch_array(mysqli_query($conn, 'SELECT sum(counter) as total FROM visitor'));
