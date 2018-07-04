<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
			$data['main_view'] = 'tos';
			$this->load->view('template', $data);
	}
}