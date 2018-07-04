<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Fungsi{
	
	function FormatDate($vardate){
		$balik="";
		if($vardate!="" && $vardate!="0000-00-00"){
			$pecah1 = explode("-", $vardate);
			$tanggal = intval($pecah1[2]);
			$arrayBulan = array("", "January", "February", "March", "April", "May", "June", "July",
								"August", "September", "October", "November", "December");
			$bulan = $arrayBulan[intval($pecah1[1])];
			//$bulan = intval($pecah[1]);
			$tahun = intval($pecah1[0]);
			$balik = $tanggal." ".$bulan." ".$tahun;
		}
		return $balik;
	}
	
	function FormatDateIndo($vardate){
		$pecah1 = explode("-", $vardate);
		$tanggal = intval($pecah1[2]);
		$arrayBulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
							"Agustus", "September", "Oktober", "November", "Desember");
		$bulan = $arrayBulan[intval($pecah1[1])];
		//$bulan = intval($pecah[1]);
		$tahun = intval($pecah1[0]);
		$balik = $tanggal." ".$bulan." ".$tahun;
		return $balik;
	}
	
	function FormatRupiah($angka,$decimal){
		$rupiah=number_format($angka,$decimal,'.',',');		
		return $rupiah;
	}	
	
	function dateformat($date){
		if($date!="" && $date!="0000-00-00"){
			if (strstr($date, "-"))   {
				   $date = preg_split("/[\/]|[-]+/", $date);
				   $date = $date[2]."-".$date[1]."-".$date[0];
				   return $date;
			}
			else if (strstr($date, "/"))   {
				   $date = preg_split("/[\/]|[-]+/", $date);
				   $date = $date[2]."-".$date[1]."-".$date[0];
				   return $date;
			}
			else if (strstr($date, ".")) {
				   $date = preg_split("[.]", $date);
				   $date = $date[2]."-".$date[1]."-".$date[0];
				   return $date;
			}
		}
		return false;
	}
	
	function replace($input,$var){
		if (!is_null($input)){
			$varresult = '';
			$varresult = str_replace($var,'',$input);
			return $varresult;
		}
	}	
	
	function msg($tipe="",$msg=""){
		if($tipe=="warning"){
			$ret = '<div class="alert alert-warning col-sm-5">'.$msg.'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button></div>';						
		}elseif($tipe=="success"){			
			$ret = '<div class="alert alert-success col-sm-5">'.$msg.'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button></div>';	
		}elseif($tipe=="error"){	
			$ret = '<div class="alert alert-danger col-sm-5">'.$msg.'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button></div>';	
		}else{					
			$ret = '<div class="alert alert-info col-sm-5">'.$msg.'<button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button></div>';	
		}	
		return $ret;
	}
	
	function Terbilang($x) {
        $ambil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        if ($x < 12)
            return " " . $ambil[$x];
        elseif ($x < 20)
            return $this->Terbilang($x - 10) . " Belas";
        elseif ($x < 100)
            return $this->Terbilang($x / 10) . " Puluh" . $this->Terbilang($x % 10);
        elseif ($x < 200)
            return " seratus" . $this->Terbilang($x - 100);
        elseif ($x < 1000)
            return $this->Terbilang($x / 100) . " Ratus" . $this->Terbilang($x % 100);
        elseif ($x < 2000)
            return " seribu" . $this->Terbilang($x - 1000);
        elseif ($x < 1000000)
            return $this->Terbilang($x / 1000) . " Ribu" . $this->Terbilang($x % 1000);
        elseif ($x < 1000000000)
            return $this->Terbilang($x / 1000000) . " Juta" . $this->Terbilang($x % 1000000);
    }
}
?>
