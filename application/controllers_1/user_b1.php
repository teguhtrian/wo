<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class User extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('unit_model');
		$this->load->model('departemen_model');
	}

	public function index(){
		/*
		$session = $this->session->userdata('isLogin');
		if ($session == FALSE) {
			$this->load->view('user_login');
		}
		else{
			redirect('home');
		} */
		$this->tampil_semua();
	}

	public function ceknipp($nipp){
		$query=$this->user_model->ceknipp($nipp);
		if($query->num_rows=='1'){
			$data['nipp']=$nipp;
			$this->load->view('user/user_nipp_notice',$data);
		}else{
			$data['nipp']='OK';
			$this->load->view('user/user_nipp_notice',$data);
		}
	}

	public function logoutLog($action,$modulAccess,$urlAccess){
		$this->load->model('login_model');
		$this->load->library('user_agent');
		if ($this->agent->is_browser()){
			$client['browser'] = $this->agent->browser().' '.$this->agent->version();
		}elseif ($this->agent->is_mobile()){
			$client['browser'] = $this->agent->mobile();
		}else{
			$client['browser'] = 'Data user gagal di dapatkan';
		}
		$client['datetime']=date("Y-m-d h:i:s");
		$client['os']=$this->agent->platform();
		$client['ip']=$this->input->ip_address();
		$client['action']=$action;
		$client['runByName']=$this->session->userdata('nama');
		$client['runByNipp']=$this->session->userdata('nipp');
		$client['kodeUnit']=$this->session->userdata('kodeUnit');
		$client['modulAccess']=$modulAccess;
		$client['urlAccess']=$urlAccess;
		//print_r($this->session->all_userdata());die();

		$this->login_model->insertActionLog($client);
	}

	public function tampil_semua(){
		$data['content'] = 'user/user_view';
		$data['data'] = $this->user_model->tampil_semua()->result();
		$this->load->view('template',$data);
	}

	public function tampil_by_unit(){
		$data['data']=$this->user_model->get_by_unit($this->uri->segment(3))->result();
		//print_r($data['data']);die;
		$data['content']='user/user_view';
		$this->load->view('template',$data);
	}

	public function tambah_user(){
		if(isset($_POST['submit'])){
			$this->user_model->tambah_user();
			if($this->session->userdata('role')!='sa'){
				redirect('user/tampil_by_unit/'.$this->session->userdata('kodeUnit'));
			}else{
				redirect('user/tampil_semua');	
			}
		} else{
			if($this->session->userdata('role')!='sa'){
				$data['unit'] = $this->unit_model->cari_semua()->result();
				$data['departemen'] = $this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
			}else{

				$data['unit'] = $this->unit_model->cari_semua()->result();
				$data['departemen'] = $this->departemen_model->get_all()->result();
			}
			$data['content'] = 'user/user_input';
			$this->load->view('template',$data);
		}
	}

	public function ubah_password(){
		if (isset($_POST['submit'])) {
			echo $passBaru=md5($this->input->post('passBaru1'));//die;
			$this->user_model->updatePassByNipp($passBaru,$this->session->userdata('nipp'));
			redirect('user/konfirmPassBaru');
		}else{
			$data['confirm'] = '';
			$data['content'] = 'user/user_change_pass';
			$this->load->view('template',$data);
		}
	}

	public function konfirmPassBaru(){
		$data['content']='user/konfirmPass';
		$this->load->view('template',$data);
	}

	public function update_password(){
		if(isset($_POST['submit'])){
			//$pass_lama = $POST['password_lama'];
			$pass_baru1 = $POST['password_baru1'];
			$pass_baru2 = $POST['password_baru2'];
			//pass lama tidak sama dengan pass baru
			if($pass_lama != $pass_baru1){
				if($pass_lama != $pass_baru2){
					if($pass_baru1 == $pass_baru2){
						//pass lama tidak sama dengan pass baru2
						//$this->user_model->update_password($pass_baru1);
						$data['confirm'] = "Password Updated";
						$data['content_view'] = "user_change_pass";
						$this->load->view('template',$data);
					}else{

					}
				}
			}
			//pass baru
		}else{

		}
	}

	public function edit(){
		//edit data user
		if(isset($_POST['submit'])){
			$this->user_model->update_user();
			if($this->session->userdata('role')!='sa'){
				redirect('user/tampil_by_unit/'.$this->session->userdata('kodeUnit'));
			}else{
				redirect('user/tampil_semua');	
			}
		}else{
			$nipp= $this->uri->segment(3);
			$data['unit'] = $this->unit_model->cari_semua()->result();
			$data['departemen'] = $this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
			$data['record']	= $this->user_model->getUserData($nipp)->row_array();
			//print_r($data['record']);die;
			$data['content'] = 'user/user_edit';
			$this->load->view('template',$data);
		}
	}

	public function delete(){
		//delete data user
		$id = $this->uri->segment(3);
		$this->user_model->delete($id);
		if($this->session->userdata('role')!=='sa'){
			redirect('user/tampil_by_unit/'.$this->session->userdata('kodeUnit'));
		}else{
			redirect('user/tampil_semua');	
		}
	}

	public function get_all_user(){
	    $data['user_all'] = $this->user_model->get_all_user();
	    $data['content_view']  = "new_tiket";
	    $this->load->view('template', $data);
	}
}

?>