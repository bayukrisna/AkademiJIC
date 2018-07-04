<?php
if (!empty($_FILES)) {
	
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$idData = $_POST['id'];
	$username = $_POST['username'];

	$tipeFile = $_POST['tipe'];
	$createBy = $_POST['createBy'];
	$skaNo = $_POST['skano'];
	$skaDate = $_POST['skadate'];
	$base_url = $_POST['base'];
	
	if ($idData != 0)
	{	
		$con = mysql_connect("10.1.2.151","operator","operator");
		if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
			
		mysql_select_db("ipska_upload", $con);
		
		$fileName = $_FILES['Filedata']['name'];
		$tmpName  = $_FILES['Filedata']['tmp_name'];
		$fileSize = $_FILES['Filedata']['size'];
		$fileType = $_FILES['Filedata']['type'];
		
		$keyTipe = $tipeFile; //array_search($tipeFile,$arrayTipe);
		
		$folder_path = date("Ymd");
		//$uploads_dir = '../file/scan/'.$folder_path;
		$uploads_dir = '/ska_upload_master/file/scan/'.$folder_path;
		$uploads_dir_thumb = '../file/scan/thumb/';
		$tgl_create = date("Y-m-d H:i:s");
		$nama_file_md5 = md5($idData."11"."_pdkng");
		
		if (!is_dir($uploads_dir))
			mkdir($uploads_dir);
	
		$uploads_dir .= "/";
		
		$type = exif_imagetype($tmpName);
	
		$sqldel = "DELETE FROM ipska_upload.tblfcupload2 WHERE tipe_data=11 AND id_header=".$idData;
		mysql_query($sqldel);
		
		$sql = "";
		if ($type==1 or $type==2 or $type==3){
			$fileType = "image/jpeg";
			$ekstensi = "jpg";
			if (move_uploaded_file($tmpName, $uploads_dir.$nama_file_md5.".".$ekstensi))
			{
				$sql = "INSERT INTO tblfcupload2(no_dokumen, tgl_dokumen, tipe_data, tipe_file, 
						ukuran_file, createBy,createDate,id_header,nama_file,nama_original,folder_path) 
						VALUES ('".$skaNo."', '".$skaDate."', '11','".$fileType."','".$fileSize."','".$createBy."',
						'".$tgl_create."','".$idData."','".$nama_file_md5."','".$nama_original."','".$folder_path."')";
			}
		}else{
			$fileType = "application/pdf";
			$ekstensi = "pdf";
			if (move_uploaded_file($tmpName, $uploads_dir.$nama_file_md5.".".$ekstensi))
			{
				$sql = "INSERT INTO tblfcupload2(no_dokumen, tgl_dokumen,tipe_data, tipe_file, ukuran_file,
						createBy,createDate,id_header,nama_file,nama_original,folder_path) 
						VALUES ('".$skaNo."', '".$skaDate."', '11','".$fileType."','".$fileSize."','".$createBy."',
						'".$tgl_create."','".$idData."','".$nama_file_md5."','".$nama_original."','".$folder_path."')";
			}
		}
		if ($sql != "")
			mysql_query($sql);
		$banyakResult = mysql_affected_rows();
		$txtReturn = '<font color="#FF0000"><b>Gagal</b></font>';
		if ($banyakResult > 0)
		{
			$txtReturn = "&nbsp;&nbsp;&nbsp;<a href='javascript:void(0)' title='Lihat Scan Dokumen SKA' onclick='view_Upload()' ><img src='".$base_url."images/icon/preview.gif' width='17px' height='17px'/></a>&nbsp;<a href='javascript:void(0)' onclick='hapus_image()' title='Hapus Scan Dokumen SKA'><img src='".$base_url."images/icon/delete.gif'></a>";
			
			$keteranganMasuk = "Upload Scan Dokumen SKA";
			$sqlUpdateFile = "UPDATE ipska.ska_mulf_cepthdr SET nama_file='".$nama_file_md5."' 
							  WHERE id=".$idData;
			mysql_query($sqlUpdateFile);
			$sqlLog = "INSERT INTO ipska.tblfcloguser(username,tgl_log,keterangan) VALUES
					   ('".trim(addslashes($createBy))."','".$tgl_create."','".$keteranganMasuk."')";
			mysql_query($sqlLog);
		}
	}
	else
	{
		$txtReturn = '<font color="#FF0000"><b>Gagal</b></font>';
	}
	$arrayReturn['txtReturn'] = $txtReturn;
	echo json_encode($arrayReturn);
}
?>