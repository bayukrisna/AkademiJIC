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
				$data['main_view'] = 'Asal_sekolah/tambah_asal_sekolah_view';
				$this->load->view('template', $data);

	}
	public function edit_asal_sekolah(){
				$data['main_view'] = 'Asal_sekolah/edit_asal_sekolah_view';
				$id_sekolah = $this->uri->segment(3);
				$data['edit'] = $this->asal_sekolah_model->get_asal_sekolah_by_id($id_sekolah);
				$this->load->view('template', $data);
	}

	public function save_asal_sekolah()
	{
		//set rule di setiap form input
		
		
			if($this->asal_sekolah_model->save_asal_sekolah() == TRUE){
				$username = $this->input->post('nama_sekolah');
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Registrasi '.$username.' berhasil didaftarkan. </div>');
            	redirect('master_asal_sekolah');
			} 
			
	}
	public function save_edit_asal_sekolah(){
			$id_sekolah = $this->uri->segment(3);
					if ($this->asal_sekolah_model->save_edit_asal_sekolah($id_sekolah) == TRUE) {
						$data['message'] = 'Edit Konsentrasi berhasil';
						redirect('master_asal_sekolah');
					} else {
						$data['main_view'] = 'Prodi/master_konsentrasi_view';
						$data['message'] = 'Edit Konsentrasi gagal';
						redirect('master_konsentrasi/edit_konsentrasi');
					}
			}

			public function hapus_asal_sekolah($id_sekolah){
		if ($this->asal_sekolah_model->hapus_asal_sekolah($id_sekolah) == TRUE) {
			$this->session->set_flashdata('message', 'Hapus Konsentrasi Berhasil');
			redirect('master_asal_sekolah');
		} else {
			$this->session->set_flashdata('message', 'Hapus Konsentrasi Berhasil');
			redirect('master_konsentrasi');
		}
	}
}