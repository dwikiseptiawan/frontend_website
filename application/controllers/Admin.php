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
				redirect("dashboard");
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
		if (!empty($this->session->tempdata('token'))) {
			$save = json_decode($this->client->simple_get(APINUMBER));
			$user = json_decode($this->client->simple_get(APIUSER));
			$data['phone'] = $save->number;
			$data['userAll'] = $user->user_all;
			$data['userToday'] = $user->user_today;
			$this->load->view('dashboard', $data);
		}
		else redirect("/");
	}

	public function menu_user()
	{
		if (!empty($this->session->tempdata('token'))) {
			$data['user'] = json_decode($this->client->simple_get(APIUSER));
			$this->load->view('pengguna', $data);
		} else redirect("/");
	}

	public function logout()
	{
		$this->session->set_tempdata('token', "");
		redirect('login');
	}
}