<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance_model extends CI_Model {


	public function __construct()
	{
		parent::__construct();
	}

	public function data_prodi(){
		return $this->db->order_by('id_prodi','ASC')
		->get('tb_prodi')
		->result();
	}
}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */