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
            <div class="row">
                <div class="col-xl-12 mb-5 mb-xl-0">
                    <div class="card bg-gradient-secondary shadow">
                        <div class="card-header bg-transparent">
                            <div class="col-xl-12">
                                <?php
                                $id_login = $_SESSION['id_login'];
                                $no = 1;

                                // QUERY UNTUK MENGAMBIL DATA TAGIHAN PENGGUNA DI ADMIN ATAU STAFF
                                $sql = mysqli_query($conn, "SELECT tagihan.*, penggunaan.*, meter.no_meter, meter.pemilik FROM tagihan 
                                     INNER JOIN penggunaan ON tagihan.id_penggunaan=penggunaan.id_penggunaan 
                                     INNER JOIN meter ON penggunaan.no_meter=meter.no_meter 
                                     ORDER BY bulan, tahun ASC;");

                                // QUERY UNTUK MENGAMBIL DATA TAGIHAN PENGGUNA DI USER
                                $sql_user = mysqli_query($conn, "SELECT tagihan.*, penggunaan.*, meter.no_meter, meter.pemilik FROM tagihan 
                                INNER JOIN penggunaan ON tagihan.id_penggunaan=penggunaan.id_penggunaan 
                                INNER JOIN meter ON penggunaan.no_meter=meter.no_meter 
                                WHERE meter.id_login = '$id_login' 
                                ORDER BY bulan, tahun ASC;");

                                if ($_SESSION['role'] != 'user') {
                                    if (mysqli_num_rows($sql) > 0) { ?>
                                        <h1>Daftar Tagihan</h1>
                                        <div class="row align-items-center mt-4">
                                            <div class="col">
                                                <table class="table table-bordered data hover">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>No. Meter</th>
                                                            <th>Nama</th>
                                                            <th>Bulan</th>
                                                            <th>Tahun</th>
                                                            <th>Pemakaian</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        while ($row = mysqli_fetch_assoc($sql)) {
                                                            $status = $row['status'];
                                                            if ($status == 1) {
                                                                $status = '<a class="text-primary>Sudah Bayar</a>';
                                                            } else {
                                                                $status = '<a style="color: red;">Belum Bayar</a>';
                                                            } ?>
                                                            <tr>
                                                                <td> <?= $no++ ?> </td>
                                                                <td> <?= $row['no_meter'] ?> </td>
                                                                <td> <?= $row['pemilik'] ?> </td>
                                                                <td><?= bulan($row['bulan']) ?> </td>
                                                                <td> <?= $row['tahun'] ?> </td>
                                                                <td> <?= $row['jumlah_meter'] ?> KWH</td>
                                                                <td> <?= $status ?> </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php
                                    } else {
                                        echo "<h1>TIDAK ADA DAFTAR TAGIHAN</h1>";
                                    }
                                } else {
                                    if (mysqli_num_rows($sql_user) > 0) {
                                        $query = mysqli_query($conn, "SELECT meter.no_meter, meter.pemilik, meter.alamat, tarif.daya FROM tarif INNER JOIN meter ON tarif.id_tarif=meter.id_tarif WHERE meter.id_login='$id_login'");
                                        $result = mysqli_fetch_assoc($query);
                                        ?>
                                            <h1 align="center">Cek Tagihan</h1>
                                            <br>
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td align='left'>No. Meter</td>
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
                                            <br>
                                            <br>
                                            <h1 align="center">Detail Tagihan</h1>
                                            <br>
                                            <table class="table table-bordered data-user hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>No. Meter</th>
                                                        <th>Nama</th>
                                                        <th>Bulan</th>
                                                        <th>Tahun</th>
                                                        <th>Pemakaian</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                while ($row = mysqli_fetch_assoc($sql_user)) {
                                                    $status = $row['status'];
                                                    if ($status == 1) {
                                                        $status = '<a class="text-info>Sudah Bayar</a>';
                                                    } else {
                                                        $status = '<a style="color: red;">Belum Bayar</a>';
                                                    } ?>
                                                    <tbody>
                                                        <tr>
                                                            <td><?= $no++ ?> </td>
                                                            <td><?= $row['no_meter'] ?> </td>
                                                            <td><?= $row['pemilik'] ?> </td>
                                                            <td><?= bulan($row['bulan']) ?> </td>
                                                            <td><?= $row['tahun'] ?> </td>
                                                            <td><?= $row['jumlah_meter'] ?> KWH</td>
                                                            <td><?= $status ?> </td>
                                                        </tr>
                                                    </tbody>
                                                <?php
                                                }
                                                ?>
                                            </table>
                                    <?php
                                    } else {
                                        echo "<h1>TIDAK ADA DAFTAR TAGIHAN</h1>";
                                    }
                                }
                                    ?>
                                        </div>
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
            // Data Table ADMIN/STAFF
            $(document).ready(function() {
                $('.data').DataTable();
            });

            // Data Table USER
            $(document).ready(function() {
                $('.data-user').DataTable({
                    searching: false,
                    paging: false,
                    info: false,
                    ordering: false

                });
            });


            // Hapus Data
            $(function() {
                $(document).on('click', '#delete', function(e) {
                    e.preventDefault();
                    let link = $(this).attr("href");
                    Swal.fire({
                        title: 'Apakah Anda Yakin Ingin Menghapus Tarif Tersebut?',
                        text: "Anda tidak akan dapat mengembalikan ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: link,
                                method: "GET",
                                success: function() {
                                    Swal.fire(
                                        'Deleted!',
                                        'Tarif Tersebut Berhasil Di Hapus!.',
                                        'success'
                                    ).then(function() {
                                        location.reload();
                                    });
                                },
                                error: function() {
                                    Swal.fire(
                                        'Error!',
                                        'Failed to delete data.',
                                        'error'
                                    );
                                }
                            });
                        }
                    })
                });
            });
        </script>
</body>

</html>