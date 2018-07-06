<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_prodi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('prodi_model');
	}

		public function index()
	{
		$data['main_view'] = 'Prodi/master_prodi_view';
		$data['prodi'] = $this->prodi_model->data_prodi();
		$this->load->view('template', $data);
	}

	public function page_tambah_prodi(){
		
		$data['main_view'] = 'prodi/tambah_prodi_view';
		$data['kodeunik'] = $this->prodi_model->buat_kode();
		$this->load->view('template', $data);
	}

	public function save_prodi()
	{
		//set rule di setiap form input
		$this->form_validation->set_rules('id_prodi', 'Id prodi', 'trim|required');		
		$this->form_validation->set_rules('nama_prodi', 'Nama prodi', 'trim|required');	
		$this->form_validation->set_rules('ketua_prodi', 'Ketua Prodi', 'trim|required');
		
		if ($this->form_validation->run() == TRUE){
			if($this->prodi_model->save_prodi() == TRUE){
				$prodi = $this->input->post('prodi');
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Registrasi '.$nama_prodi.' berhasil didaftarkan. </div>');
            	redirect('master_prodi');
			} 
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('master_prodi/page_tambah_prodi');
		}
	}

	public function hapus_prodi($id_prodi){
		if ($this->prodi_model->hapus_prodi($id_prodi) == TRUE) {
			$this->session->set_flashdata('notif', 'Hapus Program Studi Berhasil');
			redirect('master_prodi');
		} else {
			$this->session->set_flashdata('notif', 'Hapus Program Studi Berhasil');
			redirect('master_prodi');
		}
	}

	public function edit_prodi(){
			
				$data['main_view'] = 'Prodi/edit_prodi_view';
				$id_prodi = $this->uri->segment(3);
				$data['edit'] = $this->prodi_model->get_prodi_by_id($id_prodi);
				$this->load->view('template', $data);
	

	}


	public function save_edit_prodi(){
			$id_prodi = $this->uri->segment(3);

			if ($this->input->post('submit')) {
				$this->form_validation->set_rules('id_prodi', 'Id prodi', 'trim|required');		
				$this->form_validation->set_rules('nama_prodi', 'Nama prodi', 'trim|required');	
				$this->form_validation->set_rules('ketua_prodi', 'Ketua Prodi', 'trim|required');

				if ($this->form_validation->run() == TRUE) {
					if ($this->prodi_model->save_edit_prodi($id_prodi) == TRUE) {
						$data['notif'] = 'Edit prodi berhasil';
						redirect('master_prodi');
					} else {
						$data['main_view'] = 'Prodi/master_prodi_view';
						$data['notif'] = 'Edit prodi gagal';
						redirect('master_prodi/edit_prodi');
					}
				} else {
					$data['main_view'] = 'Prodi/edit_prodi_view';
					$data['notif'] = validation_errors();
					$this->load->view('template', $data);
				}
			}
		}


	

}

/* End of file master_prodi.php */
/* Location: ./application/controllers/master_prodi.php */