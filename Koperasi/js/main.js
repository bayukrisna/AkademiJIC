function add_hidden(formname, key, value) {
	var input = document.createElement('input');
	input.type = 'hidden';
	input.name = key;'name-as-seen-at-the-server';
	input.value = value;
	formname.appendChild(input);
}

function c_div(id, inner){
	div = document.createElement("div");	
	div.innerHTML = '<div id="'+id+'" style="display: none;">'+inner+'</div>';
	document.body.appendChild(div);
}

function c_dialog(id, title, inner, width, height, clobtn, modal, resize){
	$('#'+id).remove();
	c_div(id, '<div style="margin:20px 25px 5px 12px;">'+inner+'</div>');
	$("#"+id).dialog({bgiframe:true,resizable:false,autoOpen:true, modal: modal, title: title, height: height, width: width, resize: resize, 
		clobtn: clobtn,
		overlay: {
			backgroundColor: '#000',
			opacity: 0.5
		},
		show:{ effect: 'fade', direction: "up" },
		hide:{ effect: 'fade', direction: "up" },
		close:function(){
    		$(this).dialog('destroy').remove();
  		}	 
		// effect: drop,explode,slide,Fade,Fold,highlight,Pulsate,Scale,Shake,Transfer
	});
}	

function Dialog(url,Divid,title,width,height){
	c_dialog(Divid, ':: '+title+' ::', '<div id="idv_popup"></div>', width, height, "run-in", true, false);
	$("#"+Divid).html('<center><img src=\"'+base_url+'img/_load.gif\" alt=\"\" />loading...</center>');
	$('#'+Divid).load(url);				
}

function Clearjloadings(){$("#popup_container").remove();$("#popup_overlay").remove();}

function save_header(formid,msg){
	if(formid=="#peminjaman"){
		if($("#ID_ANGGOTA").val()==""){
			jAlert('Silahkan Pilih Anggota Terlbih Dahulu.','Sistem Simpan Pinjam KOPPEDI');
			return false;
		}
		if(parseFloat($("#BESAR_PINJAMAN").val()) > (parseFloat($("#GAJI").val()) * 4)){
			jAlert('Maaf total peminjaman maksimal 4 kali gaji Anda.','Sistem Peminjaman Uang KOPPEDI');
			return false;
		}
	}
	if(validasi(msg,formid)){
		jConfirm('Are you sure want to process this data?', "Sistem Simpan Pinjam KOPPEDI", 
		function(r){if(r==true){			
			$.ajax({
				type: 'POST',
				url: $(formid).attr('action') + '/ajax',
				data: $(formid).serialize(),
				success: function(data){
					if(data.search("MSG")>=0){
						arrdata = data.split('#');
						if(arrdata[1]=="OK"){
							$("."+msg).css('color', 'green');
							$("."+msg).html(arrdata[2]);
						}else{
							$("."+msg).css('color', 'red');
							$("."+msg).html(arrdata[2]);
						}
						if(arrdata.length>3){
							setTimeout(function(){location.href = arrdata[3];}, 2000);
							return false;
						}
					}else{
						$("."+msg).css('color', 'red');
						$("."+msg).html('Proccess Failed.');
					}
				}
			});	
		}else{return false;}});	   
	}return false;
}

function validasi(divid,formid){
	if(formid==""||typeof(formid)=="undefined") var formid = "";	
	else var formid = formid;		
	if(divid==""||typeof(divid)=="undefined") var divid = "msg_";	
	else var divid = divid;		
	$(formid+" ."+divid).hide();
	$(formid+" ."+divid).css('color', '');
	//$(formid+" ."+divid).html('<img src=\"'+base_url+'images/_load.gif\" alt=\"\" />loading...');
	$(formid+" ."+divid).fadeIn('slow');	
	var notvalid = 0;var notnumber = 0;var notaju = 0;var jumAju=26;
	var regNumber =/^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/;
	$.each($(formid+" input:visible, "+formid+" div, "+formid+" select:visible, "+formid+" textarea:visible, "+formid+" input:checkbox, "+formid+" input:radio"), function(n,element){
		if($(this).attr('wajib')=="yes" && ($(this).val()=="" || $(this).val()==null)){
			$(this).addClass('wajib');
			notvalid++;			
		}
		if($(this).attr('format')=="angka" && (!regNumber.test($(this).val()) && $(this).val()!="")){
			$(this).addClass('format');
			notnumber++;
		}
		if($(this).attr('aju')=="isi" && (this.value.length != jumAju && $(this).val()!="")){
			$(this).addClass('aju');
			notaju++;
		}
		
	});
	if(notvalid>0 || notnumber >0){
		var val1="";var val2="";var val3="";var pisah="";var pisah1="";
		if(notvalid>0){
		 	val1 = 'Ada ' + notvalid + ' kolom yang harus diisi!';
		}
		if(notnumber >0){
			val2 = notnumber+' Required By the Numbers';	
		}
		if(notaju >0){
			val3 ='Ada '+notaju+' Kolom Yang Formatnya Tidak Valid';	
		}
		if(notvalid>0 && notnumber>0){
			pisah =' and ';
		}
		if(notnumber>0 && notaju>0){
			pisah1 =' and ';
		}
		if(notvalid>0 && notaju>0){
			pisah1 =' and ';
		}
		$(formid+" ."+divid).css('color', 'red');
		$(formid+" ."+divid).html('<span class="msg warn">'+val1+pisah+val2+pisah1+val3+'</span>');
		$(formid+" ."+divid).fadeIn('slow');
		return false;
	}else{
		if(formid=="#anggota"){
			var sEmail = $('#email').val();
			if ($.trim(sEmail).length == 0) {
				$('#msg_email').html('Please enter valid email address').css('color','red');
				$('.msg_').html('Please enter valid email address').css('color','red');
				return false;
			}
			if (!validEmail(sEmail)) {
				$('#msg_email').html('Invalid Email Address').css('color','red');
				$('.msg_').html('Invalid Email Address').css('color','red');
				return false;
			}else{
				return true;
			}
		}else{
			return true;
		}
	}		
	return false;
}

function closedialog(id){$("#"+id).dialog('close');}

/*using by function ThausandSeperator!!*/
function removeCharacter(v, ch){
	var tempValue = v+"";
	var becontinue = true;
		while(becontinue == true){
			var point = tempValue.indexOf(ch);
			if( point >= 0 ){
				var myLen = tempValue.length;
				tempValue = tempValue.substr(0,point)+tempValue.substr(point+1,myLen);
				becontinue = true;
			}else{
			becontinue = false;
		}
	}
	return tempValue;
}
function characterControl(value){
	var tempValue = "";
	var len = value.length;
	for(i=0; i<len; i++){
		var chr = value.substr(i,1);
		if( (chr < '0' || chr > '9') && chr != '.' && chr != ',' ){
			chr = '';
		}   
		tempValue = tempValue + chr;
	}
	return tempValue;
}
function ThausandSeperator(hidden,value, digit){
	var thausandSepCh = ",";
	var decimalSepCh = ".";
	var tempValue = "";
	var realValue = value+"";
	var devValue = "";
	if(digit=="")digit=3;
	realValue = characterControl(realValue);
	var comma = realValue.indexOf(decimalSepCh);
	if(comma != -1 ){
		tempValue = realValue.substr(0,comma);
		devValue = realValue.substr(comma);
		devValue = removeCharacter(devValue,thausandSepCh);
		devValue = removeCharacter(devValue,decimalSepCh);
		devValue = decimalSepCh+devValue;
		if( devValue.length > digit){
			devValue = devValue.substr(0,digit+1);
		}
	}else{
		tempValue = realValue;
	}
	tempValue = removeCharacter(tempValue,thausandSepCh);	
	var result = "";
	var len = tempValue.length;
	while(len > 3){
		result = thausandSepCh+tempValue.substr(len-3,3)+result;
		len -=3;
	}
	result = tempValue.substr(0,len)+result;	
	if(hidden!=""){
		$("#"+hidden).val(tempValue+devValue);	
	}
	return result+devValue;
}
function change_captcha(){
	document.getElementById('captcha').src=base_url+"app/libraries/captcha/captcha.php?rnd=" + Math.random();
}
function intInput(event, keyRE) {
	if ( String.fromCharCode(((navigator.appVersion.indexOf('MSIE') != (-1)) ? event.keyCode : event.charCode)).search(keyRE) != (-1)
		|| ( navigator.appVersion.indexOf('MSIE') == (-1)
			&& ( event.keyCode.toString().search(/^(8|9|13|45|46|35|36|37|39)$/) != (-1) 
				|| event.ctrlKey || event.metaKey ) ) ) {
		return true;
	} else {
		return false;
	}
}
function ShowDP(id){
	$("#"+id).datepicker({onClose: function (){this.focus();},changeMonth: true, changeYear: true,  dateFormat: 'yy-mm-dd'});
}
function ShowA(id){
	$('#'+id).datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			dateFormat: 'MM yy'
		}).focus(function() {
			var thisCalendar = $(this);
			$('.ui-datepicker-calendar').detach();
			$('.ui-datepicker-close').click(function() {
				var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
				var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
				thisCalendar.datepicker('setDate', new Date(year, month, 1));
			});
	});
}
function ShowB(id){
	$('#'+id).datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: false,
		dateFormat: 'dd-mm-yy'
	});
}
function prosestagihan(formid){
	jConfirm('Apakah Anda akan memproses data ini ?', "KOPPEDI", 
		function(r){
			if(r==true){
				$.ajax({
					type: 'POST',
					url: site_url+'/peminjaman/proses_tagihan',
					data: $("#" + formid).serialize(),
					success: function(data){
						if(data.search("MSG")>=0){
							arrdata = data.split('#');
							if(arrdata[1]=="OK"){
								jAlert(arrdata[2],'Sistem Simpan Pinjam KOPPEDI');
								$("#fCari").load(arrdata[3]);
							}else{
								jAlert(arrdata[2],'Sistem Simpan Pinjam KOPPEDI');
							}
						}else{
							jAlert('Proses Gagal.','Sistem Simpan Pinjam KOPPEDI');
						}
					}
				});	
			}else{
				return false;
			}
		}
	);
}
function approveTagihan(tgl,tglTagih){
	jConfirm('Proses data yang dipilih?', "Sistem Simpan Pinjam KOPPEDI", 
		function(r){if(r==true){
			jloadings();
			$.ajax({
				type: 'POST',
				url: $("#fTagihan").attr('action') + '/ajax',
				data: $("#fTagihan").serialize()+'&tgl_tagih='+tglTagih,
				success: function(data){
					if(data.search("MSG")>=0){
						arrdata = data.split('#');
						if(arrdata[1]=="OK"){
							jAlert(arrdata[2],'Sistem Simpan Pinjam KOPPEDI');
							$("#fTagihan").load(arrdata[3]);
						}else{
							jAlert(arrdata[2],'Sistem Simpan Pinjam KOPPEDI');
						}
					}else{
						jAlert('Proses Gagal.','Sistem Simpan Pinjam KOPPEDI');
					}
				}
			});	
		}else{
			return false;
		}
	});
}
function cetakExcel(tgl){
	jConfirm('Proses data yang dipilih?', "Sistem Simpan Pinjam KOPPEDI", 
		function(r){if(r==true){
			window.open(site_url+'/peminjaman/cetak_tagihan/'+tgl, '_blank');
		}else{
			return false;
		}
	});
}
function save_popup(formid,msg,div){ 
	if(validasi(msg)){	
		jloadings();	
		$.ajax({
			type: 'POST',
			url: $(formid).attr('action'),
			data: $(formid).serialize(),
			success: function(data){
				if(data.search("MSG")>=0){
					arrdata = data.split('#');
					if(arrdata[1]=="OK"){
						$("."+msg).css('color', 'green');
						$("."+msg).html(arrdata[2]);				
					}else{
						$("."+msg).css('color', 'red');
						$("."+msg).html(arrdata[2]);
					}					
					if(arrdata.length>3){
						$('#'+div).load(arrdata[3]);
						closedialog('dialog-tbl');
					}
				}else{
					$("."+msg).css('color', 'red');
					$("."+msg).html('Proses Gagal.');
				}
				Clearjloadings();
			}
		});	
	}return false;	
}
function cetak_laporan(tgl_awal,tgl_akhir,tipe){
	//$.ajax({
		//type: 'POST',
		//url: site_url + '/laporan/cetak_laporan',
		//data: {'action':'cari','periode_bulan':tgl_awal,'sampai_bulan':tgl_akhir,'tipe':tipe},
		//success: function(data){
			 window.open(site_url + '/laporan/cetak_laporan/'+tgl_awal+'/'+tgl_akhir+'/'+tipe, 'blank_', 'width=800, height=650,toolbar=0,location=0,menubar=0');
		//}
	//});
}

function testEmail(){
	var sEmail = $('#email').val();
	if ($.trim(sEmail).length == 0) {
		$('#msg_email').html('Please enter valid email address').css('color','red');
		//e.preventDefault();
	}
	if (validEmail(sEmail)) {
		$('#msg_email').html('Email is valid').css('color','green');
	}
	else {
		$('#msg_email').html('Invalid Email Address').css('color','red');
		//e.preventDefault();
	}
}

function validEmail(sEmail){
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}

function prosesSimpananWajib(formid, tglSimpan) {
	jConfirm('Apakan Anda akan memproses data ini ?', "KOPPEDI", 
		function(r){if(r==true){
			jloadings();
			$.ajax({
				type: 'POST',
				url: site_url + '/simpanan/proses_simpan_wajib',
				data: $("#" + formid).serialize(),
				success: function(data){
					if(data.search("MSG")>=0){
						arrdata = data.split('#');
						if(arrdata[1]=="OK"){
							jAlert(arrdata[2],'KOPPEDI');
							setTimeout(function(){location.href = arrdata[3];}, 2000);
							return false;
						}else{
							jAlert(arrdata[2],'KOPPEDI');
						}
					}else{
						jAlert('Proses Gagal.','KOPPEDI');
					}
				}
			});	
		}else{
			return false;
		}
	});
}
/*--*/ 