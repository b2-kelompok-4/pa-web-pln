<?php
// Mendapatkan ID staff yang akan diubah dari URL
$id_login = $_GET['id'];

// Mengambil data staff berdasarkan ID
$sql = mysqli_query($conn, "SELECT * FROM login WHERE id_login = $id_login");
$data = mysqli_fetch_assoc($sql);

// Memeriksa apakah data staff ditemukan
if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}

// Memproses form saat tombol "Simpan" ditekan
if (isset($_POST['simpan'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'staff';

    // Update data staff dalam database
    mysqli_query($conn, "UPDATE login SET nama = '$nama', username = '$username', password = '$password', role = '$role' WHERE id_login = $id_login");
    
    header('location: admin.php?page=listStaff');
}
?>

<h2>Edit Staff</h2>
<form action="" method="POST">
    <label for="nama">Nama</label>
    <input type="text" name="nama" class="form-input" id="nama" value="<?php echo $data['nama']; ?>">
    <label for="username">Username</label>
    <input type="text" name="username" class="form-input" id="username" value="<?php echo $data['username']; ?>">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-input" id="password">
    <button type="submit" name="simpan" class="btn-xs btn-biru mt-2">Simpan</button>
</form>
