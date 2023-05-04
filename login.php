<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/volt.png">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body style="background: linear-gradient(to right, #15677B, #1593A9 );">
    <div class="wrapper">
        <div class="main_content" style="display: flex; justify-content: center; align-items: center; margin-left: 0 !important">
            <div class="info" style="margin-top: 200px; width: 30%;">
                <h1 align="center">Login</h1>
                <form action="" method="POST">
                    <input type="text" name="user" placeholder="Username" class="form-input mt-5" style="width:100%; font-size: 16px;" autofocus>
                    <input type="password" name="pass" placeholder="Password" class="form-input mt-2" style="width:100%; font-size: 16px;">
                    <button type="submit" name="login" class="btn btn-biru mt-2" style="width: 100%; font-size: 16px">Login</button>
                    <p>Belum memiliki akun?
                <a href="register.php">Register</a>
                    <?php
                    if (isset($_GET['pesan'])) {
                        if ($_GET['pesan'] == "gagal") {
                            echo "<p class='mt-2'>Login Gagal! Username dan Password Salah!</p>";
                        } else if ($_GET['pesan'] == "logout") {
                            echo "<p class='mt-2'>Anda Telah Berhasil Logout</p>";
                        } else if ($_GET['pesan'] == "belum_login") {
                            echo "<p class='mt-2'>Anda Harus Login Untuk Mengakses Halaman Admin</p>";
                        } else if ($_GET['pesan'] == "belum_aktif") {
                            echo "<p class='mt-2'>Akun Anda Belum Aktif</p>";
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['login'])) {
    session_start();
    include 'include/config.php';

    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = mysqli_query($conn, "SELECT * FROM login WHERE username='$user'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $password_db = $row['password'];

        // Lakukan verifikasi password
        if (password_verify($pass, $password_db)) {
            // Password valid
            // Lakukan Verifikasi Akun Aktif atau Tidak
            if ($row['aktif'] == 1) {
                $role = $row['role'];
                // Lakukan Verifiasi Role
                if ($role == 'staff') {
                    $_SESSION['role'] = 'staff';
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['status'] = 'login';
                    header('Location: staff.php');
                    die();
                } else if ($role == 'admin') {
                    $_SESSION['role'] = 'admin';
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['status'] = 'login';
                    header('Location: admin.php');
                    die();
                } else if ($role == 'user') {
                    $_SESSION['role'] = 'user';
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['status'] = 'login';
                    header('Location: user.php');
                    die();
                }
            } else {
                // Tampilkan akun anda belum aktif
                header('location: login.php?pesan=belum_aktif');
            }
        } else {
            // Password tidak valid
            header('location: login.php?pesan=gagal');
        }
    } else {
        // User tidak ditemukan
        header('location: login.php?pesan=gagal');
    }
}
?>