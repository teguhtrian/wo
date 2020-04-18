<body onload="startTime()">
	<header class="header">
		<div align="left">
		<a class="navbar-brand" href="<?php echo base_url('/home');?>">
			<img src="<?php echo base_url('asset/images/logo.png');?>" alt="logoPDAM" width="55%" height="155%" align="middle">
		</a>
		</div>
		<div class="header" align="right">
			<strong>WORK ORDER SISTEM | <?php $unit=$this->session->userdata('namaUnit'); echo "$unit";?></strong>
			<br>
			<?php 
			$fullname=$this->session->userdata('nama');
			$role = $this->session->userdata('namaRole');
			$dept = $this->session->userdata('namaDepartemen'); 
			if($dept==null){
				echo "<strong>$fullname</strong> | <b>".ucwords(strtolower($role))."</b>";
			}else{
				echo "<strong>$fullname</strong> | <b>".ucwords(strtolower($role))."/$dept</b>";
			}
			;?>
			<div>
				<span id="clocktime"></span><span id="welcome"></span>
			</div>
		</div>
	</header>
</body>