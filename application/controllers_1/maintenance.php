<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');

class Maintenance extends CI_controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('unit_model');
	}
	
	public function index(){
		$this->load->view('maintenance.html');
	}
}
?>