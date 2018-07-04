<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function data_dosen(){
		return $this->db->order_by('id_dosen','ASC')
		->get('dosen')
		->result();
	}

	

}

/* End of file dosen_model.php */
/* Location: ./application/models/dosen_model.php */