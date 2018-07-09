<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_tes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
			$data['main_view'] = 'hasil_tes';
			$data['prodi'] = $this->prodi_model->data_prodi();
			$this->load->view('template', $data);
	}
}