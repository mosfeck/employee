<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Codeigniter 4 Form</title>

        
        <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
        
    </head>

    <body>
<?php $session = \Config\Services::session(); ?>
<nav class="navbar navbar-expand navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
    <span class="navbar-toggler-icon"></span>
  </button>
  

  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
    <?php //if ($sess_id['id']) : ?>
      <li class="nav-item">
        <a class="nav-link active" href="<?php echo site_url('EmployeeControl'); ?>">Employee</a>
      </li>
      <?php //endif; ?>
      <li class="nav-item">
        <a class="nav-link active" href="<?php echo site_url('DepartControl'); ?>">Department</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link  active" href="<?php echo site_url('DesigControl'); ?>">Designation</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?php echo site_url('RoleControl'); ?>">User Role</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?php echo site_url('OffdayControl'); ?>">Offday</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?php echo site_url('ShiftControl'); ?>">shift</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?php echo site_url('EmpShiftControl'); ?>">Employee_shift</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?php echo site_url('RosterControl'); ?>">Roster</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?php echo site_url('LeaveControl'); ?>">Leave</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?php echo site_url('AttendControl'); ?>">Attendance</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
      <!-- <?php //if ($userId) : ?>
        <?php //foreach ($userId as $row) : ?>
          <p class="my-2 my-sm-0"><?php //echo $row['uname']; ?></p>
        <?php //endforeach; ?>
      <?php //endif; ?> -->

      <!-- <p class="my-2 my-sm-0"><?php //echo $userId['uname']; ?></p> -->
      <p class="my-2 my-sm-0"><?php echo session('user'); ?></p>

      <?php
      // if (isset($_SESSION['user'])) {
        // echo $_SESSION['user'];
      // }
      ?>
      <a class="nav-link active my-2 my-sm-0" href="<?php echo base_url('LoginControl/signout'); ?>">Logout</a>
    </form>
  </div>
</nav>

</body>

</html>