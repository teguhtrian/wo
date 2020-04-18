<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Departemen_model extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_all(){
		/*$query = "SELECT d.id, d.namaDepartemen, u.nama_unit
					FROM unit as u, departemen as d
					WHERE u.kodeUnit=d.kodeUnit";
		*/
		$this->db->select('*');
		$this->db->from('unit u, departemen d');
		$this->db->where('u.kodeUnit = d.kodeUnit');
		$query = $this->db->get();
		return $query;
	}

	public function getNameById($idDept){
		$this->db->select('departemen.namaDepartemen');
		$this->db->from('departemen');
		$this->db->where('departemen.id',$idDept);
		$query=$this->db->get();
		//print_r($query->result());die;
		return $query;
	}

	public function getByUnit($kodeUnit){
		/*$query = "SELECT d.id, d.namaDepartemen, u.kodeUnit, u.nama_unit
					FROM unit AS u, departemen AS d
					WHERE u.kodeUnit =\"$kodeUnit\"
					AND d.kodeUnit = u.kodeUnit" ;
		*/
		$this->db->select('*, departemen.id');
		$this->db->from('departemen');
		$this->db->where('departemen.kodeUnit',$kodeUnit);
		//$this->db->where('d.kodeUnit = u.kodeUnit');
		$this->db->join('unit','unit.kodeUnit=departemen.kodeUnit');
		$query = $this->db->get();
		return $query;
	}

	public function tambah_departemen(){
		$data = array(
			'kodeUnit'	=> $this->input->post('kodeUnit'),
			'namaDepartemen' => $this->input->post('namaDepartemen'),
			);
		//print_r($data);die;
		$this->db->insert('departemen',$data);
	}

	public function update_by_id($id){
		$data = array(
			'kodeUnit'	=> $this->input->post('kodeUnit'),
			'namaDepartemen' => $this->input->post('namaDepartemen'),
		);
		//update by id
		$this->db->where('id',$id);
		$this->db->update('departemen',$data);
	}

	public function get_by_id($id){
		$id = array('id'=>$id);
		return $this->db->get_where('departemen',$id);
	}

	public function delete($id){
		//delete data user
		//print_r($id);die;
		$this->db->where('id',$id);
		$this->db->delete('departemen');
	}

}

?>