<!-- <!DOCTYPE html>
<html>

<head>
    <title>Codeigniter 4 Form</title>

    <link href="<?php // echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php // echo base_url('assets/css/main.css') ?>" rel="stylesheet" type="text/css">

    <script src="<?php // echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

    <style type="text/css">
    
</style>
</head>

<body> -->


<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

    <div class="container">
        <br>
        <h3 class="text-center alert-info p-3">Employee Edit</h3>


        <div class="row">
            <div class="col-md-12">
                <!--<form action="<?php // echo base_url('EmployeeControl/update'); 
                                    ?>" name="EmployeeControl_edit" id="EmployeeControl_edit" method="post" accept-charset="utf-8">-->

                <?php echo form_open(site_url('Employees/createOrUpdate'), ['name' => 'EmployeeControl_edit', 'id' => 'EmployeeControl_edit', 'enctype' => 'multipart/form-data']); ?>

                <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                            <?php $js = 'onchange="readURL(this);"'; ?>
                            <?php echo form_input('avatar', '', $js, 'file'); ?>
                        </div>
                        <!-- <input type="file" name="avatar" id="avatar" class="form-control" onchange="readURL(this);" /> -->
                        <?php //$validationErrors(['field' => 'avatar']); 
                        ?>
                        <div class="col-md-6">
                            <img id="blah" src="#" alt="Not an image" class="imagesize" />
                        </div>
                    </div>
                </div>

                <!-- <input type="hidden" name="employee_id" class="form-control" id="id" value="<?php echo $employees['employee_id'] ?>"> -->
                <?php echo form_input(['name'=>'employee_id','value'=>set_value('employee_id', $employees['employee_id']),'class'=>'form-control','type'=>'hidden']); ?>

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <!--<input type="text" value="<?php // echo $employees['first_name'] 
                                                    ?>" name="first_name" class="form-control"  placeholder="Please enter First Name">-->
                    <?php echo form_input(['name' => 'first_name', 'class' => 'form-control', 'value' => set_value('first_name', $employees['first_name']), 'placeholder' => "Enter First Name"]); ?>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <!--<input type="text" value="<?php //echo $employees['last_name'] 
                                                    ?>"  name="last_name" class="form-control"  placeholder="Please enter Last Name">-->
                    <?php echo form_input(['name' => 'last_name', 'class' => 'form-control', 'value' => set_value('last_name', $employees['last_name']), 'placeholder' => "Enter Last Name"]); ?>
                </div>
                <!-- <div class="form-group"> -->
                    <!-- <label for="password">Password</label> -->
                    <!--<input type="password"  value="<?php //echo $employees['password'] 
                                                        ?>"  name="password" class="form-control"  placeholder="Please enter Password">-->
                    <!-- <?php //echo form_password(['name' => 'password', 'class' => 'form-control', 'value' => set_value('password', $employees['password']), 'placeholder' => "Enter password"]); ?> -->
                <!-- </div> -->
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <!--<input type="text"  value="<?php //echo $employees['mobile'] 
                                                    ?>" name="mobile" class="form-control"  placeholder="Please enter mobile">-->
                    <?php echo form_input(['name' => 'mobile', 'class' => 'form-control', 'value' => set_value('mobile', $employees['mobile']), 'placeholder' => "Enter mobile", 'maxlength' => 11]); ?>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <!--<input type="text"  value="<?php //echo $employees['email'] 
                                                    ?>" name="email" class="form-control"  placeholder="Please enter email">-->
                    <?php echo form_input(['name' => 'email', 'class' => 'form-control', 'value' => set_value('email', $employees['email']), 'placeholder' => "Enter email"]); ?>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <!--<input type="text"  value="<?php //echo $employees['address'] 
                                                    ?>" name="address" class="form-control"  placeholder="Please enter address">-->
                    <?php echo form_textarea(['name' => 'address', 'rows' => '2', 'cols' => '10', 'class' => 'form-control', 'value' => set_value('address', $employees['address']), 'placeholder' => "Enter address"]); ?>
                </div>
                <label>Gender &nbsp;</label>
                <div class="form-group form-control">
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" <?php if ($employees['gender'] == "Male") { ?> <?php echo "checked"; ?> <?php } ?> class="form-check-input" value="Male" name="gender">Male
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" <?php if ($employees['gender'] == "Female") { ?> <?php echo "checked"; ?> <?php } ?> class="form-check-input" value="Female" name="gender">Female
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                            <input type="radio" <?php if ($employees['gender'] == "Other") { ?> <?php echo "checked"; ?> <?php } ?> class="form-check-input" value="Other" name="gender">Other
                        </label>
                    </div>

                    <!--                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" value="Male" name="gender"
                                           >Male
                                    <?php // echo form_radio(['name'=>'gender','value'=>'Male','checked'=>set_checkbox($employees['gender']),'class'=>'form-check-input']);
                                    ?>Male
                                    <?php // echo form_radio('gender','Male',set_radio($employees['gender'],'Male',TRUE),['class'=>'form-check-input']);
                                    ?>Male
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" value="Female" name="gender"
                                           >Female
                                    <?php // echo form_radio('gender','Female',set_radio($employees['gender'],'Female'),['class'=>'form-check-input']);
                                    ?>Female
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" value="Other" name="gender"
                                           >Other
                                    <?php // echo form_radio('gender','Other',set_radio($employees['gender'],'Other'),['class'=>'form-check-input']);
                                    ?>Other
                                </label>
                            </div>-->

                </div>

                <div class="form-group">
                    <label for="dept_id">Department Name</label>

                    <!--                            <select class="form-control" name="dept_id" >
                                <option value="" selected><?php //echo $department['department_name']; 
                                                            ?></option>

                                <?php
                                //                                foreach ($departments as $department) {
                                //                                    if ($department->dept_id === $department->department_name) {
                                //                                        echo "<option selected = 'selected' value='" . $department['dept_id'] . "'>" . $department['department_name'] . "</option>";
                                //                                    }else{
                                //                                    echo "<option value='" . $department['dept_id'] . "'>" . $department['department_name'] . "</option>";
                                //                                    }
                                //                                }
                                ?>

                            </select>-->
                    <?php echo form_dropdown('dept_id', array('' => 'No Selected') + $departments, set_value('dept_id', $employees['dept_id']), ['class' => 'form-control']); ?>
                </div>



                <div class="form-group">
                    <label for="desg_id">Designation Name</label>

                    <!--                            <select class="form-control" name="desg_id">
                                <option value="">No Selected</option>
                                <?php
                                //                                foreach ($designations as $designation) {
                                //                                    echo "<option value='" . $designation['desg_id'] . "'>" . $designation['designation_name'] . "</option>";
                                //                                }
                                ?>
                            </select>-->
                    <?php echo form_dropdown('desg_id', array('' => 'No Selected') + $designations, set_value('desg_id', $employees['desg_id']), ['class' => 'form-control']); ?>
                </div>

                <div class="form-group">
                    <label for="role_id">Role Name</label>

                    <!--                            <select class="form-control" name="role_id">
                                <option value="">No Selected</option>
                                <?php
                                //                                foreach ($roles as $role) {
                                //                                    echo "<option value='" . $role['role_id'] . "'>" . $role['role_name'] . "</option>";
                                //                                }
                                ?>
                            </select>-->
                    <?php echo form_dropdown('role_id', array('' => 'No Selected') + $roles, set_value('role_id', $employees['role_id']), ['class' => 'form-control']); ?>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>

                    <!--                            <select class="form-control" name="status">
                                <option><?php echo $employees['status'] ?></option>
                                <option value="No">No</option>    	
                                <option value="Yes">Yes</option>
                            </select>-->
                    <?php
                    $options = array(
                        'No' => 'No',
                        'Yes' => 'Yes'
                    );
                    echo form_dropdown('status', array('' => 'No Selected') + $options, set_value('status', $employees['status']), ['class' => 'form-control']);
                    ?>

                </div>

                <div class="form-group">
                    <!--<button type="submit" id="send_form" class="btn btn-success">Submit</button>-->
                    <?php echo form_submit(['name' => 'update', 'value' => 'Submit', 'class' => 'btn btn-success']); ?>
                    <a href="<?php echo site_url('Employees'); ?>" type="reset" value="reset" class="btn btn-info">Close</a>
                </div>

                <!--</form>-->
                <?php echo form_close(); ?>
            </div>

        </div>

    </div>
    <script>
        if ($("#EmployeeControl_edit").length > 0) {
            $("#EmployeeControl_edit").validate({

                rules: {
                    first_name: {
                        required: true,
                    },

                    last_name: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 6,
                    },
                    mobile: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    address: {
                        required: true,
                    },
                    gender: {
                        required: true,
                    },
                    
                    dept_id: {
                        required: true,
                    },
                    desg_id: {
                        required: true,
                    },
                    role_id: {
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
                        required: "Please enter Password",
                    },
                    mobile: {
                        required: "Please enter Mobile",
                    },
                    email: {
                        required: "Please enter Email",
                    },
                    address: {
                        required: "Please enter Address",
                    },
                    gender: {
                        required: "Please enter Gender",
                    },
                    
                    dept_id: {
                        required: "Please enter Department name",
                    },
                    desg_id: {
                        required: "Please enter designation name",
                    },
                    role_id: {
                        required: "Please enter Role name",
                    },
                    status: {
                        required: "Please enter status",
                    },
                },
            })
        }
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(90)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
<!-- </body>

</html> -->

<?= $this->endSection() ?>