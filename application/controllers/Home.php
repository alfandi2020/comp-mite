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
	function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = $this->db->get_where('users',['username' => $username])->row_array();
		// echo json_encode('awda');
		if ($password == true) {
			if ($username == $data['username']) {
					if (password_verify($password, $data['password'])) {
						$datax = [
							'id_user' => $data['id'],
							'username' => $data['username'],
							'nama' => $data['nama'],
							'role' => $data['role']
						];
						$this->session->set_userdata($datax);
						$this->session->set_flashdata("msg", "<div class='alert alert-success'>Login Berhasil</div>");
						$msg = [
							'msg' => 'Login Berhasil',
							'status' => 200
						];
						echo json_encode($msg);
					} else {
						$this->session->set_flashdata("msg", "<div class='alert alert-danger'>Password salah !</div>");
						$msg = [
							'msg' => 'Username atau password salah',
							'status' => 400
						];
						echo json_encode($msg);
					}
			} else {
				$this->session->set_flashdata("msg", "<div class='alert alert-danger'>User tidak ada</div>");
				$msg = [
					'msg' => 'Username tidak ada',
					'status' => 305
				];
				echo json_encode($msg);
			}
		}
		// $this->load->view('Sign_in');
	}
	public function proforma()
	{
		$product = $this->input->post('inputProduct');
		$origin = $this->input->get('inputOrigin');
		$destination = $this->input->get('inputDest');
		// $weight = $this->input->get('inputWeight');

		$array = array('origin' => $origin, 'destinasi' => $destination);
		$this->db->where('origin',$origin);
		$this->db->where('destinasi',$destination);

		$data = [
			"pricelist" => $this->db->get('mite_pricelist')->result(),
			// "weight" => $weight,
		];

		// echo '<pre>';
		// print_r($data);
		// '</pre>';
		// exit;
		$this->load->view('temp/header',$data);
		$this->load->view('body/proforma');
		$this->load->view('temp/footer');
	}
	function logout(){
		$array_items = array('id_user', 'username','nama	');
		$this->session->unset_userdata($array_items);
		redirect('home');
	}
	public function booking()
    {
        if ($this->session->userdata('id_user') == true) {
            $id = $this->input->post('id_booking');
            $list = $this->db->get_where('mite_pricelist',['id' => $id])->row_array();
            $data = [
                "role" => 1,
                "id_pricelist" => $id,
                "all_in" => $list['all_in'],
				"status" => "Waiting"
            ];
            $this->db->insert('booking',$data);
			$msg = [
				'msg' => 'Berhasil dibooking',
				'status' => 200
			];
			echo json_encode($msg);
            // echo '<script>location.replace("https://www.menindo.com")</script>';
        }else{
            $this->session->set_flashdata('msg','<div>Silahkan login terlebih dahulu untuk melakukan booking</div>');
            echo '<script>location.replace("https://www.menindo.com")</script>';
        }
    }
}
