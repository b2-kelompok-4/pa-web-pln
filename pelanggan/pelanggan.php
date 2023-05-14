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
                                <h1>Manage Data Pelanggan</h1>
                            </div>
                            <div class="row align-items-center mt-4">
                                <div class="col">
                                    <table class="table table-bordered data hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No. Meter</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No. Telp</th>
                                                <th>Daya</th>
                                                <th>Status</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $sql = mysqli_query($conn, "SELECT meter.*, tarif.daya FROM meter INNER JOIN tarif ON meter.id_tarif=tarif.id_tarif");
                                            while ($row = mysqli_fetch_assoc($sql)) {
                                                $status = $row['status'];
                                                if ($status == 1) {
                                                    $status = '<a class="text-success">ACTIVE</a>';
                                                } else {
                                                    $status = '<a style="color: red;">NOT ACTIVE</a>';
                                                }
                                            ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $row['no_meter'] ?></td>
                                                    <td><?php echo $row['pemilik'] ?></td>
                                                    <td><?php echo $row['alamat'] ?></td>
                                                    <td><?php echo $row['telp'] ?></td>
                                                    <td><?php echo $row['daya'] ?></td>
                                                    <td><?php echo $status ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-light" data-toggle="modal" data-target="#modal_update<?= $row['id_meter'] ?>">Edit</a>
                                                        <a href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin.php?page=deletePelanggan&id=' . $row['id_meter'] : 'staff.php?page=deletePelanggan&id=' . $row['id_meter'] ?>" class="btn btn-danger" id="delete">Hapus</a>
                                                        <?php
                                                        if ($row['status'] == 0) { ?>
                                                            <a href="<?php echo ($_SESSION['role'] == 'admin') ? 'admin.php?page=activatePelanggan&id=' . $row['id_meter'] : 'staff.php?page=activatePelanggan&id=' . $row['id_meter'] ?>" class="btn btn-success">Activate</a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>

                                                <!-- Modal Update Data -->
                                                <div class="modal fade" id="modal_update<?= $row['id_meter'] ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Update Data</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                <form method="POST" action="pelanggan/edit.php">
                                                                    <input type="text" name="id_meter" value="<?= $row['id_meter'] ?>" hidden>
                                                                    <div class="form-group">
                                                                        <label for="nomor_meter">No. Meter</label>
                                                                        <input type="number" class="form-control" id="nomor_meter" name="nomor_meter" readonly value="<?php echo $row['no_meter'] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nama">Nama</label>
                                                                        <input type="text" class="form-control" id="nama" name="nama" required value="<?php echo $row['pemilik'] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="alamat">Alamat</label>
                                                                        <input type="text" class="form-control" id="alamat" name="alamat" required value="<?php echo $row['alamat'] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="telp">No. Telepon</label>
                                                                        <input type="text" class="form-control" id="telp" name="telp" required value="<?php echo $row['telp'] ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tarif">Tarif</label>
                                                                        <select name="tarif" id="tarif" class="form-control">
                                                                            <?php $tarif = mysqli_query($conn, "SELECT * FROM tarif");
                                                                            while ($result = mysqli_fetch_assoc($tarif)) { ?>
                                                                                <option value="<?php echo $result['id_tarif'] ?>" <?php if ($row['id_tarif'] == $result['id_tarif']) {
                                                                                                                                        echo "selected='selected'";
                                                                                                                                    } ?>>
                                                                                    <?php echo $result['daya'] ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-info">Simpan</button>
                                                                </form>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal Update Data -->
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
    <?php if (isset($_SESSION['active'])) { ?>
        <script>
            Swal.fire(
                'Berhasil!',
                '<?php echo $_SESSION['active']; ?>',
                'success'
            )
        </script>
    <?php
        unset($_SESSION['active']);
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
            $('.data').DataTable({
                scrollY: "300px",
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                fixedColumns: {
                    heightMatch: 'none'
                }
            });
        });

        // Hapus Data
        $(function() {
            $(document).on('click', '#delete', function(e) {
                e.preventDefault();
                let link = $(this).attr("href");
                Swal.fire({
                    title: 'Apakah Anda Yakin Ingin Menghapus Pelanggan Tersebut?',
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
                                    'Pelanggan Berhasil Di Hapus!',
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