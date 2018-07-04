<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends Controller{
	var $content = "";
	
	function Login(){
		parent::Controller();
	}
	
	function ceklogin($sessid="", $isajax=""){
		error_reporting(E_ALL ^ E_NOTICE);
		if(strtolower($_SERVER['REQUEST_METHOD'])!="post"){
			echo '2|<div class="alert alert-danger">Login failed. Please try again.<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button></div>';
			exit();
		}else{
			$uid = $this->input->post('_usr');
			$pwd = $this->input->post('_pass');
			$code = $this->input->post('_code');
			if(strtolower($code)===$_SESSION['captkodex']){
				$this->load->model('user_act');
				$hasil = $this->user_act->login($uid, $pwd);
				if($hasil==1){
					echo '1|<div class="alert alert-danger">Berhasil Login.<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button></div>';
					exit();
				}elseif($hasil==2){
					echo '2|<div class="alert alert-danger">User sudah tidak Aktif. Mohon hubungi Administrator Anda.<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button></div>';
					exit();
				}else{ 
					echo '0|<div class="alert alert-danger">User atau Password anda salah.<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button></div>';
					exit();
				}
			}else{
				echo '0|<div class="alert alert-danger">Kode yang Anda masukkan salah.<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button></div>';
				exit();
			}
		}
	}
	
}
?>