<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();

        // Load session library
        $this->load->library('session');
    }

	/* Login ----------------------------------------------------------------------------- */
	public function login()
	{
		$this->load->view('login');
	}

	public function validation()
	{
		$data = array(
			"username" => $this->input->post("username"),
			"password" => $this->input->post("password")
		);

		$save = json_decode($this->client->simple_post(APIVALIDATION, $data));

		if($save->check){
			if (strcmp($save->type, "1") == 0) {
				$this->session->set_tempdata('token', $save->token, 72000);
				if (strcmp($this->session->tempdata('token'), "") == 0){
					redirect("welcome_message");
				} else redirect("dashboard");
				// $this->session->set_userdata('token', $save->token);
				// echo "\n" . $this->session->userdata('token') . "token";
			} else {
				$save = json_decode($this->client->simple_get(APINUMBER));
				redirect("https://wa.me/" . $save->number);
			}
		} else {
			$this->load->view('welcome_message');
		}
		
	}

	public function dashboard()
	{
		// $data['tampil'] = json_decode($this->client->simple_get(APIVALIDATION));

		// foreach($data["tampil"]-> mahasiswa as $result) {
		// 	# code...
		// 	echo $result->npm_mhs."<br>";
		// }

		// echo $this->session->userdata('token') . "token";
		// echo $this->session->tempdata('token') . "token";
		// if (strcmp($this->session->tempdata('token'), "") == 0){
			// $this->load->view('welcome_message');
		// 	// redirect("/");
		// 	echo $this->session->userdata('token') . "\ntoken";
		// } else 
		$this->load->view('dashboard');
	}

	public function menu_user()
	{
		$data['user'] = json_decode($this->client->simple_get(APIUSER));
		$this->load->view('pengguna', $data);
		
	}

	public function logout()
	{
		redirect('login');
	}

	public function index()
	{
		$data['tampil'] = json_decode($this->client->simple_get(APIVALIDATION));

		// foreach($data["tampil"]-> mahasiswa as $result) {
		// 	# code...
		// 	echo $result->npm_mhs."<br>";
		// }

		$this->load->view('vw_mahasiswa', $data);
	}

	function setDelete()
	{
		// buat variabel json
		$json  = file_get_contents("php://input");
		$hasil = json_decode($json);

		$delete = json_decode($this->client->simple_delete(APIVALIDATION, array("npm" => $hasil->npmnya)));



		// isi nilai err
		// $err = 1;

		// kiirm hasil ke "vw_mahasiswa"
		echo json_encode(array("statusnya" => $delete->status));
	}

	function addMahasiswa()
	{
		$this->load->view('en_mahasiswa');
	}

	function setSave()
	{
		// baca nilai dari fetch
		$data = array(
			"npm" => $this->input->post("npmnya"),
			"nama" => $this->input->post("namanya"),
			"telepon" => $this->input->post("teleponnya"),
			"jurusan" => $this->input->post("jurusannya"),
			"token" => $this->input->post("npmnya")
		);

		$save = json_decode($this->client->simple_post(APIVALIDATION, $data));
		// kiirm hasil ke "en_mahasiswa"
		echo json_encode(array("statusnya" => $save->status));
	}

	// fungsi untuk update data
	function updateMahasiswa()
	{
		// $segmen = $this->uri->total_segments();
		// ambil nilai npm
		$token = $this->uri->segment(3);

		// echo $token;
		$tampil = json_decode($this->client->simple_get(APIVALIDATION, array("npm" => $token)));

		foreach ($tampil->mahasiswa as $result) {
			# code...
			// echo $result->nama_mhs . "<br>";
			$data = array(
				"npm" => $result->npm_mhs,
				"nama" => $result->nama_mhs,
				"jurusan" => $result->jurusan_mhs,
				"telepon" => $result->telepon_mhs,
				"token" => $token
			);
			$this->load->view('up_mahasiswa', $data);
		}
	}

	function setUpdate()
	{
		// baca nilai dari fetch
		$data = array(
			"npm" => $this->input->post("npmnya"),
			"nama" => $this->input->post("namanya"),
			"telepon" => $this->input->post("teleponnya"),
			"jurusan" => $this->input->post("jurusannya"),
			"token" => $this->input->post("tokennya")
		);

		$update = json_decode($this->client->simple_put(APIVALIDATION, $data));
		// kiirm hasil ke "up_mahasiswa"
		echo json_encode(array("statusnya" => $update->status));
	}
}
