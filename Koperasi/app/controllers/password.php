<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Password extends Controller{
	var $content = "";
	var $breadcrumb = "";
	
	function Password(){
		parent::Controller();
		$this->load->model("password_act","model");
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
	
	function change(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			if (strtolower($_SERVER['REQUEST_METHOD']) != "post") {
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/password/change">Change Password</a></li></ul><h4>Change Password</h4></div>';
				$this->content = $this->load->view('password', '', true);
				$this->index();

			}else{
				$this->model->password();
			}
		}
	}
	
}
?>