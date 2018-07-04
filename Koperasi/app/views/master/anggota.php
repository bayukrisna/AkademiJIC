<?php
?>
<div class="col-md-12">
<form action="<?=site_url();?>/master/set_data/anggota" method="post" id="anggota" novalidate>
	<input type="hidden" readonly name="act" id="act" value="<?=$act?>" />
	<input type="hidden" readonly name="id" id="act" value="<?=$data["NIK"]?>" />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Form Input Master Anggota</h4>
            <p>Keterangan : <span style="color:red">*</span> adalah form input yg wajib diisi</p>
        </div><!-- panel-heading -->
        <div class="panel-body">
            <div class="row">
				<!--<div class="form-group">
                    <label class="col-sm-3 control-label">ID Anggota <span class="asterisk"></span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" wajib="yes" readonly name="DATA[ID_ANGGOTA]" value="<?=$id?>">
                    </div>
                </div>-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">NIK <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" <?=$disabled?> name="DATA[NIK]" value="<?=$data["NIK"]?>" maxlength="10">
                    </div>
                </div><!-- form-group -->
				<div class="form-group">
                    <label class="col-sm-3 control-label">No KTP <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="DATA[KTP]" wajib="yes" value="<?=$data["KTP"]?>" maxlength="20">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Anggota <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="DATA[NAMA_ANGGOTA]" wajib="yes" value="<?=$data["NAMA_ANGGOTA"]?>" maxlength="50">
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">Jabatan Anggota <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
						<?= form_dropdown('DATA[ID_JABATAN]', $jabatan, $data['ID_JABATAN'], 'id="select-jabatan" data-placeholder="Pilih Jabatan" class="width300" wajib="yes" onclick="getGaji(this.value)" ');  ?>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">Gaji</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="URGAJI" value="<?=$data["GAJI"]?>" readonly>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">Divisi <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
						<?= form_dropdown('DATA[DIVISI]', array(""=>"","1"=>"Sales","2"=>"Development","3"=>"Marketing","4"=>"Keuangan","Support"), $data['DIVISI'], 'id="select-divisi" data-placeholder="Pilih Divisi Anggota" wajib="yes" class="width300" ');  ?>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">Alamat Anggota<span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <textarea class="form-control" wajib="yes" name="DATA[ALAMAT_ANGGOTA]" maxlength="255"><?=$data["ALAMAT_ANGGOTA"]?></textarea>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">No Telepon <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" wajib="yes" id="phone" name="DATA[NO_TELP_ANGGOTA]" value="<?=$data["NO_TELP_ANGGOTA"]?>" maxlength="13" onkeypress="return intInput(event, /[.0-9]/)">
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">Email Anggota <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" wajib="yes" name="DATA[EMAIL]" id="email" onKeyUp="testEmail();" value="<?=$data["EMAIL"]?>" maxlength="50">&nbsp;<span id="msg_email"></span>
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">Simpanan Pokok<span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-5">
						<input type="text" wajib="yes" class="form-control" maxlength="7" value="<?= $this->fungsi->FormatRupiah($data['SIMPANAN_POKOK'],2); ?>" onkeyup="this.value = ThausandSeperator('SIMPANAN_POKOK',this.value,2);"/>
						<input type="hidden" id="SIMPANAN_POKOK" name="DATA[SIMPANAN_POKOK]" value="<?=$data["SIMPANAN_POKOK"]?>">
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">Simpanan Wajib<span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-5">
						<input type="text" wajib="yes" class="form-control" maxlength="7" value="<?= $this->fungsi->FormatRupiah($data['SIMPANAN_WAJIB'],2); ?>" onkeyup="this.value = ThausandSeperator('SIMPANAN_WAJIB',this.value,2);"/>
						<input type="hidden" id="SIMPANAN_WAJIB" name="DATA[SIMPANAN_WAJIB]" value="<?=$data["SIMPANAN_WAJIB"]?>">
                    </div>
                </div>
				
				<!--<div class="form-group">
                    <label class="col-sm-3 control-label">Status Anggota <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-5">
						<?= form_dropdown('DATA[STATUS_ANGGOTA]', array(""=>"","1"=>"Aktif","0"=>"Non Aktif"), $data['STATUS_ANGGOTA'], 'id="select-status-anggota" data-placeholder="Pilih Status Anggota"  wajib="yes" class="width300" ');  ?>
                    </div>
                </div>-->
            </div><!-- row -->
        </div><!-- panel-body -->
        <div class="panel-footer">
          <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                 <a href="javascript:void(0);" class="btn btn-primary mr5" onclick="save_header('#anggota','msg_');">
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
jQuery(document).ready(function(){
	jQuery('#select option:first-child').text('');
	function format(item) {
		return '<i class="fa ' + ((item.element[0].getAttribute('rel') === undefined)?"":item.element[0].getAttribute('rel') ) + ' mr10"></i>' + item.text;
	}
	jQuery('#select-jabatan').select2({
		formatResult: format,
		formatSelection: format,
		escapeMarkup: function(m) {return m;}
	});
	jQuery('#select-divisi').select2({
		formatResult: format,
		formatSelection: format,
		escapeMarkup: function(m) {return m;}
	});
	jQuery('#select-status-anggota').select2({
		formatResult: format,
		formatSelection: format,
		escapeMarkup: function(m) {return m;}
	});
})
function getGaji(val){
	$.ajax({
        url: site_url+"/master/getGaji",
        type: "post",
        data: {id_jabatan: val},
        success: function (data) {
			$("#URGAJI").val(data);
        }
    })
}
</script>