<!-- <!DOCTYPE html>
<html>

<head>
    <title>Codeigniter 4 Form</title>

    <link href="<?php // echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php // echo base_url('assets/css/main.css') ?>" rel="stylesheet" type="text/css">
    

    <link href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <script src="<?php // echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js" type="text/javascript"></script>
</head>


<body> -->

<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

    <div class="container">
        <br>
        <h3 class="text-center alert-info p-3">Shift Edit</h3>

        

        <?php helper(['form']) ?>

        <div class="row">
            <div class="col-md-12">

                <?php echo form_open(site_url('Shifts/createOrUpdate'), ['name' => 'ShiftControl_edit', 'id' => 'ShiftControl_edit']) ?>

                <?php echo form_input(['name' => 'shift_id', 'value' =>  set_value('shift_id', $shifts['shift_id']), 'class' => 'form-control', 'type' => 'hidden']) ?>

                <div class="form-group">
                    <label for="shift_name">Shift name</label>
                    <?php echo form_input(['name' => 'shift_name', 'value' =>  set_value('shift_name', $shifts['shift_name']), 'class' => 'form-control', 'placeholder' => 'Please enter Shift name']) ?>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <?php echo form_input(['name' => 'description', 'value' => set_value('description', $shifts['description']), 'class' => 'form-control', 'placeholder' => "Please enter description"]); ?>
                </div>

                <div class="form-group">
                    <label for="login_start">Login start</label>
                    <!-- <?php // echo form_input(['name' => 'login_start', 'value' => set_value('login_start', $shifts['login_start']), 'class' => 'form-control datetimepicker-input', 'id' => "datetimepicker1", 'data-toggle' => "datetimepicker", 'data-target' => "#datetimepicker1"]);  ?> -->

                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input type="text" name="login_start" value="<?php echo $shifts['login_start']; ?>"  class="form-control datetimepicker-input" data-target="#datetimepicker1" />
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="login_end">Login end</label>
                    <!-- <?php echo form_input(['name' => 'login_end', 'value' => set_value('login_end', $shifts['login_end']), 'class' => 'date form-control datetimepicker-input', 'id' => "datetimepicker2", 'data-toggle' => "datetimepicker",  'data-target-input'=>"nearest", 'data-target' => "#datetimepicker2"]); ?> -->

                    <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                        <input type="text" name="login_end" value="<?php echo $shifts['login_end']; ?>"  class="form-control datetimepicker-input" data-target="#datetimepicker2" />
                        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="login_grace">Login grace</label>
                    <?php echo form_input(['name' => 'login_grace', 'value' => set_value('login_grace', $shifts['login_grace']), 'class' => 'form-control', 'placeholder' => "Please enter login grace priod"]); ?>
                </div>

                <div class="form-group">
                    <label for="logout">logout time</label>
                    <!-- <?php echo form_input(['name' => 'logout', 'value' => set_value('logout', $shifts['logout']), 'class' => 'form-control datetimepicker-input', 'id' => "datetimepicker3", 'data-toggle' => "datetimepicker", 'data-target' => "#datetimepicker3"]); ?> -->

                    <div class="input-group date" id="datetimepicker3" data-target-input="nearest">
                        <input type="text" name="logout" value="<?php echo $shifts['logout']; ?>"  class="form-control datetimepicker-input" data-target="#datetimepicker3" />
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
                    echo form_dropdown('status', array('' => 'No Selected') + $options, set_value('status', $shifts['status']), ['class' => 'form-control']);
                    ?>
                </div>

                <div class="form-group">
                    <?php echo form_submit(['name' => 'submit', 'value' => 'Submit', 'class' => 'btn btn-success']); ?>
                    <a href="<?php echo site_url('Shifts'); ?>" type="reset" value="reset" class="btn btn-info">Close</a>
                </div>

                <?php echo form_close(); ?>
            </div>

        </div>

    </div>
    <script>
        if ($("#ShiftControl_edit").length > 0) {
            $("#ShiftControl_edit").validate({

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