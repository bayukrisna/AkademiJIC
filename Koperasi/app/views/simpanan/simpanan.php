<div class="col-md-12">
<form action="<?=site_url();?>/simpanan/set_data/simpan" method="post" id="simpan" novalidate>
	<input type="hidden" readonly name="act" id="act" value="<?=$act?>" />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Form Input Simpanan Sukarela</h4>
            <p>Keterangan : <span style="color:red">*</span> adalah form input yg wajib diisi</p>
        </div><!-- panel-heading -->
        <div class="panel-body">
            <div class="row">
				<div class="form-group">
                    <label class="col-sm-3 control-label">Nomor Transaksi <span class="asterisk"></span></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" wajib="yes" readonly name="DATA[ID_SIMPANAN]" value="<?=$id?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Anggota <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="NAMA_ANGGOTA" disabled="disabled" wajib="yes" value="<?=$data["NAMA_ANGGOTA"]?>">
                    </div>
					<div class="col-sm-1">
						<input type="button" name="cari" id="cari" class="btn btn-small btn-primary" onclick="tb_search('anggota','NIK;NAMA_ANGGOTA','Pencarian Anggota',this.form.id,650,470)" value="...">
					</div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">NIK</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="DATA[NIK]" id="NIK" readonly value="<?=$data["NIK"]?>">
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal Simpan <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-2">
                        <input type="text" id="TGL_SIMPANAN" onFocus="ShowDP('TGL_SIMPANAN')" onMouseOver="ShowDP('TGL_SIMPANAN')" class="form-control" wajib="yes" name="DATA[TGL_SIMPANAN]" value="<?=$data["TGL_SIMPANAN"]?>">
                    </div>
                </div>
				<!-- <div class="form-group">
                    <label class="col-sm-3 control-label">Jenis Simpanan<span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-5">
						<?= form_dropdown('DATA[JENIS_SIMPANAN]', array(""=>"","2"=>"Wajib","3"=>"Sukarela"), $data['JENIS_SIMPANAN'], 'id="select-jenis-simpanan" data-placeholder="Pilih Jenis Simpanan"  wajib="yes" class="width300" onClick="getSimpananWajib(this.value);"');  ?>
                    </div>
                </div> -->
				<div class="form-group">
                    <label class="col-sm-3 control-label">Besar Simpanan<span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-5">
						<input type="text" id="UR_BESAR_SIMPANAN" wajib="yes" maxlength="11" class="form-control" value="<?= $this->fungsi->FormatRupiah($data['BESAR_SIMPANAN'],2); ?>" onkeyup="this.value = ThausandSeperator('BESAR_SIMPANAN',this.value,2);"/>
						<input type="hidden" id="BESAR_SIMPANAN" name="DATA[BESAR_SIMPANAN]" value="<?=$data["BESAR_SIMPANAN"]?>">
                    </div>
                </div>
				
            </div><!-- row -->
        </div><!-- panel-body -->
        <div class="panel-footer">
          <div class="row"
            <div class="col-sm-9 col-sm-offset-3">
                <a href="javascript:void(0);" class="btn btn-primary mr5" onclick="save_header('#simpan','msg_');">
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
	jQuery('#select-jenis-simpanan').select2({
		formatResult: format,
		formatSelection: format,
		escapeMarkup: function(m) {return m;}
	});
});
function getSimpananWajib(val) {
	var NIK = $("#NIK").val();
	if(NIK=="") {
		jAlert('Mohon Pilih Anggota terlebih dahulu.','KOPPEDI');
		$("#select-jenis-simpanan").val('');
		$("#select2-chosen-1 i")[0].nextSibling.remove();
		return false;
	} else {
		if(val == 2) {
			$.ajax({
				type: 'POST',
				url: site_url + '/simpanan/get_simpanan_wajib',
				data: {'nik':NIK},
				success: function(data){
					$("#BESAR_SIMPANAN").val(data);
					$("#UR_BESAR_SIMPANAN").val(ThausandSeperator('',data,2));
					$("#UR_BESAR_SIMPANAN").attr('readonly','readonly');
				}
			});
		} else {
			$("#UR_BESAR_SIMPANAN").removeAttr('readonly');
			$("#BESAR_SIMPANAN").val('');
			$("#UR_BESAR_SIMPANAN").val('');
		}
	}
}
</script>