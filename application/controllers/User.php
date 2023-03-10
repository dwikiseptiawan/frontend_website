<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

	public function menu_user()
	{
		$data['user'] = json_decode($this->client->simple_get(APIUSER));
		$this->load->view('pengguna', $data);
	}

	public function delete()
	{
		$json  = file_get_contents("php://input");
		$hasil = json_decode($json);
		$delete = json_decode($this->client->simple_delete(APIUSER, array("id" => $this->input->post("id"))));
		redirect("pengguna");
	}

	function tambah()
	{
		$data = array(
			"nama" => $this->input->post("nama"),
			"username" => $this->input->post("username"),
			"password" => $this->input->post("password"),
			"type" => "1",
		);

		$save = json_decode($this->client->simple_post(APIUSER, $data));
		redirect("pengguna");
	}

	function daftar()
	{
		$data = array(
			"nama" => $this->input->post("nama"),
			"username" => $this->input->post("username"),
			"password" => $this->input->post("password"),
			"type" => "0",
		);

		$save = json_decode($this->client->simple_post(APIUSER, $data));
		redirect("login");
	}

	function number()
	{
		$data = array(
			"number" => $this->input->post("number")
		);

		$save = json_decode($this->client->simple_post(APINUMBER, $data));
		redirect("dashboard");
	}
}
