<!-- <!DOCTYPE html>
<html>

<head>
    <title>Codeigniter 4 Form</title>

    <link href="<?php // echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    
    <link href="<?php // echo base_url('assets/css/main.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

    <script src="<?php // echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>


</head>

<body> -->
    
<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

    <div class="container">
        <br>
        <h3 class="text-center alert-info p-3">Shift Add</h3>

        <?php if (session('msg')) : ?>
            <div class="alert alert-success alert-dismissible text-center">
                <?= session('msg') ?>
            </div>
        <?php endif ?>

        <!-- <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $field => $error) : ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?> -->

        <?php helper(['form']); ?>

        <div class="row">
            <div class="col-md-12">
                <!-- <form action="<?php //echo base_url('ShiftControl/createOrUpdate'); ?>" name="OffdayControl_create" id="OffdayControl_create" method="post" accept-charset="utf-8"> -->
                <?php echo form_open(site_url('Shifts/createOrUpdate'), ['name' => 'ShiftControl_create', 'id' => 'ShiftControl_create','autocomplete'=>'off']); ?>

                <div class="form-group">
                    <label for="shift_name">Shift name</label>
                    <!-- <input type="text" name="title" class="form-control" placeholder="Please enter title"> -->
                    <?php echo form_input(['name' => 'shift_name', 'class' => 'form-control', 'value' => set_value('shift_name'), 'placeholder' => "Please enter shift name"]); ?>
                </div>

                <div class="form-group">
                    <label for="description">description</label>
                    <!-- <input type="text" name="title" class="form-control" placeholder="Please enter title"> -->
                    <?php echo form_input(['name' => 'description', 'class' => 'form-control', 'value' => set_value('description'), 'placeholder' => "Please enter description"]); ?>
                </div>

                <div class="form-group">
                    <label for="login_start">Login start</label>
                    <!-- <input type="text" name="login_start" class="form-control datetimepicker-input" id="datetimepicker1" data-toggle="datetimepicker" data-target="#datetimepicker1"/> -->
                    <!-- <?php echo form_input(['name' => 'login_start', 'value' => set_value('login_start'), 'class' => 'form-control datetimepicker-input', 'id' => "datetimepicker1", 'data-toggle' => "datetimepicker", 'data-target' => "#datetimepicker1"]); ?> -->

                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input type="text" name="login_start"  class="form-control datetimepicker-input" data-target="#datetimepicker1" />
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="login_end">Login end</label>
                    <!-- <input type="text" name="login_start" class="form-control datetimepicker-input" id="datetimepicker1" data-toggle="datetimepicker" data-target="#datetimepicker1"/> -->
                    <!-- <?php echo form_input(['name' => 'login_end', 'value' => set_value('login_end'), 'class' => 'form-control datetimepicker-input', 'id' => "datetimepicker2", 'data-toggle' => "datetimepicker", 'data-target' => "#datetimepicker2"]); ?> -->

                    <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                        <input type="text" name="login_end" class="form-control datetimepicker-input" data-target="#datetimepicker2" />
                        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="login_grace">Login grace</label>
                    <!-- <input type="text" name="title" class="form-control" placeholder="Please enter title"> -->
                    <?php echo form_input(['name' => 'login_grace', 'value' => set_value('login_grace'), 'class' => 'form-control', 'placeholder' => "Please enter login grace priod"]); ?>
                </div>

                <div class="form-group">
                    <label for="logout">logout time</label>
                    <!-- <input type="text" name="login_start" class="form-control datetimepicker-input" id="datetimepicker1" data-toggle="datetimepicker" data-target="#datetimepicker1"/> -->
                    <!-- <?php echo form_input(['name' => 'logout', 'value' => set_value('logout'), 'class' => 'form-control datetimepicker-input', 'id' => "datetimepicker3", 'data-toggle' => "datetimepicker", 'data-target' => "#datetimepicker3"]); ?> -->

                    <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                        <input type="text" name="logout" class="form-control datetimepicker-input" data-target="#datetimepicker3" />
                        <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <?php
                    $options = array(
                        'No' => 'No',
                        'Yes' => 'Yes'
                    );
                    echo form_dropdown('status', array('' => 'No Selected') + $options, '', ['class' => 'form-control']);
                    ?>

                </div>

                <div class="form-group">
                    <!-- <button type="submit" id="send_form" class="btn btn-success">Submit</button> -->
                    <?php echo form_submit(['name' => 'submit', 'value' => 'Submit', 'class' => 'btn btn-success']); ?>
                    <a href="<?php echo site_url('Shifts'); ?>" type="reset" value="reset" class="btn btn-info">Close</a>
                </div>

                <!-- </form> -->
                <?php echo form_close(); ?>
            </div>

        </div>

    </div>
    <script>
        if ($("#ShiftControl_create").length > 0) {
            $("#ShiftControl_create").validate({

                rules: {
                    shift_name: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    login_start: {
                        required: true,
                    },
                    
                    login_end: {
                        required: true,
                    },
                    login_grace: {
                        required: true,
                        number: true,
                    },
                    logout: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                },
                messages: {

                    shift_name: {
                        required: "Please enter shift name",
                    },
                    description: {
                        required: "Please enter description",
                    },
                    login_start: {
                        required: "Please enter login start",
                    },
                    login_end: {
                        required: "Please enter login start",
                    },
                    login_grace: {
                        required: "Please enter login grace time",
                    },
                    logout: {
                        required: "Please enter logout time",
                    },
                    status: {
                        required: "Please enter status",
                    },
                },
            })
        }
    </script>
    <script>
        $('#datetimepicker1').datetimepicker({
            format: 'HH:mm'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'HH:mm'
        });
        $('#datetimepicker3').datetimepicker({
            format: 'HH:mm'
        });
    </script>
<!-- </body>

</html> -->

<?= $this->endSection() ?>