<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tamu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('tamu_model');
		$this->load->model('daftar_ulang_model');
	}

	public function index(){
				$data['tamu'] = $this->tamu_model->data_tamu();
				$data['main_view'] = 'Tamu/data_tamu_view';
				$this->load->view('template', $data);
			
		
	}

	public function page_tambah_tamu(){
				$data['kodeunik'] = $this->tamu_model->buat_kode();
				$data['getProdi'] = $this->daftar_ulang_model->getProdi();
				$data['getPreschool'] = $this->daftar_ulang_model->getPreschool();
				$data['main_view'] = 'Tamu/tambah_tamu_view';
				$this->load->view('template', $data);

	}

	public function save_tamu()
	{
			if($this->tamu_model->save_tamu() == TRUE){
				$nama_pendaftar = $this->input->post('nama_pendaftar');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data '.$nama_pendaftar.' berhasil didaftarkan. </div>');
            	redirect('tamu');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Username/password sudah ada. </div>');
            	redirect('tamu');
			} 
	} 

	public function hapus_tamu($id_tamu){
		if ($this->tamu_model->hapus_tamu($id_tamu) == TRUE) {
			$this->session->set_flashdata('message', 'HapusTamu Berhasil');
			redirect('tamu');
		} else {
			$this->session->set_flashdata('message', 'Hapus Tamu Gagal');
			redirect('tamu');
		}
	}

	

		


}

/* End of file master_konsentrasi.php */
/* Location: ./application/controllers/master_konsentrasi.php */