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
						FROM orderdisposisi
						WHERE dari=$nipp
						UNION ALL
						SELECT *
						FROM orderdisposisi
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

	public function getReportDetailPerbagian($idDept,$periode){
		$periode=explode("-", $periode);
		$periodeAwal=$periode[1]."-".$periode[0]."-"."01";
		$periodeAkhir=date("Y-m-t", strtotime($periodeAwal));
		//print_r($idDept);die;
		$nippPerBagian=$this->user_model->getNippPegByDept($idDept)->result();
		//print_r($nippPerBagian);die;
		//foreach untuk semua nipp
		$query=null;
		foreach ($nippPerBagian as $row) {
			//print_r($row->nipp);
			$query[]=$this->db->query("
			SELECT table3.idOrder, table3.dari, convert(varchar,  table3.waktuBuat, 120) as waktuBuat, convert(varchar,  table3.waktuTutup, 120) as waktuTutup, table3.idWo, users.nama, wo.namaWo, sla.namaSla, volumekerja.pelapor, volumekerja.namaItem, volumekerja.jumlah, volumekerja.namaSatuan, volumekerja.id as idVK, volumekerja.waktuBuat as waktuLapor, DATEDIFF(hour, table3.waktuBuat, table3.waktuTutup) AS jam, DATEDIFF(minute, table3.waktuBuat, table3.waktuTutup) AS menit
			FROM (
				--pilih detail idorder sesuai data tiket order
				SELECT table2.idOrder, table2.dari, t_order.waktuBuat, t_order.waktuTutup, idWo, idSla, idTiketStatus
				FROM (
					--pilih idorder yang telah ditutup
					SELECT DISTINCT table1.idOrder, table1.dari
					FROM (
						--pilih order yang terkait dirinya
						SELECT DISTINCT od1.idOrder, od1.dari
						FROM orderdisposisi as od1
						WHERE dari=$row->nipp  AND (waktuBuat BETWEEN CONVERT(datetime, '$periodeAwal') AND CONVERT(datetime, '$periodeAkhir 23:59:59:999')) --AND idStatus= 4
						UNION ALL
						SELECT DISTINCT od2.idOrder, od2.kepada 
						FROM orderdisposisi as od2
						WHERE kepada=$row->nipp  AND (waktuBuat BETWEEN CONVERT(datetime, '$periodeAwal') AND CONVERT(datetime, '$periodeAkhir 23:59:59:999')) --AND idStatus= 4
					) AS table1
					LEFT JOIN orderdisposisi ON orderdisposisi.idOrder = table1.idOrder
					WHERE orderdisposisi.idStatus=4
				) AS table2
				LEFT JOIN t_order ON t_order.id=table2.idOrder
				WHERE (waktuBuat BETWEEN CONVERT(datetime, '$periodeAwal') AND CONVERT(datetime, '$periodeAkhir 23:59:59:999'))
			) AS table3
			LEFT JOIN wo ON wo.id=table3.idWo
			LEFT JOIN volumekerja ON volumekerja.idOrder=table3.idOrder AND volumekerja.pelapor=table3.dari
			LEFT JOIN sla ON sla.id=table3.idSla
			LEFT JOIN users ON users.nipp=table3.dari
			ORDER BY table3.idOrder ASC, table3.waktuBuat ASC
			")->result_array();
		}
			return $query;
	}

}
?>