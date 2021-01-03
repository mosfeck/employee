<!DOCTYPE html>
<html>

<head>
    <title>Codeigniter 4 Report</title>

    <link href="<?php echo base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('public/assets/css/main.css') ?>" rel="stylesheet" type="text/css">
    
    <script src="<?php echo base_url('public/assets/js/jquery.min.js') ?>" type="text/javascript"></script>
    

</head>



<body>





<div class="container">


    <div class="row justify-content-md-center">
        <div class="col col-lg-12">
           
            <hr />
            
            <table class="table table-bordered" id="attendDetails">
                <thead>
                    <tr>

                        <th>Login time</th>
                        <th>Logout time</th>
                        <th>Shift duration</th>
                        <th>Late time</th>
                        <th>Over time</th>
                        <th>Working time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($AttendDetails) > 0) : ?>
                        <?php foreach ($AttendDetails as $row) : ?>

                            <tr>
                                <td><?php echo $row['login_time']; ?></td>
                                <td><?php echo $row['logout_time']; ?></td>
                                <td><?php echo $row['shift_duration']; ?></td>
                                <td><?php echo $row['late_time']; ?></td>
                                <td><?php echo $row['over_time']; ?></td>
                                <td><?php echo $row['working_time']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="4">No data found.</td>
                        </tr>
                    <?php endif ?>

                </tbody>
            </table>
            

        </div>
    </div>
</div>





<script>
    $(document).ready(function() {
        $('#attendDetails').DataTable();
    });

</script>

</body>

</html>



