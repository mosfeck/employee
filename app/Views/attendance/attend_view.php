<!DOCTYPE html>
<html>

<head>
    <title>Codeigniter 4 Form</title>

    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/main.css') ?>" rel="stylesheet" type="text/css">


</head>

<style>
    .form-group {
        color: blue;
        border-bottom: 1px solid black;
    }
</style>

<body>
    <div class="container">
        <div class="jumbotron">
            <p class="display-4 text-center">Attendance Details</p>
        </div>
        <div class="login">
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <div class="card-deck">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <ul>
                                        <li><strong><a class="nav-link text-monospace" href="<?php echo site_url('Attends/login'); ?>">Signin</a></strong></li>
                                    </ul>
                                </div>
                                <!-- <hr/> -->
                                <div class="form-group">
                                    <ul>
                                        <li> <strong><a class="nav-link text-monospace" href="<?php echo site_url('Attends/logout'); ?>">Signout</a></strong></li>
                                    </ul>
                                </div>
                                <!-- <hr/> -->
                                <div class="clearfix">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </div>
</body>

</html>