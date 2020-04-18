<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class pagination_model extends CI_model {

	public function __construct(){

	}

	public function lihat_info($sampai,$dari){
		return $query=$this->db->get('tb_t_informasi',$sampai,$dari)->result();
	}

	public function lihat_info2($sampai,$dari){
		return $query=$this->db->get('tb_t_informasi',$sampai,$dari)->result();
	}

	public function jumlah(){
		return $this->db->get('tb_t_informasi')->num_rows();
	}

}
?>