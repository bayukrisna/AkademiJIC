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

     public function  buat_kode2()   {
          $this->db->SELECT('RIGHT(tb_du.id_du,3) as kode', FALSE);
          $this->db->order_by('id_du','DESC');    
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
          $kodejadi = "DU".$kodemax;    // hasilnya ODJ-9921-0001 dst.
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
              ->where('waktu','Pagi')
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
            'status_du'      => 'Nilai Kosong',
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
            'status_du'      => 'Mahasiswa',
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

  public function detail_nilai($id_du){
      return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_du.id_prodi2')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_du.id_sekolah2')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_du.id_konsentrasi2')
              ->join('tb_hasil_tes','tb_hasil_tes.id_hasil_tes=tb_du.kode_tes')
              ->where('id_du', $id_du)
              ->get('tb_du')
              ->row();
  }

  public function detail_du($id_du){
      return $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_du.id_prodi2')
              ->join('tb_sekolah','tb_sekolah.id_sekolah=tb_du.id_sekolah2')
              ->join('tb_konsentrasi','tb_konsentrasi.id_konsentrasi=tb_du.id_konsentrasi2')
              ->where('id_du', $id_du)
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
            'id_du'      => $this->input->post('id_du', TRUE),
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
            'jurusan_du'      => $this->input->post('jurusan_du', TRUE),
            'ibu_kandung_du'      => $this->input->post('ibu_kandung_du', TRUE),
            'id_sekolah2'      => $this->input->post('id_sekolah', TRUE),
            'id_prodi2'      => $this->input->post('id_prodi', TRUE),
            'id_konsentrasi2'      => $this->input->post('concentrate', TRUE),
            'nim'      => $this->input->post('nim', TRUE),
      );

    $this->db->where('id_du', $no_du)
        ->update('tb_du', $data);

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function get_du_by_id($id_du){
    return $this->db->join('tb_sekolah','tb_sekolah.id_sekolah=tb_du.id_sekolah2')
            ->join('tb_prodi','tb_prodi.id_prodi=tb_du.id_prodi2')
            ->where('id_du', $id_du)
            ->get('tb_du')
            ->row();
  }

  public function save_hasil_tes()
    {        
        $data = array(
            'id_hasil_tes'      => $this->input->post('id_hasil_tes', TRUE),
            'nilai_mat'      => $this->input->post('mtk', TRUE),
            'nilai_bing'      => $this->input->post('bing', TRUE),
            'nilai_psikotes'     => $this->input->post('psikotes', TRUE),
            'total_nilai'     => $this->input->post('nilai', TRUE),
            'total_jawaban'     => $this->input->post('total_jawaban', TRUE),
            'grade'     => $this->input->post('grade', TRUE),
            'tanggal_hasil_tes'     => date('Y-m-d')

        );
    
        $this->db->insert('tb_hasil_tes', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

    public function get_hasil_tes($id_du){
      return $this->db->join('tb_sekolah','tb_sekolah.id_sekolah=tb_du.id_sekolah2')
              ->join('tb_hasil_tes','tb_hasil_tes.id_hasil_tes=tb_du.kode_tes')
              ->where('id_du', $id_du)
              ->get('tb_du')
              ->row();
  }

    public function get_biaya($cek){
      return $this->db->where('nama_biaya', $cek)
              ->get('tb_biaya')
              ->row();
  }


    public function save_update_status($id_tes){
    $data = array(
       'status_du'     => 'Mahasiswa'
      );

    $this->db->where('kode_tes', $id_tes)
        ->update('tb_du', $data);

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function save_edit_hasil_tes($id_tes){
    $data = array(
            'id_hasil_tes'      => $this->input->post('id_hasil_tes', TRUE),
            'nilai_mat'      => $this->input->post('mtk', TRUE),
            'nilai_bing'      => $this->input->post('bing', TRUE),
            'nilai_psikotes'     => $this->input->post('psikotes', TRUE),
            'total_nilai'     => $this->input->post('nilai', TRUE),
            'total_jawaban'     => $this->input->post('total_jawaban', TRUE),
            'grade'     => $this->input->post('grade', TRUE),
            'tanggal_hasil_tes'     => date('Y-m-d')
      );

    $this->db->where('id_hasil_tes', $no_tes)
        ->update('tb_hasil_tes', $data);

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
