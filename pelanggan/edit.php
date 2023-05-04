<h2>Edit Pelanggan</h2>
<?php
$id = $_GET['id'];
$sql = mysqli_query($conn, "SELECT * FROM meter WHERE id_meter='$id'");
while ($row = mysqli_fetch_assoc($sql)) {
?>
    <form action="" method="POST">
        <label for="kwh">No. Meter</label>
        <input type="text" name="no_meter" class="form-input" id="no_meter" value="<?php echo $row['no_meter'] ?>">
        <label for="nama">Nama</label>
        <input type="text" name="nama" class="form-input" id="nama" value="<?php echo $row['pemilik'] ?>">
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" class="form-input" id="alamat" value="<?php echo $row['alamat'] ?>">
        <label for="telp">No. Telepon</label>
        <input type="text" name="telp" class="form-input" id="telp" value="<?php echo $row['telp'] ?>">
        <label for="tarif">Tarif</label>
        <select name="tarif" id="tarif" class="form-input">
            <?php $sql = mysqli_query($conn, "SELECT * FROM tarif");
            while ($result = mysqli_fetch_assoc($sql)) { ?>
                <option value="<?php echo $result['id_tarif'] ?>" <?php if ($row['id_tarif'] == $result['id_tarif']) {
                                                                        echo "selected='selected'";
                                                                    } ?>><?php echo $result['daya'] ?></option>
            <?php } ?>
        </select>
        <button type="submit" name="edit" class="btn-xs btn-hijau mt-2">Simpan</button>
    </form>
<?php
}
if (isset($_POST['edit'])) {
    $kwh = $_POST['no_meter'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $tarif = $_POST['tarif'];
    mysqli_query($conn, "UPDATE meter SET no_meter='$kwh', pemilik='$nama', alamat='$alamat', telp='$telp', id_tarif='$tarif' WHERE id_meter='$id'");
    header('location: ' . ($_SESSION['role'] == 'admin' ? 'admin.php?page=pelanggan' : 'staff.php?page=pelanggan'));
}
?>