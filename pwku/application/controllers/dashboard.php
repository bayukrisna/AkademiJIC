<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
			$data['total_pesanan_sukses']  = $this->model_pw->cek_pesanan_sukses($username);
			$data['total_pesanan']  = $this->model_pw->cek_semua_pesanan($username);
			$data['total_deposit']  = $this->model_pw->cek_deposit($username);
			$data['riwayat'] = $this->model_pw->cek_riwayat($username);
			$data['deposit'] = $this->model_pw->data_deposit($username);
			$data['main_view'] = 'dashboard';
			$this->load->view('template2', $data);		
		} else {
			redirect('login');
		}
		
	}
}