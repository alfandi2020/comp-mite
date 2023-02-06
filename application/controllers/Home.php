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
		$weight = $this->input->get('inputWeight');
		if ($weight >= 30) {
			$array = array('origin' => $origin, 'destinasi' => $destination);
			$this->db->where('origin',$origin);
			$this->db->where('destinasi',$destination);

			$data = [
				"pricelist" => $this->db->get('mite_pricelist')->result(),
				// "weight" => $weight,
			];
			$this->load->view('temp/header',$data);
			$this->load->view('body/proforma');
			$this->load->view('temp/footer');
		}else{
			$this->session->set_flashdata('msg','ukuran');
			redirect();
		}
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
			$id_ex = explode(',',$id);
			$id_price = $id_ex[0];
			$weight = $id_ex[1];
			$koli  = $id_ex[2];
			$product_x  = $id_ex[3];
            $list = $this->db->get_where('mite_pricelist',['id' => $id_price])->row_array();
			$get_user = $this->db->get_where('dt_agent',['id_user' => $this->session->userdata('id_user')])->row_array();
			$get_product = $this->db->get('jenis_product')->result();
			foreach ($get_product as $x) {
				if($product_x == $x->nama_inggris){
					$tambah_charge = $x->handling;
				}else{
					$tambah_charge = 0;
				}
			}
			$price_x = $list['all_in'] * $weight + $tambah_charge;
			$total = intval($get_user['saldo']) - $price_x;
			$fee_mite = $price_x * 22 / 100;
			$net = $price_x - $fee_mite;
			if ($total < $price_x || $get_user['saldo'] < 1000000) { //kondisi jika saldo kurang dan saldo limit 1jt
				$msg = [
					'msg' => 'Saldo kurang,silahkan melakukan topup dan minimal limit saldo Rp.1.000.000',
					'status' => 303
				];
			}else{
				$data = [
					"role" => 1,//role 1 untuk approve or reject admin
					"id_user" => $this->session->userdata('id_user'),
					"id_pricelist" => $id_price,
					"product" => $product_x,
					"all_in" => $list['all_in'],
					"weight" => $weight,
					"koli" => $koli,
					"status" => "Waiting",
					"net" => $net,
					"fee_mite" => $fee_mite
				];
				$this->db->insert('booking',$data);

				//update saldo agent
				$da_agent = [
					"saldo" => $total
				];
				$this->db->where('id_user',$this->session->userdata('id_user'));
				$this->db->update('dt_agent',$da_agent);
				$msg = [
					'msg' => 'Berhasil dibooking',
					'status' => 200
				];
			}
			echo json_encode($msg);

            // echo '<script>location.replace("https://www.menindo.com")</script>';
        }else{
            $this->session->set_flashdata('msg','<div>Silahkan login terlebih dahulu untuk melakukan booking</div>');
            echo '<script>location.replace("https://www.menindo.com")</script>';
        }
    }
}
