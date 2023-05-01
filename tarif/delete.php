<?php
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM tarif WHERE id_tarif='$id'");
    header('location: admin.php?page=tarif');
?>