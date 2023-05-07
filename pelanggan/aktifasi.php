<?php
function generateRandomString(int $length = 10)
{
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
$id = $_GET['id'];

// Looping untuk menghasilkan nomor meter baru sampai nomor meter tersebut unik
do {
    $no_meter = generateRandomString(10);
    $result = mysqli_query($conn, "SELECT COUNT(*) AS count FROM meter WHERE no_meter='$no_meter'");
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];
} while ($count > 0);

mysqli_query($conn, "UPDATE meter SET no_meter='$no_meter', status = 1 WHERE id_meter='$id'");
header('location: ' . ($_SESSION['role'] == 'admin' ? 'admin.php?page=pelanggan' : 'staff.php?page=pelanggan'));
