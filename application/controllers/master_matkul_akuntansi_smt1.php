<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_matkul_akuntansi_smt1 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$data['main_view'] = 'master_matkul_akuntansi_smt1_view';
		$this->load->view('template', $data);
		
	}

	

}

/* End of file master.php */
/* Location: ./application/controllers/master.php */