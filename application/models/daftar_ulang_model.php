<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_ulang_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

     public function  buat_kode()   {
          $this->db->SELECT('RIGHT(tb_du.kode_tes,3) as kode', FALSE);
          $this->db->order_by('kode_tes','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('tb_du');      //cek dulu apakah ada sudah ada kode di tabel.    
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
          $kodejadi = "TES".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi; 
    }

  

     function getProdi()
    {
        return $this->db->get('tb_prodi')
                    ->result();

    }
    public function getConcentrate($data){
    $this->db->select('tb_prodi.id_prodi, tb_konsentrasi.id_konsentrasi, tb_konsentrasi.nama_konsentrasi');
    $this->db->from('tb_prodi'); //dari tabel data_users
    $this->db->join('tb_konsentrasi', 'tb_prodi.id_prodi = tb_konsentrasi.id_prodi2');
    $this->db->where($data); //menyatukan tabel users menggunakan left join
    $data = $this->db->get(); //mengambil seluruh data
    return $data->result(); //mengembalikan data
    }

  
    function getPreschool()
    {
        return $this->db->get('tb_sekolah')
                    ->result();

    }

    public function data_du(){
      return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_du.id_prodi2')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_du.id_sekolah2')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_du.id_konsentrasi2')
              ->get('tb_du')
              ->result();
  }

  public function page_du_pagi($id_pendaftaran){
      return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_pendaftaran.id_prodi2')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah2')
              ->where('id_pendaftaran', $id_pendaftaran)
              ->get('tb_pendaftaran')
              ->row();
  }

  public function save_du_pagi()
    {        
        $data = array(
            'id_du'      => $this->input->post('id_du', TRUE),
            'kode_tes'      => $this->input->post('kode_tes', TRUE),
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
            'jurusan_du'      => $this->input->post('jurusan', TRUE),
            'ibu_kandung_du'      => $this->input->post('ibu_kandung_du', TRUE),
            'id_sekolah2'      => $this->input->post('id_sekolah', TRUE),
            'id_prodi2'      => $this->input->post('id_prodi', TRUE),
            'id_konsentrasi2'      => $this->input->post('concentrate', TRUE),
            'waktu'      => 'Pagi',
            'nim'      => $this->input->post('nim', TRUE),
            'tanggal_du'      => date('Y-m-d')
        );
    
        $this->db->insert('tb_du', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

    public function page_du_sore($id_pendaftaran){
      return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_pendaftaran.id_prodi2')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah2')
              ->where('id_pendaftaran', $id_pendaftaran)
              ->get('tb_pendaftaran')
              ->row();
  }

  public function save_du_sore()
    {        
        $data = array(
            'id_du'      => $this->input->post('id_du', TRUE),
            'kode_tes'      => $this->input->post('kode_tes', TRUE),
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
            'jurusan_du'      => $this->input->post('jurusan', TRUE),
            'ibu_kandung_du'      => $this->input->post('ibu_kandung_du', TRUE),
            'id_sekolah2'      => $this->input->post('id_sekolah', TRUE),
            'id_prodi2'      => $this->input->post('id_prodi', TRUE),
            'id_konsentrasi2'      => $this->input->post('concentrate', TRUE),
            'waktu'      => 'Sore',
            'nim'      => $this->input->post('nim', TRUE),
            'tanggal_du'      => date('Y-m-d')
        );
    
        $this->db->insert('tb_du', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

  public function detail_du($id_du){
      return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_du.id_prodi2')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_du.id_sekolah2')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_du.id_konsentrasi2')
              ->where('no_du', $id_du)
              ->get('tb_du')
              ->row();
  }

  public function get_data_pagi($id_pendaftaran){
      return $this->db->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah2')
              ->where('id_pendaftaran', $id_pendaftaran)
              ->get('tb_pendaftaran')
              ->row();
  }

    public function save_edit_du($no_du){
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
      );

    $this->db->where('no_du', $no_du)
        ->update('tb_du', $data);

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
}
   // return $this->db->where('status', 'Tersedia')->where($data)->get('service')->result();
/* End of file dosen_model.php */
/* Location: ./application/models/dosen_model.php */
