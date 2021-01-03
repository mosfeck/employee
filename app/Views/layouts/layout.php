<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Attendance in CodeIgniter 4</title>

	<!-- <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
	<link href="<?php echo base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('public/assets/css/jquery.dataTables.min.css') ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('public/assets/css/main.css') ?>" rel="stylesheet" type="text/css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" type="text/css" />


	<script src="<?php echo base_url('public/assets/js/jquery.min.js') ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('public/assets/js/jquery.dataTables.min.js') ?>" type="text/javascript"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js" type="text/javascript"></script>

	
</head>

<body>

	<!-- <?php // echo view('templates/header'); 
			?> -->
	<?php $session = \Config\Services::session(); ?>
	<nav class="navbar navbar-expand navbar-light bg-light">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
			<span class="navbar-toggler-icon"></span>
		</button>


		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">
				<?php //if ($sess_id['id']) : 
				?>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo site_url('Employees'); ?>">Employee</a>
				</li>
				<?php //endif; 
				?>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo site_url('Departs'); ?>">Department</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link  active" href="<?php echo site_url('Desigs'); ?>">Designation</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo site_url('Roles'); ?>">User_Role</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo site_url('Offdays'); ?>">Offday</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo site_url('Shifts'); ?>">shift</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo site_url('EmpShifts'); ?>">Employee_shift</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo site_url('Rosters'); ?>">Roster</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo site_url('Leaves'); ?>">Leave</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo site_url('Attends'); ?>">Attendance</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo site_url('AttendDetails'); ?>">Reports</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo site_url('DocumentControl/index'); ?>">Mail</a>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
				<!-- <?php //if ($userId) : 
						?>
        <?php //foreach ($userId as $row) : 
		?>
          <p class="my-2 my-sm-0"><?php //echo $row['uname']; 
									?></p>
        <?php //endforeach; 
		?>
      <?php //endif; 
		?> -->

				<!-- <p class="my-2 my-sm-0"><?php //echo $userId['uname']; 
												?></p> -->
				<p class="my-2 my-sm-0"><?php echo session('uname'); ?></p>

				<?php
				// if (isset($_SESSION['user'])) {
				// echo $_SESSION['user'];
				// }
				?>
				<a class="nav-link active my-2 my-sm-0" href="<?php echo site_url('signout'); ?>">Logout</a>
			</form>
		</div>
	</nav>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?= $this->renderSection('content') ?>
			</div>
		</div>

	</div>

</body>

</html>