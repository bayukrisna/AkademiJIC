<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi_model extends CI_Model {


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
<<<<<<< HEAD
=======

    // public function buat_kode(){
    //     $query = "SELECT id_prodi FROM tb_prodi DESC";
    //     $result_arr = $this->db->query($query, array(3, 0))->result_array();
    // }
>>>>>>> 8e5cbfda0d44989c227ab2c186235d550e5b7b16
    
  
    public function  buat_kode()   {
          $this->db->SELECT('RIGHT(tb_prodi.id_prodi,3) as kode', FALSE);
          $this->db->order_by('id_prodi','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('tb_prodi');      //cek dulu apakah ada sudah ada kode di tabel.    
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

    public function hapus_prodi($id_prodi){
        $this->db->where('id_prodi', $id_prodi)
          ->delete('tb_prodi');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }
}

/* End of file prodi_model.php */
/* Location: ./application/models/prodi_model.php */