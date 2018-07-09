<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

     public function save_pendaftaran_pagi()
    {        
        $data = array(
            'id_pendaftaran'      => $this->buat_kode(),
            'nama_pendaftar'      => $this->input->post('nama_pendaftar', TRUE),
            'id_sekolah2'      => $this->input->post('id_sekolah', TRUE),
            'jurusan'      => $this->input->post('jurusan', TRUE),
            'alamat'     => $this->input->post('alamat', TRUE),
            'email'     => $this->input->post('email', TRUE),
            'no_telp'     => $this->input->post('no_telp', TRUE),
            'tanggal_pendaftaran'     => date('Y-m-d'),
            'waktu'     => 'pagi'
        );
    
        $this->db->insert('tb_pendaftaran', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

    public function save_pendaftaran_sore()
    {        
        $data = array(
            'no_du'      => $this->input->post('no_du', TRUE),
            'nama_du'      => $this->input->post('nama_du', TRUE),
            'jk_daftar_du'      => $this->input->post('gender', TRUE),
            'tpt_lahir_du'      => $this->input->post('tpt_lahir_du', TRUE),
            'tgl_lahir_du'     => $this->input->post('tgl_lahir_du', TRUE),
            'alamat_du'     => $this->input->post('alamat_du', TRUE),
            'no_telp_du'     => $this->input->post('no_telp_du', TRUE),
            'no_telpm_du'     => $this->input->post('no_telpm_du', TRUE),
            'email_du'     => $this->input->post('email_du', TRUE),
            'agama_du'      => $this->input->post('agama_du', TRUE),
            'nik_du'      => $this->input->post('nik_du', TRUE),
            'jurusan'      => $this->input->post('jurusan', TRUE),
            'ibu_kandung_du'      => $this->input->post('ibu_kandung_du', TRUE),
            'id_sekolah2'      => $this->input->post('id_sekolah', TRUE),
            'id_prodi2'      => $this->input->post('id_prodi', TRUE),
            'id_konsentrasi2'      => $this->input->post('concentrate', TRUE),
            'intake'      => $this->input->post('intake', TRUE),
            'waktu'      => 'Sore',
            'status'      => 'Aktif',
            'tanggal_du'      => date('Y-m-d')

        );
    
        $this->db->insert('tb_du', $data);

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

    public function data_pra_pendaftar(){
    $this->db->select('*');
     $this->db->from('tb_pendaftaran');
     $this->db->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah2');
     $query = $this->db->get();
     return $query->result();
  }

  public function get_pra_pendaftar($id_pendaftaran){
      return $this->db->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah2')
              ->where('id_pendaftaran', $id_pendaftaran)
              ->get('tb_pendaftaran')
              ->row();
  }

    

}

/* End of file pendaftaran_model.php */
/* Location: ./application/models/pendaftaran_model.php */