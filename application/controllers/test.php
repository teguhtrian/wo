<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Test extends CI_controller {

	public function index(){
		// echo 'index.php';
		$awal = new DateTime('2020-01-01');
		$akhir = new DateTime('2020-04-14');
		$interval = new DateInterval('P1D');

		$datePeriod = new DatePeriod($awal,$interval,$akhir);
		// print_r($datePeriod);
		foreach ($datePeriod as $d => $value) {
			echo $value->format('Y-m-d');echo'<br/>';
		}

		// $date = new DateTime('2000-12-31');

		// $date->modify('+1 month');
		// echo $date->format('Y-m-d') . "\n";

		// $date->modify('+1 month');
		// echo $date->format('Y-m-d') . "\n";
	}

}