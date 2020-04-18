<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Sla_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function tampil_semua(){
		$query = "SELECT s.id, s.namaSla, s.nilaiSla, d.id, d.namaDepartemen, 			u.kodeUnit, u.namaUnit
					FROM sla as s, unit as u,departemen as d
					WHERE s.idDepartemen=d.id and s.kodeUnit=u.kodeUnit";
		return $this->db->query($query);
	}

	public function get_by_unit($kodeUnit){
		/*
		$query = "SELECT s.id, s.namaSla, s.nilaiSla, d.id, d.namaDepartemen, u.kodeUnit, u.namaUnit
					FROM sla AS s, unit AS u, departemen AS d
					WHERE s.kodeUnit =\"$kodeUnit\"
					AND s.kodeUnit = u.kodeUnit
					AND s.idDepartemen = d.id";
		$query = $this->db->query($query)->result();
		return $query;
		*/
		$this->db->select('*, sla.id');
		$this->db->from('sla');
		$this->db->where('sla.kodeUnit',$kodeUnit);
		$this->db->join('unit','unit.kodeUnit=sla.kodeUnit','left');
		$this->db->join('departemen','departemen.id=sla.idDepartemen','left');
		return $this->db->get();		
	}

	public function getByDept($id_dept){
		/*
		$query = "SELECT s.id, s.namaSla, s.nilaiSla, d.id, d.namaDepartemen, u.kodeUnit, u.namaUnit
				FROM sla AS s, unit AS u, departemen AS d 
				WHERE s.idDepartemen = \"$id_dept\"
				AND s.kodeUnit = u.kodeUnit
				AND s.idDepartemen = d.id";
		$query = $this->db->query($query);
		return $query;
		*/
		//print_r($id_dept);die;
		$this->db->distinct();
		$this->db->select('sla.id, sla.namaSla, sla.nilaiSla, departemen.namaDepartemen, unit.namaUnit');
		$this->db->from('sla');
		$this->db->where('sla.idDepartemen',$id_dept);
		$this->db->join('departemen','departemen.id=sla.idDepartemen','left');
		$this->db->join('unit','unit.kodeUnit=sla.kodeUnit','left');
		//$this->db->group_by('sla.namaSla, sla.id');
		$this->db->order_by('sla.nilaiSla','DESC');
		//print_r($this->db->get()->result());die;
		return $this->db->get();
	}

	public function get_by_unit_dept($id_dept,$kodeUnit){
		$query = "SELECT s.id, s.namaSla, s.nilaiSla, d.id, d.namaDepartemen, u.kodeUnit, u.namaUnit
				FROM sla AS s, unit AS u, departemen AS d 
				WHERE s.idDepartemen = \"$id_dept\"
				AND s.kodeUnit = \"$kodeUnit\"
				AND s.kodeUnit = u.kodeUnit
				AND s.idDepartemen = d.id";
		$query = $this->db->query($query)->result();
		return $query;
	}

	public function tambah_sla(){
		$jumlah = $this->input->post('jumlah');
		$idSatuan = $this->input->post('satuan');

		if($idSatuan == 1){
			$detik = $jumlah*60; //konversi menit ke detik
			$satuan = 'menit';
		}else if($idSatuan == 2){
			$detik = (($jumlah*60)*60); //konversi jam ke detik
			$satuan = 'jam';
		}else if($idSatuan == 3){
			$detik = ((($jumlah*60)*60)*24); //konversi hari ke detik
			$satuan = 'hari';
		}

		$data = array(
			'idSatuan' => $idSatuan,
			'nilaiSla'	=> $detik,
			'namaSla'	=> "".$jumlah." ".$satuan."",
			'kodeUnit'	=> $this->input->post('kodeUnit'),
			'idDepartemen' => $this->input->post('idDepartemen'),
			);

		$this->db->insert('sla',$data);		
	}

	public function get_by_id($id){
		//mencari user dari nipp
		$id = array('id'=>$id);
		return $this->db->get_where('sla',$id);		
	}

	public function update_sla(){
		$jumlah = $this->input->post('jumlah');
		$idSatuan = $this->input->post('satuan');

		if($idSatuan == 1){
			$detik = $jumlah*60; //konversi menit ke detik
			$satuan = 'menit';
		}else if($idSatuan == 2){
			$detik = (($jumlah*60)*60); //konversi jam ke detik
			$satuan = 'jam';
		}else if($idSatuan == 3){
			$detik = ((($jumlah*60)*60)*24); //konversi hari ke detik
			$satuan = 'hari';
		}

		//print_r($this->input->post('idDepartemen'));die;

		$data = array(
			'idSatuan' => $idSatuan,
			'nilaiSla'	=> $detik,
			'namaSla'	=> "".$jumlah." ".$satuan."",
			'kodeUnit'	=> $this->input->post('kodeUnit'),
			'idDepartemen' => $this->input->post('idDepartemen'),
			);
		$this->db->where('id',$this->input->post('id'));
		$this->db->update('sla',$data);
	}

	public function delete($id){
		//delete data user
		//print_r($id);die;
		$this->db->where('id',$id);
		$this->db->delete('sla');
	}

}

?>