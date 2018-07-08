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
    $getPreschool = $this->pendaftaran_model->getPreschool();
    $yoi = 
    for ($i= 1; $i <= 10; $i++)
    {
      echo "Saya sedang belajar PHP";
      echo "<br />";
      }


    foreach($getPreschool as $row){
    '<option value="'.$row->id_sekolah.'">'.$row->nama_sekolah.'</option>'} ;
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
                  <label for="gender">Asal Sekolah</label>
                  <select id="id_sekolah" name="id_sekolah" class="form-control" required="">
                    <option value="">Pilih Sekolah</option>
                     '.$yoi.'
                 </select>                                     
                  <!-- <input type ="radio" name = "sex" value="male" required/> Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type ="radio" name = "sex" value= "female" required/> Female -->
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