<!-- <!DOCTYPE html>
<html>

<head>
    <title>Codeigniter 4 Form</title>

    <link href="<?php // echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php // echo base_url('assets/css/main.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" />

    <script src="<?php // echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
</head>


<body> -->
    
<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

    <div class="container">
        <br>
        <h3 class="text-center alert-info p-3">Offday Edit</h3>
        

        <?php helper(['form']) ?>

        <div class="row">
            <div class="col-md-12">
                
                <?php echo form_open(site_url('Offdays/createOrUpdate'), ['name' => 'OffdayControl_edit', 'id' => 'OffdayControl_edit']) ?>

                <?php echo form_input(['name' => 'id', 'value' =>  set_value('id', $offdays['id']), 'class' => 'form-control', 'type' => 'hidden' ]) ?>

                <div class="form-group">
                    <label for="title">Title</label>
                    <?php echo form_input(['name' => 'title', 'class' => 'form-control', 'value' =>  set_value('title', $offdays['title']), 'placeholder' => 'Please enter title']) ?>
                </div>

                <div class="form-group">
                    <label for="title_type">Title type</label>
                    <?php
                    $types = array(
                        'Annual' => 'Annual',
                        'Casual' => 'Casual',
                        'Government' => 'Government',
                        'Others' => 'Others',
                        'Weekend' => 'Weekend'
                    );
                    echo form_dropdown('title_type', array('' => 'No Selected') + $types, set_value('title_type', $offdays['title_type']), ['class' => 'form-control']);
                    ?>
                </div>

                <div class="form-group">
                    <label for="cur_date">Date</label>
                    <!-- <?php // echo form_input(['name' => 'cur_date', 'data-date-format' => 'yyyy-mm-dd', 'class' => 'form-control', 'value' => set_value('cur_date', $offdays['cur_date']), 'id' => "datepicker"]); ?> -->
                    
                    <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input type="text" value="<?php echo $offdays['cur_date'] ?>" name="cur_date" class="form-control datetimepicker-input" data-target="#datetimepicker1" />
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
                    echo form_dropdown('status', array('' => 'No Selected') + $options, set_value('status', $offdays['status']), ['class' => 'form-control']);
                    ?>
                </div>

                <div class="form-group">
                <?php echo form_submit(['name' => 'submit', 'value' => 'Submit', 'class' => 'btn btn-success']); ?>
                    <a href="<?php echo site_url('Offdays'); ?>" type="reset" value="reset" class="btn btn-info">Close</a>
                </div>

                <?php echo form_close(); ?>
            </div>

        </div>

    </div>
    <script>
        if ($("#OffdayControl_edit").length > 0) {
            $("#OffdayControl_edit").validate({

                rules: {
                    title: {
                        required: true,
                    },
                    title_type: {
                        required: true,
                    },
                    cur_date: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                },
                messages: {

                    title: {
                        required: "Please enter title",
                    },
                    title_type: {
                        required: "Please enter title type",
                    },
                    cur_date: {
                        required: "Please enter date",
                    },
                    status: {
                        required: "Please enter status",
                    },
                },
            })
        }

        // $('#datepicker').datepicker({
        //     weekStart: 1,
        //     daysOfWeekHighlighted: "6,0",
        //     autoclose: true,
        //     todayHighlight: true,
        // });

        // // $('#datepicker').datepicker("setDate", new Date());

        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    </script>
<!-- </body>

</html> -->

<?= $this->endSection() ?>