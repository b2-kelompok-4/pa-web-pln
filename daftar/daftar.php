<!--

=========================================================
* Argon Dashboard - v1.1.2
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2020 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        PLN
    </title>
    <?php require 'layouts/styles.php'; ?>
    <style>
        table.dataTable thead th {
            font-size: 18px;
        }

        table.dataTable td {
            font-size: 15px;
        }
    </style>
</head>

<body class="">
    <?php require 'layouts/sidebar.php'; ?>
    <div class="main-content">
        <?php require 'layouts/navbar.php'; ?>

        <!-- Header -->
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
            <div class="container-fluid">
                <div class="header-body">
                </div>
            </div>
        </div>
        <!-- CONTENT -->
        <div class="container-fluid mt--9">
            <div class="row mt-5">
                <div class="col-xl-12 mb-5 mb-xl-0">
                    <div class="card bg-gradient-secondary shadow">
                        <div class="card-header bg-transparent">
                            <?php
                            $id_login = $_SESSION['id_login'];
                            $cek_telah_daftar = mysqli_query($conn, "SELECT * FROM meter WHERE id_login = '$id_login'");

                            if (mysqli_num_rows($cek_telah_daftar) > 0) {
                                $query = mysqli_query($conn, "SELECT meter.no_meter, meter.pemilik, meter.alamat, tarif.daya FROM tarif INNER JOIN meter ON tarif.id_tarif=meter.id_tarif WHERE meter.id_login='$id_login'");
                                $result = mysqli_fetch_assoc($query);
                                if ($result['no_meter'] == null) {
                                    $result['no_meter'] = "Tunggu Beberapa Saat Untuk Mendapatkan Nomor Meter Anda";
                                }
                            ?>
                                <h1 align='center'>ANDA TELAH TERDAFTAR PADA LAYANAN PLN KAMI </h1>
                                <br>
                                <table style='width: 100%;'>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td align='left'>Nomor Meter</td>
                                        <td><b>:</b></td>
                                        <td><?= $result['no_meter'] ?></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td align='left'>Nama</td>
                                        <td><b>:</b></td>
                                        <td><?= $result['pemilik'] ?></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td align='left'>Alamat</td>
                                        <td><b>:</b></td>
                                        <td><?= $result['alamat'] ?></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td align='left'>Daya</td>
                                        <td><b>:</b></td>
                                        <td><?= $result['daya'] ?> VA</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            <?php
                            } else {
                            ?>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <h1>FORM PERMOHONAN PENDAFTARAN PLN</h1>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <form action="daftar/add.php" method="POST">
                                            <input type="text" value="<?= $id_login ?>" hidden name="id_login">
                                            <div class="form-group">
                                                <label for="nama">Nama:</label>
                                                <input type="text" class="form-control" id="nama" name="nama" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat:</label>
                                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="telp">No. Telepon:</label>
                                                <input type="number" class="form-control" id="telp" name="telp" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="tarif">Tarif</label>
                                                <select name="tarif" id="tarif" class="form-select">
                                                    <?php $tarif = mysqli_query($conn, "SELECT * FROM tarif");
                                                    while ($result = mysqli_fetch_assoc($tarif)) { ?>
                                                        <option value="<?php echo $result['id_tarif'] ?>">
                                                            <?php echo $result['daya'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require 'layouts/footer.php'; ?>
    </div>
    <?php require 'layouts/scripts.php'; ?>

    <!-- Cek Data Berhasil Di Tambahkan Atau Tidak -->
    <?php if (isset($_SESSION['tambah'])) { ?>
        <script>
            Swal.fire(
                'Berhasil!',
                '<?php echo $_SESSION['tambah']; ?>',
                'success'
            )
        </script>
    <?php
        unset($_SESSION['tambah']);
    }
    ?>

    <script type="text/javascript">
        // Data Table
        $(document).ready(function() {
            $('.data').DataTable();
        });
    </script>
</body>

</html>