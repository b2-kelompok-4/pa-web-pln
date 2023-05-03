<h2>Tambah Staff</h2>
<form action="" method="POST">
    <label for="nama">Nama</label>
    <input type="text" name="nama" class="form-input" id="nama">
    <label for="username">Username</label>
    <input type="text" name="username" class="form-input" id="username">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-input" id="password">
    <button type="submit" name="tambah" class="btn-xs btn-biru mt-2">Tambah</button>
</form>

<?php
if (isset($_POST['tambah'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'staff';
    mysqli_query($conn, "ALTER TABLE login AUTO_INCREMENT = 1");
    mysqli_query($conn, "INSERT INTO login (nama,username,password,role) VALUES ('$nama', '$username', '$password', '$role')");
    header('location: admin.php?page=laporan');
}
?>
