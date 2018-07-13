<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tamu_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function data_tamu(){
		$this->db->select('*');
		 $this->db->from('tb_pendaftaran');
     $this->db->join('tb_sekolah','tb_sekolah.id_sekolah=tb_pendaftaran.id_sekolah2');
		 $this->db->join('tb_prodi','tb_prodi.id_prodi=tb_pendaftaran.id_prodi2');
		 $query = $this->db->get();
		 return $query->result();
	}

  public function get_tamu_by_id($id_pendaftaran){
      return $this->db->where('id_pendaftaran', $id_pendaftaran)
              ->get('tb_pendaftaran')
              ->row();
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
          $kodejadi = "TM".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi; 
    }

    public function  buat_kode_du()   {
          $this->db->SELECT('RIGHT(tb_pendaftaran.id_du2,3) as kode', FALSE);
          $this->db->order_by('id_du2','DESC');    
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
          $kodejadi = "DU".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi; 
    }

    public function save_tamu()
    {
        $data = array(
            'id_pendaftaran'      => $this->input->post('id_pendaftaran', TRUE),
            'nama_pendaftar'      => $this->input->post('nama_pendaftar', TRUE),
            'id_sekolah2'      => $this->input->post('id_sekolah', TRUE),
            'jurusan'      => $this->input->post('jurusan', TRUE),
            'alamat'     => $this->input->post('alamat', TRUE),
            'email'     => $this->input->post('email', TRUE),
            'no_telp'     => $this->input->post('no_telp', TRUE),
            'tanggal_pendaftaran'     => date('Y-m-d'),
            'status_bayar'     => 'Belum bayar',
            'waktu'     => $this->input->post('waktu', TRUE),
            'jk_pendaftar' => $this->input->post('jk_pendaftar', TRUE),
            'sumber' => $this->input->post('sumber', TRUE),
            'id_prodi2' => $this->input->post('id_prodi', TRUE),
            'ibu_kandung' => $this->input->post('ibu_kandung', TRUE),
            'agama' => $this->input->post('agama', TRUE)
            
        );
    
        $this->db->insert('tb_pendaftaran', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

    public function hapus_tamu($id_tamu){
        $this->db->where('id_pendaftaran', $id_tamu)
          ->delete('tb_pendaftaran');

    if ($this->db->affected_rows() > 0) {
      return TRUE;
      } else {
        return FALSE;
      }
    }

  
  public function save_bukti_transfer($upload_bukti, $id_pendaftaran)
   {
    $data = array('status_bayar'     => 'Proses Pengecekan',
      'bukti_transfer' => $upload_bukti['file_name'] )
                  ;
    $this->db->where('id_pendaftaran', $id_pendaftaran)->update('tb_pendaftaran', $data);
    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  } 

  public function save_update_status2($id_pendaftaran){
    $data = array(
       'status_bayar'     => 'Daftar Ulang'
      );

    $this->db->where('id_du2', $id_pendaftaran)
        ->update('tb_pendaftaran', $data);

    if ($this->db->affected_rows() > 0) {
      return TRUE;
    } else {
      return FALSE;
    }
  }


}

/* End of file konsentrasi_model.php */
/* Location: ./application/models/konsentrasi_model.php */