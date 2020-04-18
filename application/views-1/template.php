<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
	<title>WO Sistem</title>
	<link rel="shortcut icon" href="<?php echo base_url('asset/images/favicon.png');?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/bootstrap.min.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/DataTables/jquery.dataTables.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/css/bootstrap-datetimepicker.min.css');?>">
	<script type="text/javascript" src="<?php echo base_url('asset/js/moment.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('asset/js/jquery-1.12.2.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('asset/js/bootstrap.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('asset/js/time.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('asset/DataTables/jquery.dataTables.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('asset/js/bootstrap-datetimepicker.min.js');?>"></script>
	<script type="text/javascript" src="<?php echo base_url('asset/js/id.js');?>"></script>

	<?php //echo header('refresh:600'); //10 menit ?>
</head>
<body>
<!-- <div class="container"> -->
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<?php $this->load->view('header');?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<ul class="nav navbar-nav">					
							<?php $this->load->view('menu');?>
						</ul>
					</div>
				</nav>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<?php $this->load->view($content);?>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<br>
				<div class="footer">
					<?php $this->load->view('footer');?>
				</div>
			</div>
		</div>
	</div>
<!-- </div> -->
</body>
</html>