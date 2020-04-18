<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Report extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('tiket_model');
		$this->load->model('user_model');
		$this->load->model('unit_model');
		$this->load->model('departemen_model');
		$this->load->model('sop_model');
		$this->load->model('wo_model');
		$this->load->model('sla_model');
		$this->load->model('report_model');
		$this->load->library('mpdf');
	}
/*
	public function cetakPdf($nipp){
		//$nipp=$this->input->post('pegawai');
		//print_r($nipp);die;
		$data['report']=$this->report_model->getReportDetailByNipp($nipp)->result();
		//print_r($data['report']);die;
		$this->load->view('reportTabelDetail',$data);
		$sumber=$this->load->view('reportTabelDetail',$data,TRUE);
		$html=$sumber;

		$pdfFilePath="reportDetail".$nipp.".pdf";
		//lokasi file bootstrap yang akan di load
		$css=$this->load->view('asset/bootstrap.css');
		$stylesheet=file_get_contents($css);

		$pdf=$this->pdf->load();

		$pdf->AddPage('L');
        $pdf->WriteHTML($stylesheet, 1);
        $pdf->WriteHTML($html);
        
        $pdf->Output($pdfFilePath, "D");
        exit();
	}
*/
	public function reportByNipp($nipp){
		$data['report']=$this->report_model->getReportByNipp($nipp)->result();
		//print_r($data['report']);die;
		$this->load->view('reportTabel',$data);
	}

	public function reportDetailByNipp($nipp){
		$data['report']=$this->report_model->getReportDetailByNipp($nipp)->result();
		//print_r($data['report']);die;
		$this->load->view('reportTabelDetail',$data);
	}

	public function reportDetailByIdDept($idDept){
		$periode=$this->uri->segment(4); //data bulan
		//print_r($periode);die;
		$data['report']=$this->report_model->getReportDetailPerbagian($idDept,$periode);
		//print_r($data['report']);die;
		$this->load->view('reportTabelPerbagianDetail',$data);		
	}

	public function reportOrderPegawai(){
		$data['unit']=$this->unit_model->get_all()->result();
		$data['departemen']=$this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
		$data['content']='reportPegawai';
		$this->load->view('template',$data);
	}

	public function reportOrderPegawaiDetail(){
		$data['unit']=$this->unit_model->get_all()->result();
		$data['departemen']=$this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
		$data['content']='reportPegawaiDetail';
		$this->load->view('template',$data);
	}

	public function reportOrderPerbagian(){
		//$idUnit=$this->session->all_userdata(); 
		//print_r($idUnit);die;
		$data['unit']=$this->unit_model->get_all()->result();
		$data['departemen']=$this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
		$data['content']='reportPerbagian';
		$this->load->view('template',$data);
	}

	public function loginAbsentView(){
		$kodeUnit=$this->session->userdata('kodeUnit');
		$data['unit']=$this->unit_model->get_by_unit($kodeUnit)->result();
		$data['departemen']=$this->departemen_model->getByUnit($kodeUnit)->result();
		$data['content']='formReportAbsentView';
		$this->load->view('template',$data);
	}

	public function cetakLogInOutPeriode(){
		print_r($_POST);
		$date = explode(" - ", $_POST['daterange']);
		$dept = $_POST['dept'];
		$myUnit = $this->session->userdata('kodeUnit');

		print_r($date);
		$awal = new DateTime($date['0']);
		$akhir = new DateTime($date['1']);
		$interval = new DateInterval('P1D');

		// ambil setiap tanggal dari batas range yang diinputkan
		$datePeriod = new DatePeriod($awal,$interval,$akhir);
		print_r($datePeriod);
		foreach ($datePeriod as $d => $value) {
			$datePeriodVal[] =  $value->format('Y-m-d');echo'<br/>';
		}
		print_r($datePeriodVal);

		// ambil data pegawai
		if ($dept===$this->session->userdata('kodeUnit')) {
			//semua unit
			echo 'semua pegawai unit';
			$peg = $this->user_model->get_by_unit($dept)->result();
		}else{
			echo 'hanya departemen';
			$peg = $this->user_model->user_by_dept($myUnit,$dept)->result();
			// $peg = $this->user_model->get_by_dept($myUnit,$dept)->result();
		}

		print_r($peg);
		// echo '<br/>';
		//periksa nipp masing2 pertanggal
		foreach ($peg as $p) {
			// echo $p->nipp; echo '<br/>';
			foreach ($datePeriodVal as $d) {
				// echo '$d = '.$d; echo '<br/>';
				$data[$p->nipp][$d] = $this->user_model->getAbsenNippEachDate($p->nipp,$d)->row_array();
			}
		}

		print_r($data);
	}

}

?>