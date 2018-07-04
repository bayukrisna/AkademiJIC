 $(document).ready(function(){
	var checked = false;
	$(".tabelajax .klikkanan td").bind("contextmenu",function(kode){ 
		if($(this).parent().attr('urldetil')){
			if($(this).parent().attr('urldetil')!=""){
				$('#newtr').remove();
				var jmltd = $('td', $(this).parent()).length;
				var addtd = '';
				if($(".tabelajax input:checkbox").length > 0){
					addtd = '<td></td>';
					jmltd--;
				}
				$(this).parent().after('<tr id="newtr">' + addtd + '<td id="filltd" colspan="' + jmltd + '"></td></tr>');
				$('#filltd').html('Loading..');
				$('#filltd').load($(this).parent().attr('urldetil'));
			}
		}
		return false;
	});
}); 

function button_menu(formid,id){	
	var checked = false;
	var url = "";
	var jml = "";
	var met = "";
	isi = $("#tb_menu"+formid).val()
	chk = $("#tb_chk"+formid+":checked").length;
	url = $("#"+id).attr('url');
	jml = $("#"+id).attr('jml');
	met = $("#"+id).attr('met');
	div = $("#"+id).attr('div');
	wnh = $("#"+id).attr('wnh');
	
	if(url=="") return false;
	if(chk==0 && jml!=0){
		jAlert('Data belum dipilih.',"Sistem Simpan Pinjam KOPPEDI");
		return false;
	}
	if((jml=='1' || jml=='2' || jml=='3') && chk > 1){
		jAlert('Data yang dapat diproses hanya satu (1).',"Sistem Simpan Pinjam KOPPEDI");
		$("#tb_menu"+formid).val(0);
		return false;
	}	
	if(met=="GET"){
		if(jml=='0') location.href = url;
		else location.href = url + '/' + $("#tb_chk"+formid+":checked").val();				
	}
	else if(met=="GET2"){
		if(jml=='0'){
			location.href = url;
		}
		else if(jml=='2'){
			var val = $("#tb_chk"+formid+":checked").val().split("|");
			var valdata = "";
			for(var a=0;a<val.length;a++){
				valdata = valdata+'/'+val[a];
			}
			ocation.href = url + valdata;	
		}else if(jml=='3'){
			var val = $("#tb_chk"+formid+":checked").val().split("|");
			var valdata = "";
			for(var a=0;a<val.length;a++){
				valdata = valdata+'/'+val[a];
			} 
			if(val[3]==1||val[1]==1){
				jAlert("Maaf, Data yang dapat diubah hanya yang berstatus DRAFT!","Sistem Simpan Pinjam KOPPEDI");
				return false;
			}else{
				location.href = url + valdata;		
			}
		}else{			
			var val = $("#tb_chk"+formid+":checked").val().split("|");
			var valdata = "";
			for(var a=0;a<val.length;a++){
				valdata = valdata+'/'+val[a].toLowerCase();
			}
			if(val[1].substr(0,1)!=0 && formid != "fanggota"){
				jAlert("Maaf, Data yang dapat diubah hanya yang belum melakukan pembayaran!","Sistem Simpan Pinjam KOPPEDI");
				return false;
			} else if(val[1].substr(0,1) == 0 && formid == "fanggota") {
				jAlert("Maaf, Data yang dapat diubah hanya yang berstatus aktif","KOPPEDI");
				return false;
			}else{
				location.href = url + valdata;
			}
		}
		
	}else if(met=="GETNEW"){
		jConfirm('Proses data terpilih sekarang?', "Sistem Simpan Pinjam KOPPEDI", 
		function(r){if(r==true){
			if(jml=='0')
				window.open(url, '_blank')
			else
				window.open(url + '/' + $("#tb_chk"+formid+":checked").val(), '_blank');							
		}else{return false;}});				
	}else if(met=="CETAKJS"){
         var val     = $("#tb_chk"+formid+":checked").val();
         var arrdata = val.split("|");
         $("#div"+met).remove();
         c_div('#div'+met,'<form name="frm'+formid+arrdata[0]+'" id="frm'+formid+arrdata[0]+'"></form>');
         var myform    = document.forms['frm'+formid+arrdata[0]];
         myform.method = 'POST';
         myform.action = url;
         myform.target = 'blank';
         add_hidden(myform, 'action', 'cetak');
         add_hidden(myform, 'generate', 'formcetakjs');
         add_hidden(myform, 'arrpost', val);
         var count = 1;
         for(var x=0;x<arrdata.length;x++){
            add_hidden(myform, 'id'+count+'', arrdata[x]);
            count ++;
         }
         myform.submit();
         return false;
	}else if(met=="POST"){
		jConfirm('Proses data yang dipilih?', "Sistem Simpan Pinjam KOPPEDI", 
		function(r){if(r==true){
			jloadings();
			$.ajax({
				type: 'POST',
				url: url,
				data: $('#'+formid).serialize(),
				success: function(data){
					if(data.search("MSG")>=0){
						arrdata = data.split('MSG#');
						arrdata = arrdata[1].split('#');
						jAlert(arrdata[0],'Sistem Simpan Pinjam KOPPEDI');
						if(arrdata.length>1) location.href = arrdata[1];
					}else{
						jAlert('Proses Gagal.','Sistem Simpan Pinjam KOPPEDI');
					}					
				}
			});
		}else{return false;}});	
	} 
	else if(met=="EDIT"){						
		var val = $("#"+formid+" input:checkbox").serialize()
		jloadings();
		$.ajax({
			type: 'POST',
			url: url,
			data: val+'&edit=edit',
			success: function(data){
				$("#"+formid+"_form").html(data);
				Clearjloadings();
			}
		});				
	}else if(met=="ADD"){	
		jloadings();
		$.ajax({
			type: 'POST',
			url: url,
			data: 'edit=add',
			success: function(data){
				$("#"+formid+"_form").html(data);
				Clearjloadings();
			}
		});					
	}else if(met=="DEL"){		
		jConfirm('Proses data yang dipilih?', "Sistem Simpan Pinjam KOPPEDI", 
		function(r){if(r==true){				
			var val = $("#"+formid+" input:checkbox").serialize()
			jloadings();
			$.ajax({
				type: 'POST',
				url: url,
				data: val+'&edit=del&act=delete',
				success: function(data){
					if(data.search("MSG")>=0){
						arrdata = data.split('#');
						if(arrdata[1]=="OK"){
							$('#labelload'+formid).css('color', 'green');
							//jAlert(arrdata[2],'Sistem Peminjaman Uang KOPPEDI');
							if(div=='divskep'||div=='divproduksi'){
								$("#spanview").load(arrdata[3]);
							}else{
								$('#'+formid+"_list").load(arrdata[3]);
							}
						}else{
							jAlert(arrdata[2],'Sistem Simpan Pinjam KOPPEDI');
						}
						Clearjloadings();
					}else{
						jAlert('Proses Gagal.','Sistem Simpan Pinjam KOPPEDI');
					}
				}
			});	
		}else{return false;}});				
	}else if(met=="DELETE"){
		var JUMBB=$("#JUMLAH_BB").val();
		var input = $("#JUMLAH_BB");
		var JUM_BHNBKU=$("#JUMLAH_BHNBKU").val();
		var inputBhnBku = $("#JUMLAH_BHNBKU");	
		jConfirm('Anda yakin akan menghapus data ini?', "Sistem Simpan Pinjam KOPPEDI", 
		function(r){if(r==true){			
			var val = $("#"+formid+" input:checkbox").serialize()
			
			if(jml=="produksi"||jml=="sinkron"||jml=="rusak"){
				var arrval = val.split("&");
				var isi=0;
				var status=0;
				for(var a=0;a<arrval.length;a++){
					var trueval = arrval[a].split("%7C");						
					isi = isi+parseInt(trueval[2]);
					if(jml=="rusak"){
						status = status+parseInt(trueval[1]);
					}else{
						status = status+parseInt(trueval[3]);
					}
				}	
				if(status>0){//STATUS 
					jAlert('Maaf, Data yang bisa dihapus hanya yang berstatus DRAFT.\nPeriksa kembali data pilihan anda','Sistem Simpan Pinjam KOPPEDI');
					return false;
				}
			}
			jloadings();
			$.ajax({
				type: 'POST',
				url: url,
				data: val+'&edit=del&act=delete',
				success: function(data){
					if(data.search("MSG")>=0){
						arrdata = data.split('#');
						if(arrdata[1]=="OK"){
							jAlert(arrdata[2],'Sistem Simpan Pinjam KOPPEDI');
							$('#'+div).load(arrdata[3]);
							Clearjloadings();
						}else{
							jAlert(arrdata[2],'Sistem Simpan Pinjam KOPPEDI');
						}
					}else{
						jAlert('Proses Gagal.','Sistem Simpan Pinjam KOPPEDI');
					}
				}
			});	
		}else{return false;}});				
	}
	else if(met=="DIALOG"){
		var valtb_chk = $("#tb_chk"+formid+":checked").val();
		var val="";		
		var width = 500;
		var height = 500;
		if(typeof(valtb_chk)!="undefined"){
			val = valtb_chk.toLowerCase().split("|");
		}
		if(wnh!=""){
			var arrwnh = wnh.split(',');
			width = arrwnh[0];
			height = arrwnh[1];
		}
		
		Dialog(url+"/"+val+"/"+div, 'dialog-tbl','Sistem Simpan Pinjam KOPPEDI',parseInt(width), parseInt(height));
	}
	else if(met=="PROCESS"){
		var title = 'Proses data terpilih ?';
		jConfirm(title, "Sistem Simpan Pinjam KOPPEDI", 
		function(r){if(r==true){		
			var val = $("#"+formid+" input:checkbox").serialize();	
			if(jml=="produksi"||jml=="sinkron"||jml=="rusak"){
				var arrval = val.split("&");	
				var isi=0;
				var status=0;
				for(var a=0;a<arrval.length;a++){
					var trueval = arrval[a].split("%7C");
					if(jml=="rusak"){
						status = status+parseInt(trueval[1]);
					}else{
						status = status+parseInt(trueval[3]);
					}
				}	
				if(status>0){//STATUS 
					jAlert('Maaf, Data yang bisa diproses hanya yang berstatus DRAFT.\nPeriksa kembali data pilihan anda','Sistem Simpan Pinjam KOPPEDI');
					return false;
				}
			}
					
			$.ajax({
				type: 'POST',
				url: url,
				data: val+'&act=process',
				beforeSend: function(){jloadings();},
				success: function(data){
					if(data.search("MSG")>=0){
						arrdata = data.split('#');
						if(arrdata[1]=="OK"){
							jAlert(arrdata[2],'Sistem Simpan Pinjam KOPPEDI');
							Clearjloadings();
							$('#'+div).load(arrdata[3]);
						}else{
							jAlert(arrdata[2],'Sistem Simpan Pinjam KOPPEDI');
							return false;
						}
					}else{
						jAlert("Proses gagal.","Sistem Simpan Pinjam KOPPEDI");
						return false;
					}
				}
			});	
		}else{return false;}});				
	}
	else if(met=="GETNEW"){
		jConfirm('Proses data terpilih sekarang?', "Sistem Simpan Pinjam KOPPEDI", 
		function(r){if(r==true){
			if(jml=='0')
				window.open(url, '_blank')
			else
				window.open(url + '/' + $("#tb_chk"+formid+":checked").val(), '_blank');							
		}else{return false;}});				
	}
	else if(met=="DIALOG"){		
		var valtb_chk = $("#tb_chk"+formid+":checked").val();
		var val="";		
		var width = 500;
		var height = 500;
		if(typeof(valtb_chk)!="undefined"){
			val = valtb_chk.toLowerCase().split("|");
		}
		if(wnh!=""){
			var arrwnh = wnh.split(',');
			width = arrwnh[0];
			height = arrwnh[1];
		}
		Dialog(url+"/"+val+"/"+div, 'dialog-tbl','Sistem Simpan Pinjam KOPPEDI',parseInt(width), parseInt(height));	
	}	
	else if(met.substr(0,6)=="DIALOG"){	
		if(wnh=="brgstockopname"){
			if($("#TANGGAL_STOCK").val()==""){
				jAlert("Tanggal Stock Opname Belum diisi?","Sistem Simpan Pinjam KOPPEDI");	
				return false;				
			}
		}	
		var valtb_chk = $("#tb_chk"+formid+":checked").val(); 
		var val="";		
		var width = 500;
		var height = 500;
		/*if(typeof(valtb_chk)!="undefined"){
			val = valtb_chk.toLowerCase().split("|");
		} */
		var splits = met.split('-');
		var arrwnh = splits[1].split(';');
		var arrjdl = splits[1].split('|');
		if(typeof(arrjdl[1])=="undefined") var jdl = 'Sistem Simpan Pinjam KOPPEDI';
		else var jdl = arrjdl[1];
		width = arrwnh[0];
		height = arrwnh[1];
		Dialog(url+"/"+valtb_chk, 'dialog-tbl',jdl,parseInt(width), parseInt(height));	
	
	}
	$("#tb_menu"+formid).val(0);
	return false;		
}
function tb_chkall(formid){
	$("#"+formid).find(':checkbox').attr('checked', $("#tb_chkall"+formid).attr('checked'));
	$('#newtr').remove();
	if(!$("#tb_chkall"+formid).attr('checked')==true){
		$("#"+formid+" input:checkbox:not(#tb_chkall"+formid+")").parent().parent().removeClass("selected");
		$("#"+formid).find(':checkbox').attr('checked', false);
	}else{
		$("#"+formid+" input:checkbox:not(#tb_chkall"+formid+")").parent().parent().addClass("selected");
	}
}
function tb_chk(){	
 	$('input:not(:checked)').parent().parent().removeClass("selected");
 	$('input:checked').parent().parent().addClass("selected");
}
function tb_hals(formid,id){ 
	form = $("#tb_menu"+formid).attr('formid');
	newhal = $(id).val();
	newhal++;
	redirect_url(newhal,form);
	return false;
}
function td_click(id){
	$("#detils_bawah").html('<center><img src=\"'+base_url+'img/_load.gif\" alt=\"\" /><br> Loading...</center>');	
	$.ajax({
		type: 'POST',
		url: $(".tabelajax #bawah").attr('urldetil')+"/"+id,
		data: 'ajax=1',
		success: function(html){
			$("#detils_bawah").html(html);
		}
	});					
}
function redirect_url(newhal,formid){
	newlocation = $("#"+formid).attr('action') + '/row/' + $("#tb_view").val() + '/page/' + newhal + '/order/' + $("#orderby").val() + '/' + $("#sortby").val();
	if($("#tb_cari").val()!="") newlocation +=  '/search/' + $("#tb_keycari").val() + '/' + $("#tb_cari").val().replace('/', '');
	location.href = newlocation;
}
function tb_order(formid, divid, data, key, cari){
	var action = $("#"+formid+" form").attr('action');
	tb_pagging(action, divid, data, key, cari);
}
function tb_go(action, divid, hal, orderby, sortby, input, key, cari){
	var value = $("#"+input).val();
	var data = "row|"+hal+'|page|'+value+'|order|'+orderby+'|'+sortby+'|';
	tb_pagging(action, divid, data, key, cari);
}
function tb_pagging(action, divid, data, key, cari){
	var dtid = $("#"+key).find('option:selected').attr('tag');
	if(dtid=='tag-tanggal'){
		var valueCari = 'Tag-Tanggal;'+$('#'+cari+'_tgl1').val()+';'+$('#'+cari+'_tgl2').val();
	}
	else if(dtid=='tag-tanggal-2field'){
		var valueCari = 'tag-tanggal-2field;'+$('#'+cari+'_tgl1').val()+';'+$('#'+cari+'_tgl2').val();
	}
	else if(dtid=='tag-select'){
		var valueCari = 'Tag-Select;'+$("#"+cari).val().replace('/', '');
	}else{
		var valueCari = $("#"+cari).val().replace('/', '');
	}
	var tblCari = $("#tblCari").serialize();
	$.ajax({
		type: 'POST',
		url: action,
		data: 'ajax=1&'+tblCari+'&uri='+data+'search|' + $("#"+key).val() + '|' +valueCari+'|',
		beforeSend: function(){jloadings();},
		complete: function(){Clearjloadings();},				
		success: function(html){
			$("#"+divid).html(html);
		}
	});	
}
function tb_cari(action, divid, hal, orderby, sortby, input, cari, key){	
	var value = $("#"+input).val();
	var data = "row|"+hal+'|page|'+value+'|order|'+orderby+'|'+sortby+'|';
	tb_pagging(action, divid, data, key, cari);
}
function td_pilih(id){
	var arr = id.split("|");
	var formName = arr[0];//alert(arr[0]);
	var fIndexEdit = arr[1];
	var inputField = arr[2];
	var input = inputField.split(";");
	var val = fIndexEdit.split(";");
	for(var c=0;c<(input.length)-1;c++){
		if(typeof($("#"+input[c]).get(0))=="undefined"){
			jAlert('<b>ERROR:\n</b>Form elements are undefined ('+input[c]+').\nPlease check the script code!.','Sistem Simpan Pinjam KOPPEDI');
			return false;
			break;
		}		
		var tipe = $("#"+input[c]).get(0).tagName;
		if(tipe=='INPUT'){
			$("#"+formName).find("#"+input[c]).val(val[c]);
		}
		else if(tipe=='TEXTAREA'){
			$("#"+formName).find("#"+input[c]).attr("value",val[c])
		}
		else if(tipe=='SELECT'){
			//$("#"+formName).find('#'+input[c]+' option:contains("'+val[c]+'")').attr('selected', true);
			$("#"+formName).find('#'+input[c]).val(val[c]);
		}
		else{
			$("#"+formName).find("#"+input[c]).html(val[c]);
		}
	}
	$("#"+input[0]).focus();
	closedialog('Dialog-dok');	
}
function tb_search_target(tipe,inputField,title,formName,width,height,getelement,target){
	if(target==""){
		jAlert('Silahkan Pilih Target dahulu.','Sistem Simpan Pinjam KOPPEDI');
		$("#target").focus();
		return false;
	}
	var getdata="";
	if(typeof(getelement)!="undefined"){
		var data = getelement.split(";");
		var arr="";
		for(var a=0;a<data.length-1;a++){
			if($("#"+formName+" #"+data[a]).val()!=""){
				arr = arr+""+$("#"+formName+" #"+data[a]).val()+";";
			}
		}
		if(arr!="")	getdata = "/"+arr;
	}
	var judul = title.toUpperCase();
	var dataAjax = tipe+"/"+inputField+"/"+formName+getdata+"/"+target;
	Dialog(site_url+'/search/getsearch/'+dataAjax,'Dialog-dok',judul,width,height);		
}
function tb_search(tipe,inputField,title,formName,width,height,getelement){
	var getdata="";
	var gudang_asal = $("#KODE_GUDANG_ASAL").val();
	if(typeof(getelement)!="undefined"){
		var data = getelement.split(";");
		var arr="";
		for(var a=0;a<data.length-1;a++){
			if($("#"+formName+" #"+data[a]).val()!=""){
				arr = arr+""+$("#"+formName+" #"+data[a]).val()+";";
			}
		}
		if(arr!="")	getdata = "/"+arr;
	}
	var judul = title.toUpperCase();
	if(formName=="fpindahgudang"){
		var dataAjax = tipe+"/"+inputField+"/"+formName+getdata+"/"+gudang_asal;
		if(gudang_asal==""){
			jAlert("Pilih Gudang Asal Terlebih Dahulu","Sistem Simpan Pinjam KOPPEDI");
		}else{
			Dialog(site_url+'/search/getsearch/'+dataAjax,'Dialog-dok',judul,width,height);
		}
	}else{
		var dataAjax = tipe+"/"+inputField+"/"+formName+getdata;
		Dialog(site_url+'/search/getsearch/'+dataAjax,'Dialog-dok',judul,width,height);
	}
}
function td_detil_priview_bottom(id,thisid){ 
	if($(thisid).attr('btnname')=="expand"){
		if($(thisid).attr('title')=='Expand'){
			$(thisid).attr('title','Collapse');$(thisid).attr('src',base_url+'img/nolines_minus.gif');	
		}else{			
			$(thisid).attr('title','Expand');$(thisid).attr('src',base_url+'img/nolines_plus.gif');	
		}
		var thisid = "#"+$(thisid).parent().parent().attr('id');
	}else{
		if($(thisid).find('img').attr('title')=='Expand'){
			$(thisid).find('img').attr('title','Collapse');$(thisid).find('img').attr('src',base_url+'img/nolines_minus.gif');	
		}else{			
			$(thisid).find('img').attr('title','Expand');$(thisid).find('img').attr('src',base_url+'img/nolines_plus.gif');	
		}
	}
	$("tr").removeClass("selected");
 	$(thisid).addClass("selected");
	var obj = $(thisid).next().attr("id");	
	if(obj=="newtr"){ 
		$('#newtr').remove();	
		$(thisid).removeClass("selected");
	}else{
		if($(thisid).attr('urldetil')){
			if($(thisid).attr('urldetil')!=""){
				$('#newtr').remove();
				var jmltd = $('td', $(thisid)).length;
				if($(".tabelajax input:checkbox").length > 0){
					jmltd--;
				}
				$(thisid).after('<tr id="newtr"><td id="filltd" colspan="' + (jmltd+1) + '"></td></tr>');
				$('#filltd').html('<img src=\"'+base_url+'img/_load.gif\" alt=\"\" align=\"absbottom\"/> Loading..');
				$('#filltd').load($(thisid).attr('urldetil')+"/ajax");
			}
		}
		return false;
	}
}	

function td_detil_priview_blank(id,thisid){		
	var url = $(thisid).attr('urldetil');		
	var key = $(thisid).attr('keyz');
	var id = multiReplaces(key,'|','/');
	if($(thisid).attr('urldetil')){
		location.href = $(thisid).attr('urldetil')+'/'+id;
	}
	return false;
}
function td_detil_priview(id,thisid){	
	var id = id.split('|');
	var name = $(thisid).children().children().attr('name');
	var val = name+'='+$(thisid).children().children().val();
	var url = $(thisid).attr('urldetil');	
	$.ajax({
		type: 'POST',
		url: url,
		data: val+'&edit=edit',
		success: function(data){
			$("#"+id[0]+"_form").html(data);
			$('#labelload'+id).fadeOut('Slow');
		}
	});			
}
function multiReplaces(str, match, repl) {
    do {
        str = str.replace(match, repl);
    } while(str.indexOf(match) !== -1);
    return str;
}

function tb_tab(tipe,inputField,title,formName,width,height,getelement){
	var getdata="";
	if(typeof(getelement)!="undefined"){
		var data = getelement.split(";");
		var arr="";
		for(var a=0;a<data.length-1;a++){
			if($("#"+formName+" #"+data[a]).val()!=""){
				arr = arr+""+$("#"+formName+" #"+data[a]).val()+";";
			}
		}
		if(arr!="")	getdata = "/"+arr;
	}
	var judul = title.toUpperCase();
	var dataAjax = tipe+"/"+inputField+"/"+formName+getdata;
	Dialog(site_url+'/search/get_tab/'+dataAjax,'Dialog-dok',judul,width,height);		
}

function frm_Cari(div,form){
	$.ajax({
		type: 'POST',
		url: site_url+"/"+$('#'+form).attr("action"),
		data: 'ajax=1&'+$('#'+form).serialize(),
		beforeSend: function(){jloadings();},
		complete: function(){Clearjloadings();},
		success: function(data){
			$('#'+div).html(data);
		}
	});	
	return false;
}