<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();

        // Load session library
        $this->load->library('session');
    }

	/* Login ----------------------------------------------------------------------------- */
	public function index()
	{
		$this->load->view('index');
	}

}
