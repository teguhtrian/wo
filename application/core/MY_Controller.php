<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		//cek status login user
		//print_r('cek');die;
		//print_r($this->session->userdata('role'));die;
		//print_r($this->session->all_userdata());die;
		//print_r($this->session->all_userdata());die;
		//redirect('maintenance');
		if ($this->session->userdata('isLogin') == FALSE) {
			redirect('login');
		}
	}
}
//End of file MY_Controller.php
//Location: ./application/core/MY_Controller.php
?>