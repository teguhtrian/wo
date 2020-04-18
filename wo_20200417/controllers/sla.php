<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Sla extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('sla_model');
		$this->load->model('departemen_model');
		$this->load->model('unit_model');
	}

	public function index(){
		$this->tampil_semua();
	}

	public function pilih_sla(){
		//$data['sla']=$this->sla_model->get_by_dept($this->uri->segment(4))->result();
		$data['sla']=$this->sla_model->get_by_unit($this->uri->segment(3))->result();
		//print_r($data['sla']);die;
		$this->load->view('dd_sla',$data);		
	}

	public function tampil_semua(){
		$data['content'] = 'sla/sla_view';
		$data['data'] = $this->sla_model->tampil_semua()->result();
		$this->load->view('template',$data);
	}

	public function tampil_by_unit(){
		$kodeUnit = $this->uri->segment(3);
		$data['data'] = $this->sla_model->get_by_unit($kodeUnit)->result();
		$data['content'] = 'sla/sla_view';
		//print_r($data['data']);die;
		$this->load->view('template',$data);
	}

	public function tambah_sla(){
		if(isset($_POST['submit'])){
			$this->sla_model->tambah_sla();
			if($this->session->userdata('role')!='sa'){
				redirect('sla/tampil_by_unit/'.$this->session->userdata('kodeUnit'));
			}else{
				redirect('sla/tampil_semua');	
			}
		} else{
			$data['unit'] = $this->unit_model->cari_semua()->result();
			$data['departemen'] = $this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
			$data['content'] = 'sla/sla_input';
			$this->load->view('template',$data);
		}		
	}

	public function edit(){
		if(isset($_POST['submit'])){
			$this->sla_model->update_sla();
			if($this->session->userdata('role')!='sa'){
				redirect('sla/tampil_by_unit/'.$this->session->userdata('kodeUnit'));
			}else{
				redirect('sla/tampil_semua');	
			}
		}else{
			$id= $this->uri->segment(3);
			$data['unit'] = $this->unit_model->cari_semua()->result();
			$data['departemen'] = $this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
			$data['record']	= $this->sla_model->get_by_id($id)->row_array();
			$data['content'] = 'sla/sla_edit';
			//print_r($data['record']);die;
			$this->load->view('template',$data);
		}		
	}

	public function delete(){
		//delete data user
		$id = $this->uri->segment(3);
		$this->sla_model->delete($id);
		if($this->session->userdata('role')!='sa'){
			redirect('sla/tampil_by_unit/'.$this->session->userdata('kodeUnit'));
		}else{
			redirect('sla/tampil_semua');	
		}
	}

}

?>