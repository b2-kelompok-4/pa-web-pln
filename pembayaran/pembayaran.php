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
                            if ($_SESSION['role'] == 'staff') { ?>
                                <div class="col-xl-12">
                                    <h1>Manage Data Pembayaran</h1>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <table class="mt-5 table table-bordered data hover">
                                            <thead>
                                                <tr>
                                                    <th>No. Meter</th>
                                                    <th>Nama</th>
                                                    <th>Penggunaan</th>
                                                    <th>Bulan</th>
                                                    <th>Tahun</th>
                                                    <th>Status</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <?php
                                            $meter = $_POST['meter'];

                                            while ($row = mysqli_fetch_assoc($query)) {
                                                $status = $row['status'];
                                                if ($status == 1) {
                                                    $status = 'Sudah Bayar';
                                                } else {
                                                    $status = 'Belum Bayar';
                                                    $button = ($_SESSION['role'] == 'user') ? "<a href='user.php?page=bayar&id=$row[id_tagihan]' class='btn-xs btn-biru'>Bayar</a>" : "<a href='staff.php?page=bayar&id=$row[id_tagihan]' class='btn-xs btn-biru'>Bayar</a>";
                                            ?>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo $row['no_meter'] ?></td>
                                                            <td><?php echo $row['pemilik'] ?></td>
                                                            <td><?php echo $row['jumlah_meter'] ?>KWH</td>
                                                            <td><?php echo 'bulan'($row['bulan']) ?></td>
                                                            <td><?php echo $row['tahun'] ?></td>
                                                            <td><?php echo $status; ?></td>
                                                            <td><?php echo $button; ?></td>
                                                        </tr>
                                                <?php
                                                }
                                            }
                                                ?>
                                                    </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php
                            } else { ?>
                                <div class="col-xl-12">
                                    <h1>Manage Data Pembayaran</h1>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col">
                                        <table class="table table-bordered data-user hover">
                                            <thead>
                                                <tr>
                                                    <th>No. Meter</th>
                                                    <th>Nama</th>
                                                    <th>Penggunaan</th>
                                                    <th>Bulan</th>
                                                    <th>Tahun</th>
                                                    <th>Status</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <?php

                                            $id_login = $_SESSION['id_login'];

                                            $query = mysqli_query($conn, "SELECT meter.id_meter,meter.no_meter,meter.pemilik,tagihan.id_tagihan,tagihan.jumlah_meter,tagihan.status,penggunaan.bulan,penggunaan.tahun FROM tagihan 
                                INNER JOIN penggunaan ON tagihan.id_penggunaan=penggunaan.id_penggunaan 
                                INNER JOIN meter ON penggunaan.no_meter=meter.no_meter  WHERE meter.id_login = '$id_login'");

                                            while ($row = mysqli_fetch_assoc($query)) {
                                                $status = $row['status'];
                                                if ($status == 1) {
                                                    $status = 'Sudah Bayar';
                                                } else {
                                                    $status = 'Belum Bayar';
                                                    $button = ($_SESSION['role'] == 'user') ? "<a href='user.php?page=bayar&id=$row[id_tagihan]' class='btn btn-info'>Bayar</a>" : "<a href='staff.php?page=bayar&id=$row[id_tagihan]' class='btn btn-info'>Bayar</a>";
                                            ?>
                                                    <!-- Modal Bayar User -->
                                                    <div class="modal fade" id="modal_bayar_user<?= $row['id_tagihan'] ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                                <!-- Modal Header -->
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Pembayaran Listrik</h4>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>

                                                                <!-- Modal body -->
                                                                <div class="modal-body">
                                                                    <form method="POST" action="pembayaran/bayar.php">
                                                                        <input type="text" name="id_login" hidden value="<?= $id_login ?>">
                                                                        <input type="text" name="id_tagihan" hidden value="<?= $row['id_tagihan'] ?>">
                                                                        <?php
                                                                        $id_tagihan = $row['id_tagihan'];
                                                                        $query_user = mysqli_query($conn, "SELECT * FROM tagihan INNER JOIN penggunaan ON penggunaan.id_penggunaan = tagihan.id_penggunaan INNER JOIN meter ON meter.no_meter = penggunaan.no_meter INNER JOIN tarif ON tarif.id_tarif = meter.id_tarif WHERE tagihan.id_tagihan = '$id_tagihan'");
                                                                        $row_user = mysqli_fetch_assoc($query_user);
                                                                        $no_meter_user = $row_user['no_meter'];
                                                                        $tarif = $row_user['tarif_kwh'];
                                                                        $penggunaan = $row_user['jumlah_meter'];
                                                                        $tagihan = $tarif * $penggunaan;
                                                                        $total = $tagihan + 2000;
                                                                        ?>
                                                                        <div class="form-group">
                                                                            <label for="daya">No. Meter:</label>
                                                                            <input type="number" class="form-control" id="daya" name="daya" value="<?= $no_meter_user ?>" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="penggunaan">Penggunaan:</label>
                                                                            <input type="text" class="form-control" id="penggunaan" name="penggunaan" value="<?php echo $penggunaan ?> KWH" readonly required>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="tagihan">Tagihan (Rp.)</label>
                                                                            <input type="text" id="tagihan" class="form-control" name="tagihan" readonly value="<?php echo $tagihan ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="biaya">Biaya Admin (Rp.)</label>
                                                                            <input type="text" id="biaya" class="form-control" readonly value="<?php echo 2000 ?>" name="biaya_admin">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="total">Total (Rp.)</label>
                                                                            <input type="text" id="total" class="form-control" readonly value="<?php echo $total ?>" name="total">
                                                                        </div>
                                                                        <button type="submit" name="submit" class="btn btn-info">Bayar</button>
                                                                    </form>
                                                                </div>

                                                                <!-- Modal footer -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal Bayar User -->

                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo $row['no_meter'] ?></td>
                                                            <td><?php echo $row['pemilik'] ?></td>
                                                            <td><?php echo $row['jumlah_meter'] ?>KWH</td>
                                                            <td><?php echo 'bulan'($row['bulan']) ?></td>
                                                            <td><?php echo $row['tahun'] ?></td>
                                                            <td><?php echo $status; ?></td>
                                                            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_bayar_user<?= $row['id_tagihan'] ?>"><i class="fa fa-credit-card text-primary mr-2"></i>Bayar</button></td>
                                                        </tr>
                                                <?php
                                                }
                                            }
                                                ?>
                                                    </tbody>
                                        </table>
                                    </div>
                                <?php
                            }
                                ?>
                                </div>
                        </div>
                    </div>
                </div>
                <?php require 'layouts/footer.php'; ?>
            </div>
            <?php require 'layouts/scripts.php'; ?>

            <!-- Cek Data Berhasil Di Tambahkan Atau Tidak -->
            <?php if (isset($_SESSION['bayar'])) { ?>
                <script>
                    Swal.fire(
                        'Berhasil!',
                        '<?php echo $_SESSION['bayar']; ?>',
                        'success'
                    )
                </script>
            <?php
                unset($_SESSION['bayar']);
            } else if (isset($_SESSION['update'])) { ?>
                <script>
                    Swal.fire(
                        'Berhasil!',
                        '<?php echo $_SESSION['update']; ?>',
                        'success'
                    )
                </script>
            <?php
                unset($_SESSION['update']);
            } else if (isset($_SESSION['eror'])) { ?>
                <script>
                    Swal.fire(
                        'Oops...!',
                        '<?php echo $_SESSION['eror']; ?>',
                        'error'
                    )
                </script>
            <?php
                unset($_SESSION['eror']);
            }
            ?>

            <script type="text/javascript">
                // Data Table Staff
                $(document).ready(function() {
                    $('.data').DataTable();
                });

                // Data Table User
                $(document).ready(function() {
                    $('.data-user').DataTable({
                        searching: false,
                        paging: false,
                        info: false,
                        ordering: false,
                        scrollY: "300px",
                        scrollX: true,
                        scrollCollapse: true,
                    });

                });
            </script>
</body>

</html>