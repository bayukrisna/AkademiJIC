<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi_model extends CI_Model {

    var $db;
    var $table = "tb_prodi";

	public function __construct()
	{
		parent::__construct();
	}

	public function data_prodi(){
		return $this->db->order_by('id_prodi','ASC')
		->get('tb_prodi')
		->result();
	}

	 public function save_prodi()
    {
        $data = array(
            'id_prodi'        => $this->input->post('id_prodi'),
            'nama_prodi'      	=> $this->input->post('nama_prodi'),
            'ketua_prodi'      		=> $this->input->post('ketua_prodi')
            
        );
    
        $this->db->insert('tb_prodi', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

    public function buat_kode(){
        $query = "SELECT id_prodi FROM tb_prodi DESC";
        $result_arr = $this->db->query($query, array(3, 0))->result_array();
    }
    
  
    public function  buat_kode()   {

            $this->db->SELECT('RIGHT(tb_prodi.id_prodi,3) as kode', FALSE);
          $this->db->order_by('id_prodi','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('user');      //cek dulu apakah ada sudah ada kode di tabel.    
          if($query->num_rows() <> 0){      
           //jika kode ternyata sudah ada.      
           $data = $query->row();      
           $kode = intval($data->kode) + 1;    
          }
          else {      
           //jika kode belum ada      
           $kode = 1;    
          }
          $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
          $kodejadi = "PR".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi; 
    }
}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */