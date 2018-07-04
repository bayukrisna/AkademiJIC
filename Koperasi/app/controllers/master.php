<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Master extends Controller{
	var $content = "";
	var $breadcrumb = "";
	
	function Master(){
		parent::Controller();
		$this->load->model("master_act","model");
	}
	
	function index(){
		if($this->newsession->userdata('LOGGED')){	
			if($this->content=="") $this->content = $this->load->view('welcome', '', true);	
			$data = array('_appname_'=>'KOPPEDI',
						  '_content_' => $this->content,
						  '_breadcrumb_' => $this->breadcrumb,
						  '_header_' => $this->load->view('header/home', '', true));
			$this->parser->parse('home/in', $data);
		}else{
			$this->newsession->sess_destroy();
			$this->content = $this->load->view('login/login', '', true);
			$data = array('_appname_' => 'KOPPEDI',
						  '_content_' => $this->content,
						  '_header_' => $this->load->view('header/login', '', true));
			$this->parser->parse('home/out', $data);
		}
	}
	
	function anggota($tipe="",$id=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			if($tipe=="save" || $tipe=="update"){
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/master/anggota">Master</a></li><li>Anggota</li></ul><h4>Anggota</h4></div>';
				$arrdata = $this->model->get_data('anggota',$tipe,$id);
				$this->content = $this->load->view('master/anggota', $arrdata, true);
				$this->index();
			}else if($tipe=="keluar"){
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/master/anggota">Master</a></li><li>Anggota</li></ul><h4>Anggota</h4></div>';
				$arrdata = $this->model->get_data($tipe,$id);
				$this->content = $this->load->view('master/anggota_keluar', $arrdata, true);
				$this->index();
			}else{
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-user"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/master/anggota">Master</a></li><li>Anggota</li></ul><h4>Anggota</h4></div>';
				$arrdata = $this->model->daftar('anggota', $tipe);		
				$data = $this->load->view('list', $arrdata, true);
				if($this->input->post("ajax")||$tipe){
					echo  $arrdata;
				}else{
					$this->content = $data;
					$this->index();
				}
			}
		}
	}
	
	function jabatan($tipe="",$id=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			if($tipe=="save" || $tipe=="update"){
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/master/jabatan">Master</a></li><li>Jabatan</li></ul><h4>Jabatan</h4></div>';
				$arrdata = $this->model->get_data('jabatan',$tipe,$id);
				$this->content = $this->load->view('master/jabatan', $arrdata, true);
				$this->index();
			}else{
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-male"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/master/jabatan">Master</a></li><li>Jabatan</li></ul><h4>Jabatan</h4></div>';
				$arrdata = $this->model->daftar('jabatan', $tipe);		
				$data = $this->load->view('list', $arrdata, true);
				if($this->input->post("ajax")||$tipe){
					echo  $arrdata;
				}else{
					$this->content = $data;
					$this->index();
				}
			}
		}
	}
	
	function user($tipe="",$id=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			if($tipe=="save" || $tipe=="update"){
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/master/user">Master</a></li><li>User</li></ul><h4>User</h4></div>';
				$arrdata = $this->model->get_data('user',$tipe,$id);
				$this->content = $this->load->view('master/user', $arrdata, true);
				$this->index();
			}else{
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-male"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/master/user">Master</a></li><li>User</li></ul><h4>User</h4></div>';
				$arrdata = $this->model->daftar('user', $tipe);		
				$data = $this->load->view('list', $arrdata, true);
				if($this->input->post("ajax")||$tipe){
					echo  $arrdata;
				}else{
					$this->content = $data;
					$this->index();
				}
			}
		}
	}
	
	function getGaji(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			if(strtolower($_SERVER['REQUEST_METHOD']) == "post"){
				$data = $this->model->getGaji();
				echo $data;
			} else {
				redirect(base_url());
			}
		}
	}
	
	function updatepass(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$this->judul = "Update Password";
			$this->content = $this->load->view('admin/form/updatepass', '', true);
			$this->index();
		}
	}
	
	function set_data($type=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if (strtolower($_SERVER['REQUEST_METHOD']) != "post") {
        	redirect(base_url());
        	exit();
      	}else{
			$this->model->set_data($type);
		}
	}
	
}
?>