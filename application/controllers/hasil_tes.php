<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_tes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pendaftaran_model');
	}

	public function index()
	{
				$data['kodeunik'] = $this->pendaftaran_model->buat_kode_tes();
				$data['getPreschool'] = $this->pendaftaran_model->getPreschool();
				$id_hasil_tes = $this->uri->segment(3);
				$data['hasil_tes'] = $this->pendaftaran_model->get_pra_pendaftar($id_hasil_tes);
				$data['main_view'] = 'hasil_tes_view';
				$this->load->view('template', $data);
	}

	public function save_hasil_tes()
	{
			if($this->pendaftaran_model->save_hasil_tes() == TRUE){
				$hasil_tes = $this->input->post('nama_pendaftar');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> esHasil t '.$hasil_tes.' berhasil didaftarkan. </div>');
            	redirect('pendaftaran');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Username/password sudah ada. </div>');
            	redirect('pendaftaran');
			} 
	} 
}