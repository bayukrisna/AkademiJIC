<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laporan extends Controller{
	var $content = "";
	var $breadcrumb = "";
	
	function Laporan(){
		parent::Controller();
		$this->load->model("laporan_act","model");
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
	
	function simpanan(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/laporan/simpanan">Laporan</a></li><li>Simpanan</li></ul><h4>Simpanan</h4></div>';
			$this->content = $this->load->view('laporan/simpanan', '', true);
			$this->index();
		}
	}
	
	function penarikan(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/laporan/penarikan">Laporan</a></li><li>Penarikan</li></ul><h4>Penarikan Simpanan</h4></div>';
			$this->content = $this->load->view('laporan/penarikan', '', true);
			$this->index();
		}
	}
	
	function pinjaman(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/laporan/pinjaman">Laporan</a></li><li>Pinjaman</li></ul><h4>Pinjaman</h4></div>';
			$this->content = $this->load->view('laporan/pinjaman', '', true);
			$this->index();
		}
	}
	
	function angsuran(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/peminjaman/tagihan">Laporan</a></li><li>Angsuran</li></ul><h4>Angsuran</h4></div>';
			$this->content = $this->load->view('laporan/angsuran', '', true);
			$this->index();
		}
	}
	
	function pelunasan(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/laporan/pelunasan">Laporan</a></li><li>Pelunasan</li></ul><h4>Pelunasan</h4></div>';
			$this->content = $this->load->view('laporan/pelunasan', '', true);
			$this->index();
		}
	}

	function shu(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			if(strtoupper($_SERVER["REQUEST_METHOD"]) == "POST") {
				$persentase_jasa_modal = $this->input->post('jasa_modal');
				$persentase_jasa_pinjam = $this->input->post('jasa_pinjam');
				$periode_tahun = $this->input->post("periode_tahun");

				$peminjaman 		= $this->model->getSHU("peminjaman",$periode_tahun);
				$simpanan 			= $this->model->getSHU("simpanan",$periode_tahun);
				$laba_penyusutan 	= $peminjaman["bungaPinjaman"] * (70 / 100);
				$laba_bersih 		= $laba_penyusutan * (90 / 100);

				$arrdata["tipe"]			= "view";
				$arrdata["laporan"]			= "shu";
				$arrdata["total_shu"]		= $peminjaman["bungaPinjaman"];
				$arrdata["simpanan"]		= $simpanan;
				$arrdata["pinjaman"]		= $peminjaman["pinjamanTnpBunga"];
				$arrdata["jasa_pinjam"] 	= ((float)$persentase_jasa_pinjam / 100) * $laba_bersih;
				$arrdata["jasa_modal"] 		= ((float)$persentase_jasa_modal / 100) * $laba_bersih;
				$arrdata["dataSHU"]			= $this->model->getSHU("utama",$periode_tahun);
				$arrdata["tahun"]			= $periode_tahun;
				$arrdata["persen_modal"]	= $persentase_jasa_modal;
				$arrdata["persen_pinjam"] 	= $persentase_jasa_pinjam;
				echo $this->load->view("laporan/view_laporan",$arrdata,true);
			} else {
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/laporan/shu">Laporan</a></li><li>SHU</li></ul><h4>SHU</h4></div>';
				$this->content = $this->load->view('laporan/shu', '', true);
				$this->index();
			}
		}
	}
	
	function getSimpanan(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$data = $this->model->getSimpanan();
			$data['tipe'] = 'view';
			echo $this->load->view("laporan/view_laporan", $data, true);
		}
	}
	
	function getPenarikan(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$data = $this->model->getPenarikan();
			$data['tipe'] = 'view'; 
			echo $this->load->view("laporan/view_laporan", $data, true);
		}
	}
	
	function getPinjaman(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$data = $this->model->getPinjaman();
			$data['tipe'] = 'view'; 
			echo $this->load->view("laporan/view_laporan", $data, true);
		}
	}
	
	function getAngsuran(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$data = $this->model->getAngsuran();
			$data['tipe'] = 'view';
			$data['laporan'] = 'angsuran';
			echo $this->load->view("laporan/view_laporan", $data, true);
		}
	}
	
	function cetak_laporan($tgl_awal="",$tgl_akhir="",$tipe=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			ini_set("display_errors", 1);
			ini_set('memory_limit','-1');
			set_time_limit(0);
			$page="";
			$this->load->library('mpdf');
			if($tipe != "rekap_simpanan"){
				$this->mpdf=new mPDF('UTF-8','A4-L','','',8,8,35,25,10,13);
			}else{
				$this->mpdf=new mPDF('UTF-8','A4','','',8,8,35,25,10,13);
			}
			$this->mpdf->useOnlyCoreFonts = true;
			$this->mpdf->SetProtection(array('print'));
			$this->mpdf->SetAuthor("EMA");
			$this->mpdf->SetCreator("EMA");
			$this->mpdf->SetTitle('Laporan Rekap Peminjaman');
			$this->mpdf->SetSubject('Laporan Rekap Peminjaman');
			$this->mpdf->list_indent_first_level = 0; 
			$this->mpdf->SetDisplayMode('fullpage');
			$page=$this->mpdf->AliasNbPages('[pagetotal]');
			$stylesheet = file_get_contents('css/newtable.css');
			if($tipe=="peminjaman"){
				$this->mpdf->SetHTMLHeader('<img style="width:80px;padding-bottom:10px;height:95px;" src="'.base_url().'img/kpd.jpg"><div align="justify" style="margin-top:-105px; margin-left:100px;">KOPERASI KARYAWAN PT. EDI INDONESIA<br/>Komplek Ruko Mitra Sunter Blok E 1 No. 8<br />Jl. Yos Sudarso Kav. 89 Jakarta 14350<br/>Telp : (021) 6520509, 92668864<br/>Fax : (021) 6521511</div><br/><div align="center" style="margin-bottom:10px;"><b>LAPORAN PINJAMAN KOPPEDI</b><div align="center">Periode Tanggal '.date("d-m-Y",strtotime($tgl_awal)).' Sampai Tanggal '.date("d-m-Y",strtotime($tgl_akhir)).'</div>','0',true);
				$data = $this->model->getPinjaman($tgl_awal,$tgl_akhir);
			}elseif($tipe=="simpanan"){
				$this->mpdf->SetHTMLHeader('<img style="width:80px;padding-bottom:10px;height:95px;" src="'.base_url().'img/kpd.jpg"><div align="justify" style="margin-top:-105px; margin-left:100px;">KOPERASI KARYAWAN PT. EDI INDONESIA<br/>Komplek Ruko Mitra Sunter Blok E 1 No. 8<br />Jl. Yos Sudarso Kav. 89 Jakarta 14350<br/>Telp : (021) 6520509, 92668864<br/>Fax : (021) 6521511</div><br/><div align="center" style="margin-bottom:10px;"><b>LAPORAN SIMPANAN KOPPEDI</b><div align="center">Periode Tanggal Daftar '.date("d-m-Y",strtotime($tgl_awal)).' Sampai Tanggal '.date("d-m-Y",strtotime($tgl_akhir)).'</div>','0',true);
				$data = $this->model->getSimpanan($tgl_awal,$tgl_akhir);
			}elseif($tipe=="penarikan"){
				$this->mpdf->SetHTMLHeader('<img style="width:80px;padding-bottom:10px;height:95px;" src="'.base_url().'img/kpd.jpg"><div align="justify" style="margin-top:-105px; margin-left:100px;">KOPERASI KARYAWAN PT. EDI INDONESIA<br/>Komplek Ruko Mitra Sunter Blok E 1 No. 8<br />Jl. Yos Sudarso Kav. 89 Jakarta 14350<br/>Telp : (021) 6520509, 92668864<br/>Fax : (021) 6521511</div><br/><div align="center" style="margin-bottom:10px;"><b>LAPORAN PENARIKAN SIMPANAN KOPPEDI</b><div align="center">Periode Tanggal '.date("d-m-Y",strtotime($tgl_awal)).' Sampai Tanggal '.date("d-m-Y",strtotime($tgl_akhir)).'</div>','0',true);
				$data = $this->model->getPenarikan($tgl_awal,$tgl_akhir);
			}elseif($tipe=="angsuran"){
				$this->mpdf->SetHTMLHeader('<img style="width:80px;padding-bottom:10px;height:95px;" src="'.base_url().'img/kpd.jpg"><div align="justify" style="margin-top:-105px; margin-left:100px;">KOPERASI KARYAWAN PT. EDI INDONESIA<br/>Komplek Ruko Mitra Sunter Blok E 1 No. 8<br />Jl. Yos Sudarso Kav. 89 Jakarta 14350<br/>Telp : (021) 6520509, 92668864<br/>Fax : (021) 6521511</div><br/><div align="center" style="margin-bottom:10px;"><b>LAPORAN ANGSURAN KOPPEDI</b><div align="center">Periode Tanggal '.date("d-m-Y",strtotime($tgl_awal)).' Sampai Tanggal '.date("d-m-Y",strtotime($tgl_akhir)).'</div>','0',true);
				$data = $this->model->getAngsuran($tgl_awal,$tgl_akhir);
			}elseif($tipe=="pelunasan"){
				$this->mpdf->SetHTMLHeader('<img style="width:80px;padding-bottom:10px;height:95px;" src="'.base_url().'img/kpd.jpg"><div align="justify" style="margin-top:-105px; margin-left:100px;">KOPERASI KARYAWAN PT. EDI INDONESIA<br/>Komplek Ruko Mitra Sunter Blok E 1 No. 8<br />Jl. Yos Sudarso Kav. 89 Jakarta 14350<br/>Telp : (021) 6520509, 92668864<br/>Fax : (021) 6521511</div><br/><div align="center" style="margin-bottom:10px;"><b>LAPORAN PELUNASAN KOPPEDI</b><div align="center">Periode Tanggal '.date("d-m-Y",strtotime($tgl_awal)).' Sampai Tanggal '.date("d-m-Y",strtotime($tgl_akhir)).'</div>','0',true);
				$data = $this->model->getPelunasan($tgl_awal,$tgl_akhir);
			}elseif($tipe=="shu"){
				$this->load->model("main");
				$this->mpdf->SetHTMLHeader('<img style="width:80px;padding-bottom:10px;height:95px;" src="'.base_url().'img/kpd.jpg"><div align="justify" style="margin-top:-105px; margin-left:100px;">KOPERASI KARYAWAN PT. EDI INDONESIA<br/>Komplek Ruko Mitra Sunter Blok E 1 No. 8<br />Jl. Yos Sudarso Kav. 89 Jakarta 14350<br/>Telp : (021) 6520509, 92668864<br/>Fax : (021) 6521511</div><br/><div align="center" style="margin-bottom:10px;"><b>LAPORAN SHU</b><div align="center">Periode Tahun '.$tgl_awal.'</div>','0',true);

				$jasa 				= explode("~", $tgl_akhir);
				$peminjaman 		= $this->model->getSHU("peminjaman",$tgl_awal);
				$simpanan 			= $this->model->getSHU("simpanan",$tgl_awal);
				$laba_penyusutan 	= $peminjaman["bungaPinjaman"] * (70 / 100);
				$laba_bersih 		= $laba_penyusutan * (90 / 100);

				$data["laporan"]		= "shu";
				$data["total_shu"]		= $peminjaman["bungaPinjaman"];
				$data["simpanan"]		= $simpanan;
				$data["pinjaman"]		= $peminjaman["pinjamanTnpBunga"];
				$data["jasa_pinjam"] 	= ((float)$jasa[1] / 100) * $laba_bersih;
				$data["jasa_modal"] 	= ((float)$jasa[0] / 100) * $laba_bersih;
				$data["dataSHU"]		= $this->model->getSHU("utama",$tgl_awal);
				$data["tahun"]			= $tgl_awal;
				$data["persen_modal"]	= $jasa[0];
				$data["persen_pinjam"] 	= $jasa[1];
				$data["ketua"]		= $this->main->get_uraian("SELECT NAMA_USER FROM mst_user WHERE JABATAN_USER='2'", 'NAMA_USER');
			}elseif($tipe=="rekap_simpanan"){
				$this->load->model("main");
				$this->mpdf->SetHTMLHeader('<img style="width:80px;padding-bottom:10px;height:95px;" src="'.base_url().'img/kpd.jpg"><div align="justify" style="margin-top:-105px; margin-left:100px;">KOPERASI KARYAWAN PT. EDI INDONESIA<br/>Komplek Ruko Mitra Sunter Blok E 1 No. 8<br />Jl. Yos Sudarso Kav. 89 Jakarta 14350<br/>Telp : (021) 6520509, 92668864<br/>Fax : (021) 6521511</div><br/><div align="center" style="margin-bottom:10px;"><b>LAPORAN REKAPITULASI SIMPANAN KOPPEDI</b><div align="center">Periode Tanggal '.date("d-m-Y",strtotime($tgl_awal)).' Sampai Tanggal '.date("d-m-Y",strtotime($tgl_akhir)).'</div>','0',true);
				$data["dataRekap"] = $this->model->rekap_simpanan($tgl_awal,$tgl_akhir);
				$data["ketua"]		= $this->main->get_uraian("SELECT NAMA_USER FROM mst_user WHERE JABATAN_USER='2'", 'NAMA_USER');
			}
			
			$data['tipe'] = 'cetak';
			$data["laporan"] = $tipe;
			$html = $this->load->view("laporan/view_laporan", $data, true);
			
			$this->mpdf->WriteHTML($stylesheet,1);
			$this->mpdf->WriteHTML($html,2);
			$this->mpdf->Output();
			exit;
		}
	}
	
	function getPelunasan(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			$data = $this->model->getPelunasan();
			$data['tipe'] = 'view';
			$data['laporan'] = 'pelunasan';
			echo $this->load->view("laporan/view_laporan", $data, true);
		}
	}

	function rekap_simpanan(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}else{
			if(strtoupper($_SERVER["REQUEST_METHOD"]) == "POST") {
				$tgl_awal = $this->input->post('periode_bulan');
				$tgl_akhir = $this->input->post('sampai_bulan');

				$arrdata['dataRekap'] 	= $this->model->rekap_simpanan($tgl_awal,$tgl_akhir);
				$arrdata['tipe'] 		= 'view';
				$arrdata['laporan'] 	= 'rekap_simpanan';
				$arrdata["tgl_awal"]	= $tgl_awal;
				$arrdata["tgl_akhir"]	= $tgl_akhir;
				echo $this->load->view("laporan/view_laporan",$arrdata,true);
			} else {
				$this->breadcrumb = '<div class="pageicon pull-left"><i class="fa fa-file-o"></i></div><div class="media-body"><ul class="breadcrumb"><li><a href="'.base_url().'"><i class="glyphicon glyphicon-home"></i></a></li><li><a href="'.site_url().'/laporan/rekap_simpanan">Laporan</a></li><li>Rekapitulasi Simpanan</li></ul><h4>Rekapitulasi Simpanan</h4></div>';
				$this->content = $this->load->view('laporan/rekap_simpanan', '', true);
				$this->index();
			}
		}
	}
	
}
?>