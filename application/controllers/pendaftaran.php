<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pendaftaran_model');
	}

	public function index()
	{
		$data['kodeunik'] = $this->pendaftaran_model->buat_kode();
		$data['getPreschool'] = $this->pendaftaran_model->getPreschool();
		$data['main_view'] = 'Daftar/pendaftaran_view';  
		$this->load->view('template', $data);
	}

	public function save_pendaftaran()
	{
			if($this->pendaftaran_model->save_pendaftaran() == TRUE){
				$pendaftar = $this->input->post('nama_pendaftar');
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-success"> Data '.$pendaftar.' berhasil didaftarkan. </div>');
            	redirect('pendaftaran');
			} else{
				$this->session->set_flashdata('message', '<div class="col-md-12 alert alert-danger"> Username/password sudah ada. </div>');
            	redirect('pendaftaran');
			} 
	} 
	public function get_kelas($param = NULL) {
		// $layanan =$this->input->post('layanan');
		$kelas = $param;
		$kodeunik = $this->pendaftaran_model->buat_kode();
		
		$data_sekolah = $this->load->view('data_sekolah');
		
		$option = "";
		if($kelas == "k_pagi"){
			$option.='<div class="col-md-6"><br>
                <div class="form-group">
                  <label for="no">No. Pendaftaran</label>
                  <input type="text" name="id_pendaftaran" class="form-control" id="id_pendaftaran" placeholder="" required .input-sm value=" '.$kodeunik.'" readonly>
                </div>
              	<div class="form-group">
              		<label for="email">Nama Pendaftar</label>
              		<input type="text" name="nama_pendaftar" class="form-control" id="nama_pendaftar" placeholder="Masukan Nama Pendaftar" required .input-sm>
              	</div>
              	<div class="form-group">
              		<label for="preschool">Asal Sekolah</label>
              		<select id="preschool" name="preschool"class="form-control" required="">
                  <option value="">Select Intake</option>
                  '.$data_sekolah.'

                </select>   
              	</div>
                 <div class="form-group">
                  <label for="major">Jurusan di Sekolah Sebelumnya</label>
                <select id="jurusan" name="jurusan" class="form-control" required="">
                  <option value="">Pilih Jurusan</option>
                  <option value="">IPA</option>
                  <option value="">IPS</option>
                  <option value="">TKJ</option>
                  <option value="">RPL</option>

                </select>                                     
                </div>
              	<div class="form-group">
              		<label for="place">Alamat</label>
              		<input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukan Alamat" required>
              	</div>

                <div class="form-group">
                  <label for="place">Email</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Masukan Email" required>
                </div>

                 <div class="form-group">
                  <label for="place">No Telepon</label>
                  <input type="number" name="no_telp" class="form-control" id="no_telp" placeholder="Masukan Nomor Telepon" required>
                </div>

                <div class="form-group">
                  <label for="major">Waktu Kuliah</label>
                <select id="jurusan" name="jurusan" class="form-control" required="">
                  <option value="">Pilih Waktu</option>
                  <option value="">Pagi</option>
                  <option value="">Sore</option>

                </select>                                     
                </div>

                <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Daftar</button>
              </div>
    			';
		} elseif ($kelas == "k_sore") {
			$option.='<p>kk</p>';
		} else {
		} 
		echo $option;
	}

}

/* End of file pendaftaran.php */
/* Location: ./application/controllers/pendaftaran.php */