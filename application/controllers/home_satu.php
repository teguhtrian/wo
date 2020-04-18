<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('unit_model');
		$this->load->model('user_model');
		$this->load->model('tiket_model');
	}

	public function test($query){
		$this->db->select('id,nipp');
		$this->db->from('user');
		$this->db->like('nipp',$query);
		$res=$this->db->get();
		$arr=array();
		foreach($res->result() as $row){
			$arr[]=array('id'=>$row->nipp,'nipp'=>$row->nama);
		}
		echo json_encode($arr);
	}

	public function index(){
			$data['role'] = $this->session->userdata('role');
			if($data['role']=='peg' || $data['role']=='cs'){
				$data['orderOpen']=$this->tiket_model->getMyOrderOpen($this->session->userdata('nipp'))->result();
				$data['orderClosed']=$this->tiket_model->getMyOrderClosed($this->session->userdata('nipp'))->result();
				$data['jumlah_tiket']=$this->tiket_model->getMyOrderOpen($this->session->userdata('nipp'))->num_rows();
				//print_r($data['jumlah_tiket']->num_rows());die;
				$data['content']='home';
				//print_r($data['orderClosed']);die;
			}else{
				$data['li']=$this->tiket_model->getDeptLiReportByUnit($this->session->userdata('kodeUnit'))->result();
				$data['departemen']=$this->tiket_model->getDeptOrderReportByUnit($this->session->userdata('kodeUnit'))->result();
				$data['orderOpen']=$this->tiket_model->getMyOrderOpen($this->session->userdata('nipp'))->result();
				$data['orderClosed']=$this->tiket_model->getMyOrderClosed($this->session->userdata('nipp'))->result();
				//print_r($data['orderClosed']);die;
				$data['content']='dashboard';
			}
			//$data['unit_menu'] = $this->unit_model->cari_semua()->result();
			//print_r($this->session->userdata('nama'));die;
			$data['jumlah_tiket']=$this->tiket_model->jumlah_tiket_nipp();
			$this->load->view('template',$data);
	}



/*
	public function stat_user() {
		$data['role'] = $this->session->userdata('role');

		if($data['role'] == 'Admin' || $data['role'] =='Direksi'){
			$data['content_view'] = 'dashboard';	
		}else{
			$data['content_view'] = 'home';
		}
		
		$data['content'] = $this->user_model->cari_semua();
		$this->load->view('template',$data);
	}	*/
}
?>