<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_dosen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dosen_model');
	}

	public function index()
	{
		$data['main_view'] = 'Dosen/master_dosen_view';
		$data['dosen'] = $this->dosen_model->data_dosen();
		$this->load->view('template', $data);
	}

	public function page_tambah_dosen(){
		$data['main_view'] = 'Dosen/tambah_dosen_view';
		$this->load->view('template', $data);
	}


}

/* End of file master_dosen.php */
/* Location: ./application/controllers/master_dosen.php */