<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

    <div class="container mt-5">
        

        <div class="row justify-content-md-center">
            <div class="col col-lg-12">
                <div class="jumbotron">
                    <p class="display-4 text-center">Department Details</p>
                </div>

                <?php if (session('msg')) : ?>
                    <div class="alert alert-success alert-dismissible text-center">
                        <?= session('msg') ?>
                    </div>
                <?php endif ?>

                <!-- <div class="row mt-3"> -->
                <a href="<?php echo site_url('Departs/create') ?>" class="btn btn-success mb-4">Add</a>
                <a href="<?php echo site_url('Departs/export') ?>" class="btn btn-info mb-4">Export</a>
                <table class="table table-bordered" id="depart">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Id</th>
                            <th>Department name</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($departs) : ?>
                            <?php foreach ($departs as $depart) : ?>
                                <tr id="<?php echo $depart['dept_id']; ?>">
                                    <td>
                                        <a href="<?php echo site_url('Departs/edit/' . $depart['dept_id']); ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                        <a href="<?php echo site_url('Departs/delete/' . $depart['dept_id']); ?>" class="btn btn-danger"><i class="fa fa-trash remove"></i></a>
                                    </td>
                                    <td><?php echo $depart['dept_id']; ?></td>
                                    <td><?php echo $depart['department_name']; ?></td>
                                    <td><?php echo $depart['description']; ?></td>
                                    <td><?php echo $depart['status']; ?></td>
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
            $('#depart').DataTable();
        });
    </script>

    <script>
        $(".remove").click(function() {
            var id = $(this).parents("tr").attr("id");


            if (confirm('Are you sure to remove this record?')) {
                $.ajax({
                    url: "<?php echo site_url('Departs') ?>/" + id,
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
    
<?= $this->endSection() ?>