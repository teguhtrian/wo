<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Wo extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('wo_model');
		$this->load->model('sop_model');
		$this->load->model('sla_model');
		$this->load->model('departemen_model');
		$this->load->model('unit_model');
	}

	public function index(){
		$this->tampil_semua();
	}

	public function tampil_semua(){
		$data['content'] = 'wo/wo_view';
		$data['data'] = $this->wo_model->tampil_semua()->result();
		//print_r($data['data']);die;
		$this->load->view('template',$data);
	}

	public function tampil_by_unit(){
		$data['data']=$this->wo_model->get_by_unit($this->uri->segment(3))->result();
		//print_r($data['data']);die;
		$data['content']='wo/wo_view';
		$this->load->view('template',$data);
	}

	public function tambah_wo(){
		if(isset($_POST['submit'])){
			$this->wo_model->tambah_wo();
			if($this->session->userdata('role')!='sa'){
				redirect('wo/tampil_by_unit/'.$this->session->userdata('kodeUnit'));
			}else{
				redirect('wo/tampil_semua');	
			}
		} else{
			if($this->session->userdata('kodeUnit')!='00'){
				//jika bukan kantor pusat ambil data sesuai unit
				$data['unit'] = $this->unit_model->cari_semua()->result();
				$data['departemen'] = $this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
			}else{
				$data['unit'] = $this->unit_model->cari_semua()->result();
			}
			$data['content'] = 'wo/wo_input';
			$this->load->view('template',$data);
		}		
	}
	public function edit(){
		if(isset($_POST['submit'])){
			//print_r($this->input->post('idWo'));die;
			$this->wo_model->update_wo($this->input->post('idWo'));
			if($this->session->userdata('role')!='sa'){
				redirect('wo/tampil_by_unit/'.$this->session->userdata('kodeUnit'));
			}else{
				redirect('wo/tampil_semua');	
			}
		}else{
			$id= $this->uri->segment(3);
			//print_r($id);die;
			$data['departemen'] = $this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
			$data['record']	= $this->wo_model->get_by_id($id)->row_array();
			//print_r($data ['record']['idDepartemen']);die;
			$data['sla'] = $this->sla_model->getByDept($data['record']['idDepartemen'])->result();
			$data['sop'] = $this->sop_model->get_by_dept($data['record']['idDepartemen'])->result();
			$data['unit'] = $this->unit_model->cari_semua()->result();
			//print_r($data);die;
			//print_r($data['record']);
			$data['content'] = 'wo/wo_edit';
			//print_r($data['record']['nama_sla']);die;
			$this->load->view('template',$data);
		}		
	}
/*
	public function edit(){
		if(isset($_POST['submit'])){
			$this->wo_model->update_wo();
			redirect('wo/tampil_semua');
		}else{
			$id= $this->uri->segment(3);
			$data['sla'] = $this->sla_model->tampil_semua()->result();
			$data['sop'] = $this->sop_model->tampil_semua()->result();
			$data['unit'] = $this->unit_model->cari_semua()->result();
			$data['departemen'] = $this->departemen_model->get_all()->result();
			$data['record']	= $this->wo_model->get_by_id($id)->row_array();
			//print_r($data['record']);
			$data['content'] = 'wo/wo_edit';
			//print_r($data['record']['nama_sla']);die;
			$this->load->view('template',$data);
		}		
	}
*/
	public function delete(){
		//delete data user
		$id = $this->uri->segment(3);
		$this->wo_model->delete($id);
		redirect('wo/tampil_by_unit/'.$this->session->userdata('kodeUnit'));
	}

}

?>