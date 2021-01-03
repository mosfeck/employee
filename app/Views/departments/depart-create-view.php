<!-- <!DOCTYPE html>
<html>

<head>
    <title>Codeigniter 4 Form</title>

    <link href="<?php //echo base_url('assets/css/bootstrap.min.css') 
                ?>" rel="stylesheet" type="text/css">
    <link href="<?php //echo base_url('assets/css/main.css') 
                ?>" rel="stylesheet" type="text/css">

    <script src="<?php //echo base_url('assets/js/jquery.min.js') 
                    ?>" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

</head>

<body> -->

<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

<div class="container">
    <br>
    <h3 class="text-center alert-info p-3">Department Add</h3>

    <!-- <?php // if ($Insert) : 
            ?>
            <h3 class="alert alert-success"><?php // echo $Insert; 
                                            ?></h3>
        <?php // endif 
        ?> -->

    <!-- <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $field => $error) : ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?> -->

    <?php if (session('msg')) : ?>
        <div class="alert alert-success alert-dismissible text-center">
            <?= session('msg') ?>
        </div>
    <?php endif ?>

    <?php $validation =  \Config\Services::validation(); ?>

    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo site_url('Departs/createOrUpdate'); ?>" name="DepartControl_create" id="DepartControl_create1" method="post" accept-charset="utf-8">

                <div class="form-group">
                    <label for="department_name">Department Name</label>
                    <input type="text" name="department_name"  value="<?= old('department_name') ?>" class="form-control" placeholder="Please enter Department name">
                    <!-- <br/> -->
                    <?php if (session('Insert')) : ?>
                        <span class="text-danger"><?= session('Insert') ?></span>
                    <?php endif ?>

                    <!-- Error -->
                    <?php if ($validation->getError('department_name')) { ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('department_name'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="form-group">
                    <label for="Description">Description</label>
                    <input type="text" name="description" value="<?= old('description') ?>"  class="form-control" placeholder="Please enter Description">

                    <!-- Error -->
                    <?php if ($validation->getError('description')) { ?>
                        <div class='alert alert-danger mt-2'>
                            <?= $error = $validation->getError('description'); ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <!--<input type="text" name="status" class="form-control"  placeholder="Please enter status">-->

                    <select class="form-control" name="status">
                        <option value="">No Selected</option>
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
    if ($("#DepartControl_create").length > 0) {
        $("#DepartControl_create").validate({

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