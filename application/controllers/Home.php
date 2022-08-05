<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	// private $param;

	public function __construct() {
        parent::__construct();
		// if ($this->session->userdata('id_user') == false) {
		// 	$this->session->set_flashdata("msg", "<div class='alert alert-danger'>Opss anda blm login</div>");
        //     redirect('auth');
		// }
	}
	public function index()
	{
		$data = [
			"title" => "Home"
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/home');
		$this->load->view('temp/footer');
	}
}
