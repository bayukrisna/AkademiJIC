<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function data_mahasiswa(){
		return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_du.id_prodi2')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_du.id_sekolah2')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_du.id_konsentrasi2')
              ->where('status_du', 'Mahasiswa')
              ->get('tb_du')
              ->result();
	}

	public function detail_mahasiswa($id_du){
      return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_du.id_prodi2')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_du.id_sekolah2')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_du.id_konsentrasi2')
              ->where('id_du', $id_du)
              ->get('tb_du')
              ->row();
  }
}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */