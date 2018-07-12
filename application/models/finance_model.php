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
}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */