<!-- <!DOCTYPE html>
<html>

<head>
    <title>Codeigniter 4 Form</title>

    <link href="<?php // echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php // echo base_url('assets/css/main.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

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
        <h3 class="text-center alert-info p-3">Employee shift Add</h3>

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
                <!-- <form action="<?php //echo base_url('EmpShiftControl/createOrUpdate'); ?>" name="OffdayControl_create" id="OffdayControl_create" method="post" accept-charset="utf-8"> -->
                <?php echo form_open(site_url('EmpShifts/createOrUpdate'), ['name' => 'EmpShiftControl_create', 'id' => 'EmpShiftControl_create', 'autocomplete' => 'off']); ?>

                <div class="form-group">
                    <label for="dept_id">Department name</label>
                    <?php echo form_dropdown('dept_id', array('' => 'No Selected') + $departs, set_value('dept_id'),  ['class' => 'form-control', 'id' => 'department_id']); ?>
                </div>

                <!-- <div class="form-group">
                    <label for="name">Employee name</label>
                    <?php //echo form_dropdown('name', array(''=>'No Selected') + $names, set_value('name'), ['class' => 'form-control']); 
                    ?>
                </div> -->

                <!-- <div class="form-group">
                    <label for="dept_id">Department name</label>
                    <?php //echo form_input(['name' => 'dept_id', 'class' => 'form-control', 'id' => 'department_id', 'value' => set_value('dept_id'), 'placeholder' => "Please enter Department name"]); 
                    ?>
                </div> -->

                <div class="form-group">
                    <label for="employee_id">Employee Name</label>
                    <select class="form-control" name="employee_id" id="employee_id">
                        <option value="">No Selected</option>
                        <?php
                        //   foreach ($departments as $department) {
                        //    echo "<option value='" . $department['dept_id'] . "'>" . $department['department_name'] . "</option>";
                        //    }
                        ?>

                    </select>
                </div>

                <div class="form-group">
                    <label for="shift_id">Shift name</label>
                    <!-- <input type="text" name="title" class="form-control" placeholder="Please enter title"> -->
                    <?php echo form_dropdown('shift_id', array('' => 'No Selected') + $shifts, set_value('shift_id'), ['class' => 'form-control']); ?>
                </div>

                <div class="form-group">
                    <label for="from_date">From date</label>
                    <!-- <input type="text" name="login_start" class="form-control datetimepicker-input" id="datetimepicker1" data-toggle="datetimepicker" data-target="#datetimepicker1"/> -->
                    <!-- <?php //echo form_input(['name' => 'login_start', 'value' => set_value('login_start'), 'class' => 'form-control datetimepicker-input', 'id' => "datetimepicker1", 'data-toggle' => "datetimepicker", 'data-target' => "#datetimepicker1"]); 
                            ?> -->

                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input type="text" name="from_date" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="to_date">To date</label>
                    <!-- <input type="text" name="login_start" class="form-control datetimepicker-input" id="datetimepicker1" data-toggle="datetimepicker" data-target="#datetimepicker1"/> -->
                    <!-- <?php //echo form_input(['name' => 'login_start', 'value' => set_value('login_start'), 'class' => 'form-control datetimepicker-input', 'id' => "datetimepicker1", 'data-toggle' => "datetimepicker", 'data-target' => "#datetimepicker1"]); 
                            ?> -->

                    <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                        <input type="text" name="to_date" class="form-control datetimepicker-input" data-target="#datetimepicker2" />
                        <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
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
                    <a href="<?php echo site_url('EmpShifts'); ?>" type="reset" value="reset" class="btn btn-info">Close</a>
                </div>

                <!-- </form> -->
                <?php echo form_close(); ?>
            </div>

        </div>

    </div>
    <script>
        if ($("#EmpShiftControl_create").length > 0) {
            $("#EmpShiftControl_create").validate({

                rules: {
                    dept_id: {
                        required: true,
                    },
                    
                    shift_id: {
                        required: true,
                    },
                    from_date: {
                        required: true,
                    },
                    to_date: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                },
                messages: {
                    dept_id: {
                        required: "Please enter department name",
                    },
                    
                    shift_id: {
                        required: "Please enter shift name",
                    },
                    from_date: {
                        required: "Please enter from date",
                    },
                    to_date: {
                        required: "Please enter to date",
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
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD'
        });


        $('#department_id').change(function() {
            var id = $(this).val();
            
            $.ajax({
                url: "<?php echo site_url('EmpShiftControl/get_employee_name'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {

                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].employee_id + '>' + data[i].name + '</option>';
                    }
                    $('#employee_id').html(html);

                }
            });
            return false;
        });
    </script>
<!-- </body>

</html> -->
<?= $this->endSection() ?>