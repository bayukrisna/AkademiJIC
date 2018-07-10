<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class daftar_ulang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('daftar_ulang_model');
		$this->load->model('pendaftaran_model');
	}

	public function index()
	{
			$id_du = $this->uri->segment(3);
			$data['du_pagi'] = $this->daftar_ulang_model->get_data_pagi($id_du);
			$data['kodeunik'] = $this->daftar_ulang_model->buat_kode();
			$data['main_view'] = 'registration';
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPreschool'] = $this->daftar_ulang_model->getPreschool();
			$this->load->view('template', $data);
	}

	public function daftar_ulang()
	{
			if($this->pendaftaran_model->daftar_ulang() == TRUE){
				$nama_pendaftar = $this->input->post('nama_du');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data '.$nama_pendaftar.' berhasil didaftarkan. </div>');
            	redirect('daftar_ulang/data_du');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Username/password sudah ada. </div>');
            	redirect('daftar_ulang');
			} 
	} 

	public function data_du()
	{
			$data['du'] = $this->daftar_ulang_model->data_du();
			$data['main_view'] = 'Daftar/data_daftarulang_view';
			$this->load->view('template', $data);
	}

	public function detail_du()
	{
			$id_du = $this->uri->segment(3);
			$data['du'] = $this->daftar_ulang_model->detail_du($id_du);
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPreschool'] = $this->daftar_ulang_model->getPreschool();
			$data['main_view'] = 'Daftar/edit_daftarulang_view';
			$this->load->view('template', $data);
	}

	public function save_pendaftaran_sore()
	{
			if($this->pendaftaran_model->save_pendaftaran_sore() == TRUE){
				$nama_du = $this->input->post('nama_du');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data '.$nama_du.' berhasil didaftarkan. </div>');
            	redirect('daftar_ulang/data_du');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Username/password sudah ada. </div>');
            	redirect('pendaftaran');
			} 
	} 

	public function get_concentrate($param = NULL) {
		// $layanan =$this->input->post('layanan');
		$prodi = $param;
		$dt = array('id_prodi' => $prodi);
		$result = $this->daftar_ulang_model->getConcentrate($dt);
		$option = "";
		$option .= '<option value="">Pilih Produk</option>';
		foreach ($result as $data) {
			$option .= "<option value='".$data->id_konsentrasi."' >".$data->nama_konsentrasi."</option>";
			
		}
		echo $option;

	}

	 public function save_edit_du(){
      $no_du = $this->uri->segment(3);
          if ($this->daftar_ulang_model->save_edit_du($no_du) == TRUE) {
            $data['message'] = 'Edit Daftar Ulang berhasil';
            redirect('daftar_ulang/data_du');
          } else {
            $data['main_view'] = 'Prodi/master_konsentrasi_view';
            $data['message'] = 'Edit Konsentrasi gagal';
            redirect('master_konsentrasi/edit_konsentrasi');
          }
        }
}