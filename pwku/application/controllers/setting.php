<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE)
		{
			$username = $this->session->userdata('username');
			$data['user'] = $this->model_pw->cek_user($username);
			$data['main_view'] = 'setting';
			$this->load->view('template2', $data);
		} else {
			redirect('login');
		}
	}
	public function ganti_password()
	{
		if($this->session->userdata('logged_in') == TRUE)
		{
			$username = $this->session->userdata('username');
			$this->model_pw->ganti_password($username);
			
		} else {
			redirect('login');
		}	
	}
}