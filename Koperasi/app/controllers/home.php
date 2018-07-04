<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends Controller{
	var $content = "";
	
	function Home(){
		parent::Controller();
	}
	
	function index(){
		if($this->newsession->userdata('LOGGED')){	
			if($this->content=="") $this->content = $this->load->view('welcome', '', true);	
			$data = array('_appname_'=>'KOPPEDI',
						  '_content_' => $this->content,
						  '_breadcrumb_' => '<div class="pageicon pull-left"><i class="fa fa-home"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="<?=base_url();?>"><i class="glyphicon glyphicon-home"></i></a></li><li>Home</li></ul><h4>Home</h4></div>',
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
	
	function logout(){
		$this->newsession->sess_destroy();
		redirect(base_url());
	}
	
}
?>