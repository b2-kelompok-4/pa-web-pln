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
                <h1 align="center">REGISTER</h1>
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama" class="form-input mt-5" style="width:100%; font-size: 16px;" autofocus>
                    <input type="text" name="user" placeholder="Username" class="form-input mt-5" style="width:100%; font-size: 16px;">
                    <input type="password" name="pass" placeholder="Password" class="form-input mt-2" style="width:100%; font-size: 16px;">
                    <input type="password" name="cpass" placeholder="Konfirmasi Password" class="form-input mt-2" style="width:100%; font-size: 16px;">
                    <button type="submit" name="login" class="btn btn-biru mt-2" style="width: 100%; font-size: 16px">Register</button>
                    <p>Belum memiliki akun?
                        <a href="login.php">Login</a>
                        <?php
                        if (isset($_GET['pesan'])) {
                            if ($_GET['pesan'] == "gagal") {
                                echo "<p class='mt-2'>Login gagal! username dan password salah!</p>";
                            } else if ($_GET['pesan'] == "logout") {
                                echo "<p class='mt-2'>Anda telah berhasil logout</p>";
                            } else if ($_GET['pesan'] == "belum_login") {
                                echo "<p class='mt-2'>Anda harus login untuk mengakses halaman admin</p>";
                            }
                        }
                        ?>
                </form>
            </div>
        </div>
    </div>
    <!-- <div class="wrapper">
        <div class="main_content" style="display: flex; justify-content: center; align-items: center; margin-left: 0 !important">
            <div class="info" style="margin-top: 10px; width: 30%;">
                Username: admin<br>
                Password: admin
            </div>
        </div>
    </div> -->
</body>

</html>

<?php
if (isset($_POST['login'])) {
    session_start();
    include 'include/config.php';
    $nama = $_POST['nama'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    // cek username udah digunakan apa belum

    $sql = "SELECT * FROM login where username='$user'";
    $username = $conn->query($sql);

    if (mysqli_num_rows($username) > 0) {
        echo "<script>
        alert('Username sudah digunakan, silahkan menggunakan username yang lain') </script> ";
    } else {
        if ($pass == $cpass) {
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            mysqli_query($conn, "ALTER TABLE login AUTO_INCREMENT = 1");
            $query = "INSERT INTO login (nama, username, password, role) VALUES ('$nama', '$user','$pass','user')";
            $result = $conn->query($query);

            if ($result) {
                echo "<script>
                    alert('Registrasi berhasil')
                    document.location.href='login.php';
                     </script> ";
            } else {
                echo "<script>
                    alert('Registrasi gagal')
                    document.location.href='index.php';
                     </script> ";
            }
        } else {
            echo "<script>
                    alert('Password konfimasi tidak sama dengan password')
                    document.location.href='register.php';
                     </script> ";
        }
    }
}
?>