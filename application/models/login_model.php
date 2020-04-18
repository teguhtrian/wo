<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Login_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_user($nipp,$pass,$kodeUnit){
		$this->db->select('users.nipp, users.nama, users.idRole, users.kodeRole, role.namaRole, users.kodeUnit, users.id, unit.kodeUnit, unit.namaUnit, departemen.id as idDepartemen, departemen.namaDepartemen');
		$this->db->from('users');
		$this->db->where('users.nipp',$nipp);
		$this->db->where('users.password',$pass);
		$this->db->where('users.kodeUnit',$kodeUnit);
		$this->db->join('unit','unit.kodeUnit = users.kodeUnit','left');
		$this->db->join('departemen','departemen.id = users.idDepartemen','left');
		$this->db->join('role','role.kodeRole = users.kodeRole','left');
		$query=$this->db->get();
		//print_r($query->result());die;
		return $query;
	}
/*
	public function get_user($nipp,$pass,$kodeUnit){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('users.nipp',$nipp);
		$this->db->where('users.password',$pass);
		$this->db->where('users.kodeUnit',$kodeUnit);
		$this->db->join('unit','unit.kodeUnit = users.kodeUnit','left');
		$this->db->join('departemen','departemen.id = users.idDepartemen','left');
		$this->db->join('role','role.kodeRole = users.kodeRole','left');
		$query=$this->db->get();
		//print_r($query->result());die;
		return $query;
	}	
*/	
/*
	public function cek_user($nipp,$pass,$kodeUnit){
		$query = "SELECT us.nipp, us.nama_dpn, us.nama_blkg, us.kode_role, us.id, d.nama_departemen, us.kodeUnit, u.nama_unit
				FROM user AS us, departemen AS d, unit AS u
				WHERE us.nipp=$nipp
				AND us.password=\"$pass\"
				AND us.kodeUnit=$kodeUnit
				AND us.id = d.id
				AND us.kodeUnit = u.kodeUnit";
		$query = $this->db->query($query);
		//print_r($query);die;
		return $query = $query->result_array();
	}

	public function cek_user($nipp,$pass,$kodeUnit){
		$query = "SELECT us.nipp, us.nama_dpn, us.nama_blkg, us.kode_role, us.id, d.nama_departemen, us.kodeUnit, u.nama_unit
				FROM user AS us, departemen AS d, unit AS u
				WHERE us.nipp=$nipp
				AND us.password=\"$pass\"
				AND us.kodeUnit=$kodeUnit
				AND us.id = d.id
				AND us.kodeUnit = u.kodeUnit";
		$query = $this->db->query($query);
		print_r($query);die;
		return $query = $query->result_array();
	}
*/
	public function ambil_user($nipp){
		$query = $this->db->get_where($this->tbl,array('nipp'=>$nipp));
		$query = $query->result_array();
		if($query){
			return $query[0];
		}
	}

	public function load_form_rules(){
		$form_rules = array( 
			array(
				'field'=>'nipp',
				'label'=>'Nipp',
				'rules'=>'required'
			),
			array(
				'field'=>'password',
				'label'=>'password',
				'rules'=>'required'
			),
			array(
				'field'=>'unit',
				'label'=>'unit',
				'rules'=>'required'
			)
		);
		return $form_rules;
	}

	public function validasi(){
		$form = $this->load_form_rules();
		$this->form_validation->set_rules($form);

		if($this->form_validation->run()){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	//cek status user, login atau tidak?
	public function cek_user1(){
		$nipp = $this->input->post('nipp');
		$password = md5($this->input->post('password'));
		$kantor = $this->input->post('unit');

		$query = $this->db->where('nipp',$nipp)->where('password',$password)->where('unit',$kantor)->limit(1)->get($this->db_tabel);

		print_r($query);

		if($query->num_rows()==1){
			$query = $query->result_array();
			print_r($query);
			$data = array(
				'nipp' => $query['nipp'], 
				'isLogin' => TRUE, 
				'nama' => $query['fullname'],
				'unit' => $query['unit'],
				'role' => $query['role']
			);
			$this->session->set_userdata($data);
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function logout(){
		$this->session->unset_userdata(array(
				'nipp' => '', 
				'isLogin' => FALSE, 
				'nama' => '',
				'unit' => '',
				'role' => ''
			));
		$this->session->sess_destroy();
	}


	function insertActionLog($client){
		$this->db->query("INSERT INTO actionLog (actionDate, action, runByNipp, runByName, kodeUnit, idDepartemen, clientIP, clientBrowser, clientOS, modulAccess, urlAccess) VALUES ('".$client['datetime']."', '".$client['action']."', '".$client['runByNipp']."', '".$client['runByName']."', '".$client['kodeUnit']."', '".$client['idDepartemen']."', '".$client['ip']."', '".$client['browser']."', '".$client['os']."', '".$client['modulAccess']."', '".$client['urlAccess']."')");
		}	
}
?>