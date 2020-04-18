<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Unit_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	//public function cari_semua(){
	//	return $this->db->get('unit');
	//}
	
	public function cari_semua(){
		$query = "SELECT kodeUnit, namaUnit
					FROM unit";
		$query = $this->db->query($query);
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
}

?>