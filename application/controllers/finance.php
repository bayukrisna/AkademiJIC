<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('finance_model');
	}

		public function index()
	{
		$data['main_view'] = 'Finance/finance_view';
		$data['mahasiswa'] = $this->finance_model->data_mahasiswa();
		$this->load->view('template', $data);
	}

}
