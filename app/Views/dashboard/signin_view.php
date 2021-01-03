<!DOCTYPE html>
<html>

<head>
    <title>Codeigniter 4 Form</title>

    <link href="<?php echo base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/css/main.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url('public/assets/js/jquery.min.js') ?>" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

</head>



<body>
    <div class="container">
        <br>



        <div class="login">
            <!-- <h1><a href="login">Admin Access </a></h1> -->
            <div class="jumbotron">
                <p class="display-4 text-center">Login Details</p>
            </div>
            <div class="login-bottom">

                <!-- <h2>Login</h2> -->
                <?php $validation =  \Config\Services::validation(); ?>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="card-deck">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    if (isset($_SESSION['msg'])) {
                                        echo $_SESSION['msg'];
                                    }
                                    ?>

                                    <!-- <?php //if ($validation) : ?>
                                        <div class="alert alert-danger"><?php //echo $validation; ?></div>
                                    <?php// endif ?> -->

                                    <form action="<?php echo site_url('LoginControl/auth_employee'); ?>" method="post">

                                        <div class="form-group">
                                            <label for="employee_id">Employee id</label>
                                            <input name="employee_id" value="<?= old('employee_id') ?>" type="text" class="form-control" placeholder="Employee id">
                                            <!-- <i class="fa fa-envelope"></i> -->

                                            <!-- Error -->
                                            <?php if ($validation->getError('employee_id')) { ?>
                                                <div class='alert alert-danger mt-2'>
                                                    <?= $error = $validation->getError('employee_id'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input name="password" value="<?= old('password') ?>" type="password" class="form-control" placeholder="Password">
                                            <!-- <i class="fa fa-lock"></i> -->
                                            <!-- Error -->
                                            <?php if ($validation->getError('password')) { ?>
                                                <div class='alert alert-danger mt-2'>
                                                    <?= $error = $validation->getError('password'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <!-- <a class="news-letter" href="#">
                                <label class="checkbox1"><input type="checkbox" name="checkbox"><i> </i>Forget Password</label>
                            </a> -->

                                        <div class="form-group">
                                            <input type="submit" value="Login" class="btn btn-primary">
                                        </div>

                                        <!-- <p>Do not have an account?</p>
                                    <a href="signup" class="hvr-shutter-in-horizontal">Signup</a> -->


                                        <div class="clearfix"> </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
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
</body>

</html>