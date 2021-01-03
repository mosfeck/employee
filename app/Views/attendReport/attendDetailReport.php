<?= $this->extend('layouts/layout') ?>
<?= $this->section('content') ?>

<!-- <body onload="myFunction()"> -->
    <div class="container mt-3">


        <div class="row justify-content-md-center">
            <div class="col col-lg-12">
                <h3 class="">Attandance Details Report</h3>
                <hr />

                <?php if (session('msg')) : ?>
                    <div class="alert alert-success alert-dismissible text-center">
                        <?= session('msg') ?>
                    </div>
                <?php endif ?>

                <!-- <div class="row"> -->
                <form action="<?php echo site_url('AttendDetailControl/AttendDetailsReport') ?>" class="form-inline" method="post" accept-charset="utf-8">
                    <div class="col-md-3">
                        <input type="text" name="startDate" class="form-control datetimepicker-input" id="datetimepicker1" data-toggle="datetimepicker" data-target="#datetimepicker1" />
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="endDate" class="form-control datetimepicker-input" id="datetimepicker2" data-toggle="datetimepicker" data-target="#datetimepicker2" />
                    </div>
                    <div class="col-md-3">
                        <button type="submit" id="search_form" class="btn btn-success">Search</button>
                    </div>
                </form>
                <!-- </div> -->
                <hr />
                <form class="form-inline">

                    <?php if (count($empData) > 0) : ?>
                        <?php foreach ($empData as $row) : ?>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Employee ID: </label>
                                    <span class="pl-1"><?php echo $row['employee_id'] ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Name: </label>
                                    <span class="pl-1"><?php echo $row['name'] ?></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Department: </label>
                                    <span class="pl-1"><?php echo $row['department_name'] ?></span>
                                </div>
                            </div>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>
        <hr />
        


            </div>
        </div>
    </div>





    <script>
        // function myFunction() {
        //     $("#attendDetails").hide();
        // }

        // $('#search_form').on('submit', function() {
        //     $("#attendDetails").show();
        // });

        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    </script>

<!-- </body> -->
<?= $this->endSection() ?>