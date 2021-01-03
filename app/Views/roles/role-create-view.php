<!-- <!DOCTYPE html>
<html>

<head>
    <title>Codeigniter 4 Form</title>

    <link href="<?php // echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php // echo base_url('assets/css/main.css') ?>" rel="stylesheet" type="text/css">

    <script src="<?php // echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

</head>

<body> -->
    
<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

    <div class="container">
        <br>
        <h3 class="text-center alert-info p-3">User Role Add</h3>


        <?php if (session('msg')) : ?>
            <div class="alert alert-success alert-dismissible text-center">
                <?= session('msg') ?>
            </div>
        <?php endif ?>

        

        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $field => $error) : ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <?php $validation =  \Config\Services::validation(); ?>
        <div class="row">
            <div class="col-md-12">
                <form action="<?php echo site_url('Roles/createOrUpdate'); ?>" name="RoleControl_create" id="RoleControl_create" method="post" accept-charset="utf-8">

                    <div class="form-group">
                        <label for="role_name">Role Name</label>
                        <input type="text" name="role_name" class="form-control" placeholder="Please enter Role name">
                        <?php if (session('Insert')) : ?>
                            <span class="text-danger"><?= session('Insert') ?></span>
                        <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="Description">Description</label>
                        <input type="text" name="description" class="form-control" placeholder="Please enter Description">

                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <!--<input type="text" name="status" class="form-control"  placeholder="Please enter status">-->

                        <select class="form-control" name="status">
                            <option value="">No Selected</option>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>

                        </select>

                    </div>

                    <div class="form-group">
                        <button type="submit" id="send_form" class="btn btn-success">Submit</button>
                        <a href="<?php echo site_url('Roles'); ?>" type="reset" value="reset" class="btn btn-info">Close</a>
                    </div>

                </form>
            </div>

        </div>

    </div>
    <script>
        if ($("#RoleControl_create").length > 0) {
            $("#RoleControl_create").validate({

                rules: {
                    role_name: {
                        required: true,
                        minlength: 3,
                        maxlength: 20,

                    },
                    description: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                },
                messages: {
                    role_name: {
                        required: "Please enter role name",
                        // email: "Please enter a valid email address.",
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