<?php
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM login WHERE id_login='$id'");
header('location: admin.php?page=ListStaff');
