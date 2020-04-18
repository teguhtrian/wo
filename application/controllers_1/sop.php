<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Sop extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('wo_model');
		$this->load->model('sop_model');
		$this->load->model('departemen_model');
		$this->load->model('unit_model');
	}

	public function index(){
		$this->tampil_semua();
	}

	public function pilih_sop(){
		$data['sop']=$this->sop_model->get_by_dept($this->uri->segment(4))->result();
		//print_r($data['sop']);die;
		$this->load->view('dd_sop',$data);
	}

	public function tampil_semua(){
		$data['content'] = 'sop/sop_view';
		$data['data'] = $this->sop_model->tampil_semua()->result();
		$this->load->view('template',$data);
	}

	public function tampil_by_unit(){
		$data['data']=$this->sop_model->get_by_unit($this->uri->segment(3))->result();
		$data['content']='sop/sop_view';
		$this->load->view('template',$data);
	}

	public function tambah_sop(){
		if(isset($_POST['submit'])){
			$this->sop_model->tambah_sop();
			if($this->session->userdata('role')!='sa'){
				redirect('sop/tampil_by_unit/'.$this->session->userdata('kodeUnit'));
			}else{
				redirect('sop/tampil_semua');	
			}
		} else{
			if($this->session->userdata('role')!='sa'){
				$data['unit'] = $this->unit_model->cari_semua()->result();
				$data['departemen'] = $this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
			}else{

				$data['unit'] = $this->unit_model->cari_semua()->result();
				$data['departemen'] = $this->departemen_model->get_all()->result();
			}
			//print_r($data['departemen']);die;
			$data['content'] = 'sop/sop_input';
			$this->load->view('template',$data);
		}	
	}

	public function edit(){
		if(isset($_POST['submit'])){
			$this->sop_model->update_sop();
			$this->wo_model->upDeptWoByIdSop($this->input->post('id'));
			if($this->session->userdata('role')!='sa'){
				redirect('sop/tampil_by_unit/'.$this->session->userdata('kodeUnit'));
			}else{
				redirect('sop/tampil_semua');	
			}
		}else{
			$id= $this->uri->segment(3);
			$data['unit'] = $this->unit_model->cari_semua()->result();
			// $data['departemen'] = $this->departemen_model->get_all()->result();			
			$data['departemen'] = $this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
			$data['record']	= $this->sop_model->get_by_id($id)->row_array();
			$data['content'] = 'sop/sop_edit';
			//print_r($data['departemen']);die;
			$this->load->view('template',$data);
		}		
	}

	public function delete(){
		//delete data user
		$id = $this->uri->segment(3);
		//print_r($id);die;
		$this->sop_model->delete($id);
		$this->tampil_semua();
		if($this->session->userdata('role')!='sa'){
			redirect('sop/tampil_by_unit/'.$this->session->userdata('kodeUnit'));
		}else{
			redirect('sop/tampil_semua');	
		}
	}

}

?>