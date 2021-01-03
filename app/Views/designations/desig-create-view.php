<!-- <!DOCTYPE html>
<html>

<head>
    <title>Codeigniter 4 Form</title>

    <link href="<?php // echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php // echo base_url('assets/css/main.css') ?>" rel="stylesheet" type="text/css">
    
    <script src="<?php // echo base_url('assets/js/jquery.min.js') ?>" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

</head>


<body> -->
    
<?= $this->extend('layouts/layout') ?>

<?= $this->section('content') ?>

    <div class="container">
        <br>
        <h3 class="text-center alert-info p-3">Designation Add</h3>
        <!-- <?php // if ($Insert) : ?>
            <h3 class="alert alert-success"><?php // echo $Insert; ?></h3>
        <?php // endif ?> -->

        <?php $validation =  \Config\Services::validation(); ?>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $field => $error) : ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <?php if (session('msg')) : ?>
            <div class="alert alert-success alert-dismissible text-center">
                <?= session('msg') ?>
            </div>
        <?php endif ?>

        <div class="row">
            <div class="col-md-12">
                <form action="<?php echo site_url('Desigs/createOrUpdate'); ?>" name="DesigControl_create" id="DesigControl_create" method="post" accept-charset="utf-8">

                    <div class="form-group">
                        <label for="designation_name">Designation Name</label>
                        <input type="text" name="designation_name" class="form-control" placeholder="Please enter Designation name">
                        <!-- <br/> -->
                        <?php if (session('Insert')) : ?>
                        <span class="text-danger"><?= session('Insert') ?></span>
                    <?php endif ?>
                    </div>

                    <div class="form-group">
                        <label for="Description">Description</label>
                        <input type="text" name="description" class="form-control" placeholder="Please enter Description">

                    </div>

                    <div class="form-group">
                        <label for="weight">Weight</label>

                        <select class="form-control" name="weight">
                            <option value="">No Selected</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
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
                        <a href="<?php echo site_url('Desigs'); ?>" type="reset" value="reset" class="btn btn-info">Close</a>
                    </div>

                </form>
            </div>

        </div>

    </div>
    <script>
        if ($("#DesigControl_create").length > 0) {
            $("#DesigControl_create").validate({

                rules: {
                    designation_name: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },
                    weight: {
                        required: true,
                    },
                    
                    status: {
                        required: true,
                    },
                },
                messages: {

                    designation_name: {
                        required: "Please enter department name",
                    },
                    description: {
                        required: "Please enter description",
                    },
                    weight: {
                        required: "Please enter weight",
                    },
                    status: {
                        required: "Please enter status",
                    },
                },
            })
        }
    </script>
<!-- </body>

</html> -->
<?= $this->endSection() ?>