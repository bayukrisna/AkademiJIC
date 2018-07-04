<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq_ extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE)
		{
			$data['main_view'] = 'faq_';
			$this->load->view('template2', $data);
		} else {
			redirect('login');
		}
		
	}
}