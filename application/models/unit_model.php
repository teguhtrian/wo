<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Unit_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getNameById($idUnit){
		$this->db->select('unit.namaUnit');
		$this->db->from('unit');
		$this->db->where('unit.id',$idUnit);
		return $this->db->get();
	}

	public function cari_semua(){
		//$this->db->select('*');
		//$this->db->from('unit');
		//$this->db->order_by('kodeUnit','ASC');
		//return $this->db->get();

		$query="SELECT kodeUnit, namaUnit
			FROM unit
			ORDER BY namaUnit ASC";
		$query=$this->db->query($query);
		return $query;
	}

	public function getUnitParent(){
		$query="SELECT kodeUnit, namaUnit
			FROM unit
			WHERE parentId IS NULL
			ORDER BY namaUnit ASC";
		$query=$this->db->query($query);
		return $query;
	}	


	public function getSubUnit($kodeUnit){
		// $this->db->select('a.id, a.namaDepartemen');
		// $this->db->from('departemen as a');
		// //$this->db->where('d.kodeUnit = u.kodeUnit');
		// $this->db->join('unit','unit.kodeUnit=a.kodeUnit');
		// $this->db->where('a.kodeUnit',$kodeUnit);
		// $this->db->where('a.parentId = 0');
		// $this->db->order_by('a.namaDepartemen','ASC');
		// $query = $this->db->get();
		$query="SELECT kodeUnit, namaUnit
				FROM unit
				WHERE parentId='1'
				ORDER BY kodeUnit ASC";
		//print_r($query->result());die;
		$query=$this->db->query($query);
		return $query;
	}

	public function get_all(){
		$query=$this->db->get('unit');
		return $query;
	}

	public function tambah_unit(){
		$data = array(
			'kodeUnit'	=> $this->input->post('kodeUnit'),
			'namaUnit' => $this->input->post('namaUnit'),
			'alamatUnit' => $this->input->post('alamatUnit'),
			);
		$this->db->insert('unit',$data);
	}

	public function update_by_id($id){
		$data = array(
			'kodeUnit'	=> $this->input->post('kodeUnit'),
			'namaUnit' => $this->input->post('namaUnit'),
			'alamatUnit' => $this->input->post('alamatUnit'),
		);
		//update by id
		$this->db->where('id',$id);
		$this->db->update('unit',$data);
	}

	public function get_by_unit($kodeUnit){
		return $this->db->get_where('unit',array('kodeUnit'=>$kodeUnit));
	}

	public function get_by_id($id){
		$id = array('id'=>$id);
		return $this->db->get_where('unit',$id);
	}

	public function delete($id){
		//delete data user
		$this->db->where('id',$id);
		$this->db->delete('unit');
	}

	// public function getUnitByKodeUnit($kode)
}

?>