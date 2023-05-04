<?php
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM tarif WHERE id_tarif='$id'");
    header('location: ' . ($_SESSION['role'] == 'admin' ? 'admin.php?page=tarif' : 'staff.php?page=tarif'));
?>