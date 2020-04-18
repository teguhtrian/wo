<?php
	$unit_menu = $this->session->userdata('unit_menu');
	$role=$this->session->userdata('role');
?>

<li class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#">Data Master <span class="caret"></span></a>
	<ul class="dropdown-menu multi-level">
	<!--
		<li class="dropdown-submenu">
		    <a tabindex="-1" href="#">Hover me for more options</a>
			<ul class="dropdown-menu">
				<li><a tabindex="-1" href="#">Second level</a></li>
                 	<li class="dropdown-submenu">
                   	<a href="#">Even More..</a>
			</ul>
		</li>
		<li class="dropdown-submenu">
			<a href="#">Data Pegawai</a>
			<ul class="dropdown-menu">
				<?php ;?>
			</ul>
		</li>
	-->
<?php
	if($this->session->userdata('role')=="sa" || $this->session->userdata('role')=="ac" || $this->session->userdata('role')=="ad" || $this->session->userdata('role')=='dir'){
		if ($this->session->userdata('role')=='sa' || $this->session->userdata('role')=='dir') {
		echo"
		<li class=\"dropdown\">
		<a href=\"".base_url('unit/tampil_semua')."\">Data Unit</a>
		</li>
			";
		echo"
		<li class=\"dropdown-submenu\">
		    <a tabindex=\"-1\" href=\"#\">Data Departemen</a>
			<ul class=\"dropdown-menu\">
					<li><a tabindex=\"-1\" href=".base_url('departemen/tampil_semua').">Semua Data</a></li>";
					foreach ($unit_menu as $b) {
						echo '<li><a tabindex=\"-1\" href="'.base_url('departemen/tampil_by_unit/').'/'.$b->kodeUnit.'"/>'.$b->namaUnit.'</a></li>';
					}
		echo"
			</ul>
		</li>
		<li class=\"dropdown-submenu\">
		    <a tabindex=\"-1\" href=\"#\">Data Pegawai</a>
			<ul class=\"dropdown-menu\">
					<li><a tabindex=\"-1\" href=".base_url('user/tampil_semua').">Semua Data</a></li>";
					foreach ($unit_menu as $b) {
						echo '<li><a tabindex=\"-1\" href="'.base_url('user/tampil_by_unit/').'/'.$b->kodeUnit.'"/>'.$b->namaUnit.'</a></li>';
					}
		echo"
			</ul>
		</li>
		<li class=\"dropdown-submenu\">
		    <a tabindex=\"-1\" href=\"#\">Data Tiket</a>
			<ul class=\"dropdown-menu\">
					<li><a tabindex=\"-1\" href=".base_url('tiket/tampil_semua').">Semua Data</a></li>";
					foreach ($unit_menu as $b) {
						echo '<li><a tabindex=\"-1\" href="'.base_url('tiket/tampil_by_unit/').'/'.$b->kodeUnit.'"/>'.$b->namaUnit.'</a></li>';
					}
		echo"
			</ul>
		</li>
		<li class=\"dropdown-submenu\">
		    <a tabindex=\"-1\" href=\"#\">Data SOP (Standard Operasional Prosedur)</a>
			<ul class=\"dropdown-menu\">
					<li><a tabindex=\"-1\" href=".base_url('sop/tampil_semua').">Semua Data</a></li>";
					foreach ($unit_menu as $b) {
						echo '<li><a tabindex=\"-1\" href="'.base_url('sop/tampil_by_unit/').'/'.$b->kodeUnit.'"/>'.$b->namaUnit.'</a></li>';
					}
		echo"
			</ul>
		</li>
		<li class=\"dropdown-submenu\">
		    <a tabindex=\"-1\" href=\"#\">Data Work Order</a>
			<ul class=\"dropdown-menu\">
					<li><a tabindex=\"-1\" href=".base_url('wo/tampil_semua').">Semua Data</a></li>";
					foreach ($unit_menu as $b) {
						echo '<li><a tabindex=\"-1\" href="'.base_url('wo/tampil_by_unit/').'/'.$b->kodeUnit.'"/>'.$b->namaUnit.'</a></li>';
					}
		echo"
			</ul>
		</li>
		<li class=\"dropdown-submenu\">
		    <a tabindex=\"-1\" href=\"#\">Data SLA/SPM (Standard Pelayanan Minimum)</a>
			<ul class=\"dropdown-menu\">
					<li><a tabindex=\"-1\" href=".base_url('sla/tampil_semua').">Semua Data</a></li>";
					foreach ($unit_menu as $b) {
						echo '<li><a tabindex=\"-1\" href="'.base_url('sla/tampil_by_unit/').'/'.$b->kodeUnit.'"/>'.$b->namaUnit.'</a></li>';
					}
		echo"
			</ul>
		</li>
		<li class=\"dropdown\">
		<a href=\"".base_url('home/log_sistem')."\">Log Sistem</a>
		</li>
			";
		}
		else{
		echo"<li class=\"\">".anchor('departemen/tampil_by_unit/'.$this->session->userdata('kodeUnit'),'Data Departemen')."</li>";
		echo"<li class=\"\">".anchor('user/tampil_by_unit/'.$this->session->userdata('kodeUnit'),'Data Pegawai')."</li>";
		echo"<li class=\"\">".anchor('sop/tampil_by_unit/'.$this->session->userdata('kodeUnit'),'Data SOP (Standard Operasional Prosedur)')."</li>";
		echo"<li class=\"\">".anchor('sla/tampil_by_unit/'.$this->session->userdata('kodeUnit'),'Data SLA/SPM (Standard Pelayanan Minimum)')."</li>";
		echo"<li class=\"\">".anchor('wo/tampil_by_unit/'.$this->session->userdata('kodeUnit'),'Data Work Order')."</li>";
		//echo"<li class=\"\">".anchor('tiket','Data Tiket')."</li>";
		}
	}

?>

		<!--<li class=""><?php echo anchor('role/tampil_semua','Role')?></li>-->
	</ul>
</li>

<?php 
	echo '<li class="dropdown">
		<a class="dropdown-toggle" data-toggle="dropdown" href="#">Report <span class="caret"></span></a>
			<ul class="dropdown-menu multi-level">
				<li class="dropdown">
					<a tabindex="-1" href='.base_url().'report/reportOrderPerbagian/'.'>Report Order / Bagian</a>
				</li>
				<li class="dropdown">
					<a tabindex="-1" href='.base_url().'report/reportOrderPegawai/'.'>Report Order / Pegawai</a>
				</li>
				<li class="dropdown">
					<a tabindex="-1" href='.base_url().'report/loginAbsentView/'.'>Absen Unit Kerja</a>
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
	</li>';
?>