<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Sop_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_sop($iddept,$kodeUnit){
		$this->db->select('*');
		$this->db->from('sop');
		$this->db->where('sop.idDepartemen',$iddept);
		$this->db->where('sop.kodeUnit',$kodeUnit);
		$query = $this->db->get();
		return $query;
	}

	public function tampil_semua(){
		$query = "SELECT s.id, s.namaSop, d.id, d.namaDepartemen, u.kodeUnit, u.namaUnit
				FROM sop as s, departemen as d, unit as u 
				WHERE s.idDepartemen=d.id and s.kodeUnit=u.kodeUnit";
		return $this->db->query($query);
	}

	public function get_by_unit($kodeUnit){
		/*
		$query = "SELECT s.id, s.namaSop, d.idDepartemen, d.nama_departemen, u.kodeUnit, u.nama_unit
					FROM sop AS s, unit AS u, departemen AS d
					WHERE s.kodeUnit =\"$kodeUnit\"
					AND s.kodeUnit = u.kodeUnit
					AND s.idDepartemen = d.idDepartemen";
		$query = $this->db->query($query);
		return $query;
		*/
		$this->db->select('*, sop.id');
		$this->db->from('sop');
		$this->db->where('sop.kodeUnit',$kodeUnit);
		//$this->db->where('d.kodeUnit = u.kodeUnit');
		$this->db->join('unit','unit.kodeUnit=sop.kodeUnit','left');
		$this->db->join('departemen','departemen.id=sop.idDepartemen');
		$query = $this->db->get();
		return $query;
	}

	public function get_by_dept($id_dept){
		/*
		$query = "SELECT s.id, s.namaSop, d.idDepartemen, d.nama_departemen, u.kodeUnit, u.nama_unit
					FROM sop AS s, unit AS u, departemen AS d
					WHERE s.idDepartemen =\"$id_dept\"
					AND s.kodeUnit = u.kodeUnit
					AND s.idDepartemen = d.idDepartemen";
		$query = $this->db->query($query)->result();
		return $query;
		*/
		$this->db->select('sop.namaSop, sop.id');
		$this->db->from('sop');
		$this->db->where('sop.idDepartemen',$id_dept);
		$this->db->join('departemen','departemen.id=sop.idDepartemen','left');
		return $this->db->get();

	}
/*
	public function get_by_unit_dept($id_dept,$kodeUnit){
		$query = "SELECT s.id, s.namaSop, d.idDepartemen, d.nama_departemen, u.kodeUnit, u.nama_unit
					FROM sop AS s, unit AS u, departemen AS d
					WHERE s.idDepartemen =\"$id_dept\"
					AND s.kodeUnit = \"$kodeUnit\"
					AND s.kodeUnit = u.kodeUnit
					AND s.idDepartemen = d.idDepartemen";
		$query = $this->db->query($query)->result();
		return $query;
	}
*/
	public function tambah_sop(){
		$data = array(
			'namaSop'	=> $this->input->post('namaSop'),
			'kodeUnit'	=> $this->input->post('kodeUnit'),
			'idDepartemen' => $this->input->post('idDepartemen'),
			);
		//print_r($data);die;
		$this->db->insert('sop',$data);

	}

	public function get_by_id($id){
		//mencari user dari nipp
		$id = array('id'=>$id);
		return $this->db->get_where('sop',$id);		
	}

	public function update_sop(){
		$data = array(
			'namaSop'	=> $this->input->post('namaSop'),
			'kodeUnit'	=> $this->input->post('kodeUnit'),
			'idDepartemen' => $this->input->post('idDepartemen'),
			);
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('sop',$data);
	}

	public function delete($id){
		//delete data user
		//print_r($id);die;
		$this->db->where('id',$id);
		$this->db->delete('sop');
	}

}

?>