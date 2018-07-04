<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_act extends Model{
	
	function login($uid_, $pwd_, $adm=FALSE){
		$query="SELECT ID_USER, NAMA_USER, ALAMAT_USER, NO_TELP_USER, DATE_FORMAT(LAST_LOGIN,'%d %M %Y %H:%i:%s') AS LAST_LOGIN, 
				CASE JABATAN_USER 
					WHEN JABATAN_USER ='1' THEN 'Staff KOPPEDI'
					WHEN JABATAN_USER ='2' THEN 'Ketua KOPPEDI'
				END AS JABATAN_USER, STATUS_USER
				FROM MST_USER WHERE USERNAME = '".addslashes($uid_)."' AND PASSWORD = '".md5($pwd_)."'";
		$data = $this->db->query($query);
		if($data->num_rows() > 0){
			$rs = $data->row();
			if($rs->STATUS_USER=="0"){
				return 2;die();										
			}else{
				foreach($data->result_array() as $row){
					$datses['LOGGED'] = true;
					$datses['USERNAME'] = $uid_;
					$datses['PASSWORD'] = $pwd_;
					$datses['ID_USER'] = $row['ID_USER'];
					$datses['NAMA_USER'] = $row['NAMA_USER'];
					$datses['ALAMAT_USER'] = $row['ALAMAT_USER'];
					$datses['NO_TELP_USER'] = $row['NO_TELP_USER'];
					$datses['LAST_LOGIN'] = $row['LAST_LOGIN'];
					$datses['JABATAN_USER'] = $row['JABATAN_USER'];
				}
				date_default_timezone_set('Asia/Jakarta');
				$data = array('LAST_LOGIN' => date('Y-m-d H:i:s'));
				$this->db->where('ID_USER', $rs->ID_USER);
				$this->db->update('mst_user', $data);
				$this->newsession->set_userdata($datses);
				return 1;
			}
		}else{
			return 0;
		}
	}
}
?>