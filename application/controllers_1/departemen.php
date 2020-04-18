<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Departemen extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('departemen_model');
		$this->load->model('unit_model');
	}

	public function index(){
		$this->tampil_semua();
	}

	public function pilih_dept(){
		$data['departemen']=$this->departemen_model->getByUnit($this->uri->segment(3))->result();
		//print_r($data);die;
		$this->load->view('dd_departemen',$data);
	}

	public function tampil_semua(){
		$data['content'] = 'departemen/departemen_view';
		$data['data'] = $this->departemen_model->get_all()->result();
		$this->load->view('template',$data);
	}

	public function tampil_by_unit($kodeUnit){
		$data['data']=$this->departemen_model->getByUnit($kodeUnit)->result();
		//print_r($data['data']);die;
		$data['content']='departemen/departemen_view';
		$this->load->view('template',$data);
	}

	public function tambah_departemen(){
		if(isset($_POST['submit'])){
			$this->departemen_model->tambah_departemen();
			if($this->session->userdata('role')!='sa'){
				redirect('departemen/tampil_by_unit/'.$this->session->userdata('kodeUnit'));
			}
			redirect('departemen/tampil_semua');
		} else{
			$data['unit'] = $this->unit_model->cari_semua()->result();
			$data['content'] = 'departemen/departemen_input';
			$this->load->view('template',$data);
		}
	}

	public function edit($id){
		if(isset($_POST['submit'])){
			//print_r($id);die;
			$this->departemen_model->update_by_id($id);
			if ($this->session->userdata('role'=='sa')) {
				redirect('departemen/tampil_semua');
			}else{
				redirect('departemen/tampil_by_unit/'.$this->session->userdata('kodeUnit'));
			}
		}else{
			//print_r($id);die;
			$data['unit'] = $this->unit_model->cari_semua()->result();
			$data['departemen']	= $this->departemen_model->get_by_id($id)->row_array();
			//print_r($data['departemen']);die;
			$data['content'] = 'departemen/departemen_edit';
			$this->load->view('template',$data);
		}
	}

	public function delete($id){
		$this->departemen_model->delete($id);
		if ($this->session->userdata('role'=='sa')) {
			redirect('departemen/tampil_semua');
		}else{
			redirect('departemen/tampil_by_unit/'.$this->session->userdata('kodeUnit'));
		}
	}

}

?>