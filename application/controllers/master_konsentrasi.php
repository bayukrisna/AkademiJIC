<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_konsentrasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prodi_model');
		$this->load->model('konsentrasi_model');
	}

	public function index(){
				$data['prodi'] = $this->prodi_model->data_prodi();
				$data['konsentrasi'] = $this->konsentrasi_model->data_konsentrasi();
				$data['main_view'] = 'Konsentrasi/master_konsentrasi_view';
				$this->load->view('template', $data);
			
		
	}

	public function page_tambah_konsentrasi(){
				$data['kodeunik'] = $this->konsentrasi_model->buat_kode();
				$data['drop_down_prodi'] = $this->konsentrasi_model->get_prodi();
				$data['konsentrasi'] = $this->konsentrasi_model->data_konsentrasi();
				$data['main_view'] = 'Konsentrasi/tambah_konsentrasi_view';
				$this->load->view('template', $data);

	}

	public function save_konsentrasi()
	{
		//set rule di setiap form input
		$this->form_validation->set_rules('id_konsentrasi', 'Id Konsnetrasi', 'trim|required');		
		$this->form_validation->set_rules('nama_konsentrasi', 'Nama Konsentrasi', 'trim|required');	
		$this->form_validation->set_rules('id_prodi', 'Nama Prodi', 'trim|required');	
		
		if ($this->form_validation->run() == TRUE){
			if($this->konsentrasi_model->save_konsentrasi() == TRUE){
				$username = $this->input->post('nama_konsentrasi');
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Registrasi '.$username.' berhasil didaftarkan. </div>');
            	redirect('master_konsentrasi');
			} 
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('master_konsentrasi/page_tambah_konsentrasi');
		}
	}

	public function hapus_konsentrasi($id_konsentrasi){
		if ($this->konsentrasi_model->hapus_konsentrasi($id_konsentrasi) == TRUE) {
			$this->session->set_flashdata('message', 'Hapus Konsentrasi Berhasil');
			redirect('master_konsentrasi');
		} else {
			$this->session->set_flashdata('message', 'Hapus Konsentrasi Berhasil');
			redirect('master_konsentrasi');
		}
	}

	public function edit_konsentrasi(){
				$data['konsentrasi'] = $this->konsentrasi_model->data_konsentrasi();
			    $data['drop_down_prodi'] = $this->konsentrasi_model->get_prodi();
				$data['main_view'] = 'Konsentrasi/edit_konsentrasi_view';
				$id_konsentrasi = $this->uri->segment(3);
				$data['edit'] = $this->konsentrasi_model->get_konsentrasi_by_id($id_konsentrasi);
				$this->load->view('template', $data);
	}


	public function save_edit_konsentrasi(){
			$id_konsentrasi = $this->uri->segment(3);
					if ($this->konsentrasi_model->save_edit_konsentrasi($id_konsentrasi) == TRUE) {
						$data['message'] = 'Edit Konsentrasi berhasil';
						redirect('master_konsentrasi');
					} else {
						$data['main_view'] = 'Prodi/master_konsentrasi_view';
						$data['message'] = 'Edit Konsentrasi gagal';
						redirect('master_konsentrasi/edit_konsentrasi');
					}
			}
		


}

/* End of file master_konsentrasi.php */
/* Location: ./application/controllers/master_konsentrasi.php */