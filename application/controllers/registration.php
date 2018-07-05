<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('registration_model');
	}

	public function index()
	{
			$data['main_view'] = 'registration';
			$this->load->view('template_awal', $data);
	}
	public function signup()
	{
			if($this->registration_model->signup() == TRUE){
				$username = $this->input->post('fullname');
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Registrasi '.$username.' berhasil didaftarkan. </div>');
            	redirect('registration');
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> Username/password sudah ada. </div>');
            	redirect('registration');
			} 
	} 
}