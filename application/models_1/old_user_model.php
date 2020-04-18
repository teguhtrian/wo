<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class User_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function updatePassByNipp($passBaru,$nipp){
		$data = array(
			'password' => $passBaru,
			);
		$this->db->where('nipp',$nipp);
		$this->db->update('users',$data);
	}

	public function getUserData($nipp){
		$this->db->select('users.*, unit.namaUnit, departemen.namaDepartemen, role.namaRole');
		$this->db->from('users');
		$this->db->where('users.nipp',$nipp);
		$this->db->join('unit','unit.kodeUnit=users.kodeUnit','left');
		$this->db->join('departemen','departemen.id=users.idDepartemen','left');
		$this->db->join('role','role.id=users.idRole','left');
		$query=$this->db->get();
		return $query;		
	}

	public function ceknipp($nipp){
		$this->db->select('users.*, unit.namaUnit');
		$this->db->from('users');
		$this->db->where('users.nipp',$nipp);
		$this->db->join('unit','unit.kodeUnit=users.kodeUnit','left');
		$query=$this->db->get();
		return $query;
	}

	public function get_staf($iddept,$kodeUnit){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('users.idDepartemen',$iddept);
		$this->db->where('users.kodeRole = "peg"');
		$this->db->where('users.kodeUnit',$kodeUnit);
		$query = $this->db->get()->result();
		return $query;		
	}

	public function getPegByDept($idDept){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('users.idDepartemen',$idDept);
		$this->db->where('users.idRole >= 7');
		$this->db->order_by('users.idRole','ASC');
		$this->db->order_by('users.nama','ASC');
		return $this->db->get();
	}

	public function getAllPegByDept($idDept){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('users.idDepartemen',$idDept);
		//$this->db->where('user.kodeRole = "staf"');
		return $this->db->get();
	}

	public function getAllPegByUnit($kodeUnit){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('users.kodeUnit',$kodeUnit);
		$this->db->where('users.kodeRole != "ac"');
		$this->db->where('users.kodeRole != "sa"');
		$this->db->order_by('users.idRole','ASC');
		$this->db->order_by('users.nama','ASC');
		return $this->db->get();
	}

	public function getSuperior(){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('users.idDepartemen',$this->session->userdata('idDepartemen'));
		$this->db->where('users.idRole',($this->session->userdata('idRole')-1));
		return $this->db->get();
	}

	public function get_kbag($iddept,$kodeUnit){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('users.idDepartemen',$iddept);
		$this->db->where('users.kodeRole = "kbag"');
		$this->db->where('users.kodeUnit',$kodeUnit);
		$query = $this->db->get();
		return $query;
	}

	public function get_kcab($unit,$kepala){
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->where('u.kodeUnit',$unit);
		$this->db->where('u.kodeRole',$kepala);
		$query = $this->db->get()->result();
		//print_r($query);die;
		return $query;		
	}

	public function get_kdiv($id_dept,$kepala){
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->where('u.idDepartemen',$id_dept);
		$this->db->where('u.kodeRole',$kepala);
		$query = $this->db->get()->result();
		//print_r($query);die;
		return $query;
	}

	public function tampil_semua(){
		/*
		$query = "SELECT us.id, us.nipp, us.nama_dpn, us.nama_blkg, us.kodeRole, us.kodeUnit, us.idDepartemen, d.idDepartemen, d.nama_departemen, u.kodeUnit, u.nama_unit, us.lastLog
					FROM user AS us, unit AS u, departemen AS d
					WHERE us.kodeUnit = u.kodeUnit
					AND us.idDepartemen = d.idDepartemen";
		$query = $this->db->query($query);
		*/
		$this->db->select('*, users.id');
		$this->db->from('users');
		$this->db->join('role', 'role.id=users.idRole','left');
		$this->db->join('unit','unit.kodeUnit=users.kodeUnit','left');
		$this->db->join('departemen','departemen.id=users.idDepartemen','left');
		$query = $this->db->get();
		return $query;
	}

	public function get_by_dept($id_dept){
		$query = "SELECT us.id, us.nipp, us.nama_dpn, us.nama_blkg, us.kodeRole, us.kodeUnit, us.idDepartemen, d.nama_departemen, u.kodeUnit, u.nama_unit, us.lastLog
					FROM users AS us, unit AS u, departemen AS d
					WHERE us.idDepartemen = \"$id_dept\"
					AND us.kodeUnit = u.kodeUnit
					AND us.idDepartemen = d.idDepartemen";
		$query = $this->db->query($query);
		return $query;
	}

	public function get_by_unit_dept($id_dept,$kodeUnit){
		$query = "SELECT us.id, us.nipp, us.nama_dpn, us.nama_blkg, us.kodeRole, us.kodeUnit, us.idDepartemen, d.nama_departemen, u.kodeUnit, u.nama_unit, us.lastLog
					FROM users AS us, unit AS u, departemen AS d
					WHERE us.idDepartemen = \"$id_dept\"
					AND us.kodeUnit = \"$kodeUnit\"
					AND us.kodeUnit = u.kodeUnit
					AND us.idDepartemen = d.idDepartemen
					ORDER BY us.nama_blkg ASC";
		$query = $this->db->query($query);
		return $query;
	}

	public function ambil_user($nipp){
		$query = $this->db->get_where($this->tbl,array('nipp'=>$nipp));
		$query = $query->result_array();
		if($query){
			return $query[0];
		}
	}

	public function cari_semua(){
		return $this->db->get('users');
	}

	public function cari_password(){
		return $this->db->get('users',1);
	}

	public function tambah_user(){
		$role=explode('-', $this->input->post('kodeRole'));
		$data = array(
			'nipp'	=> $this->input->post('nipp'),
			'nama' => $this->input->post('nama'),
			'password' => md5('12345'),
			'kodeUnit' => $this->input->post('kodeUnit'),
			'kodeRole' =>  $role[0],
			'idRole' => $role[1],
			'idDepartemen' => $this->input->post('idDepartemen'),
			);
		//print_r($data);die;
		$this->db->insert('users',$data);
	}
	public function tambah_user_unit($kodeUnit){
		$data = array(
			'nipp'	=> $this->input->post('nipp'),
			'nama_dpn' => $this->input->post('nama_dpn'),
			'nama_blkg' => $this->input->post('nama_blkg'),
			'password' => md5('12345'),
			'kodeUnit' => $kodeUnit,
			'kodeRole' => $this->input->post('kodeRole'),
			'idDepartemen' => $this->input->post('idDepartemen'),
			);
		//print_r($data);die;
		$this->db->insert('users',$data);
	}

	public function log_logout(){
		$data = array(
			'lastLog' => date("Y-m-d H:i:s")
			);
		//print_r($data);die;
		$nipp = $this->session->userdata('nipp');
		$this->db->where('nipp',$nipp);
		$this->db->update('users',$data);		
	}

	public function get_by_id($id){
		//mencari user dari nipp
		$id = array('id'=>$id);
		return $this->db->get_where('users',array('id'=>$id));
	}
/*
	public function get_by_unit($kodeUnit){
		$query = "SELECT us.id, us.nipp, us.nama_dpn, us.nama_blkg, us.kodeRole, us.kodeUnit, us.idDepartemen, d.idDepartemen, d.nama_departemen, u.kodeUnit, u.nama_unit, us.lastLog
					FROM user AS us, unit AS u, departemen AS d
					WHERE us.kodeUnit=\"$kodeUnit\"
					AND us.kodeUnit = u.kodeUnit
					AND us.idDepartemen = d.idDepartemen";
		$query = $this->db->query($query);
		return $query = $query->result();
	}
*/

	public function get_by_unit($kodeUnit){
		$this->db->select('*,users.id');
		$this->db->from('users');
		$this->db->where('users.kodeUnit',$kodeUnit);
		$this->db->join('unit','unit.kodeUnit=users.kodeUnit','left');
		$this->db->join('departemen','departemen.id=users.idDepartemen','left');
		$this->db->join('role','role.id=users.idRole','left');
		$query=$this->db->get();
		//print_r($query);die;
		return $query;
	}
	public function update_user(){
		$role=explode('-', $this->input->post('kodeRole'));
		$data = array(
			'nipp'	=> $this->input->post('nipp'),
			'nama' => $this->input->post('nama'),
			'password' => md5('12345'),
			'kodeUnit' => $this->input->post('kodeUnit'),
			'idDepartemen' => $this->input->post('idDepartemen'),
			'kodeRole' => $role[0],
			'idRole' => $role[1],
			);
		$this->db->where('nipp',$this->input->post('nipp'));
		$this->db->update('users',$data);
	}

	public function delete($id){
		//delete data user
		//print_r($id);die;
		$this->db->where('id',$id);
		$this->db->delete('users');
	}

	public function user_by_unit($unit){
		//ambil data unit dari user
		//panggil data user sesuai unit yang ambil
		$query = $this->db->get_where('users',array('unit'=>$unit));
		return $query;
	}

	public function update_password($pass_baru1){

	}
}
?>