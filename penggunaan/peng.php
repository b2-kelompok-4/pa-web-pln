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
                            <div class="row">
                                <div class="col-xl-10">
                                    <h1>Manage Data Tarif</h1>
                                </div>
                                <div class="col-xl-2">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_tambah"><i class="fa fa-plus mr-2"></i> Add Tarif</button>
                                </div>
                            </div>
                            <div class="row align-items-center mt-4">
                                <div class="col">
                                    <table class="table table-bordered data hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Daya</th>
                                                <th>Tarif per-KWH</th>
                                                <th>Opsi</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $sql = mysqli_query($conn, "SELECT * FROM tarif");
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                                $status = $row['status'];
                                                if ($status == 1) {
                                                    $status = '<a class="text-success">ACTIVE</a>';
                                                } else {
                                                    $status = '<a style="color: red;">NOT ACTIVE</a>';
                                                }
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo $row['daya'] ?> VA</td>
                                                    <td>Rp. <?php echo number_format($row['tarif_kwh']) ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-light" data-toggle="modal" data-target="#modal_update<?= $row['id_tarif'] ?>">Edit</a>
                                                        <a href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin.php?page=deleteTarif&id=' . $row['id_tarif'] : 'staff.php?page=deleteTarif&id=' . $row['id_tarif'] ?>" id="delete" class="btn btn-danger delete-link" data-id="<?php echo $row['id_tarif']; ?>">Hapus</a>
                                                    <td>
                                                        <?php echo $status ?>
                                                    </td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
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
        // Data Table
        $(document).ready(function() {
            $('.data').DataTable();
        });

        // FORMAT INPUT KWH MENJADI RUPIAH
        $("#kwh-tambah, #kwh-update ").on("keyup", function() {
            // mengambil nilai input
            var angka = $(this).val();
            // menghilangkan semua karakter kecuali angka
            angka = angka.replace(/\D/g, '');
            // format angka menjadi ribuan dengan tanda titik
            angka = parseInt(angka, 10).toLocaleString('id-ID', {
                minimumFractionDigits: 0
            });
            // tambahkan "Rp" di depan angka
            angka = "Rp. " + angka;
            // set nilai input dengan format angka
            $(this).val(angka);
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