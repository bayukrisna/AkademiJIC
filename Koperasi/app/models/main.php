<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR);
class Main extends Model{
	function get_uraian($query, $select){
		$data = $this->db->query($query);
		if($data->num_rows() > 0){
			$row = $data->row();
			return $row->$select;
		}else{
			return "";
		}
		return 1;
	}
	
	function get_result(&$query){
		$data = $this->db->query($query);
		if($data->num_rows() > 0){
			$query = $data;
		}else{
			return false;
		}
		return true;
	}
	
	function get_combobox($query, $key, $value, $empty = FALSE, &$disable = ""){
		$combobox = array();
		$data = $this->db->query($query);
		if($empty) $combobox[""] = "&nbsp;";
		if($data->num_rows() > 0){
			$kodedis = "";
			$arrdis = array();
			foreach($data->result_array() as $row){
				if(is_array($disable)){
					if($kodedis==$row[$disable[0]]){
						if(!array_key_exists($row[$key], $combobox)) $combobox[$row[$key]] = str_replace("'", "\'", "&nbsp; &nbsp;&nbsp;".$row[$value]);
					}else{
						if(!array_key_exists($row[$disable[0]], $combobox)) $combobox[$row[$disable[0]]] = $row[$disable[1]];
						if(!array_key_exists($row[$key], $combobox)) $combobox[$row[$key]] = str_replace("'", "\'", "&nbsp; &nbsp;&nbsp;".$row[$value]);
					}
					$kodedis = $row[$disable[0]];
					if(!in_array($kodedis, $arrdis)) $arrdis[] = $kodedis;
				}else{
					$combobox[$row[$key]] = str_replace("'", "\'", $row[$value]);
				}
			}
			$disable = $arrdis;
		}
		return $combobox;
	}
	
	function post_to_query($array, $except=""){
		$data = array();
		foreach($array as $a => $b){
			if(is_array($except)){
				if(!in_array($a, $except)) $data[$a] = $b;
			}else{
				$data[$a] = $b;
			}
		}
		return $data;
	}
	
	/////////////////////////////////////////privat2e function:////////////////////////////////////////////////////////////////
	
	function getWhere($sql,$uri,$keys){
		if($uri){
			$ada = strpos(strtolower($sql), "where");
			if ( $ada === false )
				$dtWhere .= " WHERE ";
			else
				$dtWhere .= " AND ";
			
			$dtPos = explode("|",$uri);
			if($dtPos[7]=="search"){
				$dtField = $keys[$dtPos[8]];
				$dtSeeks = $dtPos[9];
				
				if ($dtSeeks != "")
				{							
					if (strpos(strtolower($dtSeeks), "tag-tanggal") === false ){								
						$dtSeeks = str_replace("'", "''", $dtSeeks);
						$value = $dtWhere.$dtField." LIKE '%".$dtSeeks."%' "; 
					}else{												
						if (strpos(strtolower($dtSeeks), "tag-tanggal-2field") === false ){																									
							$dtSeeks = str_replace("tag-tanggal;","",strtolower($dtSeeks));
							$arrayCari = explode(";",$dtSeeks);
							$tanggal1  = $arrayCari[0];
							$tanggal2  = $arrayCari[1];
							#for mysql
							$value =  $dtWhere."STR_TO_DATE(".$dtField.",'%Y-%m-%d')"." BETWEEN '".$tanggal1."' AND '".$tanggal2."'";	
						}else{	
							$dtSeeks = str_replace("tag-tanggal-2field;","",strtolower($dtSeeks));
							$arrayCari = explode(";",$dtSeeks);
							$tanggal1  = $arrayCari[0];
							$tanggal2  = $arrayCari[1];
							$dtField = explode(";",$dtField);
							#for mysql
							$value =  $dtWhere."STR_TO_DATE(".$dtField[0].",'%Y-%m-%d') >= '".$tanggal1."' AND STR_TO_DATE(".$dtField[1].",'%Y-%m-%d') <= '".$tanggal2."'";	
						}
						
					}
				}				
			}
			return $value;
		}	
	}
	
	function upload($folder="",$element="",$id=""){
		$error = "";
		$msg = "";
		$arrtype = array("JPG", "JPEG", "GIF", "DOC", "PDF", "RAR", "ZIP", "PNG");
		if($element!=""){
				$ftype = explode(".",$_FILES[$element]['name']);
				$ftype = trim(strtoupper($ftype[count($ftype)-1]));
				if(!empty($_FILES[$element]['error'])){
					if(($_FILES[$element]['error']=="1") || ($_FILES[$element]['error']=="2")){
						$error = "<b>Error :</b><br>Ukuran File ".strtoupper($element)." Terlalu Besar.";
					}else if($_FILES[$element]['error']=="3"){
						$error = "<b>Error :</b><br>File ".strtoupper($element)." Yang Ter-Upload Tidak Sempurna.";
					}else if($_FILES[$element]['error']=="4"){
						$error = "<b>Error :</b><br>File ".strtoupper($element)." Kosong Atau Belum Dipilih.";
					}else if($_FILES[$element]['error']=="6"){
						$error = "<b>Error :</b><br>Direktori Penyimpanan Sementara Tidak Ditemukan.";
					}else if($_FILES[$element]['error']=="7"){
						$error = "<b>Error :</b><br>File ".strtoupper($element)." Gagal Ter-Upload.";
					}else if($_FILES[$element]['error']=="8"){
						$error = "<b>Error :</b><br>Proses Upload File ".strtoupper($element)." Dibatalkan.";
					}else{
						$error = "<b>Error :</b><br>Pesan Error Tidak Ditemukan.";
					}
				}else if(empty($_FILES[$element]['tmp_name']) || ($_FILES[$element]['tmp_name']=='none')){
					$error = "<b>Error :</b><br>File ".strtoupper($element)." Gagal Ter-Upload.";
				}else if(!in_array($ftype, $arrtype)){
					$error = "<b>Error :</b><br>Tipe File ".strtoupper($element)." Salah.<br>Tipe File Yang Diterima : *.JPG, *.JPEG, *.GIF, *.DOC, *.PDF, *.RAR Dan *.ZIP *.PNG";
				}else{
					
					$path = "img/".$folder.'/';
					$cekpath = $this->validate_upload_path($path);
					if($cekpath!=1){
						return  "{error: '$cekpath',\n msg: '$msg'\n}";exit();
					}
					$filename = $path.md5($id).".$ftype";				
					$imagename=str_replace($path,"",$filename);
					if(move_uploaded_file($_FILES[$element]['tmp_name'], $filename)){
						$rstemp = 1;
						if($rstemp==1){
							if($ftype=="JPG"||$ftype=="JPEG"||$ftype=="GIF"||$ftype=="PNG"){
								$msg1 = "<table border='0' cellpadding='0' cellpadding='0'><tr><td><img src=\"".base_url()."img/".$folder.'/'.$imagename."\" alt='' style=\"max-height:181px;max-width:181px;border:solid 1px #CCC\" align=\"middle\"></td><td valign='top'>";
								$msg2 = "</td><tr></table>";
							}
							$msg .= $msg1;
							$msg .= "<table border='0' cellpadding='0' cellpadding='0'><tr><td colspan='3'>Upload File Berhasil.</td></tr>";
							$msg .= '<tr><td>Nama File</td><td>:</td><td>'.$_FILES[$element]['name']."</td></tr>";
							if($element=="logo"){
							$msg .= '<tr><td>Tipe File</td><td>:</td><td>'.$_FILES[$element]['type']."</td></tr>";
							$msg .= '<tr><td>Ukuran File</td><td>:</td><td>'.@filesize($filename)." byte</td></tr>";
							$msg .= "<tr><td colspan=2><a href='javascript:void(0);' class='button del' id='btnupload' onClick=\"deleteFupload(\'".$imagename."\',\'".$element."\')\"><span><span class='icon'></span>&nbsp;Delete&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></a></td></tr>";
							}
							$msg .= "</table>";
							if($element=="logo")
							$msg .= "<input type=\"hidden\" name=\"DATA[LOGO]\" id=\"LOGO\" value=\"".$imagename."\"/>";	
							else
							$msg .= "<input type=\"hidden\" name=\"PROFIL[LOGO]\" id=\"LOGO\" value=\"".$imagename."\"/>";	
							$msg .= $msg2;
						}else{
							$error = "<b>Error :</b> File ".strtoupper($element)." Gagal Ter-Upload.";
							@unlink($filename);
						}
					}else{
						$error = "<b>Error :</b> File ".strtoupper($element)." Gagal Ter-Upload.";
					}
					@unlink($_FILES[$element]);
				}
		}else{
			$error = "<b>Error :</b><br>Parameter Tidak Ditemukan.";
		}
		return  "{error: '$error',\n msg: '$msg'\n}";	
	}
	
	function validate_upload_path($upload_path){
		if ($upload_path == ''){
			return 'No filepath 1';
		}
		
		if (function_exists('realpath') AND @realpath($upload_path) !== FALSE){
			$upload_path = str_replace("\\", "/", realpath($upload_path));
		}

		if ( ! @is_dir($upload_path)){
			return 'No filepath 2';
		}

		if ( ! is_really_writable($upload_path)){
			return 'upload Not Writable';
		}

		$upload_path = preg_replace("/(.+?)\/*$/", "\\1/",  $upload_path);
		return '1';
	}
	
	function getIP($type){ 
		 if (getenv("HTTP_CLIENT_IP") 
			 && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) 
			 $ip = getenv("HTTP_CLIENT_IP"); 
		 else if (getenv("REMOTE_ADDR") 
			 && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) 
			 $ip = getenv("REMOTE_ADDR"); 
		 else if (getenv("HTTP_X_FORWARDED_FOR") 
			 && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) 
			 $ip = getenv("HTTP_X_FORWARDED_FOR"); 
		 else if (isset($_SERVER['REMOTE_ADDR']) 
			 && $_SERVER['REMOTE_ADDR'] 
			 && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) 
			 $ip = $_SERVER['REMOTE_ADDR']; 
		 else { 
			 $ip = "unknown"; 
		 return $ip; 
			 } 
		 if ($type==1) {return md5($ip);} 
		 if ($type==0) {return $ip;}
	}
	
	function findWhere($SQL){
		if(strpos($SQL,"WHERE")===FALSE){
			$SQL = " WHERE ";		
		}else{
			$SQL = " AND ";		
		}	
		return $SQL;
	}


}
?>