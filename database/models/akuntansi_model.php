<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akuntansi_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function data_matkul_akuntansi(){
		return $this->db->order_by('id_matkul_akuntansi','ASC')
		->get('matkul_akuntansi')
		->result();
	}

	

}

/* End of file akuntansi_model.php */
/* Location: ./application/models/akuntansi_model.php */