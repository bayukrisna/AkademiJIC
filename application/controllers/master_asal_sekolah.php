<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_asal_sekolah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('asal_sekolah_model');
	}

	public function index()
	{		
			$data['asal_sekolah'] = $this->asal_sekolah_model->get_asal_sekolah();
			$data['main_view'] = 'Asal_sekolah/master_asal_sekolah_view';
			$this->load->view('template', $data);
	}
	public function page_tambah_asal_sekolah(){
				$data['kodeunik'] = $this->asal_sekolah_model->buat_kode();
				$data['drop_down_prodi'] = $this->asal_sekolah_model->get_asal_sekolah();
				$data['main_view'] = 'Asal_sekolah/tambah_asal_sekolah_view';
				$this->load->view('template', $data);

	}
	public function edit_asal_sekolah(){
				$data['main_view'] = 'Asal_sekolah/edit_asal_sekolah_view';
				$id_sekolah = $this->uri->segment(3);
				$data['edit'] = $this->asal_sekolah_model->get_asal_sekolah_by_id($id_sekolah);
				$this->load->view('template', $data);
	}
}