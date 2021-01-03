<!DOCTYPE html>
<html>

<head>
    <title>Codeigniter 4 Form</title>

    <link href="<?php echo base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/css/main.css') ?>" rel="stylesheet" type="text/css">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" /> -->

    <script src="<?php echo base_url('public/assets/js/jquery.min.js') ?>" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script> -->


</head>



<body onload="myFunction()">
    <div class="container">
        <br>

        <!-- <h1><a href="login">Admin Access </a></h1> -->
        <div class="jumbotron">
            <p class="display-4 text-center">Attendance Logout</p>
        </div>
        <div class="login">

            <!-- <h2>Login</h2> -->
            <?php $validation =  \Config\Services::validation(); ?>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card-deck">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                if (isset($_SESSION['warnMsg'])) {
                                    echo $_SESSION['warnMsg'];
                                }
                                ?>

                                <?php if (session('Update')) : ?>
                                    <div class="alert alert-danger text-center"><?= session('Update') ?></div>
                                <?php endif ?>

                                <?php if (session('msg')) : ?>
                                    <div class="alert alert-success alert-dismissible text-center">
                                        <?= session('msg') ?>
                                    </div>
                                <?php endif ?>

                                <!-- <?php // if ($validation) : 
                                        ?>
                                    <div class="alert alert-danger"><?php // echo $validation; 
                                                                    ?></div>
                                <?php // endif 
                                ?> -->

                                <!-- <a href="<?php //echo base_url('AttendControl/get_data_by_id_date') 
                                                ?>" class="btn btn-success mb-4">Check</a> -->
                                <form action="<?php echo base_url('AttendControl/update'); ?>" method="post" id="attend_create">

                                    <div class="form-group">
                                        <label for="empId">Employee id</label>
                                        <input name="empId" value="<?= old('employee_id') ?>" type="text" class="form-control" id="empId" onblur="blurFunction()" placeholder="Employee id">

                                        <!-- Error -->
                                        <?php if ($validation->getError('employee_id')) { ?>
                                            <div class='alert alert-danger mt-2'>
                                                <?= $error = $validation->getError('employee_id'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input name="password" value="<?= old('password') ?>" id="password" type="password" class="form-control" placeholder="Password">

                                        <!-- Error -->
                                        <?php if ($validation->getError('password')) { ?>
                                            <div class='alert alert-danger mt-2'>
                                                <?= $error = $validation->getError('password'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="form-group">
                                        <input type="submit" value="Logout" class="btn btn-primary">
                                    </div>

                                    <!-- <p>Do not have an account?</p>
                                    <a href="signup" class="hvr-shutter-in-horizontal">Signup</a> -->


                                    <div class="clearfix"> </div>
                                    <!-- </form> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <br />
        <div class="attend">
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" id="emp_auto_id" name="emp_auto_id" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" id="over_time" value="over_time" name="over_time" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" id="status" value="Present" name="status" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="employee_id">Employee id</label>
                                <input type="text" id="employee_id" name="employee_id" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dept_id">Department id</label>
                                <input type="text" id="dept_id" name="dept_id" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="desg_id">Designation id</label>
                                <input type="text" id="desg_id" name="desg_id" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="shift_id">Shift id</label>
                                <input type="text" id="shift_id" name="shift_id" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="emp_shift_id">Employee shift id</label>
                                <input type="text" id="emp_shift_id" name="emp_shift_id" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="roster_id">Roster id</label>
                                <input type="text" id="roster_id" name="roster_id" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="roster_date">Roster date</label>
                                <input type="text" id="roster_date" name="roster_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="leave_id">Leave id</label>
                                <input type="text" id="leave_id" name="leave_id" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="leave_from_date">Leave from date</label>
                                <input type="text" id="leave_from_date" name="leave_from_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="leave_to_date">Leave to date</label>
                                <input type="text" id="leave_to_date" name="leave_to_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="login_date">Login date</label>
                                <input type="text" id="login_date" value="login_date" name="login_date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="login_time">Login time</label>
                                <input type="text" id="login_time" value="login_time" name="login_time" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="schedule_login_start">Schedule login start</label>
                                <input type="text" id="schedule_login_start" name="schedule_login_start" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="schedule_login_end">Schedule login end</label>
                                <input type="text" id="schedule_login_end" name="schedule_login_end" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="schedule_login_grace">Schedule login grace</label>
                                <input type="text" id="schedule_login_grace" name="schedule_login_grace" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="late_time">Late time</label>
                                <input type="text" id="late_time" value="late_time" name="late_time" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="schedule_logout">Schedule logout</label>
                                <input type="text" id="schedule_logout" name="schedule_logout" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="logout_time">Logout time</label>
                                <input type="text" id="logout_time" value="logout_time" name="logout_time" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="early_logout">Early logout</label>
                                <input type="text" id="early_logout" value="early_logout" name="early_logout" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="working_time">Working time</label>
                                <input type="text" id="working_time" value="working_time" name="working_time" class="form-control">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
    <script>
        function myFunction() {
            var d = new Date();

            var month = d.getMonth() + 1;
            var day = d.getDate();

            var output = d.getFullYear() + '-' +
                (('' + month).length < 2 ? '0' : '') + month + '-' +
                (('' + day).length < 2 ? '0' : '') + day;

            $('#login_date').val(output);
            console.log(output);

        }

        if ($("#attend_create").length > 0) {
            $("#attend_create").validate({

                rules: {
                    empId: {
                        required: true,
                    },

                    password: {
                        required: true,
                    },
                },
                messages: {
                    empId: {
                        required: "Please enter employee id",
                    },
                    password: {
                        required: "Please enter password",
                    },
                },
            })
        }

        function blurFunction() {
            // document.getElementById("employee_id_lostfocus").style.background = "red";


            var empId = $("#empId").val();
            // var loginDate = $("#login_date").val();
            // console.log(empId);
            var d = new Date();

            var month = d.getMonth() + 1;
            var day = d.getDate();

            var output = d.getFullYear() + '-' +
                (('' + month).length < 2 ? '0' : '') + month + '-' +
                (('' + day).length < 2 ? '0' : '') + day;
            // console.log(output);
            // $('#login_date').val(output);
            var time = d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();

            // <?php //header('Content-type: application/json'); 
                ?>

            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo base_url('AttendControl/get_data_by_id_date'); ?>/" + empId,
                // data: {
                //     employee_id: empId,
                //     login_date: loginDate
                // },
                type: "GET",
                dataType: "JSON",
                success: function(res) {
                    console.log(res);

                    $('#emp_auto_id').val(res.emp_auto_id);
                    $('#employee_id').val(res.employee_id);
                    $('#name').val(res.name);
                    $('#dept_id').val(res.dept_id);
                    $('#desg_id').val(res.desg_id);
                    $('#desg_id').val(res.desg_id);
                    $('#shift_id').val(res.shift_id);
                    $('#emp_shift_id').val(res.emp_shift_id);
                    $('#roster_id').val(res.roster_id);
                    $('#roster_date').val(res.roster_date);
                    $('#leave_id').val(res.leave_id);
                    $('#leave_from_date').val(res.leave_from_date);
                    $('#leave_to_date').val(res.leave_to_date);
                    // $('#login_date').val(res.login_date);

                    $('#login_time').val(res.login_time);
                    $('#schedule_login_start').val(res.schedule_login_start);
                    $('#schedule_login_end').val(res.schedule_login_end);
                    $('#schedule_login_grace').val(res.schedule_login_grace);
                    $('#late_time').val(res.late_time);
                    $('#schedule_logout').val(res.schedule_logout);
                    $('#status').val(res.status);
                    // $('#logout_time').val(res.logout_time);
                    // $('#early_logout').val(res.early_logout);
                    // $('#working_time').val(res.working_time);



                    // if ($('#logout_time').val()) {
                    //     $('#logout_time').val(time);
                    // }

                    $('#logout_time').val(output + " " + time);

                    // var lateTime = $('#login_time').val(output + " " + time) - $('#schedule_login_start').val(res.schedule_login_start);
                    // console.log(lateTime);
                    // $('#late_time').val(lateTime);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    alert('Error getting data from ajax');
                }
            });
            // $('#login_date').datetimepicker({
            //     defaultDate: new Date()
            // });

        }

        $("#password").blur(function() {
            // var date1 = new Date($('#d1').val() + " " + $('#t1').val()).getTime();
            // var date2 = new Date($('#d2').val() + " " + $('#t2').val()).getTime();

            // logout time
            var logoutVal = $('#logout_time').val();
            // console.log(logoutVal);
            // var logoutTime = new Date($('#login_date').val() + " " + logoutVal).getTime();
            var logoutTime = new Date(logoutVal).getTime();
            // console.log(logoutTime);

            // schedule logout time
            var shelogoutVal = $('#schedule_logout').val();
            // console.log(shelogoutVal);
            // convert to date
            var shelogoutTime = new Date($('#login_date').val() + " " + shelogoutVal).getTime();
            // console.log(sheloginTime);



            var loginVal = $('#login_time').val();
            // console.log(loginVal);
            var loginTime = new Date(loginVal).getTime();
            // console.log(loginTime);

            // var lateTime = new Date();
            // var lateTimeDif = new Date();
            // var lateTimeDif = loginTime - sheloginTime;
            // lateTime.setTime(lateTimeDif);
            // console.log(lateTime);

            // console.log( "In minutes: ", mins + " minutes");
            // mins = mins % 60;
            // console.log( "In hours: ", hrs + " hours, " + mins + " minutes");
            // hrs = hrs % 24;
            // console.log( "In days: ", days + " days, " + hrs + " hours, " + mins + " minutes");
            // days = days % 365;
            // console.log( "In years: ", yrs + " years " + days + " days ");

            if (shelogoutTime > logoutTime) {
                var msec = shelogoutTime - logoutTime;
                var mins = Math.floor(msec / 60000);
                var hrs = Math.floor(mins / 60);
                var days = Math.floor(hrs / 24);
                var yrs = Math.floor(days / 365);
                mins = mins % 60;
                // console.log("In hours: ", hrs + " hours, " + mins + " minutes");
                $('#early_logout').val(hrs + ":" + mins + ":00");
            }

            // if logoutTime > loginTime then calculate total working time
            if (logoutTime > loginTime) {
                var msec = logoutTime - loginTime;
                var mins = Math.floor(msec / 60000);
                var hrs = Math.floor(mins / 60);
                var days = Math.floor(hrs / 24);
                var yrs = Math.floor(days / 365);
                mins = mins % 60;
                // assign in working time
                $('#working_time').val(hrs + ":" + mins + ":00");
            }

            // if logoutTime - loginTime > 8 then calculate overtime
            var msec = logoutTime - loginTime;
            var mins = Math.floor(msec / 60000);
            var hrs = Math.floor(mins / 60);
            if (hrs > 8) {
                hrs = hrs - 8;
                var days = Math.floor(hrs / 24);
                var yrs = Math.floor(days / 365);
                mins = mins % 60;
                // assign in over time
                $('#over_time').val(hrs + ":" + mins + ":00");
            }

        });
    </script>
</body>

</html>