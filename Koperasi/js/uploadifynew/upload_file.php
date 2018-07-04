<?php
if (!empty($_FILES)) 
{
	$idData = $_POST['id'];
	$username = $_POST['username'];
	$tipeFile = $_POST['tipe'];
	$divResult = $_POST['div'];
	$namaText = $_POST['nama'];
	$base_url = $_POST['base'];
	
	if ($idData != 0)
	{	
		$con = mysql_connect("localhost","root","");
		
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
			
		mysql_select_db("eoffice", $con);
		
		$fileName = $_FILES['Filedata']['name'];
		$tmpName  = $_FILES['Filedata']['tmp_name'];
		$fileSize = $_FILES['Filedata']['size'];
		$fileType = $_FILES['Filedata']['type'];
		//echo $fileType;die();
		$nama_original = $fileName;
		$type = exif_imagetype($tmpName);
		
		$arrayTipe = array("","peb","npe","bl","awb","cargo","invoice","packing","coo","cost","npwp");
		$keyTipe = $tipeFile; //array_search($tipeFile,$arrayTipe);
		
		$folder_path = date("Ymd");		
		$uploads_dir = '/uploads/'.$folder_path;		
		$tgl_create = date("Y-m-d H:i:s");
		$nama_file_md5 = md5($tgl_create.$keyTipe."_pdkng");
		
		if (!is_dir($uploads_dir))
			mkdir($uploads_dir,0777);
	
		$uploads_dir .= "/";
		$sql = "";
		
		if ($type==1 or $type==2 or $type==3)
		{
			$fileType = "image/jpeg";
			$ekstensi = "jpg";
			if (move_uploaded_file($tmpName, $uploads_dir.$nama_file_md5.".".$ekstensi))
			{
				$sql = "INSERT INTO td_file_surat(tipe_file, ukuran_file, create_by, create_date, nama_file, 
						nama_original, folder_path, ekstensi_file) 
						VALUES ('".$fileType."','".$fileSize."','".$username."',
						'".$tgl_create."','".$nama_file_md5."','".$nama_original."','".$folder_path."','".$ekstensi."')";
				
			}
		
		}
		else
		{
			$tipeFileExcel = array("application/vnd.ms-excel","application/octet-stream");
			$extensionExcel = array("xls","xlsx");
			$tipeFileWord = array("application/vnd.ms-word","application/octet-stream");
			$extensionWord = array("doc","docx");
			$pecahNamaFile = explode(".",$fileName);
			$extension = $pecahNamaFile[count($pecahNamaFile)-1];
			$ekstensi = "pdf";
			if ((in_array($fileType,$tipeFileExcel)) and (in_array($extension,$extensionExcel)))
			{
				$ekstensi = "xls";
				$tipeFileOthers = "application/vnd.ms-excel";
			}
			elseif((in_array($fileType,$tipeFileWord)) and (in_array($extension,$extensionWord)))
			{
				$ekstensi = "doc";
				$tipeFileOthers = "application/vnd.ms-word";
			}
			else
			{
				$tipeFileOthers = "application/pdf";
			}
			if (move_uploaded_file($tmpName, $uploads_dir.$nama_file_md5.".".$ekstensi))
			{
										
				$sql = "INSERT INTO td_file_surat(tipe_file, ukuran_file, create_by, create_date, nama_file, 
						nama_original, folder_path, ekstensi_file) 
						VALUES ('".$fileType."','".$fileSize."','".$username."',
						'".$tgl_create."','".$nama_file_md5."','".$nama_original."','".$folder_path."','".$ekstensi."')";
			}
			
		}
		if ($sql != "")
			mysql_query($sql);
		$txtReturn = '<font color="#FF0000"><b>Gagal</b></font>';
		$banyakResult = mysql_affected_rows();
		if ($banyakResult > 0)
		{
			$id = mysql_insert_id();
			$txtReturn = "<div id='".$divResult.'_'.$id."' >".$nama_original." &nbsp;<a href='javascript:void(0)' title='Lihat Data Scan' onclick='view_Upload(\"".$id."\",\"".$keyTipe."\")'><img src='".$base_url."img/opt-find.png' width='17px' height='17px'/></a>&nbsp;<a href='javascript:void(0)' title='Hapus Data Scan' onclick='hapus_file(\"".$id."\",\"".$keyTipe."\",\"".$nama_original."\",\"".$divResult.'_'.$id."\")'>&nbsp;&nbsp;&nbsp;<img src='".$base_url."img/delete.png'></a><input type='hidden' name='file_upload[]' value='".$id."' /></div> ";
			
		}
		mysql_close();
	}
	else
	{
		$txtReturn = '<font color="#FF0000"><b>Gagal</b></font>';
	}
	$arrayReturn['txtReturn'] = $txtReturn;
	echo json_encode($arrayReturn);
}
?>