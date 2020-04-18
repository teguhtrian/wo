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

}

?>