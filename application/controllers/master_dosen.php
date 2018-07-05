<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_dosen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dosen_model');
	}

	public function index()
	{
		$data['main_view'] = 'Dosen/master_dosen_view';
		$data['dosen'] = $this->dosen_model->data_dosen();
		$this->load->view('template', $data);
	}

	public function page_tambah_dosen(){
		$data['main_view'] = 'Dosen/tambah_dosen_view';
		$this->load->view('template', $data);
	}

	public function save_dosen()
	{
		//set rule di setiap form input
		$this->form_validation->set_rules('nama_dosen', 'Nama Dosen', 'trim|required');		
		$this->form_validation->set_rules('kode_dosen', 'Kode Dosen', 'trim|required');	
		$this->form_validation->set_rules('no_hp', 'No HP', 'trim|required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
		
		if ($this->form_validation->run() == TRUE){
			if($this->dosen_model->save_dosen() == TRUE){
				$dosen = $this->input->post('dosen');
				$this->session->set_flashdata('message', '<div class="alert alert-success"> Registrasi '.$nama_dosen.' berhasil didaftarkan. </div>');
            	redirect('master_dosen');
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> Username/password sudah ada. </div>');
            	redirect('master_dosen/page_tambah_dosen');
			} 
			} else{
				$this->session->set_flashdata('message', '<div class="alert alert-danger"> '.validation_errors().' </div>');
            	redirect('master_dosen/page_tambah_dosen');
				// $data['notif'] = validation_errors();
				// $data['main_view'] = 'daftar';
				// $this->load->view('template', $data);
		}
	} 


}

/* End of file master_dosen.php */
/* Location: ./application/controllers/master_dosen.php */