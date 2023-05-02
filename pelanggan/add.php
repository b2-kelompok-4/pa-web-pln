<h2>Tambah Pelanggan</h2>
<form action="" method="POST">
    <label for="kwh">No. Meter</label>
    <input type="text" name="kwh" class="form-input" id="kwh">
    <label for="nama">Nama</label>
    <input type="text" name="nama" class="form-input" id="nama">
    <label for="alamat">Alamat</label>
    <input type="text" name="alamat" class="form-input" id="alamat">
    <label for="telp">No. Telepon</label>
    <input type="text" name="telp" class="form-input" id="telp">
    <label for="tarif">Tarif</label>
    <select name="tarif" id="tarif" class="form-input">
        <?php $sql = mysqli_query($conn, "SELECT * FROM tarif");
        while ($row = mysqli_fetch_assoc($sql)) { ?>
            <option value="<?php echo $row['id_tarif'] ?>"><?php echo $row['daya'] ?></option>
        <?php } ?>
    </select>
    <button type="submit" name="tambah" class="btn-xs btn-biru mt-2">Tambah</button>
</form>
<?php
if (isset($_POST['tambah'])) {
    $kwh = htmlspecialchars($_POST['kwh']);
    $nama = htmlspecialchars($_POST['nama']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $telp = htmlspecialchars($_POST['telp']);
    $tarif = htmlspecialchars($_POST['tarif']);
    mysqli_query($conn, "ALTER TABLE meter AUTO_INCREMENT = 1");
    
    $add = mysqli_query($conn, "INSERT INTO meter VALUES (NULL, '$kwh', '$nama', '$alamat', '$telp', '$tarif')");
    header('location: admin.php?page=pelanggan');
}
?>