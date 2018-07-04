<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Peminjaman extends Controller{
	var $content = "";
	var $breadcrumb = "";
	
	function Peminjaman(){
		parent::Controller();
		$this->load->model("peminjaman_act","model");
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
	
	function pinjaman($tipe="",$id=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			if($tipe=="save" || $tipe=="update"){
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/peminjaman/pinjaman">Pinjaman</a></li></ul><h4>Pinjaman</h4></div>';
				$arrdata = $this->model->get_data('pinjaman',$tipe,$id);
				$this->content = $this->load->view('peminjaman/peminjaman', $arrdata, true);
				$this->index();
			}else{
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-user"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/peminjaman/pinjaman">Pinjaman</a></li></ul><h4>Pinjaman</h4></div>';
				$arrdata = $this->model->pinjaman('pinjaman', $tipe);		
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
	
	function set_data(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if (strtolower($_SERVER['REQUEST_METHOD']) != "post") {
        	redirect(base_url());
        	exit();
      	}else{
			$this->model->set_data();
		}
	}
	
	function cetak($id){ 
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		ini_set("display_errors", 1);
		ini_set('memory_limit','-1');
		set_time_limit(0);
		$page="";
		$this->load->library('mpdf');
		$this->mpdf=new mPDF('UTF-8','A4-L','','',8,8,35,25,10,13); 
		$this->mpdf->useOnlyCoreFonts = true;
		$this->mpdf->SetProtection(array('print'));
		$this->mpdf->SetAuthor("AIKB");
		$this->mpdf->SetCreator("AIKB");
		$this->mpdf->SetTitle('Laporan Rekap Peminjaman');
		$this->mpdf->SetSubject('Laporan Rekap Peminjaman');
		$this->mpdf->list_indent_first_level = 0; 
		$this->mpdf->SetDisplayMode('fullpage');
		$page=$this->mpdf->AliasNbPages('[pagetotal]');
		$this->mpdf->SetHTMLHeader('<img style="width:80px;padding-bottom:10px;height:95px;" src="'.base_url().'img/kpd.jpg"><div align="justify" style="margin-top:-105px; margin-left:100px;">KOPERASI KARYAWAN PT. EDI INDONESIA<br/>Komplek Ruko Mitra Sunter Blok E 1 No. 8<br />Jl. Yos Sudarso Kav. 89 Jakarta 14350<br/>Telp : (021) 6520509, 92668864<br/>Fax : (021) 6521511</div>','0',true);
		$stylesheet = file_get_contents('css/newtable.css');
		
		$data = $this->model->cetak($id);
		$data['tipe'] = 'cetak';
		$html = $this->load->view("peminjaman/cetak", $data, true);
		
		$this->mpdf->WriteHTML($stylesheet,1);
		$this->mpdf->WriteHTML($html,2);
		$this->mpdf->Output();
		exit;
	}
	
	function detilPeminjaman($id){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = explode("|",$id);
		$x = $id[0];
		$data = $this->model->detilPeminjaman($x);
	}
	
	function angsuran(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/peminjaman/angsuran">Pinjaman</a></li><li>Angsuran</li></ul><h4>Angsuran</h4></div>';
			$this->content = $this->load->view('peminjaman/tagihan', '', true);
			$this->index();
		}
	}
	
	function getTagihan($tglTagihan=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$data = $this->model->getTagihan($tglTagihan);
			echo $data;
		}
	}
	
	function getPelunasan($id=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$data = $this->model->getPelunasan($id);
			echo $data;
		}
	}
	
	function proses_tagihan(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		echo $this->model->proses_tagihan();
	}
	
	function approve_tagihan(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if (strtolower($_SERVER['REQUEST_METHOD']) != "post") {
        	redirect(base_url());
        	exit();
      	}else{
			$this->model->approve_tagihan();
		}
	}
	
	function cetak_tagihan($tgl){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		$data = $this->model->cetak_tagihan($tgl);
		$this->cetakexcell('DATA TAGIHAN',$data);
		exit;
	}
	
	function cetakexcell($filename="",$contents=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}				
		$html .= '<style> td{mso-number-format:"\@";}</style>';
		$html .= $contents;
		$filename = str_replace(" ","_",$filename).".xls";
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private",false);
		header("Content-Type: application/octet-stream");
		header('Content-type: application/ms-excel');
		header('Content-Disposition: attachment; filename='.$filename);
		header("Content-Transfer-Encoding: binary"); 
		echo $html;
	}
	
	function pelunasan(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/peminjaman/pelunasan">Pinjaman</a></li><li>Pelunasan</li></ul><h4>Pelunasan Pinjaman</h4></div>';
			$this->content = $this->load->view('peminjaman/pelunasan', '', true);
			$this->index();
		}
	}
	
	function pelunasanAngsuran($id="",$tagihan=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if (strtolower($_SERVER['REQUEST_METHOD']) != "post") {
			$this->load->model("main");
			$data["NIK"] = $id;
			$data["BESAR_ANGSURAN"] = $tagihan;
			$data["NAMA"] = $this->main->get_uraian("SELECT NAMA_ANGGOTA FROM MST_ANGGOTA WHERE NIK = '".$id."'","NAMA_ANGGOTA");
        	echo $this->load->view("peminjaman/pelunasanAngsuran",$data,true);
      	}else{
			$this->model->pelunasanAngsuran($id);
		}
	}
	
	function cetakPelunasan($id_anggota=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		ini_set("display_errors", 1);
		ini_set('memory_limit','-1');
		set_time_limit(0);
		$page="";
		$this->load->library('mpdf');
		$this->load->model("main");
		$this->mpdf=new mPDF('UTF-8','A4-L','','',8,8,35,25,10,13); 
		$this->mpdf->useOnlyCoreFonts = true;
		$this->mpdf->SetProtection(array('print'));
		$this->mpdf->SetAuthor("EMA");
		$this->mpdf->SetCreator("EMA");
		$this->mpdf->SetTitle('Kwitansi Pembayaran');
		$this->mpdf->SetSubject('Kwitansi Pembayaran');
		$this->mpdf->list_indent_first_level = 0; 
		$this->mpdf->SetDisplayMode('fullpage');
		$page=$this->mpdf->AliasNbPages('[pagetotal]');
		
		$this->mpdf->SetHTMLHeader('<img style="width:80px;padding-bottom:10px;height:95px;" src="'.base_url().'img/kpd.jpg"><div align="justify" style="margin-top:-105px; margin-left:100px;">KOPERASI KARYAWAN PT. EDI INDONESIA<br/>Komplek Ruko Mitra Sunter Blok E 1 No. 8<br />Jl. Yos Sudarso Kav. 89 Jakarta 14350<br/>Telp : (021) 6520509, 92668864<br/>Fax : (021) 6521511</div>','0',true);
		$stylesheet = file_get_contents('css/newtable.css');
		$data = $this->model->cetakPelunasan($id_anggota,'cetak');
		$this->mpdf->WriteHTML($stylesheet,1);
		$this->mpdf->WriteHTML($data,2);
		$this->mpdf->Output();
		exit;
	}
	
	function cetakKwitansi($tgl) {
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		ini_set("display_errors", 1);
		ini_set('memory_limit','-1');
		set_time_limit(0);
		$page="";
		$this->load->library('mpdf');
		$this->load->model("main");
		$this->mpdf=new mPDF('UTF-8','A4-L','','',8,8,35,25,10,13); 
		$this->mpdf->useOnlyCoreFonts = true;
		$this->mpdf->SetProtection(array('print'));
		$this->mpdf->SetAuthor("EMA");
		$this->mpdf->SetCreator("EMA");
		$this->mpdf->SetTitle('Kwitansi Pembayaran');
		$this->mpdf->SetSubject('Kwitansi Pembayaran');
		$this->mpdf->list_indent_first_level = 0; 
		$this->mpdf->SetDisplayMode('fullpage');
		$page=$this->mpdf->AliasNbPages('[pagetotal]');
		
		$this->mpdf->SetHTMLHeader('<img style="width:80px;padding-bottom:10px;height:95px;" src="'.base_url().'img/kpd.jpg"><div align="justify" style="margin-top:-105px; margin-left:100px;">KOPERASI KARYAWAN PT. EDI INDONESIA<br/>Komplek Ruko Mitra Sunter Blok E 1 No. 8<br />Jl. Yos Sudarso Kav. 89 Jakarta 14350<br/>Telp : (021) 6520509, 92668864<br/>Fax : (021) 6521511</div>','0',true);
		$stylesheet = file_get_contents('css/newtable.css');
		$data = $this->model->cetakKwitansi($tgl);
		$this->mpdf->WriteHTML($stylesheet,1);
		$this->mpdf->WriteHTML($data,2);
		$this->mpdf->Output();
		exit;
	}
	
}
?>