<?php
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM meter WHERE id_meter='$id'");
header('location: admin.php?page=pelanggan');
