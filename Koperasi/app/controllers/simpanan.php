<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Simpanan extends Controller{
	var $content = "";
	var $breadcrumb = "";
	
	function Simpanan(){
		parent::Controller();
		$this->load->model("simpanan_act","model");
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
	
	function sukarela($tipe="",$id=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			if($tipe=="view") {
				echo $this->model->simpan($tipe,$id);
			}elseif($tipe=="save"){
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/simpanan/pokok">Simpanan</a></li></ul><h4>Simpanan Sukarela</h4></div>';
				$arrdata = $this->model->get_data('sukarela',$tipe,$id);
				$this->content = $this->load->view('simpanan/simpanan', $arrdata, true);
				$this->index();
			}else{
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-user"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/simpanan/pokok">Simpanan</a></li></ul><h4>Simpanan Sukarela</h4></div>';
				$arrdata = $this->model->simpan('sukarela', $tipe);		
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

	function wajib($tipe="",$id=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			if($tipe=="view") {
				$tabel = $this->model->get_rincian_wajib($id);		
				if($this->input->post('ajax')){
					echo $tabel;
				}else{
					$arrdata = array("tabel"=>$tabel);
					echo $this->load->view('list', $arrdata, true);
				}
			}elseif($tipe=="save"){
				if(strtoupper($_SERVER["REQUEST_METHOD"]) == "POST"){
					echo $arrdata = $this->model->get_data('wajib',$tipe,$id);
				} else {
					$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/simpanan/wajib">Simpanan</a></li></ul><h4>Simpanan Wajib</h4></div>';
					$this->content = $this->load->view('simpanan/simpanan_wajib', "", true);
					$this->index();
				}
			} else {
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-user"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/simpanan/wajib">Simpanan</a></li></ul><h4>Simpanan Wajib</h4></div>';
				$arrdata = $this->model->simpan('wajib', $tipe);		
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
	
	function tarikan($tipe="",$id=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			if($tipe=="save" || $tipe=="update"){
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/simpanan/tarikan">Simpanan</a></li></ul><h4>Penarikan Simpanan</h4></div>';
				$arrdata = $this->model->get_data('tarikan',$tipe,$id);
				$this->content = $this->load->view('simpanan/penarikan', $arrdata, true);
				$this->index();
			}else{
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-user"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/simpanan/tarikan">Simpanan</a></li></ul><h4>Penarikan Simpanan</h4></div>';
				$arrdata = $this->model->tarikan('tarikan', $tipe);		
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
	
	function cetak($tipe="",$id=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		ini_set("display_errors", 1);
		ini_set('memory_limit','-1');
		set_time_limit(0);
		$page="";
		$this->load->library('mpdf');
		if($tipe !="daftarwajib"){
			$this->mpdf=new mPDF('UTF-8','A4-L','','',8,8,35,25,10,13); 
		}else{
			$this->mpdf=new mPDF('UTF-8','A4','','',8,8,35,25,10,13); 
		}
		$this->mpdf->useOnlyCoreFonts = true;
		$this->mpdf->SetProtection(array('print'));
		$this->mpdf->SetAuthor("EMA");
		$this->mpdf->SetCreator("EMA");
		if ($tipe=="sukarela") {
			$this->mpdf->SetTitle('Kwitansi Pembayaran');
			$this->mpdf->SetSubject('Kwitansi Pembayaran');
		} else if($tipe=="wajib") {
			$this->mpdf->SetTitle('Bukti Simpanan Wajib');
			$this->mpdf->SetSubject('Bukti Simpanan Wajib');
		}else if($tipe=="daftarwajib"){
			$this->mpdf->SetTitle('Daftar Simpanan Wajib Anggota KOPPEDI');
			$this->mpdf->SetSubject('Daftar Simpanan Wajib Anggota KOPPEDI');
		} else if($tipe=="kwitansiWajib") {
			$this->mpdf->SetTitle('Kwitansi Pembayaran');
			$this->mpdf->SetSubject('Kwitansi Pembayaran');
		} else {
			$this->mpdf->SetTitle('Bukti Penarikan Simpanan');
			$this->mpdf->SetSubject('Bukti Penarikan Simpanan');
		}
		$this->mpdf->list_indent_first_level = 0; 
		$this->mpdf->SetDisplayMode('fullpage');
		$page=$this->mpdf->AliasNbPages('[pagetotal]');
		$this->mpdf->SetHTMLHeader('<img style="width:80px;padding-bottom:10px;height:95px;" src="'.base_url().'img/kpd.jpg"><div align="justify" style="margin-top:-105px; margin-left:100px;">KOPERASI KARYAWAN PT. EDI INDONESIA<br/>Komplek Ruko Mitra Sunter Blok E 1 No. 8<br />Jl. Yos Sudarso Kav. 89 Jakarta 14350<br/>Telp : (021) 6520509, 92668864<br/>Fax : (021) 6521511</div>','0',true);
		$stylesheet = file_get_contents('css/newtable.css');
		
		if($tipe != "daftarwajib"){
			$data = $this->model->cetak($tipe,$id);
		}
		$data['tipe'] = 'cetak';
		if($tipe=="sukarela"){
			$html = $this->load->view("simpanan/cetak_simpanan", $data, true);
		}else if($tipe=="wajib"){
			$html = $this->load->view("simpanan/cetak_wajib", $data, true);
		}elseif($tipe=="tarikan"){
			$html = $this->load->view("simpanan/cetak_penarikan", $data, true);
		}elseif($tipe=="daftarwajib"){
			$html = $this->model->cetakWajib($id);
		} elseif($tipe=="kwitansiWajib") {
			$data["tgl"] = $id;
			$html = $this->load->view("simpanan/cetak_kwitansi_wajib", $data, true);
		}
		$this->mpdf->WriteHTML($stylesheet,1);
		$this->mpdf->WriteHTML($html,2);
		$this->mpdf->Output();
		exit;
	}
	
	function get_simpanan_wajib() {
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		echo $this->model->get_simpanan_wajib();
	}
	
	function get_saldo_penarikan() {
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		echo $this->model->get_saldo_penarikan();
	}

	function proses_simpan_wajib() {
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtoupper($_SERVER["REQUEST_METHOD"]) == "POST") {
			echo $this->model->proses_simpan_wajib();
		}
	}
	
}
?>