<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Login extends CI_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('unit_model');
	}
	
	public function index(){
		$this->cekSession();
		$data['pesan'] = "";
		$data['unit'] = $this->unit_model->getUnitParent()->result();
		// $this->load->view('login_form',$data);
		$this->load->view('login_form',$data);
	}

	public function pilih_divisi(){
		$data['divisi']=$this->unit_model->getSubUnit($this->uri->segment(3))->result();
		$this->load->view('dd_divisi',$data);
	}

	public function auth(){
		if(isset($_POST['submit'])){
					$nipp = strip_tags(addslashes(trim($_POST['nipp'])));
					$pass = md5(strip_tags(addslashes(trim($_POST['password']))));
					$kodeUnit = $this->input->post('unit');
					if ($kodeUnit=='00' && $nipp!='1') {
						$kodeUnit = $this->input->post('subUnit');
					}
					$cek = $this->login_model->get_user($nipp,$pass,$kodeUnit)->result_array();
					//print_r($cek);die;

					// print_r($_POST);
					// print_r($cek);die;
					if(count($cek)==1){
						//ambil data dari db, ada tidak?
						foreach ($cek as $cek) {
							$idRole = $cek['idRole'];
							$kodeRole = $cek['kodeRole'];
							$namaRole = $cek['namaRole'];
							$kodeUnit = $cek['kodeUnit'];
							$namaUnit = $cek['namaUnit'];
							$nama = $cek['nama'];
							$idDepartemen = $cek['idDepartemen'];
							$namaDepartemen = $cek['namaDepartemen'];
						}
						
						//simpan data ke session
						$this->session->set_userdata(array(
							'isLogin' => TRUE,
							'nipp' => $nipp,
							'role' => $kodeRole,
							'idRole' => $idRole,
							'namaRole' => $namaRole,
							'kodeUnit' => $kodeUnit,
							'namaUnit' => $namaUnit,
							'idDepartemen' => $idDepartemen,
							'namaDepartemen' => $namaDepartemen,
							'nama' => $nama,						
						));
						if($kodeRole=="sa"){
							$this->session->set_userdata(array(
								//ambil semua unit
								'unit_menu' => $this->unit_model->cari_semua()->result(),
							));
						}
						//
						//print_r($this->session->userdata());die;
						//print_r($this->session->all_userdata());die;
						
						session_start();
						// catat ke log
						// print_r($this->session->all_userdata());die;
						$nama=str_replace("'", "''", $this->session->userdata('nama'));
						$this->actionLog($nama." (".$this->session->userdata('nipp').") Berhasil login ke sistem","loginAuth()",current_url());
						// catat ke login
						// $this->actionLog($this->session->userdata('nama')." (".$this->session->userdata('nipp').") Berhasil login ke sistem","auth()",current_url());
						//arahkan ke kontroler sesuai role
						//print_r($this->session->userdata('role'));die;
						if($this->session->userdata('role')=="sa"){
							//print_r($this->session->userdata());die;
							//print_r('dashboard');die;
							//print_r($this->session->all_userdata());die;
							redirect('home','refresh');
						}else if($this->session->userdata('role')=="ac"){
							redirect('home','refresh');
						}else if($this->session->userdata('role')=="ad"){
							redirect('home','refresh');
						}else if($this->session->userdata('role')=="dir"){
							redirect('home','refresh');
						}else if($this->session->userdata('role')=="kdiv"){
							redirect('home','refresh');
						}else if($this->session->userdata('role')=="kbid"){
							redirect('home','refresh');
						}else if($this->session->userdata('role')=="kcab"){
							redirect('home','refresh');
						}else if($this->session->userdata('role')=="kbag"){
							redirect('home','refresh');
						}else if ($this->session->userdata('role')=="cs"){
							redirect('home','refresh');						
						}else if($this->session->userdata('role')=="peg"){
							//print_r($this->session->all_userdata());die;
							redirect('home','refresh');
						}
					}
					else{
						//jika data tidak cocok
						//alihkan ke home
						echo "<script>alert('Gagal Login')</script>";
						redirect('login','refresh');
					}
				}
	}

	public function cekSession(){
		if($this->session->userdata('isLogin')==TRUE){
			redirect('home','refresh');
		}
	}

	public function logout(){
		$this->load->model('user_model');
		$this->user_model->log_logout();
		//catat login logout
		$this->actionLog($this->session->userdata('nama')." (".$this->session->userdata('nipp').") Berhasil logout dari sistem","logout()",current_url());
		// $this->logoutLog($this->session->userdata('nama')." (".$this->session->userdata('nipp').") Berhasil logout dari sistem","logout()",current_url());
		$this->session->sess_destroy();
		redirect('login','refresh');
		// $login = new Login();
	}

	public function loginLog($action,$modulAccess,$urlAccess){
		$this->load->library('user_agent');
		if ($this->agent->is_browser()){
			$client['browser'] = $this->agent->browser().' '.$this->agent->version();
		}elseif ($this->agent->is_mobile()){
			$client['browser'] = $this->agent->mobile();
		}else{
			$client['browser'] = 'Data user gagal di dapatkan';
		}

		$nama=str_replace("'", "''", $this->session->userdata('nama'));
		$client['datetime']=date("Y-m-d H:i:s");
		$client['os']=$this->agent->platform();
		$client['ip']=$this->input->ip_address();
		$client['action']=$action;
		$client['runByName']=$nama;
		$client['runByNipp']=$this->session->userdata('nipp');
		$client['kodeUnit']=$this->session->userdata('kodeUnit');
		$client['idDepartemen']=$this->session->userdata('idDepartemen');
		$client['modulAccess']=$modulAccess;
		$client['urlAccess']=$urlAccess;
		//print_r($this->session->all_userdata());die();

		$this->login_model->insertActionLog($client);
	}

	public function actionLog($action,$modulAccess,$urlAccess){
		$this->load->library('user_agent');
		if ($this->agent->is_browser()){
			$client['browser'] = $this->agent->browser().' '.$this->agent->version();
		}elseif ($this->agent->is_mobile()){
			$client['browser'] = $this->agent->mobile();
		}else{
			$client['browser'] = 'Data user gagal di dapatkan';
		}

		$nama=str_replace("'", "''", $this->session->userdata('nama'));
		$client['datetime']=date("Y-m-d H:i:s");
		$client['os']=$this->agent->platform();
		$client['ip']=$this->input->ip_address();
		$client['action']=$action;
		$client['runByName']=$nama;
		$client['runByNipp']=$this->session->userdata('nipp');
		$client['kodeUnit']=$this->session->userdata('kodeUnit');
		$client['idDepartemen']=$this->session->userdata('idDepartemen');
		$client['modulAccess']=$modulAccess;
		$client['urlAccess']=$urlAccess;
		//print_r($this->session->all_userdata());die();

		$this->login_model->insertActionLog($client);
	}
}
?>