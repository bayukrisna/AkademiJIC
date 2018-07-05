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

	 public function save_dosen()
    {
        $data = array(
            'nama_dosen'        => $this->input->post('nama_dosen'),
            'kode_dosen'      	=> $this->input->post('kode_dosen'),
            'no_hp'      		=> $this->input->post('no_hp'),
            'keterangan'     	=> $this->input->post('keterangan')
            
        );
    
        $this->db->insert('dosen', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

	

}

/* End of file dosen_model.php */
/* Location: ./application/models/dosen_model.php */