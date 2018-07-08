<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}


	public function index()
	{
			$data['main_view'] = 'tes_backup';
			$this->load->view('template', $data);
	}
}