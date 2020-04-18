<li ><?php echo anchor('home','Beranda');?></li>
	<li class="dropdown">
		<a class="dropown-toggle" data-toggle="dropdown" href="#">Buat Pesan <span class="caret"></span></a>
		<ul class="dropdown-menu multi-level">
			<li class="dropdown">
				<a tabindex="-1" href=<?php echo base_url('tiket/pesanInformasi');?>>Pesan Informasi</a>
			</li>
			<li class="dropdown">
				<a tabindex="-1" href=<?php echo base_url('tiket/pesanPengaduan');?>>Pesan Pengaduan</a>
			</li>
		</ul>
	</li>
	<?php
	if($this->session->userdata('role')=='kbag' || $this->session->userdata('role')=='kbid'){
	echo '
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Tiket Order <span class="caret"></span></a>
		<ul class="dropdown-menu multi-level">
		<!--
			<li class="dropdown-submenu">
				<a tabindex="-1" href="#">Tiket Saya</a>
				<ul class="dropdown-menu">
					<li><a tabindex="-1" href='.base_url('tiket/tiket_masuk').'>Tiket Masuk</a></li>
					<li><a tabindex="-1" href='.base_url('tiket/tiket_keluar').'>Tiket Keluar</a></li>
				</ul>
			</li>
		-->

			<li class="dropdown">
				<a tabindex="-1" href="'.base_url('tiket/orderBaru').'">Buat Order</a>

			<!--
				<ul class="dropdown-menu">
					<li class="dropdown-submenu">
						<li><a tabindex="-1" href='.base_url('tiket/orderUmum').'>Order Umum</a></li>
							<li><a tabindex="-1" href='.base_url('tiket/orderRutin').'>Order Rutinitas</a></li>
					</li>
				</ul>
			-->

			</li>

			<!--
			<li class="dropdown-submenu">
				<a tabindex="-1" href="#">Tiket by Status</a>
				<ul class="dropdown-menu">
					<li><a tabindex="-1" href='.base_url('tiket/tiket_unsigned').'>Tiket Unsigned</a></li>
					<li><a tabindex="-1" href='.base_url('tiket/tiket_open').'>Tiket Open</a></li>
					<li><a tabindex="-1" href='.base_url('tiket/tiket_answer').'>Tiket Answer</a></li>
					<li><a tabindex="-1" href='.base_url('tiket/tiket_closed').'>Tiket Closed</a></li>
				</ul>
			</li>
			-->
			<li class="dropdown">
				<a href='.base_url().'tiket/myOrder/'.$this->session->userdata('nipp').'>Tiket Order Saya</a>
			</li>					
			<li class="dropdown">
				<a href='.base_url().'tiket/orderByUnit/'.$this->session->userdata('kodeUnit').'>Semua Order</a>
			</li>
		</ul>
	</li>
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Report <span class="caret"></span></a>
			<ul class="dropdown-menu multi-level">
				<li class="dropdown">
					<a tabindex="-1" href='.base_url().'report/reportOrderPerbagian/'.'>Report Order / Bagian</a>
				</li>
				<li class="dropdown">
					<a tabindex="-1" href='.base_url().'report/reportOrderPegawai/'.'>Report Order / Pegawai</a>
				</li>
					<!--
				<li class="dropdown">
					<a tabindex="-1" href='.base_url().'report/reportOrderPegawaiDetail/'.'>Report Order / Pegawai Detail Tiket</a>
				</li>
					<li class="dropdown">
						<a tabindex="-1" href="#">Order per Unit</a>
					</li>
					-->
			</ul>
	</li>
	
	<!--
	<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Report <span class="caret"></span></a>
		<ul class="dropdown-menu multi-level">
			
			<li class="dropdown">
				<a tabindex="-1" href='.base_url().'report/reportOrderPegawai/'.'>Report Order Pegawai</a>
			</li>
			
			<li class="dropdown">
				<a tabindex="-1" href='.base_url().'report/reportOrderPegawaiDetail/'.'>Report Order Detail</a>
			</li>
			
			<li class="dropdown">
				<a tabindex="-1" href="#">Order per Unit</a>
			</li>
			
		</ul>
	</li>
	-->
	';
	}
	elseif($this->session->userdata('role')=='peg'){
		echo "<li >".anchor('tiket/orderBaruByPeg/','Buat Order')."</li>";
	}
	elseif($this->session->userdata('role')=='dir'||$this->session->userdata('role')=='kcab'||$this->session->userdata('role')=='kdiv'){
		echo '
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Report <span class="caret"></span></a>
				<ul class="dropdown-menu multi-level">
					<li class="dropdown">
						<a tabindex="-1" href='.base_url().'report/reportOrderPerbagian/'.'>Report Order / Bagian</a>
					</li>
					<li class="dropdown">
						<a tabindex="-1" href='.base_url().'report/reportOrderPegawai/'.'>Report Order / Pegawai</a>
					</li>
					<!--
					<li class="dropdown">
						<a tabindex="-1" href='.base_url().'report/reportOrderPegawaiDetail/'.'>Report Order / Pegawai Detail Tiket</a>
					</li>
					<li class="dropdown">
						<a tabindex="-1" href="#">Order per Unit</a>
					</li>
					-->
				</ul>
			</li>
		';
	}
			?>
	<?php 
		if($this->session->userdata('role')=='sa'||$this->session->userdata('role')=="ac"||$this->session->userdata('role')=="ad"){ 
			echo $this->load->view('menu_admin');
		}else{
			
		}
	?>
	<li><?php echo anchor('user/ubah_password','Ubah Password');?></li>
	<li><?php echo anchor('login/logout','Logout', array('onclick' => "return confirm('Anda yakin akan logout?')"));?></li>