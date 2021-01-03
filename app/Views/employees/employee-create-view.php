<!DOCTYPE html>
<html>
    <head>
        <title>Codeigniter 4 Form</title>

        <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
        <script src="<?php echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

    </head>
    <body>

        <div class="container">
            <br>
            <?= \Config\Services::validation()->listErrors(); ?>

            <span class="d-none alert alert-success mb-3" id="res_message"></span>

            <div class="row">
                <div class="col-md-12">
                    <form action="<?php echo base_url('EmployeeControl/store'); ?>" name="EmployeeControl_create" id="EmployeeControl_create" method="post" accept-charset="utf-8">

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" class="form-control"  placeholder="Please enter First Name">

                        </div> 

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control"  placeholder="Please enter Last Name">

                        </div>  
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control"  placeholder="Please enter Password">

                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" class="form-control"  placeholder="Please enter mobile">

                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control"  placeholder="Please enter email">

                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control"  placeholder="Please enter address">

                        </div>
                        <label>Gender &nbsp;</label>
                        <div class="form-group form-control">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" value="Male" name="gender"
                                           >Male
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" value="Female" name="gender"
                                           >Female
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" value="Other" name="gender"
                                           >Other
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dept_id">Department Name</label>

                            <select class="form-control" name="dept_id">
                                <option value="">No Selected</option>
                                
                                <?php
                                foreach ($departments as $department) {
                                    echo "<option value='" . $department['dept_id'] . "'>" . $department['department_name'] . "</option>";
                                }
                                ?>

                            </select>
                        </div>



                        <div class="form-group">
                            <label for="desg_id">Designation Name</label>

                            <select class="form-control" name="desg_id">
                                <option value="">No Selected</option>
                                <?php
                                foreach ($designations as $designation) {
                                    echo "<option value='" . $designation['desg_id'] . "'>" . $designation['designation_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="role_id">Role Name</label>

                            <select class="form-control" name="role_id">
                                <option value="">No Selected</option>
                                <?php
                                foreach ($roles as $role) {
                                    echo "<option value='" . $role['role_id'] . "'>" . $role['role_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>

                            <select class="form-control" name="status">
                                <option value="">No Selected</option>
                                <option value="No">No</option>
                                <option value="Yes">Yes</option>
                            </select>
                        </div> 

                        <div class="form-group">
                            <button type="submit" id="send_form" class="btn btn-success">Submit</button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
        <script>
            if ($("#EmployeeControl_create").length > 0) {
                $("#EmployeeControl_create").validate({

                    rules: {
                        first_name: {
                            required: true,
                        },

                        last_name: {
                            required: true,
                        },
                        password: {
                            required: true,
                        },
                        status: {
                            required: true,
                        },
                    },
                    messages: {
                        first_name: {
                            required: "Please enter First name",
                        },
                        last_name: {
                            required: "Please enter Last name",
                        },
                        password: {
                            required: "Please enter password",
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