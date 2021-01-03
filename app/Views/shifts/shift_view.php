<!-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Codeigniter 4 Form</title>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css">

    <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js') ?>" type="text/javascript"></script>
</head>

<body> -->

<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

    <div class="container mt-5">
        
        <div class="row justify-content-md-center">
            <div class="col col-lg-12">
                <div class="jumbotron">
                    <p class="display-4 text-center">Shift Details</p>
                </div>

                <!-- <?php
                if (isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                }
                ?> -->

                <?php if (session('msg')) : ?>
                    <div class="alert alert-success alert-dismissible text-center">
                        <?= session('msg') ?>
                    </div>
                <?php endif ?>

                <!-- <div class="row mt-3"> -->
                <a href="<?php echo site_url('Shifts/create') ?>" class="btn btn-success mb-4">Add</a>
                <a href="<?php echo site_url('Shifts/export') ?>" class="btn btn-info mb-4">Export</a>
                <table class="table table-bordered" id="shifts">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Id</th>
                            <th>Shift Name</th>
                            <th>Description</th>
                            <th>Login start</th>
                            <th>Login end</th>
                            <th>Grace time</th>
                            <th>Logout</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($shifts) : ?>
                            <?php foreach ($shifts as $row) : ?>
                                <tr id="<?php echo $row['shift_id']; ?>">
                                    <td>
                                        <a href="<?php echo site_url('Shifts/edit/' . $row['shift_id']); ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo site_url('Shifts/delete/' . $row['shift_id']); ?>" class="btn btn-danger"><i class="fa fa-trash remove"></i></a>
                                    </td>
                                    <td><?php echo $row['shift_id']; ?></td>
                                    <td><?php echo $row['shift_name']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo date('H:i', strtotime($row['login_start'])); ?></td>
                                    <td><?php echo date('H:i', strtotime($row['login_end'])); ?></td>
                                    <td><?php echo $row['login_grace']; ?></td>
                                    <td><?php echo date('H:i', strtotime($row['logout'])); ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>





    <script>
        $(document).ready(function() {
            $('#shifts').DataTable();
        });
    </script>

    <script>
        $(".remove").click(function() {
            var id = $(this).parents("tr").attr("id");


            if (confirm('Are you sure to remove this record?')) {
                $.ajax({
                    url: "<?php echo site_url('Shifts') ?>/" + id,
                    type: 'DELETE',
                    error: function() {
                        alert('Something is wrong');
                    },
                    success: function(data) {
                        $("#" + id).remove();
                        alert("Record removed successfully");
                    }
                });
            }
        });
    </script>
<!-- </body>

</html> -->

<?= $this->endSection() ?>