<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
			$data['main_view'] = 'daftar';
			$this->load->view('template', $data);
	}
	public function signup()
	{
		//set rule di setiap form input
		$this->form_validation->set_rules('username', 'Username', 'trim|required');		
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required');	
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		if ($this->form_validation->run() == TRUE){
			if($this->model_pw->signup() == TRUE){
				$username = $this->input->post('username');
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Registrasi '.$username.' berhasil didaftarkan. </div>');
            	redirect('registration');
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> Username/password sudah ada. </div>');
            	redirect('registration');
			} 
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('registration');
				// $data['notif'] = validation_errors();
				// $data['main_view'] = 'daftar';
				// $this->load->view('template', $data);
		}
	} 
	
}