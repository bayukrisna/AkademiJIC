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
				$data['getPreschool'] = $this->pendaftaran_model->getPreschool();
				$id_pendaftaran = $this->uri->segment(3);
				$data['hasil_tes'] = $this->pendaftaran_model->get_pra_pendaftar($id_pendaftaran);
				$data['id_pendaftaran'] = $id_pendaftaran;
				$data['main_view'] = 'hasil_tes_view';
				$this->load->view('template', $data);
	}

	public function cetak_hasil_tes()
	{
				$data['main_view'] = 'Tes/hasil_tes_cetak_view';
				$this->load->view('template', $data);
	}

	public function save_hasil_tes()
	{
		
			
			if($this->pendaftaran_model->save_hasil_tes() == TRUE){
				$id_tes = $this->input->post('id_hasil_tes');
				$this->pendaftaran_model->save_update_status($id_tes);
				$hasil_tes = $this->input->post('nama_pendaftar');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> esHasil t '.$hasil_tes.' berhasil didaftarkan. </div>');
            	redirect('pendaftaran/data_pra_pendaftar');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Username/password sudah ada. </div>');
            	redirect('pendaftaran');
			} 
	} 

	 public function print_hasil_tes(){
        
        $id_pendaftaran = $this->uri->segment(3);
        $data['edit'] = $this->pendaftaran_model->get_hasil_tes($id_pendaftaran);
        $data['main_view'] = 'Tes/hasil_tes_cetak_view';
        $this->load->view('template', $data);
  }

  public function detail_tes(){
        
        $id_pendaftaran = $this->uri->segment(3);
        $data['edit'] = $this->pendaftaran_model->get_hasil_tes($id_pendaftaran);
        $data['main_view'] = 'Tes/detail_hasil_tes_view';
        $this->load->view('template', $data);
  }
}