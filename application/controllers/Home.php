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
			"title" => "Home",
			"destination" => $this->db->get('mite_destinasi')->result(),
		];
		$this->load->view('temp/header',$data);
		$this->load->view('body/home');
		$this->load->view('temp/footer');
	}

	public function proforma()
	{
		$product = $this->input->post('inputProduct');
		$origin = $this->input->post('inputOrigin');
		$destination = $this->input->post('inputDest');
		$weight = $this->input->post('inputWeight');

		$array = array('origin' => $origin, 'destinasi' => $destination);
		$this->db->where('origin',$origin);
		$this->db->where('destinasi',$destination);

		$data = [
			"pricelist" => $this->db->get('mite_pricelist')->result(),
			"weight" => $weight,
		];

		// echo '<pre>';
		// print_r($data);
		// '</pre>';
		// exit;
		$this->load->view('temp/header',$data);
		$this->load->view('body/proforma');
		$this->load->view('temp/footer');
	}
}
