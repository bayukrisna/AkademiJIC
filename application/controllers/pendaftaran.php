<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pendaftaran_model');
	}

	public function index()
	{
		$data['kodeunik'] = $this->pendaftaran_model->buat_kode();
		$data['getPreschool'] = $this->pendaftaran_model->getPreschool();
		$data['main_view'] = 'Daftar/pendaftaran_view';
		$this->load->view('template', $data);
	}

	public function save_pendaftaran()
	{
			if($this->pendaftaran_model->save_pendaftaran() == TRUE){
				$pendaftar = $this->input->post('nama_pendaftar');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data '.$pendaftar.' berhasil didaftarkan. </div>');
            	redirect('pendaftaran');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Username/password sudah ada. </div>');
            	redirect('pendaftaran');
			} 
	} 

}

/* End of file pendaftaran.php */
/* Location: ./application/controllers/pendaftaran.php */