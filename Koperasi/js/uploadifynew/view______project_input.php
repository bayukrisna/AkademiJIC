<script>
$(function () {
	$(".chzn-select").chosen();
	$(".chzn-select-deselect").chosen({
		allow_single_deselect: true
	});
	var idData = 1;
	var username = '<?php echo $this->session->userdata('username');?>';
	createUploadObject('fileupload',idData,username,'1','div_fileupload','fileupload');
});

function createUploadObject(namaDivUpload,idData,username,tipeData,divResult,namaText)
{
	$('#'+namaDivUpload).uploadify({			
		'uploader'  : base_url+'uploadify/uploadify.swf',
		'script'    : base_url+'uploadify/upload_pendukung.php',
		'cancelImg' : base_url+'uploadify/cancel.png',
		'folder'    : '../uploads',
		'removeCompleted' : true,
		'multi'	  : false,
		'auto'      : true,
		'sizeLimit' : 1024000,
		'fileExt'   : '*.jpg;*.gif;*.png;*.pdf;*.doc;*.docx',
		'fileDesc'  : 'Image/PDF Files',
		'scriptData'  : {'id':idData,'tipe':tipeData,'div':divResult,'nama':namaText,'base':base_url,'username':username},
		'buttonText' : 'Pilih File',
		'onAllComplete' : function(event,data) {
			//alert('complete');
			},
		'onComplete'  : function(event, ID, fileObj, response, data) {
			//alert(response);
			console.log(response);
			var myObject = eval('(' + response + ')');
			var htmldiv = $('#'+divResult).html();
			$('#'+divResult).html(htmldiv+'</br>'+myObject.txtReturn);
			}
	});
}


/*DATE PICKER*/
 $(function () {
	$('#tgl_awal').datetimepicker({
		pickTime: false
	});
	
	$('#tgl_akhir').datetimepicker({
		pickTime: false
	});
});



</script>
<!-- start Left Bar -->
<?php // $this->load->view('left_bar');?>
<!-- end Left Bar -->
<div class="main-wrapper"  style="margin-left:0px;" >
	<div class="container-fluid">
		<div class="row-fluid ">
			<div class="span12">
				<div class="primary-head">
					<h3 class="page-header">Project Plan</h3>						
				</div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>" class="icon-home"></a>
						<span class="divider "><i class="icon-angle-right"></i></span>
					</li>
					<li><a href="<?php echo site_url();?>/project">Project Plan</a>
						<span class="divider"><i class="icon-angle-right"></i></span>
					</li>
						<li class="active">Create Project</li>
					
				</ul>
			</div>
		</div>
		
		<div class="row-fluid ">
			<div class="span12">
				<div class="content-widgets light-gray">
					<div class="widget-head blue">
						<h3>Input Project</h3>
					</div>	
					<div class="widget-container">
						<form class="form-horizontal" action="#" method="post" onsubmit="saveProject(); return false;" id="project" name="project">
						<fieldset class="default">
						<legend>Data Project</legend>
							<div class="control-group">
								<label class="control-label">Nama Project </label>
								<div class="controls">
									<input type="text" placeholder="Text Input" class="span4 left-stripe" name="nama_pro" id="nama_pro">									
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Deskripsi</label>
								<div class="controls">
									<textarea rows="2" placeholder="Text Input" class="span4 left-stripe" name="keterangan" id="keterangan"></textarea>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Tgl Mulai</label>
								<div class="controls" >									
									<div id="tgl_awal" class="input-append">
										<input data-format="yyyy-MM-dd" type="text" style="height:34px;" name="tgl_awal"><span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
									</div>
								</div>
							</div>	
							<div class="control-group">
								<label class="control-label">Tgl Selesai</label>
								<div class="controls" >									
									<div id="tgl_akhir" class="input-append">
										<input data-format="yyyy-MM-dd" type="text" style="height:34px;" name="tgl_akhir"><span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Divisi</label>
								<div class="controls">
									<select data-placeholder="Select" class="chzn-select-deselect span4" tabindex="2" name="divisi" id="divisi" onchange="get_pic(this.value);" >
										<option value=""></option>
										<?php foreach ($arrdata_divisi as $divisi): ?>
										<option value="<?php echo $divisi['id']; ?>" ><?php echo $divisi['nama_divisi']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label">PIC/Penanggung Jawab</label>
								<div class="controls" id="pic">
									<select data-placeholder="Select" class="chzn-select-deselect span4" tabindex="2" name="sales" id="sales" >																			
										<option value=""></option>
									</select>
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label">Upload Dokumen Pendukung Proyek</label>
								<div class="controls" >
									<input type="file" id="fileupload" name="fileupload">
									<div id="div_fileupload" ></div>
								</div>
							</div>
						</fieldset>
						
							<div class="form-actions">
								<button type="submit" class="btn btn-success">&nbsp; Save &nbsp;</button>
								<button type="reset" class="btn"> Cancel </button>
								<span class="msg_pro"></span>
							</div>							
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function get_pic(id){
	if(id){	
	$.post(site_url + "/project/get_pic/"+Math.random(),{kode:id},function(data) {				
			$('#pic').html(data.tabel);			
		},"json");
	}else{
	var tbl ='';
		tbl += '<select data-placeholder="Select" class="chzn-select-deselect span4" tabindex="2" name="sales" id="sales" >';
		tbl += '<option value=""></option>';
		tbl += '</select>';
		$('#pic').html(tbl);
	}
}

function saveProject(){
	if (cek_input())
	{
		var url_cek = site_url + '/project/save_project/' + Math.random();
		$('.msg_pro').html('<img src="' + base_url + 'images/loading.gif" style="height:20px;" >');
		$.ajax({
			type: 'POST',
			url: url_cek,
			data: $('#project').serialize(),
			dataType: 'json',
			success: function(data) {			
				var returnData = data.id;
					$('.msg_pro').html(data.txt);
				if (returnData == "0"){					
					setTimeout(function(){$('.msg_pro').html('')}, 15000);
				}else if (returnData == "1"){					
					setTimeout(function(){window.location.href = site_url+'/project'}, 2000);									
				}
			}
		})
	}
	return false;
}

$(function () {
	$("#project").validate({
		rules: {			
			nama_pro: {
				required: true
				//minlength: 2
			},
			tgl_awal: {
				required: true
				//minlength: 5
			},
			tgl_akhir: {
				required: true
				//minlength: 5
			}			
		},
		messages: {			
			nama_pro: {
				required: "Please enter a project name"
				//minlength: "Your username must consist of at least 2 characters"
			},
			tgl_awal: {
				required: "Please provide start date"
				//minlength: "Your password must be at least 5 characters long"
			},
			tgl_akhir: {
				required: "Please enter end date"
				//minlength: "Your captcha must be at least 5 characters long"
			}
		}
	});
});

function cek_input()
{
	var errorString = "Silahkan melengkapi data berikut:\n";
	var panjangAwal = errorString.length;
	
	if ($('[name="nama_pro"]').val() == "")
		errorString += "- Nama Project\n";
	if ($('[name="tgl_awal"]').val() == "")
		errorString += "- tgl awal\n";
	if ($('[name="tgl_akhir"]').val() == "")
		errorString += "- Tgl akhir\n";	
	
	var panjangAkhir = errorString.length;		
	if (panjangAwal == panjangAkhir)
	{			
		return true;
	}
	else
	{
		alert(errorString);
		return false;
	}
}

function view_Upload(id,tipe)
{
	var width = 500;
	var height = 400;
	var winl = (screen.width - width) / 2;
	var wint = (screen.height - height) / 2;
	var url = site_url + '/project/lihatImg/'+id;
	
	var popupname = 'view_img';
	popupWindow = window.open(url, popupname, 'left='+winl+',top='+wint+',width='+width+', height='+height+',scrollbars=yes,resizable=yes,statusbar=yes');	
}

function hapusImage(idnya,tipe, namaTipe, namaDive)
{
	var konfirmasi = confirm('Anda ingin menghapus data scan ' + namaTipe + '?');
	if (konfirmasi)
	{
		$('#'+namaDive).html('<img src="'+base_url+'images/loading.gif">');
		$.post(site_url + "/project/hapus/"+Math.random(),{tipe:tipe,id:idnya,'namaTipe':namaTipe,'namaDiv':namaDive},function(data) {
			var returnData = data.returnData;
			if (returnData > 0)
			{
				alert('Scan ' + namaTipe + ' berhasil dihapus');				
				$('#'+namaDive).html('');
			}
			else
			{
				alert('Scan ' + namaTipe + ' gagal dihapus');
				$('#'+namaDive).html(data.txtReturn);
			}
		},"json");
	}
	else
	{
		return false;
	}
}

</script>

	     

