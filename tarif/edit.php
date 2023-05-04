<h2>Edit Tarif</h2>
<?php
    $id = $_GET['id'];
    $sql = mysqli_query($conn, "SELECT * FROM tarif WHERE id_tarif='$id'");
    while ($row = mysqli_fetch_assoc($sql)) {
    ?>
<form action="" method="POST">
    <label for="daya">Daya</label>
    <input type="text" name="daya" class="form-input" id="daya" value="<?php echo $row['daya'] ?>">
    <label for="kwh">Tarif per-KWH</label>
    <input type="text" name="kwh" class="form-input" id="kwh" value="<?php echo $row['tarif_kwh'] ?>">
    <button type="submit" name="edit" class="btn-xs btn-hijau mt-2">Simpan</button>
</form>
<?php
    }if(isset($_POST['edit'])){
        $daya = $_POST['daya'];
        $kwh = $_POST['kwh'];
        mysqli_query($conn, "UPDATE tarif SET daya='$daya', tarif_kwh='$kwh' WHERE id_tarif='$id'");
        header('location: ' . ($_SESSION['role'] == 'admin' ? 'admin.php?page=tarif' : 'staff.php?page=tarif'));
    }
?>