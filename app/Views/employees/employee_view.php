<!-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Codeigniter 4 Form</title>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php // echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php // echo base_url('assets/css/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css">

    <script src="<?php // echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
    <script src="<?php // echo base_url('assets/js/jquery.dataTables.min.js') ?>" type="text/javascript"></script>
</head>

<body> -->

<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

    <div class="container mt-5">

        <div class="row justify-content-md-center">
            <div class="col col-lg-12">
                <div class="jumbotron">
                    <p class="display-4 text-center">Employee Details</p>
                </div>

                <?php
                if (isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                }
                ?>

                <?php if (session('msg')) : ?>
                    <div class="alert alert-success alert-dismissible text-center">
                        <?= session('msg') ?>
                    </div>
                <?php endif ?>

                <!-- <div class="row mt-3"> -->
                <a href="<?php echo site_url('Employees/create') ?>" class="btn btn-success mb-4">Add</a>
                <a href="<?php echo site_url('Employees/export') ?>" class="btn btn-info mb-4">Export</a>
                <div class="table table-responsive">
                    <table class="table table-bordered" id="employee">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <!-- <th>Address</th> -->
                                <th>Gender</th>
                                <!-- <th>Photo</th> -->
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Role</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($employees) : ?>
                                <?php foreach ($employees as $employee) : ?>
                                    <tr id="<?php echo $employee['employee_id']; ?>">
                                        <td>
                                            <a href="<?php echo site_url('Employees/edit/' . $employee['employee_id']); ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                            <a href="<?php echo site_url('Employees/delete/' . $employee['employee_id']); ?>" class="btn btn-danger"><i class="fa fa-trash remove"></i></a>
                                        </td>
                                        <td><?php echo $employee['employee_id']; ?></td>
                                        <td><?php echo $employee['name']; ?></td>
                                        <td><?php echo $employee['mobile']; ?></td>
                                        <!-- <td><?php //echo $employee['address']; 
                                                    ?></td> -->
                                        <td><?php echo $employee['gender']; ?></td>
                                        <!-- <td><img src="<?php echo base_url('../public/uploads/' . $employee['photo']); ?>"></td> -->
                                        <td><?php echo $employee['department_name']; ?></td>
                                        <td><?php echo $employee['designation_name']; ?></td>
                                        <td><?php echo $employee['role_name']; ?></td>
                                        <td><?php echo $employee['status']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#employee').DataTable();
        });
    </script>

    <script>
        $(".remove").click(function() {
            var id = $(this).parents("tr").attr("id");

            if (confirm('Are you sure to remove this record?')) {
                $.ajax({
                    url: "<?php echo site_url('Employees') ?>/" + id,
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