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
        <h3 class="text-center alert-info p-3">Roster Edit</h3>
        
        <?php helper(['form']) ?>

        <div class="row">
            <div class="col-md-12">

                <?php echo form_open(site_url('Rosters/createOrUpdate'), ['name' => 'RosterControl_edit', 'id' => 'RosterControl_edit']) ?>

                <?php echo form_input(['name' => 'roster_id', 'value' =>  set_value('roster_id', $rosters['roster_id']), 'class' => 'form-control', 'type' => 'hidden']) ?>

                <div class="form-group">
                    <label for="dept_id">Department name</label>
                    <?php echo form_dropdown('dept_id', array('' => 'No Selected') + $departs, set_value('dept_id', $rosters['dept_id']), ['class' => 'form-control', 'id' => 'department_id']); ?>
                </div>

                <div class="form-group">
                    <label for="employee_id">Employee Name</label>
                    <select class="form-control" name="employee_id" id="employee_id">
                        <option value="">No Selected</option>

                    </select>
                </div>

                <div class="form-group">
                    <label for="shift_id">Shift name</label>
                    <?php echo form_dropdown('shift_id', array('' => 'No Selected') + $shifts, set_value('shift_id', $rosters['shift_id']), ['class' => 'form-control']); ?>
                </div>

                <div class="form-group">
                    <label for="roster_date">From date</label>
                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input type="text" name="roster_date" value="<?php echo $rosters['roster_date'] ?>" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
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
                    echo form_dropdown('status', array('' => 'No Selected') + $options, set_value('status', $rosters['status']), ['class' => 'form-control']);
                    ?>
                </div>

                <div class="form-group">
                    <!-- <button type="submit" id="send_form" class="btn btn-success">Submit</button> -->
                    <?php echo form_submit(['name' => 'submit', 'value' => 'Submit', 'class' => 'btn btn-success']); ?>
                    <a href="<?php echo site_url('Rosters'); ?>" type="reset" value="reset" class="btn btn-info">Close</a>
                </div>

                <?php echo form_close(); ?>
            </div>

        </div>

    </div>
    
    <script>
        if ($("#RosterControl_edit").length > 0) {
            $("#RosterControl_edit").validate({

                rules: {
                    dept_id: {
                        required: true,
                    },
                    
                    shift_id: {
                        required: true,
                    },
                    roster_date: {
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
                    roster_date: {
                        required: "Please enter roster date",
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
            var employee_id = "<?php echo $rosters['employee_id'];?>";
            $.ajax({
                url: "<?php echo site_url('RosterControl/get_employee_name'); ?>",
                method: "POST",
                data: {
                    id: id
                },
                async: true,
                dataType: 'json',
                success: function(data) {

                    $('select[name="employee_id"]').empty();

                        $.each(data, function(key, value) {
                            if(employee_id==value.employee_id){
                                $('select[name="employee_id"]').append('<option value="'+ value.employee_id +'" selected>'+ value.name +'</option>').trigger('change');
                            }else{
                                $('select[name="employee_id"]').append('<option value="'+ value.employee_id +'">'+ value.name +'</option>');
                            }
                        });

                }
            });
            return false;
        });
    </script>
<!-- </body>

</html> -->
<?= $this->endSection() ?>