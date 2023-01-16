<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gambar extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

	public function menu_gambar()
	{
		if (!empty($this->session->tempdata('token'))) {
			$data['user'] = json_decode($this->client->simple_get(APIUSER));
			$this->load->view('gambar', $data);
		} else redirect("/");
	}

	public function delete()
	{
		if (!empty($this->session->tempdata('token'))) {
			$json  = file_get_contents("php://input");
			$hasil = json_decode($json);
			$delete = json_decode($this->client->simple_delete(APIUSER, array("id" => $this->input->post("id"))));
			redirect("gambar");
		} else redirect("/");
		
	}

	function tambah()
	{
		if (!empty($this->session->tempdata('token'))) {
			$data = array(
			"nama" => $this->input->post("nama"),
			"username" => $this->input->post("username"),
			"password" => $this->input->post("password"),
			"type" => "1",
		);

		$save = json_decode($this->client->simple_post(APIUSER, $data));
		redirect("gambar");
		} else redirect("/");
	}
}
