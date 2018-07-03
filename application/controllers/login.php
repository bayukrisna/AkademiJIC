<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// if($this->session->userdata('logged_in') == TRUE)
		// {
		// 	redirect(base_url('dashboard'));
		// } else {
			$data['main_view'] = 'login';
			$this->load->view('template_awal', $data);
		// }
	}
	public function login()
	{
		if($this->model_pw->masuk() == TRUE){
			redirect(base_url('dashboard'));
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><p> Login Gagal</p></div>');
			redirect('login');
		}
	}
	public function lupa(){
		$this->session->set_flashdata('message', '<div class="alert alert-danger"><p> Please Contact Admin</p></div>');
		redirect('login');
	}
}