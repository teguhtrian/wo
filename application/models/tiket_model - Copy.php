<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tiket_model extends CI_model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
		//$this->output->cache(1);
	}

	public function closeOrder($idOrder){
		//echo'close';print_r($idOrder);die;
		//$time1=new DateTime($order['waktuBuat']);
		//$time2=new DateTime(date('Y-m-d H:i:s'));
		//$interval=
		//print_r($order['noTiket']);die;
		$order=array(
			"idTiketStatus"=>4,
			"responAkhir"=>date('Y-m-d H:i:s'),
			"waktuTutup"=>date('Y-m-d H:i:s'),
			);
		$this->db->where('id',$idOrder);
		$this->db->update('t_order',$order);

		$order=$this->db->get_where('t_order',array('id'=>$idOrder))->row_array();
		//print_r($order);die;
		$disposisi=array(
			"idOrder"=>$idOrder,
			"noTiket"=>$order['noTiket'],
			"waktuBuat"=>date('Y-m-d H:i:s'),
			"dari"=>$this->session->userdata('nipp'),
			"idStatus"=>4,
			"keterangan"=>'DITUTUP',
			);
		$this->db->insert('orderDisposisi',$disposisi);

		if (!empty($order['noLi'])) {
			//print_r($order['noLi']);die;
			$li=array(
				"idStatus"=>4,
				"keterangan"=>'Ditutup oleh '.$this->session->userdata('nama').' ('.$this->session->userdata('nipp').')',
				"waktuTutup"=>date('Y-m-d H:i:s'),
				"responAkhir"=>date('Y-m-d H:i:s'),
				);
			$this->db->where('id',$order['idLi']);
			$this->db->update('layananInformasi',$li);
		}
	}

	public function verifiedOrder($idOrder){
		//echo'verified';print_r($idOrder);die;
		$order=array(
			"idTiketStatus"=>5,
			"responAkhir"=>date('Y-m-d H:i:s'),
			//"waktuTutup"=>date('Y-m-d H:i:s'),
			);
		$this->db->where('id',$idOrder);
		$this->db->update('t_order',$order);

		$order=$this->db->get_where('t_order',array('id'=>$idOrder))->row_array();
		$disposisi=array(
			"idOrder"=>$idOrder,
			"noTiket"=>$order['noTiket'],
			"waktuBuat"=>date('Y-m-d H:i:s'),
			"dari"=>$this->session->userdata('nipp'),
			"idStatus"=>5,
			"keterangan"=>'TERVERIFIKASI',
			);
		$this->db->insert('orderDisposisi',$disposisi);
	}

	public function reportOrder($idOrder){
		//echo'reporting';print_r($idOrder);die;
		$order=array(
			"idTiketStatus"=>4,
			"responAkhir"=>date('Y-m-d H:i:s'),
			);
		$this->db->where('id',$idOrder);
		$this->db->update('t_order',$order);

		$order=$this->db->get_where('t_order',array('id'=>$idOrder))->row_array();
		$disposisi=array(
			"idOrder"=>$idOrder,
			"noTiket"=>$order['noTiket'],
			"waktuBuat"=>date('Y-m-d H:i:s'),
			"dari"=>$this->session->userdata('nipp'),
			"idStatus"=>4,
			"keterangan"=>'DITUTUP',
			);
		$this->db->insert('orderDisposisi',$disposisi);
	}

	public function getMyOrderOpen($nipp){
		$query=$this->db->query("
			SELECT TOP 100 idOrder, noTiket, waktuBuat, nama, namaSla, namaStatus
				FROM(
					SELECT DISTINCT idOrder
						FROM(
							SELECT idOrder, dari, kepada
								FROM orderdisposisi
								WHERE dari=$nipp
								GROUP BY idOrder, dari, kepada
								HAVING COUNT(idOrder) > 0
							UNION ALL
							SELECT idOrder, dari, kepada
								FROM orderdisposisi
								WHERE kepada=$nipp
						) 
				as tiketSaya) as tiketsaya
				LEFT JOIN t_order ON t_order.id = tiketsaya.idOrder
				LEFT JOIN sla ON sla.id = t_order.idSla
				LEFT JOIN users ON users.nipp = t_order.dari
				LEFT JOIN orderstatus ON orderstatus.id = t_order.idTiketStatus
				WHERE t_order.idTiketStatus < 4
				ORDER BY t_order.id DESC
		");
		//print_r($query->result());die;
		return $query;
	}

	public function getDiteruskanOrder($idOrder){
		$query=$this->db->query("
			SELECT TOP (1000) a.[id]
			      ,a.[idOrder]
			      ,a.[noTiket]
			      ,a.[dari]
			      ,a.[kepada]
	  			  ,a.[idStatus]
				  ,a.[keterangan]
			  FROM [db_workorder_new].[dbo].[orderdisposisi] a, t_order b
			  WHERE a.idOrder='$idOrder' AND a.idOrder=b.id AND b.waktuTutup IS NULL AND a.keterangan='DITERUSKAN' AND a.idStatus='2'
		");
		//print_r($query->result());die;
		return $query;		
	}

	public function getDitugaskanOrder($idOrder){
		$query=$this->db->query("
			SELECT TOP (1000) a.[id]
			      ,a.[idOrder]
			      ,a.[noTiket]
			      ,a.[dari]
			      ,a.[kepada]
	  			  ,a.[idStatus]
				  ,a.[keterangan]
			  FROM [db_workorder_new].[dbo].[orderdisposisi] a, t_order b
			  WHERE a.idOrder='$idOrder' AND a.idOrder=b.id AND b.waktuTutup IS NULL AND a.keterangan='DITUGASKAN' AND a.idStatus='3'
		");
		//print_r($query->result());die;
		return $query;		
	}


	public function getMyOrderClosed($nipp){
		/*
		$this->db->select('*, d.id, CONCAT(u.nama) as dari');
		$this->db->from('orderDisposisi as d');
		$this->db->where('d.kepada',$nipp);
		//$this->db->where('d.dari',$nipp);
		$this->db->where('o.idTiketStatus = 6');
		$this->db->join('t_order as o','o.id=d.idOrder','left');
		$this->db->join('sla as s','s.id=o.idSla','left');
		$this->db->join('user as u','u.nipp=o.dari','left');
		$this->db->join('orderstatus as os','os.id=o.idTiketStatus','left');
		$this->db->order_by('d.id','DESC');
		return $this->db->get();
		
		$query=$this->db->query("
			SELECT *
			FROM(
			SELECT DISTINCT idOrder
			FROM(
			SELECT idOrder, dari, kepada
			FROM `orderdisposisi`
			WHERE dari= $nipp
			GROUP BY idOrder
			HAVING COUNT(idOrder) > 0
			UNION ALL
			SELECT idOrder, dari, kepada
			FROM `orderdisposisi`
			WHERE kepada= $nipp) as tiketSaya) as tiketsaya
			LEFT JOIN t_order ON t_order.id=tiketsaya.idOrder
			LEFT JOIN sla ON sla.id=t_order.idSla
			LEFT JOIN users ON users.nipp=t_order.dari
			LEFT JOIN orderstatus ON orderstatus.id=t_order.idTiketStatus
			WHERE t_order.idTiketStatus >= 4
			ORDER BY t_order.id DESC
		");
		*/
		$query=$this->db->query("
			SELECT TOP 200 idOrder, noTiket, waktuBuat, nama, namaSla, namaStatus
				FROM(
					SELECT DISTINCT idOrder
						FROM(
							SELECT idOrder, dari, kepada
								FROM orderdisposisi
								WHERE dari=$nipp
								GROUP BY idOrder, dari, kepada
								HAVING COUNT(idOrder) > 0
							UNION ALL
							SELECT idOrder, dari, kepada
								FROM orderdisposisi
								WHERE kepada=$nipp
						) 
				as tiketSaya) as tiketsaya
				LEFT JOIN t_order ON t_order.id = tiketsaya.idOrder
				LEFT JOIN sla ON sla.id = t_order.idSla
				LEFT JOIN users ON users.nipp = t_order.dari
				LEFT JOIN orderstatus ON orderstatus.id = t_order.idTiketStatus
				WHERE t_order.idTiketStatus = 4
				ORDER BY t_order.id DESC
		");
		return $query;
	}

	public function getLiByUnit($kodeUnit){
		$this->db->select('*, li.id, un1.namaUnit as unitAsal, un2.namaUnit as unitTujuan, d1.namaDepartemen as departemenAsal, d2.namaDepartemen as departemenTujuan , u1.nama as dari, u2.nama as kepada, p.namaPrioritas as prioritas');
		$this->db->from('layananInformasi as li');
		$this->db->where('li.kodeUnitTujuan',$kodeUnit);
		$this->db->join('users as u1','u1.nipp=li.dari','left');
		$this->db->join('users as u2','u2.nipp=li.kepada','left');
		$this->db->join('jenisPrioritas as p','p.id=li.idPrioritas','left');
		$this->db->join('layananInformasiStatus','layananInformasiStatus.id=li.idStatus','left');
		$this->db->join('unit as un1','un1.kodeUnit=li.kodeUnitAsal','left');
		$this->db->join('unit as un2','un2.kodeUnit=li.kodeUnitTujuan','left');
		$this->db->join('departemen as d1','d1.id=li.idDepartemenAsal','left');
		$this->db->join('departemen as d2','d2.id=li.idDepartemenTujuan','left');
		//$this->db->join('jenisGangguan as g','g.id=layananinformasi.subjek','left');
		$this->db->order_by('li.id','DESC');
		return $this->db->get();
	}

	public function getOrderbyUnit($kodeUnit){
	$this->db->select('*, t_order.id, deptTujuan.namaDepartemen as deptTujuan, deptAsal.namaDepartemen as deptAsal, unitTujuan.namaUnit as unitTujuan, unitAsal.namaUnit as unitAsal', 'unitTujuan.namaUnit as unitTujuan, unitAsal.namaUnit as unitAsal');
		$this->db->from('t_order');
		$this->db->where('kodeUnitTujuan',$kodeUnit);
		$this->db->join('departemen as deptTujuan','deptTujuan.id=t_order.idDepartemenTujuan','left');
		$this->db->join('departemen as deptAsal','deptAsal.id=t_order.idDepartemenAsal','left');
		$this->db->join('unit as unitTujuan','unitTujuan.id=t_order.kodeUnitTujuan','left');
		$this->db->join('unit as unitAsal','unitAsal.id=t_order.kodeUnitAsal','left');
		$this->db->join('sla','sla.id=t_order.idSla','left');
		$this->db->join('sop','sop.id=t_order.idSop','left');
		$this->db->join('wo','wo.id=t_order.idWo','left');
		$this->db->join('users','users.nipp=t_order.dari');
		$this->db->join('layananInformasiStatus','layananInformasiStatus.id=t_order.idtiketStatus','left');
		$this->db->join('orderstatus','orderstatus.id=t_order.idTiketStatus','left');
		$this->db->order_by('t_order.id','DESC');
		//$this->db->join('unit');
		return $this->db->get();
	}

	public function getVolKerjaById($idOrder){
		$this->db->select('*');
		$this->db->from('volumekerja');
		$this->db->where('volumekerja.idOrder',$idOrder);
		$this->db->join('users','users.nipp=volumekerja.pelapor','left');
		return $this->db->get();
	}

	public function addVolKerjaByIdOrder($idOrder){
		//print_r($this->input->post('namaItem'));die;
		$order=$this->db->get_where('t_order',array('id'=>$idOrder))->row_array();
		//print_r($order);die;
		$nama=$this->input->post('namaItem');
		$jumlah=$this->input->post('jumlahItem');
		$satuan=$this->input->post('satuanItem');
		//print_r($nama);die;
		foreach ($nama as $row =>$data){
			$volume=array(
				"idOrder"=>$idOrder,
				"noTiket"=>$order['noTiket'],
				"pelapor"=>$this->session->userdata('nipp'),
				"namaItem"=>$data,
				"jumlah"=>$jumlah[$row],
				"namaSatuan"=>$satuan[$row],
				"waktuBuat"=>date('Y-m-d H:i:s'),
				);	
			//print_r($volume);die;
			$this->db->insert('volumeKerja',$volume);
		}
	}

	public function getOrderByDept($idDept){
		$this->db->select('*, deptTujuan.namaDepartemen as deptTujuan, deptAsal.namaDepartemen as deptAsal, unitTujuan.namaUnit as unitTujuan, unitAsal.namaUnit as unitAsal', 'unitTujuan.namaUnit as unitTujuan, unitAsal.namaUnit as unitAsal');
		$this->db->from('t_order');
		$this->db->join('departemen as deptTujuan','deptTujuan.id=t_order.idDepartemenTujuan','left');
		$this->db->join('departemen as deptAsal','deptAsal.id=t_order.idDepartemenAsal','left');
		$this->db->join('unit as unitTujuan','unitTujuan.id=t_order.kodeUnitTujuan','left');
		$this->db->join('unit as unitAsal','unitAsal.id=t_order.kodeUnitAsal','left');
		$this->db->join('sla','sla.id=t_order.idSla','left');
		$this->db->join('users','users.nipp=t_order.dari');
		$this->db->join('layananInformasiStatus','layananInformasiStatus.id=t_order.idStatus','left');
		//$this->db->join('unit');
		$this->db->where('idDepartemenTujuan',$idDept);
		return $this->db->get();
	}

	public function getOrderOpenByDept($idDept){
		
		$this->db->select('TOP 200 t_order.id, t_order.noTiket, users.nama, users.nipp, sop.namaSop, wo.namaWo, sla.namaSla, t_order.waktuBuat, t_order.responAkhir, orderStatus.namaStatus');
		$this->db->from('t_order');
		$this->db->where('idDepartemenTujuan',$idDept);
		$this->db->join('sla','sla.id=t_order.idSla','left');
		$this->db->join('sop','sop.id=t_order.idSop','left');
		$this->db->join('wo','wo.id=t_order.idWo','left');
		$this->db->join('orderStatus','orderStatus.id=t_order.idTiketStatus','left');
		$this->db->join('users','users.nipp=t_order.dari','left');
		$this->db->where('idTiketStatus !=',5);
		$this->db->order_by('t_order.id','DESC');
		return $this->db->get();
		/*
		$query = "
			SELECT TOP 200 t_order.id, t_order.noTiket, users.nama, users.nipp, sop.namaSop, wo.namaWo, sla.namaSla, t_order.waktuBuat, t_order.responAkhir, orderStatus.namaStatus
			FROM t_order
			LEFT JOIN sla ON sla.id=t_order.idSla
			LEFT JOIN sop ON sop.id=t_order.idSop
			LEFT JOIN wo ON wo.id=t_order.idWo
			LEFT JOIN orderStatus ON orderStatus.id=t_order.idTiketStatus
			LEFT JOIN users ON users.nipp=t_order.dari
			WHERE idDepartemenTujuan=$idDept AND idTiketStatus!=5
			ORDER BY t_order.id DESC
		";
		$query=$this->db->query($query);
		return $query;
		*/
	}

	public function getOrderClosedByDept($idDept){
		$this->db->select('TOP 100 t_order.id, t_order.noTiket, users.nama, users.nipp, sop.namaSop, sla.namaSla, wo.namaWo, t_order.waktuBuat, t_order.responAkhir, orderStatus.namaStatus');
		$this->db->from('t_order');
		$this->db->join('sla','sla.id=t_order.idSla','left');
		$this->db->join('sop','sop.id=t_order.idSop','left');
		$this->db->join('wo','wo.id=t_order.idWo','left');
		$this->db->join('orderStatus','orderStatus.id=t_order.idTiketStatus','left');
		$this->db->join('users','users.nipp=t_order.dari','left');
		$this->db->where('idTiketStatus =',5);
		$this->db->where('idDepartemenTujuan',$idDept);
		$this->db->order_by('t_order.id','DESC');
		return $this->db->get();		
	}

	public function getUnitLiOpenCloseAll(){
		$query="SELECT TOP 100 a.parentId, a.id, a.kodeUnit, a.namaUnit, 
				SUM(CASE WHEN li.jenisInformasi = 1 and li.idStatus != 4 THEN 1 ELSE 0 END) as openInfo, 
				SUM(CASE WHEN li.jenisInformasi = 1 and li.idStatus = 4 THEN 1 ELSE 0 END) as closeInfo, 
				SUM(CASE WHEN li.jenisInformasi = 2 and li.idStatus != 4 THEN 1 ELSE 0 END) as openPeng, 
				SUM(CASE WHEN li.jenisInformasi = 2 and li.idStatus = 4 THEN 1 ELSE 0 END) as closePeng
				FROM unit as a
				LEFT JOIN layananInformasi as li ON li.kodeUnitTujuan=a.kodeUnit
				WHERE a.kodeUnit <>'00'
				GROUP BY a.namaUnit, a.kodeUnit, a.parentId, a.id
				ORDER BY parentId ASC, a.namaUnit ASC, a.kodeUnit ASC";
		$query=$this->db->query($query);
		return $query;
	}

	public function getDeptLiReportByUnit($kodeUnit){

		$query="
			SELECT TOP 100 a.kodeUnit, a.namaUnit, 
			SUM(CASE WHEN li.jenisInformasi = 1 and li.idStatus != 4 THEN 1 ELSE 0 END) as openInfo, 
			SUM(CASE WHEN li.jenisInformasi = 1 and li.idStatus = 4 THEN 1 ELSE 0 END) as closeInfo, 
			SUM(CASE WHEN li.jenisInformasi = 2 and li.idStatus != 4 THEN 1 ELSE 0 END) as openPeng, 
			SUM(CASE WHEN li.jenisInformasi = 2 and li.idStatus = 4 THEN 1 ELSE 0 END) as closePeng
			FROM unit as a
			LEFT JOIN layananInformasi as li ON li.kodeUnitTujuan=a.kodeUnit
			GROUP BY a.namaUnit, a.kodeUnit
			ORDER BY a.namaUnit ASC, a.kodeUnit ASC
		";
		$query=$this->db->query($query);
		return $query;
	}

	public function getDeptOrderReportByUnit($kodeUnit){
		$this->db->select('a.id, a.namaDepartemen, 
sum(CASE WHEN b.idtiketstatus != 5 THEN 1 ELSE 0 END) as tiketOpen, 
sum(CASE WHEN b.idtiketstatus = 5 THEN 1 ELSE 0 END) as tiketClose');
		$this->db->from('departemen as a');
		$this->db->join('t_order as b','b.idDepartemenTujuan=a.id','left');
		$this->db->where('a.kodeUnit',$kodeUnit);
		$this->db->group_by('a.namaDepartemen, a.id');
		return $query=$this->db->get();
		/*
		$query="SELECT a.id, a.namaDepartemen, sum(b.idtiketstatus!=6) as open, sum(b.idtiketstatus=6) as close
						FROM departemen a
						left outer join t_order b on b.iddepartementujuan=a.id
						where a.kodeUnit=".$kodeUnit."
						group by a.namadepartemen";
		return $this->db->query($query);
		*/
	}

	public function addOrder(){
		$data=$this->db->get('t_order');
		$row=$data->num_rows;$row++;
		//print_r($row);die;
		$noTiket=strtoupper($this->session->userdata('role')).'/ORDER/'.$this->session->userdata('kodeUnit').'/'.date('Y').'/'.$row;
		//print_r($noTiket);die;
		$order=array(
			'waktuBuat'=>date('Y-m-d H:i:s'),
			'noTiket'=>$noTiket,
			'kodeUnitTujuan'=>$this->session->userdata('kodeUnit'),
			'idDepartemenTujuan'=>$this->input->post('departemen'),
			'kodeUnitAsal'=>$this->session->userdata('kodeUnit'),
			'idDepartemenAsal'=>$this->session->userdata('idDepartemen'),
			'dari'=>$this->session->userdata('nipp'),
			'idSop'=>$this->input->post('sop'),
			'idWo'=>$this->input->post('wo'),
			'idSla'=>$this->input->post('sla'),
			'idTiketStatus'=>3, //langsung ditugaskan
		);
		//print_r($order);die;
		$this->db->insert('t_order',$order);
		$idOrder=$this->db->insert_id();
		//print_r($idOrder);die;
		foreach ($this->input->post('pegawai') as $kol) {
			if ($kol!=0) {
				$disposisi=array(
					'idOrder'=>$idOrder,
					'noTiket'=>$order['noTiket'],
					'dari'=>$this->session->userdata('nipp'),
					'kepada'=>$kol,
					'waktuBuat'=>date('Y-m-d H:i:s'),
					'idStatus'=>3,
					'keterangan'=>'DITUGASKAN'
					);
				$this->db->insert('orderDisposisi',$disposisi);
			}
		}
		$pesan=$this->input->post('pesan');
		//print_r($this->input->post('pesan'));die;
		if(!empty($pesan)){
			//jika ada pesan. input sebagai respon
			$data=array(
				'idOrder'=>$idOrder,
				'waktuBuat'=>date('Y-m-d H:i:s'),
				'pesan'=>$this->input->post('pesan'),
				'pembuat'=>$this->session->userdata('nipp')
			);
			$this->db->insert('orderRespon',$data);
			$this->updateResAKhirOrder($idOrder);
		}
		return $idOrder;
	}

	public function addOrderByPeg(){
		$data=$this->db->get('t_order');
		$row=$data->num_rows;$row++;
		//print_r($row);die;
		$noTiket=strtoupper($this->session->userdata('role')).'/ORDER/'.$this->session->userdata('kodeUnit').'/'.date('Y').'/'.$row;
		//print_r($noTiket);die;
		$order=array(
			'waktuBuat'=>date('Y-m-d H:i:s'),
			'noTiket'=>$noTiket,
			'kodeUnitTujuan'=>$this->session->userdata('kodeUnit'),
			'idDepartemenTujuan'=>$this->input->post('departemen'),
			'kodeUnitAsal'=>$this->session->userdata('kodeUnit'),
			'idDepartemenAsal'=>$this->session->userdata('idDepartemen'),
			'dari'=>$this->session->userdata('nipp'),
			'idSop'=>$this->input->post('sop'),
			'idWo'=>$this->input->post('wo'),
			'idSla'=>$this->input->post('sla'),
			'idTiketStatus'=>3, //langsung ditugaskan
		);
		//print_r($order);die;
		$this->db->insert('t_order',$order);
		$idOrder=$this->db->insert_id();
		//print_r($idOrder);die;
		$respon = $this->input->post('pesan');
		//print_r(empty($respon));die;
		if(!empty($respon)){
			$respon=array(
				'idOrder' => $idOrder,
				'noTiket' => $noTiket,
				'pembuat' => $this->session->userdata('nipp'),
				'pesan' => $this->input->post('pesan'),
				'waktuBuat' => date('Y-m-d H:i:s'),
				);
			$this->db->insert('orderRespon',$respon);
		}
		
		$disposisi=array(
			'idOrder'=>$idOrder,
			'noTiket'=>$order['noTiket'],
			'dari'=>$this->input->post('atasan'),
			'kepada'=>$this->session->userdata('nipp'),
			'waktuBuat'=>date('Y-m-d H:i:s'),
			'idStatus'=>3,
			'keterangan'=>'DITUGASKAN'
		);
		$this->db->insert('orderDisposisi',$disposisi);
		$this->updateResAKhirOrder($idOrder);
		return $idOrder;
	}

	public function addOrderFwd($idLi,$noLi){
		$data=$this->db->get('t_order');
		$row=$data->num_rows;$row++;
		//print_r($row);die;
		$noTiket=strtoupper($this->session->userdata('role')).'/ORDER/'.$this->session->userdata('kodeUnit').'/'.date('Y').'/'.$row;
		//add data ke t_order
		$order=array(
			'waktuBuat'=>date('Y-m-d H:i:s'),
			'noTiket'=>$noTiket,
			'idLi'=>$idLi,
			'noLi'=>str_replace('-', '/', $noLi),
			'kodeUnitTujuan'=>$this->session->userdata('kodeUnit'),
			'idDepartemenTujuan'=>$this->input->post('departemen'),
			'kodeUnitAsal'=>$this->session->userdata('kodeUnit'),
			'idDepartemenAsal'=>$this->session->userdata('idDepartemen'),
			'dari'=>$this->session->userdata('nipp'),
			'idTiketStatus'=>2,
		);
		//print_r($order);die;
		$this->db->insert('t_order',$order);
		$idOrder=$this->db->insert_id();
		//print_r($idOrder);die;
		//add data riwayat ke disposisi
		$diposisi=array(
			'idOrder'=>$idOrder,
			'noTiket'=>$noTiket,
			'dari'=>$this->session->userdata('nipp'),
			'kepada'=>$this->input->post('pegawai'),
			'waktuBuat'=>date('Y-m-d H:i:s'),
			'idStatus'=>2,
			'keterangan'=>'DITERUSKAN',
		);
		$this->db->insert('orderDisposisi',$diposisi);
		$idDispo=$this->db->insert_id();

		$li=array(
			'idOrder'=>$idOrder,
			'idStatus'=>2,
			'keterangan'=>'Diteruskan '.$this->session->userdata('nama').'; '.$noTiket,
		);
		$this->db->where('id',$idLi);
		$this->db->update('layananinformasi',$li);
		//print_r($idDispo);die;
		return $dataOrder=array($idOrder,$idDispo);
	}

	public function getOrderById($idOrder){
		//return $this->db->get_where('t_order',array('id'=>$idOrder));
		$this->db->select('*, o.id, o.dari as createdBy, o.noTiket, convert(varchar, o.waktuBuat, 120) as waktuBuat, convert(varchar, o.waktuTutup, 120) as waktuTutup, convert(varchar, o.responAkhir, 120) as responAkhir, convert(varchar, o.intervalWaktu, 120) as intervalWaktu, o.idDepartemenTujuan, li.id as idLi, u1.namaUnit as unitAsal, u2.namaUnit as unitTujuan, u1.namaUnit as unitAsal, d1.namaDepartemen as departemenAsal, d2.namaDepartemen as departemenTujuan');
		$this->db->from('t_order as o');
		$this->db->where('o.id',$idOrder);
		$this->db->join('jenisWo as jWo','jWo.id=o.idJenisWo','left');
		$this->db->join('layananInformasi as li','li.id=o.idLi','left');
		$this->db->join('unit as u1','u1.kodeUnit=o.kodeUnitAsal','left');
		$this->db->join('unit as u2','u2.kodeUnit=o.kodeUnitTujuan','left');
		$this->db->join('departemen as d1','d1.id=o.idDepartemenAsal','left');
		$this->db->join('departemen as d2','d2.id=o.idDepartemenTujuan','left');
		$this->db->join('sop','sop.id=o.idSop','left');
		$this->db->join('wo','wo.id=o.idWo','left');
		$this->db->join('sla','sla.id=o.idSla','left');
		$this->db->join('users','users.nipp=o.dari','left');
		$this->db->join('orderStatus as os','os.id=o.idTiketStatus','left');
		return $this->db->get();
	}

	public function getResponById($idOrder){
		//return $this->db->get_where('orderRespon',array('idOrder'=>$idOrder));
		$this->db->select('*');
		$this->db->from('orderRespon as o');
		$this->db->where('o.idOrder',$idOrder);
		$this->db->join('users as u','u.nipp=o.pembuat','left');
		return $this->db->get();		
	}

	public function getDispoById($idOrder){
		//return $this->db->get_where('orderDisposisi',array('idOrder'=>$idOrder));
		$this->db->select('*, u1.nama as dari, u2.nama as kepada');
		$this->db->from('orderDisposisi as o');
		$this->db->where('o.idOrder',$idOrder);
		$this->db->join('users as u1','u1.nipp=o.dari','left');
		$this->db->join('users as u2','u2.nipp=o.kepada','left');
		return $this->db->get();
	}

	public function get_respon(){
		return $this->db->get('orderRespon')->result();
	}

	public function compOrderFwdById($idOrder){
		//lihat jenis order: rutin/nonrutin
		$wo=$this->db->get_where('wo',array('id'=>$this->input->post('wo')))->row_array();
		//print_r($wo);die;
		//update detail order, respon terakhir dan mengubah status menjadi ditugaskan dari id
		$order=array(
			'idSop'=>$this->input->post('sop'),
			'idWo'=>$this->input->post('wo'),
			'idJenisWo'=>$wo['idJenisWo'],
			'idSla'=>$this->input->post('sla'),
			'responAkhir'=>date('Y-m-d H:i:s'),
			'idTiketStatus'=>3,
			);
		//print_r($order);die;
		$this->db->where('id',$idOrder);
		$this->db->update('t_order',$order);
		//print_r($order);die;
		$order=$this->db->get_where('t_order',array('id'=>$idOrder))->row_array();
		//print_r($order);die;
		//insert pegawai penerima order dengan status ditugaskan
		foreach ($this->input->post('pegawai') as $kol) {
			if ($kol!=0) {
				$disposisi=array(
					'idOrder'=>$idOrder,
					'noTiket'=>$order['noTiket'],
					'dari'=>$this->session->userdata('nipp'),
					'kepada'=>$kol,
					'waktuBuat'=>date('Y-m-d H:i:s'),
					'idStatus'=>3,
					'keterangan'=>'DITUGASKAN'
					);
				$this->db->insert('orderDisposisi',$disposisi);
			}
		}
	}

	public function getInfoByUnit($kodeUnit){
		/*
		$this->db->select('*, layananInformasi.id, us1.nama as dari, us2.nama as kepada');
		$this->db->from('layananInformasi');
		$this->db->where('layananInformasi.kodeUnitTujuan',$kodeUnit);
		$this->db->join('unit as u1','u1.kodeUnit=layananInformasi.kodeUnitTujuan','left');
		$this->db->join('unit as u2','u2.kodeUnit=layananInformasi.kodeUnitAsal','left');
		$this->db->join('users as us1','us1.nipp=layananInformasi.dari','left');
		$this->db->join('users as us2','us2.nipp=layananInformasi.kepada','left');
		$this->db->join('jenisPrioritas as jp','jp.id=layananInformasi.idPrioritas','left');
		$this->db->join('layananInformasiStatus as lis','lis.id=layananInformasi.idStatus','left');
		return $query=$this->db->get();
		*/
		$query="
			SELECT TOP 200 layananInformasi.id, layananInformasi.noTiket, layananInformasi.waktuBuat, layananInformasi.subjek, jp.namaPrioritas, lis.namaJenisStatus, us1.nama as dari, us2.nama as kepada
			FROM layananInformasi
			LEFT JOIN unit as u1 ON u1.kodeUnit = layananInformasi.kodeUnitTujuan
			LEFT JOIN unit as u2 ON u2.kodeUnit = layananInformasi.kodeUnitAsal
			LEFT JOIN users as us1 ON us1.nipp = layananInformasi.dari
			LEFT JOIN users as us2 ON us2.nipp = layananInformasi.kepada
			LEFT JOIN jenisPrioritas as jp ON jp.id = layananInformasi.idPrioritas
			LEFT JOIN layananInformasiStatus as lis ON lis.id = layananInformasi.idStatus
			WHERE layananInformasi.kodeUnitTujuan = $kodeUnit
		";
		$query=$this->db->query($query);
		return $query;
	}

	public function get_info_inbox($nipp){
		//$this->db->select('*, CONCAT(u1.nama) as dari, CONCAT(u2.nama) as kepada', FALSE);
		$this->db->select('*');
		$this->db->from('layananInformasi');
		$this->db->where('layananInformasi. ='.$nipp);
		$this->db->join('unit','unit.kodeUnit = layananInformasi.kodeUnit','left');
		$this->db->join('users as u1','u1.nipp = layananInformasi.dari','left');
		$this->db->join('users as u2','u2.nipp = layananInformasi.kepada','left');
		$query=$this->db->get();
		//print_r($query);die;
		return $query;
	}

	public function get_peng_inbox($nipp){
		$this->db->select('*, u1.nama as dari, u2.nama as kepada');
		$this->db->from('t_pengaduan');
		$this->db->where('t_pengaduan.kepada ='.$nipp);
		$this->db->join('unit','unit.kodeUnit = t_pengaduan.kodeUnit','left');
		$this->db->join('users as u1','u1.nipp = t_pengaduan.dari','left');
		$this->db->join('users as u2','u2.nipp = t_pengaduan.kepada','left');
		$query=$this->db->get();
		//print_r($query);die;
		return $query;
	}

	public function get_uorder_inbox($nipp){
		$this->db->select('*, u1.nama as dari, u2.nama as kepada, u3.nama as petugas');
		$this->db->from('t_undirorder');
		$this->db->where('t_undirorder.kepada ='.$nipp);
		$this->db->join('unit','unit.kodeUnit = t_undirorder.kodeUnit','left');
		$this->db->join('users as u1','u1.nipp = t_undirorder.dari','left');
		$this->db->join('users as u2','u2.nipp = t_undirorder.kepada','left');
		$this->db->join('users as u3','u3.nipp = t_undirorder.petugas','left');
		$query=$this->db->get();
		//print_r($query);die;
		return $query;
	}

	public function get_uorder_staf_inbox($nipp){ //untuk staf
		$this->db->select('*, u1.nama as dari, u2.nama as kepada, u3.nama as petugas', FALSE);
		$this->db->from('t_undirorder');
		$this->db->where('t_undirorder.petugas ='.$nipp);
		$this->db->join('unit','unit.kodeUnit = t_undirorder.kodeUnit','left');
		$this->db->join('users as u1','u1.nipp = t_undirorder.dari','left');
		$this->db->join('users as u2','u2.nipp = t_undirorder.kepada','left');
		$this->db->join('users as u3','u3.nipp = t_undirorder.petugas','left');
		$query=$this->db->get();
		//print_r($query);die;
		return $query;
	}
/*
	public function get_dorder_inbox($nipp){
		$this->db->select('*, CONCAT(u1.nama) as dari, CONCAT(u2.nama) as kepada', FALSE);
		$this->db->from('t_dorder');
		$this->db->where('t_dorder.kepada ='.$nipp);
		$this->db->join('unit','unit.kodeUnit = t_pengaduan.kodeUnit','left');
		$this->db->join('user as u1','u1.nipp = t_dorder.dari','left');
		$this->db->join('user as u2','u2.nipp = t_dorder.kepada','left');
		$query=$this->db->get();
		//print_r($query);die;
		return $query;
	}
*/

	public function get_info_outbox($nipp){
		$this->db->select('*, u1.nama as dari, u2.nama as kepada');
		$this->db->from('layananInformasi');
		$this->db->where('layananInformasi.dari ='.$nipp);
		$this->db->join('unit','unit.kodeUnit = layananInformasi.kodeUnitTujuan','left');
		$this->db->join('users as u1','u1.nipp = layananInformasi.dari','left');
		$this->db->join('users as u2','u2.nipp = layananInformasi.kepada','left');
		$query=$this->db->get();
		//print_r($query);die;
		return $query;
	}

	public function get_peng_outbox($nipp){
		$this->db->select('*, u1.nama as dari, u2.nama as kepada');
		$this->db->from('t_pengaduan');
		$this->db->where('t_pengaduan.dari ='.$nipp);
		$this->db->join('unit','unit.kodeUnit = t_pengaduan.kodeUnit','left');
		$this->db->join('users as u1','u1.nipp = t_pengaduan.dari','left');
		//$this->db->join('user as u2','u2.nipp = t_pengaduan.kepada','left');
		$query=$this->db->get();
		//print_r($query);die;
		return $query;
	}

	public function get_uorder_outbox($nipp){
		$this->db->select('*, u1.nama as dari, u2.nama as kepada, u3.nama as petugas');
		$this->db->from('t_undirorder');
		$this->db->where('t_undirorder.dari ='.$nipp);
		$this->db->join('unit','unit.kodeUnit = t_undirorder.kodeUnit','left');
		$this->db->join('users as u1','u1.nipp = t_undirorder.dari','left');
		$this->db->join('users as u2','u2.nipp = t_undirorder.kepada','left');
		$this->db->join('users as u3','u3.nipp = t_undirorder.petugas','left');
		$query=$this->db->get();
		//print_r($query);die;
		return $query;
	}

	public function get_uorder_kbag_outbox($nipp){
		$this->db->select('*, u1.nama as dari, u2.nama as kepada, u3.nama as petugas', FALSE);
		$this->db->from('t_undirorder');
		$this->db->where('t_undirorder.kepada ='.$nipp);
		$this->db->where('t_undirorder.petugas != ',0,FALSE);
		$this->db->join('unit','unit.kodeUnit = t_undirorder.kodeUnit','left');
		$this->db->join('users as u1','u1.nipp = t_undirorder.dari','left');
		$this->db->join('users as u2','u2.nipp = t_undirorder.kepada','left');
		$this->db->join('users as u3','u3.nipp = t_undirorder.petugas','left');
		$query=$this->db->get();
		//print_r($query);die;
		return $query;
	}

	public function getInfoById($id){
	$this->db->select('*, convert(varchar, li.waktuBuat, 120) as waktuBuat, convert(varchar, li.waktuTutup, 120) as waktuTutup, convert(varchar, li.responAkhir, 120) as responAkhir, li.kodeUnitTujuan, uAsal.namaUnit as unitAsal, uTujuan.namaUnit as unitTujuan, dAsal.namaDepartemen as departemenAsal, dTujuan.namaDepartemen as departemenTujuan, u.nama as dari');
		$this->db->from('layananInformasi as li');
		$this->db->where('li.id',$id);
		$this->db->join('unit as uAsal','uAsal.kodeUnit=li.kodeUnitAsal','left');
		$this->db->join('unit as uTujuan','uTujuan.kodeUnit=li.kodeUnitTujuan','left');
		$this->db->join('departemen as dAsal','dAsal.id=li.idDepartemenAsal','left');
		$this->db->join('departemen as dTujuan','dTujuan.id=li.idDepartemenTujuan','left');
		$this->db->join('users as u','u.nipp=li.dari','left');
		return $this->db->get();
	}

	public function getJenisGangguan(){
		return $this->db->get('jenisGangguan');
	}

	public function getJenisPrioritas(){
		return $this->db->get('jenisPrioritas');
	}

	public function getPesanPengaduanById($id){
		$this->db->select('*, convert(varchar, li.waktuBuat, 120) as waktuBuat, convert(varchar, li.waktuTutup, 120) as waktuTutup, convert(varchar, li.responAkhir, 120) as responAkhir,uAsal.namaUnit as unitAsal, uTujuan.namaUnit as unitTujuan, dAsal.namaDepartemen as departemenAsal, dTujuan.namaDepartemen as departemenTujuan, u.nama as dari', FALSE);
		$this->db->from('layananInformasi as li');
		$this->db->where('li.id',$id);
		$this->db->join('unit as uAsal','uAsal.kodeUnit=li.kodeUnitAsal','left');
		$this->db->join('unit as uTujuan','uTujuan.kodeUnit=li.kodeUnitTujuan','left');
		$this->db->join('departemen as dAsal','dAsal.id=li.idDepartemenAsal','left');
		$this->db->join('departemen as dTujuan','dTujuan.id=li.idDepartemenTujuan','left');
		$this->db->join('users as u','u.nipp=li.dari','left');
		return $this->db->get();
		//return $this->db->get_where('layananinformasi',array('id'=>$id));
	}

	public function addPesanPengaduan(){
		//$img=$this->uploadPengaduan();
		//lihat layananInformasi jenis pengaduan
		$data=$this->db->get_where('layananInformasi',array('jenisInformasi'=>'2'));
		$row=$data->num_rows; $row++;
		//print_r($row);die;
		//buat no surat dari row terakhir pesan pengaduan +1
		$noTiket=strtoupper($this->session->userdata('role'))."/KOMP/".$this->input->post('unit')."/".date("Y")."/".$row;
		//print_r($num_tiket);die;
		$data=array(
			'noTiket'=>$noTiket,
			'jenisInformasi'=>'2',
			'dari'=>$this->session->userdata('nipp'),
			'kodeUnitAsal'=>$this->session->userdata('kodeUnit'),
			'idDepartemenAsal'=>$this->session->userdata('idDepartemen'),
			'kodeUnitTujuan'=>$this->input->post('unit'),
			'idDepartemenTujuan'=>$this->input->post('departemen'),
			'subjek'=>$this->input->post('gangguan'),
			'detail'=>$this->input->post('detailGangguan'),
			'idPrioritas'=>$this->input->post('prioritas'),
			'keterangan'=>'Baru',
			'idStatus'=>1,
			'waktuBuat'=>date("Y-m-d H:i:s"),
			'npa'=>$this->input->post('npa'),
			'namaPelanggan'=>$this->input->post('namaPelanggan'),
			'alamat'=>$this->input->post('alamat'),
			'tanggalLapor'=>$this->input->post('waktu'),
			'namaPelapor'=>$this->input->post('namaPelapor'),
			'noTelpon'=>$this->input->post('noHp'),
			'noDepanRumah'=>$this->input->post('noDepanRumah'),
			);
		$this->db->insert('layananInformasi',$data);
		return $this->db->insert_id();
	}

	public function addPesanInformasi(){
		//Cek lampiran
		//print_r($_FILES['uploadFile']['error']);die;
		if($_FILES['uploadFile']['error']==4){ 
		//print_r($_FILES);die;
		//kode 4 = tidak melampirkan
		//jika tidak ada lampiran, langsung simpan pesan
			$data=$this->db->get_where('layananInformasi',array('jenisInformasi'=>'1')); //lihat banyak data
			$row=$data->num_rows; $row++;
			$noTiket=strtoupper($this->session->userdata('role'))."/INFO/".$this->input->post('unit')."/".date("Y")."/".$row;
			//print_r($noTiket);die;

			$data = array(
				'noTiket'=>$noTiket,
				'jenisInformasi'=>'1',
				'dari'=>$this->session->userdata('nipp'),
				'kepada'=>$this->input->post('kepala'),
				'kodeUnitAsal'=>$this->session->userdata('kodeUnit'),
				'idDepartemenAsal'=>$this->session->userdata('idDepartemen'),
				'kodeUnitTujuan'=>$this->input->post('unit'),
				'idDepartemenTujuan'=>$this->input->post('departemen'),
				'subjek'=>$this->input->post('subjek'),
				'detail'=>$this->input->post('detail'),
				'idPrioritas'=>$this->input->post('prioritas'),
				'keterangan'=>'Baru',
				'idStatus'=>1,
				'waktuBuat'=>date("Y-m-d H:i:s"),
				);
			$this->db->insert('layananInformasi',$data);
			return $this->db->insert_id();
		}else{
		//jika ada lampiran, simpan lampiran
			$file=$this->uploadFileInfo();//echo $file;die;
			//print_r($file);die;
			if(isset($file['error'])!=TRUE){
			//tidak ada error, langsung simpan
				//print('tidak ada error');die;
				//susun path data upload
				$path=str_replace('./', '', $file['path_data']).'/'.$file['upload_data']['file_name'];
				$data=$this->db->get_where('layananInformasi',array('jenisInformasi'=>'1')); //lihat banyak data
				$row=$data->num_rows; $row++;
				$noTiket=strtoupper($this->session->userdata('role'))."/INFO/".$this->input->post('unit')."/".date("Y")."/".$row;
				//print_r($noTiket);die;

				$data = array(
					'noTiket'=>$noTiket,
					'jenisInformasi'=>'1',
					'dari'=>$this->session->userdata('nipp'),
					'kepada'=>$this->input->post('kepala'),
					'kodeUnitAsal'=>$this->session->userdata('kodeUnit'),
					'idDepartemenAsal'=>$this->session->userdata('idDepartemen'),
					'kodeUnitTujuan'=>$this->input->post('unit'),
					'idDepartemenTujuan'=>$this->input->post('departemen'),
					'subjek'=>$this->input->post('subjek'),
					'detail'=>$this->input->post('detail'),
					'idPrioritas'=>$this->input->post('prioritas'),
					'keterangan'=>'Baru',
					'idStatus'=>1,
					'waktuBuat'=>date("Y-m-d H:i:s"),
					'pathLampiran'=>$path,
					'namaLampiran'=>$file['upload_data']['file_name'],
					'extLampiran'=>$file['upload_data']['file_ext'],
					);
				$this->db->insert('layananInformasi',$data);
				return $this->db->insert_id();
			}else{
			//print('ada error');die;
			//ada error
				$data['unit']=$this->unit_model->cari_semua()->result();
				$data['prioritas']=$this->tiket_model->getJenisPrioritas()->result();
				$data['error'] = $file['error'];
				$data['content'] = 'tiket/inputPesanInformasi';
				$this->load->view('template',$data);
			}
		}
	}

	public function uploadFileInfo(){
		$unit=$this->session->userdata('kodeUnit');
		$date=str_replace("-", "", date('d-m-Y'));
		//print_r($date);die;

		$config['upload_path']	='./uploads/info/'.$unit.'/'.$date;
		$config['allowed_types']='gif|jpg|png|doc|docx|xls|xlsx|pdf';
		$config['max_size']		=5000;
		$config['max_width']	=5000;
		$config['max_height']	=5000;

		if(!is_dir('./uploads/info/'.$unit.'/'.$date)){
			mkdir('./uploads/info/'.$unit.'/'.$date,0777,TRUE);
		}

		$this->load->library('upload',$config);
		if(! $this->upload->do_upload('uploadFile')){
			return $error=array('error'=>$this->upload->display_errors());
		}else{
			return $data=array('upload_data'=>$this->upload->data(), 'path_data'=>$config['upload_path']);
		}
	}

	public function closedLi($idLi){
		$data=array(
			'keterangan'=>'Ditutup oleh '.$this->session->userdata('nama').' ('.$this->session->userdata('nipp').')',
			'idStatus'=>4,
			'waktuTutup'=>date('Y-m-d H:i:s'),
			'responAkhir'=>date('Y-m-d H:i:s'),
		);
		$this->db->where('id',$idLi);
		$this->db->update('layananInformasi',$data);
	}

	public function tambah_t_undirorder($idinfo){
		$info=$this->get_info_id($idinfo)->row_array();
		//print_r($info);die;
		$row=$this->db->get('t_undirorder');
		$row=$row->num_rows; $row++;
		$no_tiket=strtoupper($this->session->userdata('role'))."/UORDER/".$this->session->userdata('kodeUnit')."/".$this->input->post('departemen')."/".date("Y")."/".$row;
		//	print_r($notiket);die;
		$data=array(
			'no_tiket'=>$no_tiket,
			'dari'=>$this->session->userdata('nipp'),
			'kodeUnit'=>$this->session->userdata('kodeUnit'),
			'id_departemen'=>$this->input->post('departemen'),
			'kepada'=>$this->input->post('kbag'),
			'ref_tiket'=>$info['no_tiket'],
			'id_ref_tiket'=>$info['id'],
			'status_eks1'=>'Diteruskan sebagai Order',
			'tgl_close1'=>date("d-m-Y"),
			'tgl_buat'=>date("d-m-Y"),
			);
		//print_r($data);die;
		$this->db->insert('t_undirorder',$data);
		return $this->get_uorder_notiket($no_tiket);
	}

	public function update_uorder($notiket){ //oleh kbag
		$notiket=str_replace('-', "/", $notiket);
		//print_r($notiket);die;
		$sla=$this->get_idsla($this->input->post('wo'))->row_array();
		//print_r($sla);die;
		$data=array(
			'petugas'=>$this->input->post('petugas'),
			'id_sop'=>$this->input->post('sop'),
			'id_wo'=>$this->input->post('wo'),
			'id_sla'=>$sla['id_sla'],
			'status_eks2'=>'Memilih SOP/WO dan Menugaskan Pegawai',
			'status_kini'=>'Memilih SOP/WO dan Menugaskan Pegawai',
			'tgl_close2'=>date('d-m-Y'),
			'respon_akhir'=>date('d-m-Y'),
		);
		$respon=array(
			'no_tiket'=>$notiket,
			'nipp'=>$this->session->userdata('nipp'),
			'tgl_buat'=>date('d-m-Y'),
			'komentar'=>$this->input->post('pesan2'),
		);
		//print_r($data);die;
		$this->db->where('no_tiket',$notiket);
		$this->db->update('t_undirorder',$data);
		$this->db->insert('respon_undirorder',$respon);
		return $this->get_uorder_notiket($notiket);
	}

	public function get_idsla($idwo){
		$this->db->select('id_sla');
		$this->db->from('wo');
		$this->db->where('id_wo',$idwo);
		return $data=$this->db->get();
		//print_r($data);die;
	}

	public function close_tiket($notiket){
		//print_r($notiket);die;
		if($this->session->userdata('role')=='kcab'){
			$data=array(
				'status_eks1'=>'Closed Tiket',
				'tgl_close1'=>$this->input->post('tanggal'),
				'tgl_tutup'=>$this->input->post('tanggal'),
				'status_kini'=>'Tiket ditutup oleh '.$this->session->userdata('nama'),
				'respon_akhir'=>date('d-m-Y H:i:s'),
			);
			$respon=array(
				'no_tiket'=>$notiket,
				'nipp'=>$this->session->userdata('nipp'),
				'tgl_buat'=>date('d-m-Y H:i:s'),
				'komentar'=>$this->input->post('pesan'),
			);
		}else if($this->session->userdata('role')=='kbag'){
			$data=array(
				'status_eks2'=>'Closed Tiket',
				'tgl_close2'=>$this->input->post('tanggal'),
				'status_kini'=>'Tiket ditutup oleh '.$this->session->userdata('nama'),
				'respon_akhir'=>date('d-m-Y H:i:s'),
			);
			$respon=array(
				'no_tiket'=>$notiket,
				'nipp'=>$this->session->userdata('nipp'),
				'tgl_buat'=>date('d-m-Y H:i:s'),
				'komentar'=>$this->input->post('pesan'),
			);
		}else if($this->session->userdata('role')=='staf'){		
			$data=array(
				'status_eks3'=>'Closed Tiket',
				'tgl_close3'=>date('d-m-Y H:i:s'),
				'status_kini'=>'Tiket ditutup oleh '.$this->session->userdata('nama'),
				'respon_akhir'=>date('d-m-Y H:i:s'),
			);
			$respon=array(
				'no_tiket'=>$notiket,
				'nipp'=>$this->session->userdata('nipp'),
				'tgl_buat'=>date('d-m-Y H:i:s'),
				'komentar'=>$this->input->post('pesan'),
			);
		}
		//print_r($data);die;
		$this->db->where('no_tiket',$notiket);
		$this->db->update('t_undirorder',$data);
		$this->db->insert('respon_undirorder',$respon);
	}

	public function addResponById($idOrder){
		if($_FILES['uploadFile']['error']!=4){
			//jika file yang di upload ada
			//echo 'berisi';print_r($_FILES);die;
			$path=$this->upload_gbr_res();
			//print_r($path);die;
			if(isset($path['error'])!=TRUE){
				//tidak ada error, langsung simpan
					//print('tidak ada error');die;
				//print_r($path);die;
				$path['path_data']=str_replace('./', '', $path['path_data']);
				$path=$path['path_data'].'/'.$path['upload_data']['file_name'];
				//print_r($path);die;
				$data=array(
					'idOrder'=>$idOrder,
					'waktuBuat'=>date('Y-m-d H:i:s'),
					'pesan'=>$this->input->post('pesan'),
					'pembuat'=>$this->session->userdata('nipp'),
					'lampiran'=>$path,
				);
				$this->db->insert('orderRespon',$data);
				$this->updateResAKhirOrder($idOrder);
				return;
				//print_r($data);die;
			}else{
				//print('ada error');die;
				//ada error
				$data['unit']=$this->unit_model->cari_semua()->result();
				$data['prioritas']=$this->tiket_model->getJenisPrioritas()->result();
				//$data['error'] = $path['error'];
				//print_r($data['error']);die;
				$this->session->set_flashdata('error', $path['error']);
				$data['content'] = 'tiket/readOrderFwd';
				$this->load->view('template',$data);
			}
		}else{
			//jika tidak ada file upload, langsung simpan respon
			//echo 'kosong';print_r($_FILES);die;
			$data=array(
				'idOrder'=>$idOrder,
				'waktuBuat'=>date('Y-m-d H:i:s'),
				'pesan'=>$this->input->post('pesan'),
				'pembuat'=>$this->session->userdata('nipp'),
				//'lampiran'=>'',
			);
			$this->db->insert('orderRespon',$data);
			$this->updateResAKhirOrder($idOrder);
			return;
		}
	}

	public function updateResAKhirOrder($idOrder){
		$data=array(
			'responAkhir'=>date('Y-m-d H:i:s'),
		);
		$this->db->where('id',$idOrder);
		$this->db->update('t_order',$data);
	}

	public function tambah_respon($notiket){
		$notiket=str_replace("-", "/", $notiket);
		$path=$this->upload_gbr_res();
		if(isset($path['error'])==TRUE){ //cek error pada var path
			$data=array(
				'no_tiket'=>$notiket,
				'nipp'=>$this->session->userdata('nipp'),
				'tgl_buat'=>date('d-m-Y  H:i:s'),
				'komentar'=>$this->input->post('pesan'),
			);
			$this->session->set_flashdata('error',$path['error']);
		}else{
			$data=array(
				'no_tiket'=>$notiket,
				'nipp'=>$this->session->userdata('nipp'),
				'tgl_buat'=>date('d-m-Y H:i:s'),
				'komentar'=>$this->input->post('pesan'),
				'path_gbr'=>str_replace(".", "", $path['path_data'])."/",
				'nama_gbr'=>$path['upload_data']['raw_name'],
				'ext_gbr'=>$path['upload_data']['file_ext'],
				);		
		}
		$this->db->insert('respon_undirorder',$data);

		if($this->session->userdata('role')=='staf'){
			$data=array(
				'status_kini'=>'Merespon tiket',
				'status_eks3'=>'Merespon tiket',
				'tgl_close3'=>date('d-m-Y H:i:s'),
				'respon_akhir'=>date('d-m-Y H:i:s'),
				);
			$this->db->where('no_tiket',$notiket);
			$this->db->update('t_undirorder',$data);
		}else if($this->session->userdata('role')=='kcab'){
			$data=array(
				'status_kini'=>'Merespon tiket',
				'status_eks1'=>'Merespon tiket',
				'tgl_close1'=>date('d-m-Y H:i:s'),
				'respon_akhir'=>date('d-m-Y H:i:s'),
				);
			$this->db->where('no_tiket',$notiket);
			$this->db->update('t_undirorder',$data);
		}else if($this->session->userdata('role')=='kbag'){
			$data=array(
				'status_kini'=>'Merespon tiket',
				'status_eks2'=>'Merespon tiket',
				'tgl_close2'=>date('d-m-Y H:i:s'),
				'respon_akhir'=>date('d-m-Y H:i:s'),
				);
			$this->db->where('no_tiket',$notiket);
			$this->db->update('t_undirorder',$data);
		}
	}

	public function upload_gbr_res(){
		$unit=$this->session->userdata('kodeUnit');
		$date=str_replace("-", "", date('d-m-Y'));
		//print_r($date);die;

		$config['upload_path']	='./uploads/res/'.$unit.'/'.$date;
		$config['allowed_types']='gif|jpg|png';
		$config['max_size']		=5000;
		$config['max_width']	=5000;
		$config['max_height']	=5000;

		if(!is_dir('./uploads/res/'.$unit.'/'.$date)){
			mkdir('./uploads/res/'.$unit.'/'.$date,0777,TRUE);
		}

		$this->load->library('upload',$config);
		if(! $this->upload->do_upload('uploadFile')){
			return $error=array('error'=>$this->upload->display_errors());
		}else{
			return $data=array('upload_data'=>$this->upload->data(), 'path_data'=>$config['upload_path']);
		}
	}

	public function get_undirorder_id($id){
		$this->db->select('*, CONCAT(u1.nama) as dari, CONCAT(u2.nama) as kepada, CONCAT(u3.nama) as petugas', FALSE);
		//$this->db->select('*');
		$this->db->from('t_undirorder');
		$this->db->join('unit','unit.kodeUnit = t_undirorder.kodeUnit','left');
		$this->db->join('users as u1','u1.nipp = t_undirorder.dari','left');
		$this->db->join('users as u2','u2.nipp = t_undirorder.kepada','left');
		$this->db->join('users as u3','u3.nipp = t_undirorder.petugas','left');
		$this->db->join('wo as wo','wo.id_wo = t_undirorder.id_wo','left');
		$this->db->join('sop as sop','sop.id_sop = t_undirorder.id_sop','left');
		$this->db->join('sla as sla','sla.id_sla = t_undirorder.id_sla','left');
		//$this->db->join('user','user.nipp = layananInformasi.dari','left');	
		//$this->db->join('user','user.nipp = layananInformasi.kepada','left');		
		$this->db->where('t_undirorder.id',$id);
		return $this->db->get();
	}
	
	public function get_uorder_notiket($no_tiket){
		$this->db->select('*, CONCAT(u1.nama) as dari, CONCAT(u2.nama) as kepada, CONCAT(u3.nama) as petugas', FALSE);
		//$this->db->select('*');
		$this->db->from('t_undirorder');
		$this->db->join('unit','unit.kodeUnit = t_undirorder.kodeUnit','left');
		$this->db->join('users as u1','u1.nipp = t_undirorder.dari','left');
		$this->db->join('users as u2','u2.nipp = t_undirorder.kepada','left');
		$this->db->join('users as u3','u3.nipp = t_undirorder.petugas','left');
		$this->db->join('wo as wo','wo.id_wo = t_undirorder.id_wo','left');
		$this->db->join('sop as sop','sop.id_sop = t_undirorder.id_sop','left');
		$this->db->join('sla as sla','sla.id_sla = t_undirorder.id_sla','left');
		//$this->db->join('user','user.nipp = layananInformasi.dari','left');	
		//$this->db->join('user','user.nipp = layananInformasi.kepada','left');		
		$this->db->where('t_undirorder.no_tiket',$no_tiket);
		return $this->db->get();
	}

	public function get_res_uorder($no_tiket){ //berdasarkan no tiket
		$this->db->select('*');
		$this->db->from('respon_undirorder');
		$this->db->join('users','users.nipp = respon_undirorder.nipp','left');
		$this->db->where('respon_undirorder.no_tiket',$no_tiket);
		$this->db->order_by('id_komen','asc');
		return $this->db->get();
	}

	public function get_info_notiket($num_tiket){
		$this->db->select('*, CONCAT(u1.nama) as dari, CONCAT(u2.nama) as kepada', FALSE);
		//$this->db->select('*');
		$this->db->from('layananInformasi');
		$this->db->join('unit','unit.kodeUnit = layananInformasi.kodeUnit','left');
		$this->db->join('users as u1','u1.nipp = layananInformasi.dari','left');
		$this->db->join('users as u2','u2.nipp = layananInformasi.kepada','left');
		//$this->db->join('user','user.nipp = layananInformasi.dari','left');	
		//$this->db->join('user','user.nipp = layananInformasi.kepada','left');		
		$this->db->where('layananInformasi.no_tiket',$num_tiket);
		return $this->db->get();
	}

	public function get_info_all(){
		$this->db->select('*, CONCAT(u1.nama) as dari, CONCAT(u2.nama) as kepada', FALSE);
		$this->db->from('layananInformasi');
		$this->db->join('unit','unit.kodeUnit = layananInformasi.kodeUnit','left');
		$this->db->join('users as u1','u1.nipp = layananInformasi.dari','left');
		$this->db->join('users as u2','u2.nipp = layananInformasi.kepada','left');
		$query=$this->db->get();
		//print_r($query);die;
		return($query);
	}

	public function get_peng_all(){
		$this->db->select('*, CONCAT(u1.nama) as dari, CONCAT(u2.nama) as kepada', FALSE);
		$this->db->from('t_pengaduan');
		$this->db->join('unit','unit.kodeUnit = t_pengaduan.kodeUnit','left');
		$this->db->join('users as u1','u1.nipp = t_pengaduan.dari','left');
		$this->db->join('users as u2','u2.nipp = t_pengaduan.kepada','left');
		$query=$this->db->get();
		//print_r($query);die;
		return $query;
	}

	public function get_dirorder_all(){ //get by masterdata

	}

	public function get_uorder_all(){ //get by masterdata

	}

	public function get_info_unit($kodeUnit){
		$this->db->select('*');
		$this->db->from('layananInformasi');
		$this->db->where('layananInformasi.kodeUnit',$kodeUnit);
		$this->db->join('unit','unit.kodeUnit = layananInformasi.kodeUnit','left');
		$query=$this->db->get();
		//print_r($query);die;
		return $query;
	}

	public function get_peng_unit($kodeUnit){
		$this->db->select('*, CONCAT(u1.nama) as dari, CONCAT(u2.nama) as kepada', FALSE);
		$this->db->from('t_pengaduan');
		$this->db->where('t_pengaduan.kodeUnit',$kodeUnit);
		$this->db->join('unit','unit.kodeUnit = t_pengaduan.kodeUnit','left');
		$this->db->join('users as u1','u1.nipp = t_pengaduan.dari','left');
		$this->db->join('users as u2','u2.nipp = t_pengaduan.kepada','left');
		$query=$this->db->get();
		//print_r($query);die;
		return $query;
	}

	public function get_all(){
		$data['info']=$this->get_info_all()->result();
		$data['pengaduan']=$this->get_peng_all()->result();
		//$data['dir_order']=$this->db->get('dir_order');
		//$data['undir_order']=$this->db->get('undir_order');
		//print_r($data);die;
		return $data;		
	}

	public function get_by_unit($kodeUnit){
		$data['info']=$this->get_info_unit($kodeUnit)->result();
		$data['pengaduan']=$this->get_peng_unit($kodeUnit)->result();
		//$data['dir_order']=$this->db->get('dir_order');
		//$data['undir_order']=$this->db->get('undir_order');
		//print_r($data);die;
		return $data;		
	}

	public function get_by_nipp($nipp){
		/*
		$query="SELECT t.id_tiket, t.no_tiket, t.kodeUnit, t.id_departemen, t.id_sop, t.id_wo, t.id_sla, t.nipp_p, t.nipp_d, t.subjek_tiket, t.detail_tiket, u.kodeUnit, u.nama_unit, d.id_departemen, d.nama_departemen, so.id_sop, so.nama_sop, wo.id_wo, wo.nama_wo, s.id_sla, s.nama_sla, us.nipp, us.nama, us.
				FROM tiket AS t, user AS us, sla AS s, sop AS so, unit AS u, departemen AS d, wo AS wo
				WHERE t.nipp_p = \"$nipp\"
				AND t.id_departemen = d.id_departemen
				AND t.id_sop = so.id_sop
				AND t.id_wo = wo.id_wo
				AND t.id_sla = s.id_sla
				AND t.nipp_p = us.nipp
				AND t.nipp_d = us.nipp";
		*/
		$this->db->select('*');
		$this->db->from('tiket t, users us, sla s, sop so, unit u, departemen d, wo wo');
		$this->db->where('t.nipp_p',$nipp);
		$this->db->where('t.id_departemen = d.id_departemen');		
		$this->db->where('t.id_sop = so.id_sop');
		$this->db->where('t.id_wo = wo.id_wo');
		$this->db->where('t.id_sla = s.id_sla');
		$this->db->where('t.nipp_p = us.nipp');
		$this->db->where('t.nipp_d = us.nipp');
		$query = $this->db->get();
		//print_r($query);die;
		return $query;
	}

	public function get_t_info_by_nipp($nipp){
		//$this->db->select('*');
		//$this->db->from('layananInformasi');
		//$this->db->where('layananInformasi.')
	}

	public function cari_semua() {
		return $this->db->get('tikets');
	}

	public function id_tiket() {
		return $this->db->get('tikets');
	}

	public function tambah_tiket() {
			$this->db->select_max('id');
			$query = $this->db->get('tikets')->result();
			$id = $query[0]->id += 1;
			$unit = $this->session->userdata('unit');
			$tahun = date('Y');

		$data = array(
			//tambah tiket
			//simpan data terkait dan kode cab serta nipp pemberi kerja
			'd_peg' => $this->session->userdata('nipp'),
			'unit' => $unit,
			'k_peg' => $this->input->post('nipp_peg'),
			'status' => "OPEN",
			//nomor surat = id / kode kantor / tahun
			'no_tiket' => $id."/".$unit."/".$tahun,
			'id_sla' => $this->input->post('id_sla'),
			'subjek' => $this->input->post('subjek_tiket'),
			'detail' => $this->input->post('detail_tiket'),
			);
		$this->db->insert('tikets',$data);
	}

	public function tiket_by_nipp(){
		$nipp = $this->session->userdata('nipp');
		$query = $this->db->get_where($this->tbl,array('k_peg' => $nipp));
		return $query;
	}

	public function tiket_by_id($id){
		//mencari user dari nipp
		$id = array('id'=>$id);
		return $this->db->get_where('tikets',$id);
	}

	public function jumlah_tiket_nipp(){
		$nipp = $this->session->userdata('nipp');
		//$query = $this->db->get_where('orderDisposisi',array('kepada' => $nipp));
		//$query = $query->num_rows();
		$query = "
				SELECT id
				FROM orderDisposisi
				WHERE kepada = $nipp
		";
		$query=$this->db->query($query)->num_rows();
		return $query;
	}

	public function delete($id){
		//delete data tiket
		$this->db->where('id',$id);
		$this->db->delete('tikets');
	}
}
?>