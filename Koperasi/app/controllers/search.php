<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Search extends Controller{
	
	function Search(){
		parent::Controller();
	}
	
	function index(){}

	function getsearch($tipe="",$indexField="",$formName="",$getdata=""){
		$this->load->model("search_act");
		$arrdata = $this->search_act->search($tipe,$indexField,$formName,$getdata);
		$data =  $this->load->view("view", $arrdata, true);
		if($this->input->post("ajax")){
			echo $arrdata;
		}else{
			echo $data;
		}
	}
}
?>