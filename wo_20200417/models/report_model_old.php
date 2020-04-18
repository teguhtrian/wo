<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function getReportByNipp($nipp){
		$query=$this->db->query(
			"SELECT DISTINCT *
				FROM (
						SELECT *
						FROM `orderdisposisi`
						WHERE dari=$nipp
						UNION ALL
						SELECT *
						FROM `orderdisposisi`
						WHERE kepada=$nipp
				) as test
				ORDER BY idOrder ASC
			");
		return $query;
	}

	public function getReportDetailByNipp($nipp){
		$query=$this->db->query(
			"
			SELECT tabel.*, convert(varchar, tabel.waktuBuat, 120) as waktuBuat, convert(varchar, tabel.waktuTutup, 120) as waktuTutup, convert(varchar, tabel.intervalWaktu, 120) as intervalWaktu, wo.namaWo, sla.namaSla, sla.nilaiSla, users.nama
			FROM(
				SELECT tabel.*, t_order.idWo, t_order.idSla
				FROM(
					SELECT orderdisposisi.*
					FROM(
						SELECT DISTINCT idOrder
						FROM (
							SELECT *
							FROM orderdisposisi
							where dari=$nipp
							union all
							SELECT *
							FROM orderdisposisi
							where kepada=$nipp
						) as tabel
					) as tabel
					LEFT JOIN orderdisposisi ON orderdisposisi.idOrder=tabel.idOrder
				) as tabel
				LEFT JOIN t_order ON t_order.id=tabel.idOrder
			) as tabel
			LEFT JOIN wo ON tabel.idWo=wo.id
			LEFT JOIN sla ON tabel.idSla=sla.id
			LEFT JOIN users ON tabel.dari=users.nipp
			ORDER BY tabel.idOrder ASC, tabel.idStatus ASC");
		return $query;
	}

}
?>