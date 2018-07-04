<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_matkul_akuntansi_smt1 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('akuntansi_model');
		
	}

	public function index()
	{
		$data['main_view'] = 'master_matkul_akuntansi_smt1_view';
		$data['akuntansi'] = $this->akuntansi_model->data_matkul_akuntansi();
		$this->load->view('template', $data);
	}

	public function simpan_matkul()
	{
		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules('subjectcode','subjectcode','trim|required');
			$this->form_validation->set_rules('subjectname','subjectname','trim|required');
			$this->form_validation->set_rules('credits','credits','trim|required');
			$this->form_validation->set_rules('semester','semester','trim|required');
			$this->form_validation->set_rules('dosen','credits','trim|required');
			$this->form_validation->set_rules('credits','credits','trim|required');

			if ($this->form_validation->run() == TRUE) 
			{	if ($this->kelolapegawai_model->insert() == TRUE) 
					{
					$data['notif'] = 'Tambah admin Berhasil';
					redirect(base_url().'index.php/kelolapegawai/datapegawai');
				} else {
					$data['notif'] = 'Tambah admin gagal';
					$data['main_view'] = 'admin/tambahpegawai_view';
					$this->load->view('admin/template', $data);
				}
			} else {
				$data['main_view'] = 'admin/tambahpegawai_view';
				$data['notif'] = $this->upload->display_errors();
				$this->load->view('admin/template', $data);
			}		
		} else {
			$data['main_view'] = 'admin/tambapegawai_view';
				$data['notif'] = validation_errors();				
				$this->load->view('admin/template', $data);
			}
		}

	

}

/* End of file master.php */
/* Location: ./application/controllers/master.php */