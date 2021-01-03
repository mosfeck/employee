<!-- <!DOCTYPE html>
<html>

<head>
    <title>Codeigniter 4 Form</title>

    <link href="<?php // echo base_url('assets/css/bootstrap.min.css') 
                ?>" rel="stylesheet" type="text/css">
    <link href="<?php // echo base_url('assets/css/main.css') 
                ?>" rel="stylesheet" type="text/css">
    
    <script src="<?php // echo base_url('assets/js/jquery.min.js') 
                    ?>" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

</head>


<body> -->

<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

<div class="container">
    <br>
    <h3 class="text-center alert-info p-3">Department Edit</h3>



    <!-- <p><?php
            //testing 1
            if (isset($data)) {
                var_dump($data);
            }

            //testing 2
            if (isset($data)) {
                echo 'Trying to display:' . $data . ' yes?';
            } else {
                echo 'No data found';
            } ?> </p> -->

    <?php $validation =  \Config\Services::validation(); ?>

    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo site_url('Departs/createOrUpdate'); ?>" name="DepartControl_edit" id="DepartControl_edit1" method="post" accept-charset="utf-8">

                <input type="hidden" name="dept_id" class="form-control" id="id" value="<?php echo $departs['dept_id'] ?>">

                <div class="form-group">
                    <label for="department_name">Department Name</label>
                    <input type="text" value="<?php echo old('department_name', $departs['department_name']); ?>" name="department_name" class="form-control" placeholder="Please enter Department name">

                    <!-- Error -->
                    <?php if ($validation->getError('department_name')) { ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('department_name'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label for="Description">Description</label>
                    <input type="text" value="<?php echo old('description',$departs['description']); ?>" name="description" class="form-control" placeholder="Please enter Description">

                    <!-- Error -->
                    <?php if ($validation->getError('description')) { ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('description'); ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <!--<input type="text"  value="<?php // echo $departs['status'] ?>" name="status" class="form-control"  placeholder="Please enter status">-->
                    <select class="form-control" name="status">
                        <option><?php echo old('status',$departs['status']); ?></option>
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>

                    <!-- Error -->
                    <?php if ($validation->getError('status')) { ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('status'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <button type="submit" id="send_form" class="btn btn-success">Submit</button>
                    <a href="<?php echo site_url('Departs'); ?>" type="reset" value="reset" class="btn btn-info">Close</a>
                </div>

            </form>
        </div>

    </div>

</div>
<script>
    if ($("#DepartControl_edit").length > 0) {
        $("#DepartControl_edit").validate({

            rules: {
                department_name: {
                    required: true,
                },

                description: {
                    required: true,
                },
                status: {
                    required: true,
                },
            },
            messages: {

                department_name: {
                    required: "Please enter department name",
                },
                description: {
                    required: "Please enter description",
                },
                status: {
                    required: "Please enter status",
                },
            },
        })
    }
</script>
<!-- </body>

</html> -->

<?= $this->endSection() ?>