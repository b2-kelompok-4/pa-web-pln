<h2>Tambah Tarif</h2>
<form action="" method="POST">
    <label for="daya">Daya</label>
    <input type="text" name="daya" class="form-input" id="daya">
    <label for="kwh">Tarif per-KWH</label>
    <input type="text" name="kwh" class="form-input" id="kwh">
    <button type="submit" name="tambah" class="btn-xs btn-biru mt-2">Tambah</button>
</form>
<?php
if (isset($_POST['tambah'])) {
    $daya = htmlspecialchars($_POST['daya']);
    $kwh = htmlspecialchars($_POST['kwh']);
    mysqli_query($conn, "INSERT INTO tarif (daya,tarif_kwh) VALUES ('$daya', '$kwh')");
    header('location: admin.php?page=tarif');
}
?>