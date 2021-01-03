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
        <h3 class="text-center alert-info p-3">User Role Edit</h3>

        

        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $field => $error) : ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <div class="row">
            <div class="col-md-12">
                <form action="<?php echo site_url('Roles/createOrUpdate'); ?>" name="RoleControl_edit" id="RoleControl_edit" method="post" accept-charset="utf-8">

                    <input type="hidden" name="role_id" class="form-control" id="id" value="<?php echo $roles['role_id'] ?>">

                    <div class="form-group">
                        <label for="role_name">Role Name</label>
                        <input type="text" value="<?php echo $roles['role_name'] ?>" name="role_name" class="form-control" placeholder="Please enter Role name">
                        
                    </div>

                    <div class="form-group">
                        <label for="Description">Description</label>
                        <input type="text" value="<?php echo $roles['description'] ?>" name="description" class="form-control" placeholder="Please enter Description">

                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <!--<input type="text"  value="<?php echo $roles['status'] ?>" name="status" class="form-control"  placeholder="Please enter status">-->
                        <select class="form-control" name="status">
                            <option><?php echo $roles['status'] ?></option>
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
        if ($("#RoleControl_edit").length > 0) {
            $("#RoleControl_edit").validate({

                rules: {
                    role_name: {
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

                    role_name: {
                        required: "Please enter role name",
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