<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function data_mahasiswa(){
		return $this->db->where('status_bayar' , 'Proses Pengecekan')
		->order_by('id_pendaftaran','ASC')
		->get('tb_pendaftaran')
		->result();
	}

  public function data_lunas(){
    $query = $this->db->query("SELECT * FROM tb_pendaftaran WHERE status_bayar = 'Lunas' OR status_bayar = 'Daftar Ulang'")->result();
    return $query;
  }

	public function save_konfirmasi($id_pendaftaran){
    $data = array(
       'id_pendaftaran'     => $id_pendaftaran,
       'id_du2'            => $this->input->post('id_daftar_ulang', TRUE),
        'status_bayar'  => 'Lunas'
      );

    $this->db->where('id_pendaftaran', $id_pendaftaran)
        ->update('tb_pendaftaran', $data);

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  public function gagal_konfirmasi($id_pendaftaran){
    $data = array(
       'id_pendaftaran'     => $id_pendaftaran,
        'status_bayar'  => 'Belum bayar'
      );

    $this->db->where('id_pendaftaran', $id_pendaftaran)
        ->update('tb_pendaftaran', $data);

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */