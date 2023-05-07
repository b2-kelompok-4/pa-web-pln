<?php include 'include/config.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="img/volt.png">
    <link rel="stylesheet" href="style.css">
    <title>Listrik</title>
</head>

<body>
    <nav id="menu">
        <ul>
            <div id="heading">
                <a href="">PLN</a>
            </div>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="index.php?page=about">Tentang Kami</a></li>
        </ul>
    </nav>
    <div class="wrapper">
        <div class="main_content" style="width: 80%; left: 10%; position: relative; margin: 0;">
            <div class="info" style="text-align:center">
                <?php
                if (isset($_GET['page'])) {
                    if ($_GET['page'] == 'about') {
                        include 'about.php';
                    }
                } else {
                    include 'home.php';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="footer footer1">
        <p align="center">Copyright &copy; 2023 B2 Kelompok 4</p>
    </div>
</body>

</html>