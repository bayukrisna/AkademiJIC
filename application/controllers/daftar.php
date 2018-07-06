<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
			$data['main_view'] = 'daftar_view';
			$this->load->view('template_awal', $data);
		// }
	}
	public function get_kelas($param = NULL) {
		// $layanan =$this->input->post('layanan');
		$kelas = $param;
		$option = "";
		if($kelas == "k_pagi"){
			$option.='<p>kk</p>';
		} elseif ($kelas == "k_sore") {
			$option.='<p>kk</p>';
		} else {
		} 
		echo $option;


	}
}