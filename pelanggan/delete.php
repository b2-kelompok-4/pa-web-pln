<?php
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM meter WHERE id_meter='$id'");
header('location: ' . ($_SESSION['role'] == 'admin' ? 'admin.php?page=pelanggan' : 'staff.php?page=pelanggan'));
