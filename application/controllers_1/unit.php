<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Unit extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('unit_model');
	}


	public function index(){
		$this->tampil_semua();
	}

	public function tampil_semua(){
		$data['content']='unit/unit_view';
		$data['data']=$this->unit_model->get_all()->result();
		$this->load->view('template',$data);
	}

	public function tampil_by_unit(){
		$data['data']=$this->unit_model->get_by_unit($this->uri->segment(3))->result();
		$data['content']='unit/unit_view';
		$this->load->view('template',$data);
	}

	public function tambah_unit(){
		if(isset($_POST['submit'])){
			$this->unit_model->tambah_unit();
			redirect('unit/tampil_semua');
		} else{
			$data['content'] = 'unit/unit_input';
			$this->load->view('template',$data);
		}
	}

	public function edit(){
		if(isset($_POST['submit'])){
			$id= $this->input->post('id_unit');
			//print_r($id);die;
			$this->unit_model->update_by_id($id);
			$this->tampil_semua();
		}else{
			$id= $this->uri->segment(4);
			$data['record']	= $this->unit_model->get_by_id($id)->row_array();
			$data['content'] = 'unit/unit_edit';
			$this->load->view('template',$data);
		}
	}

	public function delete(){
		$id = $this->uri->segment(4);
		$this->unit_model->delete($id);
		$this->tampil_semua();
	}

	
}

?>