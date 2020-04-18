<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Wo_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function insertLog($date,$deskripsi,$pelaku){
		
	}

	public function get_wo($idsop){
		$this->db->select('*');
		$this->db->from('wo');
		$this->db->where('wo.idSop',$idsop);
		$query = $this->db->get();
		return $query;
	}

	public function tampil_semua(){
		$this->db->select('*, wo.id');
		$this->db->from('wo');
		//$this->db->where('d.kodeUnit = u.kodeUnit');
		$this->db->join('unit','unit.kodeUnit=wo.kodeUnit');
		$this->db->join('departemen','departemen.id=wo.idDepartemen');
		$this->db->join('sop','sop.id=wo.idSop');
		$this->db->join('sla','sla.id=wo.idSla');
		$query = $this->db->get();
		return $query;
	}

/*
	public function tampil_semua(){
		$query = "SELECT w.id_wo, w.nama_wo, so.idSop, so.nama_sop, s.idSla, s.nama_sla, 					u.kodeUnit, u.nama_unit, d.idDepartemen, d.nama_departemen
					FROM wo as w, sop as so, sla as s, unit as u,departemen as d
					WHERE w.idSop=so.idSop and w.idSla=s.idSla and w.idDepartemen=d.idDepartemen and w.kodeUnit=u.kodeUnit";
		$query = $this->db->query($query)->result();
		return $query;
	}
*/
	public function get_by_unit($kodeUnit){
		/*
		$query = "SELECT w.id_wo, w.nama_wo, sl.idSla, sl.nama_sla, s.idSop, s.nama_sop, d.idDepartemen, d.nama_departemen, u.kodeUnit, u.nama_unit
					FROM wo AS w, sla AS sl, sop AS s, unit AS u, departemen AS d
					WHERE w.kodeUnit = \"$kodeUnit\"
					AND w.kodeUnit = u.kodeUnit
					AND w.idDepartemen = d.idDepartemen
					AND w.idSla = sl.idSla
					AND w.idSop = s.idSop";
		$query = $this->db->query($query)->result();
		return $query;
		*/
		//print_r($kodeUnit);die;
		$this->db->select('*, wo.id');
		$this->db->from('wo');
		$this->db->where('wo.kodeUnit',$kodeUnit);
		//$this->db->where('d.kodeUnit = u.kodeUnit');
		$this->db->join('unit','unit.kodeUnit=wo.kodeUnit','left');
		$this->db->join('departemen','departemen.id=wo.idDepartemen','left');
		$this->db->join('sop','sop.id=wo.idSop','left');
		$this->db->join('sla','sla.id=wo.idSla','left');
		$query = $this->db->get();
		return $query;
	}

	public function get_by_dept($id_dept){
		$query = "SELECT w.id_wo, w.nama_wo, sl.idSla, sl.nama_sla, s.idSop, s.nama_sop, d.idDepartemen, d.nama_departemen, u.kodeUnit, u.nama_unit
					FROM wo AS w, sla AS sl, sop AS s, unit AS u, departemen AS d
					WHERE w.idDepartemen =\"$id_dept\"
					AND w.kodeUnit = u.kodeUnit
					AND w.idDepartemen = d.idDepartemen
					AND w.idSla = sl.idSla
					AND w.idSop = s.idSop";
		$query = $this->db->query($query)->result();
		return $query;
	}

	public function get_by_unit_dept($id_dept,$kodeUnit){
		$query = "SELECT w.id_wo, w.nama_wo, sl.idSla, sl.nama_sla, s.idSop, s.nama_sop, d.idDepartemen, d.nama_departemen, u.kodeUnit, u.nama_unit
					FROM wo AS w, sla AS sl, sop AS s, unit AS u, departemen AS d
					WHERE w.idDepartemen =\"$id_dept\"
					AND w.kodeUnit = \"$kodeUnit\"
					AND w.kodeUnit = u.kodeUnit
					AND w.idDepartemen = d.idDepartemen
					AND w.idSla = sl.idSla
					AND w.idSop = s.idSop";
		$query = $this->db->query($query)->result();
		return $query;
	}	

	public function tambah_wo(){
		$jenper=explode('-',$this->input->post('jenper'));
		//print_r($jenper);die;
		$data = array(
			'idSop' => $this->input->post('idSop'),
			'namaWo'	=> $this->input->post('namaWo'),
			'idSla'	=> $this->input->post('idSla'),
			'kodeUnit'	=> $this->input->post('kodeUnit'),
			'idDepartemen' => $this->input->post('idDepartemen'),
			'jenisWo' => $jenper[0],
			'idJenisWo' => $jenper[1],
			);
		//print_r($data);die;
		$this->db->insert('wo',$data);		
	}

	public function get_by_id($id){
		//mencari user dari nipp
		$id = array('id'=>$id);
		return $this->db->get_where('wo',$id);		
	}

	public function update_wo($id_wo){
		//print_r($id_wo);die;
		$data = array(
			'idSop' => $this->input->post('idSop'),
			'namaWo'	=> $this->input->post('namaWo'),
			'idSla'	=> $this->input->post('idSla'),
			'kodeUnit'	=> $this->input->post('kodeUnit'),
			'idDepartemen' => $this->input->post('idDepartemen'),
			'jenisWo' => $this->input->post('jenper')
			);

		$this->db->where('id',$id_wo);
		$this->db->update('wo',$data);
	}

	public function upDeptWoByIdSop($idSop){
		//print_r($id_wo);die;
		$data = array(
			'idDepartemen' => $this->input->post('idDepartemen'),
			);

		$this->db->where('idSop',$idSop);
		$this->db->update('wo',$data);
	}	

	public function delete($id){
		//delete data user
		$this->db->where('id',$id);
		$this->db->delete('wo');
	}

}

?>