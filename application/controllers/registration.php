<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('registration_model');
	}

	public function index()
	{
			$data['kodeunik'] = $this->registration_model->buat_kode();
			$data['main_view'] = 'registration';
			$data['getProdi'] = $this->registration_model->getProdi();
			$data['getIntake'] = $this->registration_model->getIntake();
			$data['getPreschool'] = $this->registration_model->getPreschool();
			$this->load->view('template_awal', $data);
	}
	public function signup()
	{
			if($this->registration_model->signup() == TRUE){
				$username = $this->input->post('fullname');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Registrasi '.$username.' berhasil didaftarkan. </div>');
            	redirect('registration');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Username/password sudah ada. </div>');
            	redirect('registration');
			} 
	} 
	public function get_concentrate($param = NULL) {
		// $layanan =$this->input->post('layanan');
		$prodi = $param;
		$dt = array('id_prodi' => $prodi);
		$result = $this->registration_model->getConcentrate($dt);
		$option = "";
		$option .= '<option value="">Pilih Produk</option>';
		foreach ($result as $data) {
			$option .= "<option value='".$data->id_konsentrasi."' >".$data->nama_konsentrasi."</option>";
			
		}
		echo $option;

	}
}