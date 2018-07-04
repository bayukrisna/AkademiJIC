<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Search_act extends Model{	

	function search($tipe="",$indexField="",$formName="",$getData=""){
		$func = get_instance();
		$func->load->model("main","main", true);
		$this->load->library('newtable');
		$rowcount = 7;
		switch($tipe){	
			case "anggota":
				if($formName == "simpan" || $formName == "peminjaman") $WHERE = " WHERE A.STATUS_ANGGOTA = 1 ";
				$judul = "Pencarian Data Anggota";
				$SQL = "SELECT A.NIK, A.NAMA_ANGGOTA AS NAMA, B.JABATAN, B.GAJI 
						FROM MST_ANGGOTA A LEFT JOIN MST_JABATAN B ON A.ID_JABATAN=B.ID_JABATAN".$WHERE;					
				$order  = "1";	
				$sort   = "ASC";		
				$key    = array("NIK","NAMA","JABATAN","GAJI");
				$search = array(array('A.NIK', 'NIK'),array('A.NAMA_ANGGOTA', 'NAMA ANGGOTA'),array('B.JABATAN', 'JABATAN'));			
				$field  = explode(";",$indexField);
				$show_search=true;					
			break;
			case "pelunasan":
				$judul = "Pencarian Data Anggota";
				$SQL = "SELECT A.NIK, A.NAMA_ANGGOTA AS 'NAMA', B.JABATAN, A.STATUS_ANGGOTA 'STATUS' 
						FROM MST_ANGGOTA A LEFT JOIN MST_JABATAN B ON A.ID_JABATAN=B.ID_JABATAN";					
				$order  = "1";
				$sort   = "ASC";		
				$key    = array("NIK","NAMA","STATUS");
				$search = array(array('A.NAMA_ANGGOTA', 'NAMA ANGGOTA'));			
				$field  = explode(";",$indexField);
				$hidden = array("STATUS");
				$show_search=true;					
			break;
			default:
				$judul = "Failed";
			break;
		}
		$ciuri = $this->input->post("uri");		
		$this->newtable->action(site_url()."/search/getsearch/".$tipe."/".$indexField."/".$formName."/".$getData);
		$this->newtable->hiddens($hidden);			
		$this->newtable->keys($key);			
		$this->newtable->indexField($field);
		$this->newtable->formField($formName);		
		$this->newtable->orderby($order);
		$this->newtable->sortby($sort);
		$this->newtable->detail_tipe('pilih');
		$this->newtable->cidb($this->db);
		$this->newtable->ciuri($ciuri);
		$this->newtable->show_search($show_search);
		$this->newtable->search($search);
		$this->newtable->show_chk(false);
		$this->newtable->field_order(false);		
		$this->newtable->set_formid("fdetildok");
		$this->newtable->set_divid("divfdetildok");
		$this->newtable->header_bg('#62A8D1');
		$this->newtable->rowcount($rowcount);
		$this->newtable->clear();  
		$tabel = $this->newtable->generate($SQL);
		$arrdata = array("judul" => $judul,"tabel" => $tabel);
		if($this->input->post("ajax")) return $tabel;				 
		else return $arrdata;		
	}
	
}