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
        <h3 class="text-center alert-info p-3">Leave Edit</h3>
        <?php helper(['form', 'url']); ?>

        <div class="row">
            <div class="col-md-12">
                
                <!-- <div class="jumbotron">
                    <p class="display-3 text-center">Leave Details</p>
                </div> -->
                <?php echo form_open(site_url('Leaves/createOrUpdate'), ['id' => 'leave_edit', 'autocomplete' => 'off']); ?>

                <?php echo form_input(['name'=>'leave_id','value'=>set_value('leave_id', $leaves['leave_id']),'class'=>'form-control','type'=>'hidden']) ?>

                <div class="form-group">
                    <label for="dept_id">Department name</label>
                    <?php echo form_dropdown('dept_id', array('' => 'No Selected') + $departs, set_value('dept_id', $leaves['dept_id']), ['class' => 'form-control', 'id' => 'department_id']); ?>
                </div>

                <div class="form-group">
                    <label for="employee_id">Employee Name</label>
                    <select class="form-control" name="employee_id" id="employee_id">
                        <option value="">No Selected</option>

                    </select>
                </div>

                <div class="form-group">
                    <label for="leave_type">Leave type</label>
                    <?php
                    $leaveType = [
                        'Casual' => 'Casual',
                        'Earn' => 'Earn',
                        'Medical' => 'Medical'
                    ];
                    echo form_dropdown('leave_type', array(''=>'No Selected')+$leaveType, set_value('leave_type', $leaves['leave_type']), ['class'=>'form-control']);
                    ?>
                </div>

                <div class="form-group">
                    <label for="reason">Reason</label>
                    <?php echo form_input(['name'=>'reason', 'value'=>set_value('reason',$leaves['reason']), 'class'=>'form-control', 'placeholder'=>'Please enter reason']); ?>
                </div>

                <div class="form-group">
                    <label for="from_date">From date</label>
                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input name="from_date" value="<?php echo $leaves['from_date']; ?>" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="to_date">To date</label>
                    <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                        <input type="text" name="to_date" value="<?php echo $leaves['to_date']; ?>" class="form-control datetimepicker-input" data-target="#datetimepicker2" />
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
                    echo form_dropdown('status', array('' => 'No Selected') + $options, set_value('status', $leaves['status']), ['class' => 'form-control']);
                    ?>
                </div>

                <div class="form-group">
                    <?php echo form_submit(['name'=>'submit','value'=>'Submit','class'=>'btn btn-success']); ?>
                    <a href="<?php echo site_url('Leaves'); ?>" type="reset" value="reset" class="btn btn-info">Close</a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <script>
        if ($("#leave_edit").length > 0) {
            $("#leave_edit").validate({

                rules: {
                    dept_id: {
                        required: true,
                    },

                    leave_type: {
                        required: true,
                    },
                    reason: {
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

                    leave_type: {
                        required: "Please enter leave type",
                    },
                    reason: {
                        required: "Please enter reason",
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

        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD'
        });


        $('#department_id').change(function() {
            var id = $(this).val();
            var employee_id = "<?php echo $leaves['employee_id'];?>";
            $.ajax({
                url: "<?php echo site_url('LeaveControl/get_employee_name'); ?>",
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