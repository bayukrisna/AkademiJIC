<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class daftar_ulang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('daftar_ulang_model');
		$this->load->model('tamu_model');
	}

	public function page_du_pagi()
	{
			$id_pendaftaran = $this->uri->segment(3);
			$data['du_pagi'] = $this->daftar_ulang_model->page_du_pagi($id_pendaftaran);
			$data['kodeunik'] = $this->daftar_ulang_model->buat_kode();
			$data['kodeunik2'] = $this->daftar_ulang_model->buat_kode2();
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPreschool'] = $this->daftar_ulang_model->getPreschool();
			$data['main_view'] = 'Daftar/daftarulang_pagi_view';
			$this->load->view('template', $data);
	}

	public function page_du_sore()
	{
			$id_pendaftaran = $this->uri->segment(3);
			$data['du_pagi'] = $this->daftar_ulang_model->page_du_sore($id_pendaftaran);
			$data['kodeunik2'] = $this->daftar_ulang_model->buat_kode2();
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPreschool'] = $this->daftar_ulang_model->getPreschool();
			$data['main_view'] = 'Daftar/daftarulang_sore_view';
			$this->load->view('template', $data);
	}

	public function save_du_pagi()
	{
			if($this->daftar_ulang_model->save_du_pagi() == TRUE){
				$id_pendaftaran = $this->input->post('id_du');
				$this->tamu_model->save_update_status2($id_pendaftaran);
				$nama_pendaftar = $this->input->post('nama_du');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data '.$nama_pendaftar.' berhasil didaftarkan. </div>');
            	redirect('daftar_ulang/data_du');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Data  '.$nama_pendaftar.' Sudah Ada </div>');
            	redirect('daftar_ulang/page_du_pagi');
			} 
	} 

	public function save_du_sore()
	{
			if($this->daftar_ulang_model->save_du_sore() == TRUE){
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

	public function detail_nilai()
	{
			$id_du = $this->uri->segment(3);
			$data['edit'] = $this->daftar_ulang_model->detail_nilai($id_du);
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getPreschool'] = $this->daftar_ulang_model->getPreschool();
			$data['main_view'] = 'Tes/detail_hasil_tes_view';
			$this->load->view('template', $data);
	}

	public function print_ljk(){
        
        $id_du= $this->uri->segment(3);
        $data['edit'] = $this->daftar_ulang_model->get_du_by_id($id_du);
        $data['main_view'] = 'tes_backup';
        $this->load->view('template', $data);
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
      $id_du = $this->uri->segment(3);
          if ($this->daftar_ulang_model->save_edit_du($id_du) == TRUE) {
            $data['message'] = 'Edit Daftar Ulang berhasil';
            redirect('daftar_ulang/data_du');
          } else {
            $data['main_view'] = 'Prodi/master_konsentrasi_view';
            $data['message'] = 'Edit Konsentrasi gagal';
            redirect('master_konsentrasi/edit_konsentrasi');
          }
        }
}