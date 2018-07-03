<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_matkul_akuntansi_smt1 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$this->load->view('View File', $data);
		
	}

	public function datasuratmasuk(){
		if ($this->session->userdata('logged_in') == TRUE) {
			if ($this->session->userdata('jabatan') == 'Sekretaris') {
				$data['main_view'] = 'sekretaris/datasuratmasuk_view';
				$data['data_surat_masuk'] = $this->surat_model->get_surat_masuk();

				$this->load->view('template', $data);
			} else {
				$data['main_view'] = 'disposisimasuk_view';
				$data['data_disposisi'] = $this->surat_model->get_all_disposisi_masuk($this->session->userdata('id_pegawai'));
				$this->load->view('template', $data);
			}
		} else {
			redirect('login/login');
		}
	}

}

/* End of file master.php */
/* Location: ./application/controllers/master.php */