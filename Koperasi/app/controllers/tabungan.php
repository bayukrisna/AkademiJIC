<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tabungan extends Controller{
	var $content = "";
	var $breadcrumb = "";
	
	function Tabungan(){
		parent::Controller();
		$this->load->model("tabungan_act","model");
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
	
	function daftar($tipe=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-money"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/tabungan/daftar">Tabungan</a></li></ul><h4>Daftar Tabungan</h4></div>';
			$arrdata = $this->model->daftar($tipe);		
			$data = $this->load->view('list', $arrdata, true);
			if($this->input->post("ajax")||$tipe=="ajax"){
				echo  $arrdata;
			}else{
				$this->content = $data;
				$this->index();
			}
		}
	}

	function detilTabungan($id){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		$id = explode("|",$id);
		$x = $id[0];
		$data = $this->model->detilTabungan($x);
	}
	
	function mutasi() {
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			if(strtolower($_SERVER['REQUEST_METHOD']) == "post") {
				echo $this->model->get_mutasi();
			} else {
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-money"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/tabungan/daftar">Mutasi</a></li></ul><h4>Mutasi Tabungan</h4></div>';
				$this->content = $this->load->view("tabungan/mutasi",'',true);
				$this->index();
			}
		}
	}

	function cetakTabungan($id=""){
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
		$this->mpdf->SetTitle('Daftar Tabungan');
		$this->mpdf->SetSubject('Daftar Tabungan');
		$this->mpdf->list_indent_first_level = 0; 
		$this->mpdf->SetDisplayMode('fullpage');
		$page=$this->mpdf->AliasNbPages('[pagetotal]');
		$id = explode("|",$id);
		$idd = $id[0];
		$NAMA = $this->main->get_uraian("SELECT NAMA_ANGGOTA AS NAMA FROM MST_ANGGOTA WHERE NIK = '".$idd."'","NAMA");
		
		$this->mpdf->SetHTMLHeader('<img style="width:80px;padding-bottom:10px;height:95px;" src="'.base_url().'img/kpd.jpg"><div align="justify" style="margin-top:-105px; margin-left:100px;">KOPERASI KARYAWAN PT. EDI INDONESIA<br/>Komplek Ruko Mitra Sunter Blok E 1 No. 8<br />Jl. Yos Sudarso Kav. 89 Jakarta 14350<br/>Telp : (021) 6520509, 92668864<br/>Fax : (021) 6521511</div><br/><div align="center" style="margin-bottom:10px;"><b>DAFTAR TABUNGAN</b><div align="left"><table><tr><td>NIK</td><td>:</td><td>'.$idd.'</td></tr><tr><td>Nama</td><td>:</td><td>'.$NAMA.'</td></tr></table></div>','0',true);
		$stylesheet = file_get_contents('css/newtable.css');
		$data = $this->model->cetakTabungan($idd,'cetak');
		$this->mpdf->WriteHTML($stylesheet,1);
		$this->mpdf->WriteHTML($data,2);
		$this->mpdf->Output();
		exit;
	}

	function cetakMutasi($NIK="",$TGL_AWAL="",$TGL_AKHIR=""){
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
		$this->mpdf->SetTitle('Mutasi Tabungan');
		$this->mpdf->SetSubject('Mutasi Tabungan');
		$this->mpdf->list_indent_first_level = 0; 
		$this->mpdf->SetDisplayMode('fullpage');
		$page=$this->mpdf->AliasNbPages('[pagetotal]');
		
		$NAMA = $this->main->get_uraian("SELECT NAMA_ANGGOTA AS NAMA FROM MST_ANGGOTA WHERE NIK = '".$NIK."'","NAMA");
		$TGLAWAL = date("d F Y", strtotime($TGL_AWAL));
		$TGLAKHIR = date("d F Y", strtotime($TGL_AKHIR));

		$this->mpdf->SetHTMLHeader('<img style="width:80px;padding-bottom:10px;height:95px;" src="'.base_url().'img/kpd.jpg"><div align="justify" style="margin-top:-105px; margin-left:100px;">KOPERASI KARYAWAN PT. EDI INDONESIA<br/>Komplek Ruko Mitra Sunter Blok E 1 No. 8<br />Jl. Yos Sudarso Kav. 89 Jakarta 14350<br/>Telp : (021) 6520509, 92668864<br/>Fax : (021) 6521511</div><br/><div align="center" style="margin-bottom:10px;"><b>MUTASI TABUNGAN</b><div align="left"><table><tr><td>NIK</td><td>:</td><td>'.$NIK.'</td></tr><tr><td>Nama</td><td>:</td><td>'.$NAMA.'</td></tr><tr><td>Periode</td><td>:</td><td>'.$TGLAWAL.' sampai '.$TGLAKHIR.'</td></tr></table></div>','0',true);
		$stylesheet = file_get_contents('css/newtable.css');
		$data = $this->model->cetakMutasi($NIK,$TGL_AWAL,$TGL_AKHIR,'cetak');
		$this->mpdf->WriteHTML($stylesheet,1);
		$this->mpdf->WriteHTML($data,2);
		$this->mpdf->Output();
		exit;
	}
	
}
?>