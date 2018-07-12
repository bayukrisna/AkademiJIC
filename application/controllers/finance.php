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
	public function konfirmasi($id_pendaftaran){
				$data['data_biaya'] = $this->biaya_sekolah_model->data_biaya();
				$data['main_view'] = 'Biaya_sekolah/edit_biaya_sekolah_view';
				$id_biaya = $this->uri->segment(3);
				$data['edit'] = $this->biaya_sekolah_model->get_biaya_by_id($id_biaya);
				$this->load->view('template', $data);
	}

}
