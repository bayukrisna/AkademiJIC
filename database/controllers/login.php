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
	public function masuk()
	{
		if($this->input->post('submit')){

		//set rule di setiap form input
		$this->form_validation->set_rules('username', 'Username', 'trim|required');		
		$this->form_validation->set_rules('password', 'Password', 'trim|required');	

		if ($this->form_validation->run() == TRUE)	{
			
			if($this->login_model->cek_user() == TRUE){
						redirect(base_url('index.php/registration'));
			} else {
					$data['notif'] = 'Login Gagal';
					$data['main_view'] = 'login';
					$this->load->view('template_awal', $data);
			}
			//jika sukses
		}else {
			//jika gagal
			$data['notif'] = validation_errors();
			$data['main_view'] = 'login_view';
			$this->load->view('template', $data);
			}
		}
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