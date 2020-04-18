<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Tiket extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('tiket_model');
		$this->load->model('user_model');
		$this->load->model('unit_model');
		$this->load->model('departemen_model');
		$this->load->model('sop_model');
		$this->load->model('wo_model');
		$this->load->model('sla_model');
	}

	public function reportOrderPegawai(){
		$data['unit']=$this->unit_model->get_all()->result();
		$data['departemen']=$this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
		$data['content']='reportPegawai';
		$this->load->view('template',$data);
	}

	public function bacaLiByNoTiket($noTiket){

	}

	public function closeOrder($idOrder){
		$this->tiket_model->closeOrder($idOrder);
		redirect('tiket/bacaOrderFwd/'.$idOrder);
	}

	public function verifiedOrder($idOrder){
		$this->tiket_model->verifiedOrder($idOrder);
		redirect('tiket/bacaOrderFwd/'.$idOrder);
	}

	public function reportingOrder($idOrder){
		$this->tiket_model->reportOrder($idOrder);
		redirect('tiket/bacaOrderFwd/'.$idOrder);
	}

	public function bacaLiByUnit($kodeUnit){
		$data['li']=$this->tiket_model->getLiByUnit($kodeUnit)->result();
		$data['unit']=$this->unit_model->get_by_unit($kodeUnit)->row_array();
		//print_r($data['li']);die;
		$data['content']='tiket/liView';
		$this->load->view('template',$data);
	}

	public function compOrderFwd($idOrder){
		$this->tiket_model->compOrderFwdById($idOrder);
		redirect('tiket/bacaOrderFwd/'.$idOrder);
	}

	public function tambahVolKerjaByIdOrder($idOrder){
		/*
		$nama=$this->input->post('namaItem');
		$jumlah=$this->input->post('jumlahItem');
		$satuan=$this->input->post('satuanItem');
 
		foreach ($nama as $index => $name) {
			echo 'Item='.$name.' Jumlah='.$jumlah[$index].' Satuan='.$satuan[$index].'<br>' ;
		}
		print_r($nama);
		print_r($jumlah);
		print_r($satuan);die;
		*/
		//print_r($idOrder);die;
		$this->tiket_model->addVolKerjaByIdOrder($idOrder);
		redirect('tiket/bacaOrderFwd/'.$idOrder);
	}

	public function reportOrder(){
		
	}

	public function myOrder($nipp){
		$data['orderOpen']=$this->tiket_model->getMyOrderOpen($this->session->userdata('nipp'))->result();
		$data['orderClosed']=$this->tiket_model->getMyOrderClosed($this->session->userdata('nipp'))->result();
		//print_r($data);die;
		$data['content']='tiket/myTiket';
		$this->load->view('template',$data);
	}

	public function orderByUnit($kodeUnit){
		$data['order']=$this->tiket_model->getOrderByUnit($kodeUnit)->result();
		$data['content']='tiket/allOrderView';
		//print_r($data['order']);die;
		$this->load->view('template',$data);
	}

	public function orderByDept($idDept){
		$data['informasi']=$this->tiket_model->getInfoByUnit($this->session->userdata('kodeUnit'))->result();
		$data['pengaduan']='';
		$data['orderOpen']=$this->tiket_model->getOrderOpenByDept($idDept)->result();
		$data['orderClosed']=$this->tiket_model->getOrderClosedByDept($idDept)->result();
		$data['namaDept']=$this->departemen_model->get_by_id($idDept)->row_array();
		//$data['departemen']=$this->departemen->get_by_id($idDept)->;
		//print_r($data['informasi']);die;
		$data['content']='tiket/orderView';
		$this->load->view('template',$data);
	}

	public function orderOpenByDept($idDept){
		$data['query']=$this->tiket_model->getOrderOpenByDept($idDept)->result();
		//print_r($query);die;
		$data['content']='tiket/orderView';
		$this->load->view('template',$data);
	}

	public function orderClosedByDept($idDept){
		$query=$this->tiket_model->getOrderClosedByDept($idDept)->result();
		print_r($query);die;
	}

	public function orderUmum(){
		if(isset($_POST['submit'])){
			$this->tiket_model->addOrderUmum();
		}else{
			if($this->session->userdata('role')=='sa'||$this->session->userdata('role')=='dir'){
				$data['unit']=$this->unit_model->get_all()->result();
			}else{
				$data['unit']=$this->unit_model->get_all()->result();
				$data['dept']=$this->departemen_model->get_by_unit($this->session->userdata('kodeUnit'))->result();
			}
			//print_r($data);die;
			$data['content']='tiket/inputOrderUmum';
			$this->load->view('template',$data);
		}
	}

	public function orderRutin(){
		if(isset($_POST['submit'])){

		}else{
			
		}
	}

//tes pagination
	public function pagination(){
		$this->load->model('pagination_model');
		$jumlah=$this->pagination_model->jumlah();

		$config['base_url']=base_url().'tiket/pagination/';
		$config['total_rows']=$jumlah;
		$config['per_page']=3;
		$dari=$this->uri->segment(3);
		$data['info']=$this->pagination_model->lihat_info($config['per_page'],$dari);
		$data['content']='pagination';
		$this->pagination->initialize($config);
		$this->load->view('template',$data);
	}

	public function index(){
		$this->tampil_semua();
	}

	public function baca(){
		$data['respon']=$this->tiket_model->get_respon();
		$data['content']='tiket/formReadOrder';
		$this->load->view('template',$data);
	}


	public function bacaRutin(){
		$data['respon']=$this->tiket_model->get_respon();
		$data['content']='tiket/formReadOrderRutin';
		$this->load->view('template',$data);
	}


	public function formdirorder(){
		$data['content']='tiket/formInputTiketOrder';
		$this->load->view('template',$data);
	}

	public function formuorder(){
		$data['content']='tiket/formReadTiketOrderFwd';
		$this->load->view('template',$data);
	}

	public function tiket_masuk(){
		$nipp = $this->session->userdata('nipp');
		//$data['info']=$this->tiket_model->get_info_inbox($nipp)->result();
		//$data['pengaduan']=$this->tiket_model->get_peng_inbox($nipp)->result();
		if($this->session->userdata('role')!='staf'){
			$data['uorder']=$this->tiket_model->get_uorder_inbox($nipp)->result();
		}
		else{
			$data['uorder']=$this->tiket_model->get_uorder_staf_inbox($nipp)->result();
		}
		//$data['d_order']=$this->tiket_model->get_dorder_inbox($nipp)->result();
		$data['content'] = 'tiket/tiket_view_masuk';
		//print($data);die;
		$this->load->view('template',$data);
	}

	public function tiket_keluar(){
		/*
		$nipp = $this->session->userdata('nipp');
		$data['info']=$this->tiket_model->get_info_outbox($nipp)->result();
		$data['pengaduan']=$this->tiket_model->get_peng_outbox($nipp)->result();
		//periksa role user
		if($this->session->userdata('role')!='kbag'){
			$data['uorder']=$this->tiket_model->get_uorder_outbox($nipp)->result();	
		}else{
			$data['uorder']=$this->tiket_model->get_uorder_kbag_outbox($nipp)->result();
		}
		*/
		$	
		$data['content'] = 'tiket/tiket_view_keluar';
		$this->load->view('template',$data);		
	}

	public function tampil_by_unit(){
		$data['data']=$this->unit_model->get_by_unit($this->uri->segment(3))->result();
		$data['content']='tiket/tiket_view';
		$this->load->view('template',$data);
	}

	public function tampil_semua(){
		$data=$this->tiket_model->get_all();
		$data['content'] = 'tiket/tiket_view';
		//print_r($data);die;
		$this->load->view('template',$data);
	}

	public function pilihpeg(){
		$data['pegawai']=$this->user_model->get_by_dept($this->uri->segment(4))->result();
		print_r($data);die;
	}

	public function pilihPegawai($idDept){
		$data['pegawai']=$this->user_model->getPegByDept($idDept)->result();
		//print_r($data);die;
		$this->load->view('dd_pegawai',$data);
	}

	public function pilihPegawaiByUnit($kodeUnit){
		//print_r($kodeUnit);die;
		$data['pegawai']=$this->user_model->getAllPegByUnit($kodeUnit)->result();
		//print_r($this->session->userdata('kodeUnit'));die;
		//print_r($data);die;
		$this->load->view('dd_pegawai',$data);
	}

	public function pilih_divisi(){
		$data['divisi']=$this->departemen_model->getByUnit($this->uri->segment(3))->result();
		$this->load->view('dd_divisi',$data);
	}

	public function pilih_kepala(){ //baru
		//menunjuk ke kepala cabang
		if($this->uri->segment(3) != '00'){
			$kepala = 'kcab';
			$data['kepala']=$this->user_model->get_kcab($this->uri->segment(3),$kepala);
		}else{
			$kepala = 'kdiv';
			$data['kepala']=$this->user_model->get_kdiv($this->uri->segment(4),$kepala);
		}
		$this->load->view('dd_kepala',$data);
	}

	public function pilihBagian(){
		$iddept=$this->uri->segment(3);
		$kodeUnit=$this->session->userdata('kodeUnit');
		if ($this->session->userdata('role')=='kbid'||$this->session->userdata('role')=='kdiv') {
			$data['kepala']=$this->user_model->getKbid($iddept,$kodeUnit)->result();
		}else{
			$data['kepala']=$this->user_model->get_kbag($iddept,$kodeUnit)->result();
		}
		// $data['kepala']=$this->user_model->get_kbag($iddept,$kodeUnit)->result();
		//print_r($data['kepala']);die;
		$this->load->view('dd_bagian',$data);
	}

	public function pilih_petugas(){ //dari id departemen
		$iddept=$this->uri->segment(4);
		$kodeUnit=$this->session->userdata('kodeUnit');
		$data['petugas']=$this->user_model->get_staf($iddept,$kodeUnit)->result();
		//print_r($data);die;
		$this->load->view('dd_petugas',$data);
	}

	public function pilihSlaByDept(){
		$idDept=$this->uri->segment(3);
		//print_r($idDept);die;
		$data['sla']=$this->sla_model->getByDept($idDept)->result();
		//print_r($data['sla']);die;
		$this->load->view('dd_sla',$data);
	}

	public function pilih_sop(){ //dari id departemen
		$iddept=$this->uri->segment(4);
		$kodeUnit=$this->session->userdata('kodeUnit');
		$data['sop']=$this->sop_model->get_sop($iddept,$kodeUnit)->result();
		//print_r($data);die;
		$this->load->view('dd_sop',$data);
	}

	public function pilih_wo(){ //dari id departemen
		$idsop=$this->uri->segment(3);
		$data['wo']=$this->wo_model->get_wo($idsop)->result();
		//print_r($data);die;
		$this->load->view('dd_wo',$data);
	}

//selesaikan disini bang!
	public function tiket_undirOrder(){
		$idinfo=$this->uri->segment(3);
		if(isset($_POST['submit'])){
			//cek status tiket info
			//print_r($idinfo);die;
			//$data['info']=$this->tiket_model->get_info_id($idinfo)->result();
			$data['data']=$this->tiket_model->tambah_t_undirorder($idinfo)->row_array();
			//print_r($data);die;
			redirect('tiket/baca_uorder/'.$data['data']['id'],'refresh');	
		}else{
			redirect('tiket/baca_info/'.$idinfo);
		}
	}

	public function perbarui_uorder($notiket){ //kbag
		$this->tiket_model->update_uorder($notiket)->row_array();
		redirect('tiket/baca_uorder_notiket/'.str_replace("/", "-", $notiket));
	}

	public function baca_uorder(){ //dr id
		$id=$this->uri->segment(3); //baca id tiket uorder
		//print_r($id);
		$data['data']=$this->tiket_model->get_undirorder_id($id)->row_array();
		//print_r($data);die;
		$data['respon']=$this->tiket_model->get_res_uorder($data['data']['no_tiket'])->result();
		//print_r($data);die;
		$data['content']='tiket/formReadTiketOrderFwd';
		$this->load->view('template',$data);
	}

	public function baca_uorder_notiket($notiket){ //dr notiket
		$notiket=str_replace("-", "/", $notiket);
		$data['data']=$this->tiket_model->get_uorder_notiket($notiket)->row_array();
		$data['respon']=$this->tiket_model->get_res_uorder($notiket)->result(); //dr notiket
		$data['content']='tiket/formReadTiketOrderFwd';
		//print_r($data);die;
		$this->load->view('template',$data);
	}

	public function baca_ref_tiket($notiket){ //dr notiket
		$segment=explode('-', $notiket);
		//print_r($segment);die;
		if($segment[1]=="INFO"){
			$this->baca_info_notiket($notiket);
		}else{
			$this->baca_peng_notiket($notiket);
		}
	}

	public function orderBaru(){
		if (isset($_POST['submit'])){
		//jika tombol submit ditekan
			$data['idOrder']=$this->tiket_model->addOrder();
			//print_r($data);die;
			redirect('tiket/konfirmasiOrderById/'.$data['idOrder']);
		}else{
			$data['sop']=$this->sop_model->get_by_dept($this->session->userdata('idDepartemen'))->result();
			$data['unit']=$this->unit_model->cari_semua()->result();
			$data['departemen']=$this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
			$data['pegawai']=$this->user_model->getPegByDept($this->session->userdata('idDepartemen'))->result();
			//print_r($data['pegawai']);die;
			$data['content']='tiket/inputOrder';
			$this->load->view('template',$data);
		}
	}

	public function orderBaruByPeg(){
		if (isset($_POST['submit'])) {
			//jika tombol submit ditekan
			//echo 'submit bro';
			$data['idOrder']=$this->tiket_model->addOrderByPeg();
			redirect('tiket/konfirmasiOrderById/'.$data['idOrder']);
		}else{
			$data['sop']=$this->sop_model->get_by_dept($this->session->userdata('idDepartemen'))->result();
			$data['unit']=$this->unit_model->cari_semua()->result();
			$data['departemen']=$this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
			$data['pegawai']=$this->user_model->getPegByDept($this->session->userdata('idDepartemen'))->result();
			$data['atasan']=$this->user_model->getSuperior()->row_array();
			if (empty($data['atasan'])) {
				$data['atasan']=$this->user_model->getSuperiorPusat()->row_array();
			}
			//print_r($data['atasan']);die;
			$data['content']='tiket/inputOrderByPeg';
			$this->load->view('template',$data);
		}
	}

	public function tambahResponById($idOrder){
		$this->tiket_model->addResponById($idOrder);
		redirect('tiket/bacaOrderFwd/'.$idOrder);
	}

	public function tambah_respon($notiket){
		$notiket=str_replace("-", "/", $notiket);
		$close=$this->input->post('cb_close');
		if($close=='yes'){ //cek close tiket?
			//print_r($close);die;
			$this->tiket_model->close_tiket($notiket);
			redirect('tiket/baca_uorder_notiket/'.str_replace("/", "-", $notiket));
		}else{
			$this->tiket_model->tambah_respon($notiket);
			redirect('tiket/baca_uorder_notiket/'.str_replace("/", "-", $notiket));
		}
	}

	public function konfirmasiLiById($idLi){
		$data['pesan']=$this->tiket_model->getInfoById($idLi)->row_array();
		$data['content']='tiket/konfirmasiLi';
		$this->load->view('template',$data);
	}

	public function baca_informasi($notiket){
		$notiket=str_replace("-", "/", $notiket);
		//print_r($notiket);die;
		$data['data']=$this->tiket_model->get_info_notiket($notiket)->row_array();
		$data['content'] = 'tiket/formReadTiketInformasi';
		$this->load->view('template',$data);
	}

	public function pesanInformasi(){
		//Ubah algoritma
		//submit simpan, lalu redirect ke read tiket informasi pada bag else
		if (isset($_POST['submit'])) {
			//jika submit ditekan maka simpan
			$id = $this->tiket_model->addPesanInformasi();
			//print_r($id);die;
			//redirect('tiket/bacaInfoById/'.$id); diubah ke halaman konfirmasi 4/10/2016
			redirect('tiket/konfirmasiLiById/'.$id);
		}else{
			//sediakan data sesuai view
			//print_r($this->session->all_userdata());die;
			$data['unit']=$this->unit_model->cari_semua()->result();
			$data['prioritas']=$this->tiket_model->getJenisPrioritas()->result();
			$data['error'] = '';
			$data['content'] = 'tiket/inputPesanInformasi';
			$this->load->view('template',$data);
		}
	}

	public function bacaInfoById($id){
		//print_r($id);die;
		$data['pesan']=$this->tiket_model->getInfoById($id)->row_array();
		//print_r($data['pesan']['waktuBuat']);die;
		$data['bagian']=$this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
		$data['content']='tiket/readPesanInformasi';
		//print_r($data['pesan']);die;
		$this->load->view('template',$data);
	}

	public function bacaInfoOnOrderById($idli){
		$data['pesan']=$this->tiket_model->getInfoById($idli)->row_array();
		//print_r($data['pesan']);die;
		$data['bagian']=$this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
		$data['content']='tiket/readPesanInformasiRestricted';
		//print_r($data);die;
		$this->load->view('template',$data);		
	}

	public function bacaPengaduanOnOrderById($idli){
		//print_r($idDept);die;
		$data['pesan']=$this->tiket_model->getPesanPengaduanById($idli)->row_array();
		$data['bagian']=$this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
		//print_r($data);die;
		//buat view untuk baca pengaduan
		$data['content']='tiket/readPengaduanRestricted';
		$this->load->view('template',$data);		
	}

	public function baca_info_notiket(){
		$no_tiket=str_replace("-", "/", $this->uri->segment(3));
		//print_r($no_tiket);die;
		$data['data']=$this->tiket_model->get_info_notiket($no_tiket)->row_array();
		print_r($data);die;
		$data['content']='tiket/formReadTiketInformasi';
		//print_r($data);die;
		$this->load->view('template',$data);
	}

	public function baca_peng_notiket(){
		$no_tiket=str_replace("-", "/", $this->uri->segment(4));
		//print_r($no_tiket);die;
		$data['data']=$this->tiket_model->get_peng_notiket($no_tiket)->row_array();
		//print_r($data);die;
		$data['content']='tiket/formReadTiketPengaduan';
		//print_r($data);die;
		$this->load->view('template',$data);
	}

	public function bacaPengaduanById($id){
		//print_r($idDept);die;
		$data['pesan']=$this->tiket_model->getPesanPengaduanById($id)->row_array();
		$data['bagian']=$this->departemen_model->getByUnit($this->session->userdata('kodeUnit'))->result();
		//print_r($data);die;
		//buat view untuk baca pengaduan
		$data['content']='tiket/readPengaduan';
		$this->load->view('template',$data);
	}

	public function pesanPengaduan(){ //baru
		if (isset($_POST['submit'])){
			$idPengaduan=$this->tiket_model->addPesanPengaduan();
			//redirect('tiket/bacaPengaduanById/'.$idPengaduan);
			//diubah sesuai permintaan Pak Nono
			//4/10/2016
			redirect('tiket/konfirmasiLiById/'.$idPengaduan);
		}else{
			$data['unit']=$this->unit_model->cari_semua()->result();
			$data['jenisGangguan']=$this->tiket_model->getJenisGangguan()->result();
			$data['prioritas']=$this->tiket_model->getJenisPrioritas()->result();
			$data['error'] = '';
			$data['content'] = 'tiket/inputPesanPengaduan';
			$this->load->view('template',$data);
		}
	}

	public function tutupLi($idLi,$noLi){
		//merubah status Li menjadi tutup
		$this->tiket_model->closedLi($idLi,$noLi);
		if($this->input->post('jenisInformasi')==1){
			redirect('tiket/bacaInfoByid/'.$idLi);
		}else{
			redirect('tiket/bacaPengaduanById/'.$idLi);
		}
	}

	public function konfirmasiOrderById($idOrder){
		//echo 'konfirmasi';die;
		$data['pesan']=$this->tiket_model->getOrderById($idOrder)->row_array();
		$data['content']='tiket/konfirmasiOrder';
		$this->load->view('template',$data);
	}

	public function tambahOrderFwd($idLi){
		$noLi=$this->uri->segment(4);
		$dataOrder=$this->tiket_model->addOrderFwd($idLi,$noLi);
		//print_r($dataOrder);die;
		//redirect('tiket/bacaOrderFwd/'.$dataOrder[0].'/'.$dataOrder[1]);
		//redirect ke halaman konfirmasi
		//4/10/2016
		redirect('tiket/konfirmasiOrderById/'.$dataOrder[0]);
	}

	public function bacaOrderFwd($idOrder){
		$noDispo=$this->uri->segment(4);
		//print_r($noDispo);die;
		//print_r($idOrder);die;
		$data['order']=$this->tiket_model->getOrderById($idOrder)->row_array();
		$data['respon']=$this->tiket_model->getResponById($idOrder)->result();
		$data['disposisi']=$this->tiket_model->getDispoById($idOrder)->result();
		$data['pegawai']=$this->user_model->getPegByDept($this->session->userdata('idDepartemen'))->result();
		$data['sop']=$this->sop_model->get_by_dept($this->session->userdata('idDepartemen'))->result();
		$data['content']='tiket/readOrderFwd';
		$data['kepadaOrder']=$this->tiket_model->getDitugaskanOrder($idOrder)->result();
		if (empty($data['kepadaOrder'])) {
			$data['kepadaOrder']=$this->tiket_model->getDiteruskanOrder($idOrder)->result();
		}
		// print_r($data['kepadaOrder']);die;
		$data['volKerja']=$this->tiket_model->getVolKerjaById($idOrder)->result();
		$data['tutupKbag']=$this->tiket_model->getDispoById($idOrder)->row_array();
		// print_r($data['kepadaOrder']);die;
		$this->load->view('template',$data);
	}

	public function tiket_saya(){ //baru //diganti jadi tiket masuk - tiket keluar
		$nipp = $this->session->userdata('nipp');
		//$data['t_order']=$this->tiket_model->get_t_order_nipp($nipp)->result();
		//$data['t_info']=$this->tiket_model->get_t_info_nipp($nipp)->result();
		//$data['t_peng']=$this->tiket_model->get_t_peng_nipp($nipp)->result();		
		$data['content'] = 'tiket/tiket_view';
		//print($data['data']);die;
		$this->load->view('template',$data);
	}

	public function tiket_baru(){
		$id_dept = $this->session->userdata('id_departemen');
		$kodeUnit = $this->session->userdata('kodeUnit');
		//print_r($id_dept);die;
		$data['pegawai'] = $this->user_model->get_by_unit_dept($id_dept,$kodeUnit);
		$data['sla'] = $this->sla_model->get_by_unit_dept($id_dept,$kodeUnit);
		$data['sop'] = $this->sop_model->get_by_unit_dept($id_dept,$kodeUnit);
		$data['wo'] = $this->wo_model->get_by_unit_dept($id_dept,$kodeUnit);
		//print_r($data['sop']);die;
		$data['content'] = 'tiket/tiket_baru';
		$this->load->view('template',$data);
	}

	public function tambah_tiket(){
		if(isset($_POST['submit'])){
			$this->tiket_model->tambah_tiket();
			redirect(tiket);
		}
	}

	public function delete(){
		$id_tiket = $this->uri->segment(4);
		$this->tiket_model->delete($id_tiket);
		$this->tampil_semua();
	}

	public function download_gbr($namagbr){
		$this->load->helper("download");
		//ob_clean();
		$extensi=explode(" ", str_replace('.', ' ', $namagbr)); //ekstrak nama file
		$nama=md5($namagbr).'.'.$extensi[1]; //ambil extensi file, enkripsi nama file
		$data=file_get_contents('http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/'.str_replace("-", "/", $namagbr));
		//print_r($data);die;
		force_download($nama,$data);flush();
	}

	public function edit(){
		if(isset($_POST['submit'])){
			$this->tiket_model->update_tiket();
			redirect('tiket/tampil_semua');
		}else{
			$id=$this->uri->segment(4);
			$data['error']='';
			$data['unit'] = $this->unit_model->cari_semua()->result();
			$data['record']	= $this->tiket_model->get_info_id($id)->row_array();
			$data['content'] = 'tiket/formEditTiketInfo';
			//print_r($data);die;
			$this->load->view('template',$data);
		}
	}

}
?>