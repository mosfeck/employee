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
                    <form action="<?php echo base_url('EmployeeControl/update'); ?>" name="EmployeeControl_edit" id="EmployeeControl_edit" method="post" accept-charset="utf-8">

                        <input type="hidden" name="employee_id" class="form-control" id="id" value="<?php echo $employees['employee_id'] ?>">

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" value="<?php echo $employees['first_name'] ?>" name="first_name" class="form-control"  placeholder="Please enter First Name">

                        </div> 

                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" value="<?php echo $employees['last_name'] ?>"  name="last_name" class="form-control"  placeholder="Please enter Last Name">

                        </div>  
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password"  value="<?php echo $employees['password'] ?>"  name="password" class="form-control"  placeholder="Please enter Password">

                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text"  value="<?php echo $employees['mobile'] ?>" name="mobile" class="form-control"  placeholder="Please enter mobile">

                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text"  value="<?php echo $employees['email'] ?>" name="email" class="form-control"  placeholder="Please enter email">

                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text"  value="<?php echo $employees['address'] ?>" name="address" class="form-control"  placeholder="Please enter address">

                        </div>
                        <label>Gender &nbsp;</label>
                        <div class="form-group form-control">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" <?php if ($employees['gender'] == "Male") { ?> <?php echo "checked"; ?> <?php } ?> class="form-check-input" value="Male" name="gender"
                                           >Male
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" <?php if ($employees['gender'] == "Female") { ?> <?php echo "checked"; ?> <?php } ?>  class="form-check-input" value="Female" name="gender"
                                           >Female
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" <?php if ($employees['gender'] == "Other") { ?> <?php echo "checked"; ?> <?php } ?>  class="form-check-input" value="Other" name="gender"
                                           >Other
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dept_id">Department Name</label>

                            <select class="form-control" name="dept_id" >
                                <option value="" selected><?php //echo $department['department_name']; ?></option>

                                <?php
                                foreach ($departments as $department) {
                                    if ($department->department_name === $department->dept_id) {
                                        echo "<option selected = 'selected' value='" . $department['dept_id'] . "'>" . $department['department_name'] . "</option>";
                                    }else{
                                    echo "<option value='" . $department['dept_id'] . "'>" . $department['department_name'] . "</option>";
                                    }
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
                                <option><?php echo $employees['status'] ?></option>
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
            if ($("#EmployeeControl_edit").length > 0) {
                $("#EmployeeControl_edit").validate({

                    rules: {
                        department_name: {
                            required: true,
                        },

                        description: {
                            required: true,
                        },
                        status: {
                            required: true,
                        },
                    },
                    messages: {

                        department_name: {
                            required: "Please enter department name",
                        },
                        description: {
                            required: "Please enter description",
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