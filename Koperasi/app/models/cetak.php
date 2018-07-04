<?php
function cetak($tipe="",$cetak=""){
	if(!$this->newsession->userdata('LOGGED')){
		$this->index();
		return;
	}
	ini_set("display_errors", 1);
	ini_set('memory_limit','-1');
	set_time_limit(0);
	$this->load->library('mpdf');
	$this->mpdf=new mPDF('UTF-8','A4-L','','',8,8,35,25,10,13); 
	$this->mpdf->useOnlyCoreFonts = true;
	$this->mpdf->SetProtection(array('print'));
	$this->mpdf->SetAuthor("AIKB");
	$this->mpdf->SetCreator("AIKB");
	$this->mpdf->SetTitle($tittle);
	$this->mpdf->SetSubject($nama);
	$this->mpdf->list_indent_first_level = 0; 
	$this->mpdf->SetDisplayMode('fullpage');
	$page=$this->mpdf->AliasNbPages('[pagetotal]');
	$this->mpdf->SetHTMLHeader('<div align="justify" style="margin-bottom:5px;">KAWASAN BERIKAT '.$nama.'<br />LAPORAN DATA BARANG<div align="right">Halaman {PAGENO} dari [pagetotal]</div>','0',true);			
	$SQL= "SELECT KODE_BARANG,KODE_HS,SERI,URAIAN_BARANG,
		   f_ref('ASAL_JENIS_BARANG',JNS_BARANG) JNS_BARANG,MERK,TIPE,STOCK_AKHIR,
		   KODE_SATUAN FROM M_TRADER_BARANG 
		   WHERE KODE_TRADER = '".$this->newsession->userdata('KODE_TRADER')."'";
		   $QUERYTEMP=$this->db->query($SQL);	
	$resultRow=$QUERYTEMP->result_array();
	
	$data = array("tipe"=>$tipe, "nama"=>$nama,  "page"=>$page, "resultData"=>$resultRow);
	$html=$this->load->view("laporan/print", $data,true);	
	$stylesheet = file_get_contents('css/style.css');
	$this->mpdf->WriteHTML($stylesheet,1);
	$this->mpdf->WriteHTML($html,2);
	$this->mpdf->Output();
	exit();
}
?>