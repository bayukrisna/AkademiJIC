<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_daftar_ulang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('daftar_ulang_model');
	}

	public function index()
	{
			$data['kodeunik'] = $this->daftar_ulang_model->buat_kode();
			$data['main_view'] = 'registration';
			$data['getProdi'] = $this->daftar_ulang_model->getProdi();
			$data['getIntake'] = $this->daftar_ulang_model->getIntake();
			$data['getPreschool'] = $this->daftar_ulang_model->getPreschool();
			$this->load->view('template', $data);
	}
	public function signup()
	{
			if($this->daftar_ulang_model->signup() == TRUE){
				$username = $this->input->post('fullname');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Registrasi '.$username.' berhasil didaftarkan. </div>');
            	redirect('master_daftar_ulang');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Username/password sudah ada. </div>');
            	redirect('master_daftar_ulang');
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
}