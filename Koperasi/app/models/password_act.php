<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Password_act extends Model{
	function password(){
		if($this->newsession->userdata("PASSWORD")!= $this->input->post("passwordlama")){
			echo "MSG#ERR#Password Lama yang Anda masukkan salah!.";
		}elseif($this->input->post("passwordbaru")!= $this->input->post("konfirmpassword")){
			echo "MSG#ERR#Konfirmasi Password yang Anda masukkan tidak sama dengan Password Baru!.";
		}else{
			$this->db->where(array("ID_USER"=>$this->newsession->userdata("ID_USER")));
			$this->db->update("mst_user", array("PASSWORD"=>md5($this->input->post("passwordbaru"))));
			echo "MSG#OK#Password Berhasil Diubah!.#".base_url();
			$this->newsession->set_userdata(array("PASSWORD"=>$this->input->post("passwordbaru")));
		}
	}
}
?>