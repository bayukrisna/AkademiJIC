<div class="col-md-12">
<form action="<?=site_url();?>/peminjaman/set_data" method="post" id="peminjaman" novalidate>
	<input type="hidden" readonly name="act" id="act" value="<?=$act?>" />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Form Input Peminjaman</h4>
            <p>Keterangan : <span style="color:red">*</span> adalah form input yg wajib diisi</p>
        </div><!-- panel-heading -->
        <div class="panel-body">
            <div class="row">
				<div class="form-group">
                    <label class="col-sm-3 control-label">Nomor Transaksi <span class="asterisk"></span></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" wajib="yes" readonly name="DATA[ID_PINJAMAN]" value="<?=$id?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Anggota <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="NAMA_ANGGOTA" disabled="disabled" wajib="yes" value="<?=$data["NAMA_ANGGOTA"]?>">
                    </div>
					<div class="col-sm-1">
						<input type="button" name="cari" id="cari" class="btn btn-small btn-primary" onclick="tb_search('anggota','NIK;NAMA_ANGGOTA;JABATAN;GAJI','Pencarian Anggota',this.form.id,650,470)" value="...">
					</div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">Jabatan</label>
                    <div class="col-sm-5">
						<input type="text" class="form-control" id="JABATAN" disabled="disabled" value="<?=$data["JABATAN"]?>">
						<input type="hidden" id="GAJI" value="<?=$data["GAJI"]?>"/>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">NIK</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="DATA[NIK]" id="NIK" readonly value="<?=$data["NIK"]?>">
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal Pinjaman</label>
                    <div class="col-sm-2">
                        <input type="text" id="TGL_PINJAMAN" onFocus="ShowDP('TGL_PINJAMAN')" onMouseOver="ShowDP('TGL_PINJAMAN')" class="form-control" wajib="yes" name="DATA[TGL_PINJAMAN]" value="<?=$data["TGL_PINJAMAN"]?>">
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">Besar Pinjaman<span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-5">
						<input type="text" wajib="yes" maxlength="11" class="form-control" value="<?= $this->fungsi->FormatRupiah($data['BESAR_PINJAMAN'],2); ?>" onkeyup="this.value = ThausandSeperator('BESAR_PINJAMAN',this.value,2);test();"/>
						<input type="hidden" id="BESAR_PINJAMAN" name="DATA[BESAR_PINJAMAN]" value="<?=$data["BESAR_PINJAMAN"]?>">
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">Untuk Keperluan<span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-5">
                        <textarea class="form-control" wajib="yes" maxlength="255" name="DATA[ALASAN_PINJAMAN]"><?=$data["ALASAN_PINJAMAN"]?></textarea>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">Mulai Bulan<span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-2">
						<input type="text" readonly class="form-control" onFocus="DateButir('BULAN_MULAI')" onMouseOver="DateButir('BULAN_MULAI')" id="BULAN_MULAI" wajib="yes" name="DATA[BULAN_MULAI]" value="<?=$data["BULAN_MULAI"]?>">
                    </div>
					<label class="col-sm-2 control-label" style="width:90px">s/d Bulan<span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-2">
						<input type="text" readonly class="form-control" id="BULAN_SELESAI" onChange="testtanggal();" wajib="yes" name="DATA[BULAN_SELESAI]" value="<?=$data["BULAN_SELESAI"]?>">
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">Angsuran Selama <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-2">
                        <input type="text" readonly class="form-control" id="LAMA_ANGSURAN" wajib="yes" name="DATA[ANGSURAN_SELAMA]" value="<?=$data["ANGSURAN_SELAMA"]?>" onFocus="test();">
                    </div>
					<div style="padding-top:10px;">
						Bulan
					</div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">Provisi 5% dari Besar Pinjaman <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-5">
						<input type="text" id="UR_PROVISI" wajib="yes" disabled="disabled" class="form-control" value="<?= $this->fungsi->FormatRupiah($data['PROVISI']); ?>" onkeyup="this.value = ThausandSeperator('PROVISI',this.value,2);"/>
						<input type="hidden" id="PROVISI" name="DATA[PROVISI]" value="<?=$data["PROVISI"]?>">
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">Total Pengembalian Pinjaman <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-5">
						<input type="text" id="UR_TOTAL_PENGEMBALIAN" wajib="yes" disabled="disabled" class="form-control" value="<?= $this->fungsi->FormatRupiah($data['TOTAL_PENGEMBALIAN']); ?>" onkeyup="this.value = ThausandSeperator('TOTAL_PENGEMBALIAN',this.value,2);"/>
						<input type="hidden" id="TOTAL_PENGEMBALIAN" name="DATA[TOTAL_PENGEMBALIAN]" value="<?=$data["TOTAL_PENGEMBALIAN"]?>">
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">Besar Jumlah Angsuran / Bulan<span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-5">
						<input type="text" id="UR_BESAR_ANGSURAN_BULAN" wajib="yes" disabled="disabled" class="form-control" value="<?= $this->fungsi->FormatRupiah($data['BESAR_ANGSURAN_BULAN']); ?>" onkeyup="this.value = ThausandSeperator('BESAR_ANGSURAN_BULAN',this.value,2);"/>
						<input type="hidden" id="BESAR_ANGSURAN_BULAN" name="DATA[BESAR_ANGSURAN_BULAN]" value="<?=$data["BESAR_ANGSURAN_BULAN"]?>">
                    </div>
                </div>
				
            </div><!-- row -->
        </div><!-- panel-body -->
        <div class="panel-footer">
          <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                 <a href="javascript:void(0);" class="btn btn-primary mr5" onclick="save_header('#peminjaman','msg_');">
                    <i class="fa fa-save"></i>&nbsp;<?=ucwords($act)?>
                </a>
                <button class="btn btn-dark" type="reset"><i class="fa fa-times"></i>&nbsp;Reset</button>&nbsp;<span class="msg_">&nbsp;</span>
            </div>
          </div>
        </div><!-- panel-footer -->  
    </div><!-- panel -->
    </form>
</div>
<script src="<?= base_url(); ?>js/toggles.min.js"></script>
<script>
/*$("#BULAN_MULAI" ).datepicker({
	yearRange: "-20:+100",
	changeMonth: true,
	changeYear: true,
	dateFormat: "yy-mm-dd"
});*/

$("#BULAN_SELESAI" ).datepicker({
	yearRange: "-20:+100",
	changeMonth: true,
	changeYear: true,
	dateFormat: "yy-mm-dd"
});
function getGaji(val){
	$.ajax({
        url: site_url+"/master/getGaji",
        type: "post",
        data: {id_jabatan: val},
        success: function (data) {
			$("#URGAJI").val(data);
        }
    });
}
function test(){
	var besar_pinjaman = parseFloat($("#BESAR_PINJAMAN").val()?$("#BESAR_PINJAMAN").val():0); 
	
	var provisi = (5/100) * besar_pinjaman;
	$("#PROVISI").val(Math.round(provisi));
	$("#UR_PROVISI").val(ThausandSeperator('',Math.round(provisi)));
	
	var total_pengembalian = parseFloat($("#PROVISI").val()) + parseFloat(besar_pinjaman);
	$("#UR_TOTAL_PENGEMBALIAN").val(ThausandSeperator('',Math.round(total_pengembalian)));
	$("#TOTAL_PENGEMBALIAN").val(Math.round(total_pengembalian));
	
	var lama_angsuran = $("#LAMA_ANGSURAN").val();
	var besar_angsuran_perBulan = parseFloat($("#TOTAL_PENGEMBALIAN").val()) / parseFloat(lama_angsuran);
	$("#UR_BESAR_ANGSURAN_BULAN").val(ThausandSeperator('',Math.round(besar_angsuran_perBulan)));
	$("#BESAR_ANGSURAN_BULAN").val(Math.round(besar_angsuran_perBulan));
}

function monthDiff(d1, d2) {
    var months;
    months = (d2.getFullYear() - d1.getFullYear()) * 12;
    months -= d1.getMonth();
    months += d2.getMonth() + 1;
    return months;
}

function testtanggal(){
	d1 = new Date($( "#BULAN_MULAI" ).val());
    d2 = new Date($( "#BULAN_SELESAI").val());
    $("#LAMA_ANGSURAN").val(monthDiff(d1, d2));
	$("#LAMA_ANGSURAN").focus();
}

function DateButir(id){
	//$( "#" + id ).datepicker({ minDate: 0 });
	//d = $("#"+id).datepicker("getDate");alert(d);return false;
	//$("#"+id).datepicker("setDate", new Date(d.getFullYear(),d.getMonth()+1,d.getDate()));
	
	/*$("#"+id).datepicker({
		beforeShowDay: DisableSpecificDates,
		minDate: 0
	});*/
	$( "#"+id ).datepicker({
		defaultDate: "+1m",
		changeMonth: false,
		changeYear: true,
		numberOfMonths: 1,
		beforeShowDay: DisableSpecificDates,
		minDate: "m",
		dateFormat: 'yy-mm-dd'
	});
}

function DisableSpecificDates(date) {
	var disableddates = ["2016-01-12","2016-01-13", "2016-01-14", "2016-01-15", "2016-01-16", "2016-01-17", 
						 "2016-01-18", "2016-01-19", "2016-01-20", "2016-01-21", "2016-01-22", "2016-01-23", 
						 "2016-01-24", "2016-01-25", "2016-01-26", "2016-01-27", "2016-01-28", "2016-01-29", 
						 "2016-01-30", "2016-01-31"];	
    var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
    return [disableddates.indexOf(string) == -1];
  }
</script>