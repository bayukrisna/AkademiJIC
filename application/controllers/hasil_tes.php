<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_tes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
<<<<<<< HEAD
		
=======
		$this->load->model('pendaftaran_model');
>>>>>>> 8b3b12f338432d8d84e844f0392ed3f2cecdfe89
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
}