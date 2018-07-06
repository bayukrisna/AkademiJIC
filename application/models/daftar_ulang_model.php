<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_ulang_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function  buat_kode()   {
          $this->db->SELECT('RIGHT(tb_du.no_du,3) as kode', FALSE);
          $this->db->order_by('no_du','DESC');    
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
          $kodejadi = "PE".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi; 
    }

    public function signup()
    {        
        $data = array(
            'no_du'                => $this->buat_kode(),
            'nama_du'      => $this->input->post('fullname', TRUE),
            'jk_du'      => $this->input->post('gender', TRUE),
            'tgl_lahir_du'     => $this->input->post('date', TRUE),
            'tpt_lahir_du'     => $this->input->post('birth_place', TRUE),
            'alamat_du'     => $this->input->post('address', TRUE),
            'no_telp_du'     => $this->input->post('phone', TRUE),
            'no_telpm_du'     => $this->input->post('mphone', TRUE),
            'email_du'      => $this->input->post('email', TRUE),
            'agama_du'     => $this->input->post('religion', TRUE),
            'id_sekolah'     => $this->input->post('preschool', TRUE),
            'nik_du'     => $this->input->post('nik', TRUE),
            'id_prodi'     => $this->input->post('prodi', TRUE),
            'id_konsentrasi'     => $this->input->post('concentrate', TRUE),
            'waktu'     => $this->input->post('time', TRUE),
            'intake'     => $this->input->post('intake', TRUE)
        );
    
        $this->db->insert('tb_du', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

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
    function getIntake()
    {
        return $this->db->get('tb_intake')
                    ->result();

    }
    function getPreschool()
    {
        return $this->db->get('tb_sekolah')
                    ->result();

    }
}
   // return $this->db->where('status', 'Tersedia')->where($data)->get('service')->result();
/* End of file dosen_model.php */
/* Location: ./application/models/dosen_model.php */
