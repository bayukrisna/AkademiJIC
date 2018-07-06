<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

     public function save_pendaftaran()
    {        
        $data = array(
            'id_pendaftaran'      => $this->buat_kode(),
            'nama_pendaftar'      => $this->input->post('nama_pendaftar', TRUE),
            'id_sekolah'      => $this->input->post('id_sekolah', TRUE),
            'alamat'     => $this->input->post('alamat', TRUE),
            'email'     => $this->input->post('email', TRUE),
            'no_telp'     => $this->input->post('no_telp', TRUE),
            'tanggal_pendaftaran'     => date('Y-m-d')
        );
    
        $this->db->insert('tb_pendaftaran', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

    public function  buat_kode()   {
          $this->db->SELECT('RIGHT(tb_pendaftaran.id_pendaftaran,3) as kode', FALSE);
          $this->db->order_by('id_pendaftaran','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('tb_pendaftaran');      //cek dulu apakah ada sudah ada kode di tabel.    
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
          $kodejadi = "PE".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi; 
    }

    function getPreschool()
    {
        return $this->db->get('tb_sekolah')
                    ->result();

    }

    

}

/* End of file pendaftaran_model.php */
/* Location: ./application/models/pendaftaran_model.php */