<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE)
		{
			redirect(base_url('dashboard_admin'));
		} else {
			$data['main_view'] = 'admin_login';
			$this->load->view('template3', $data);
		}
	}
	public function login()
	{
		if($this->model_pw->admin_masuk() == TRUE){
			redirect(base_url('dashboard_admin'));
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger"><p> Anda Bukan Admin</p></div>');
			redirect('admin');
		}
	}
	// public function login()
	// {
	// 	if (!empty($this->input->post('email')) && !empty($this->input->post('password'))) {
 //            $login = $this->input->post('email');
 //            $password = $this->input->post('password');
 //            $user = $this->model_pw->getUserByLogin($login, $password);
 //            if ($user == TRUE){
 //            	redirect(base_url('dashboard'));
 //            } else {
	// 				$data['notif'] = 'Login Gagal';
	// 				$data['main_view'] = 'login';
	// 				$this->load->view('template', $data);
	// 		}
            
 //        }
	// }
}