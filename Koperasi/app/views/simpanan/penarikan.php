<div class="col-md-12">
<form action="<?=site_url();?>/simpanan/set_data/tarikan" method="post" id="tarikan" novalidate>
	<input type="hidden" readonly name="act" id="act" value="<?=$act?>" />
	<input type="hidden" readonly name="status" id="status" />
	<input type="hidden" readonly name="gaji" id="gaji" />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Form Input Penarikan Simpanan</h4>
            <p>Keterangan : <span style="color:red">*</span> adalah form input yg wajib diisi</p>
        </div><!-- panel-heading -->
        <div class="panel-body">
            <div class="row">
				<div class="form-group">
                    <label class="col-sm-3 control-label">Nomor Transaksi <span class="asterisk"></span></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" wajib="yes" readonly name="DATA[ID_PENARIKAN]" value="<?=$id?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Anggota <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="NAMA_ANGGOTA" disabled="disabled" wajib="yes" value="<?=$data["NAMA_ANGGOTA"]?>">
                    </div>
					<div class="col-sm-1">
						<input type="button" name="cari" id="cari" class="btn btn-small btn-primary" onclick="tb_search('pelunasan','NIK;NAMA_ANGGOTA;status','Pencarian Anggota',this.form.id,650,470)" value="...">
					</div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">NIK</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="DATA[NIK]" id="NIK" readonly value="<?=$data["NIK"]?>" onFocus="getSaldoPenarikan();">
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal Penarikan<span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-2">
                        <input type="text" id="TGL_PENARIKAN" onFocus="ShowDP('TGL_PENARIKAN')" onMouseOver="ShowDP('TGL_PENARIKAN')" class="form-control" wajib="yes" name="DATA[TGL_PENARIKAN]" value="<?=($data["TGL_PENARIKAN"])?$data["TGL_PENARIKAN"]:date('Y-m-d')?>">
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">Saldo Tabungan</label>
                    <div class="col-sm-5">
						<input type="text" class="form-control" readonly="readonly" id="UR_SALDO_TABUNGAN"/>
						<input type="hidden" class="form-control" readonly="readonly" id="SALDO_TABUNGAN" name="SALDO_TABUNGAN" />
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">Besar Penarikan<span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-5">
						<input type="text" wajib="yes" maxlength="11" class="form-control" id ="UR_BESAR_PENARIKAN" value="<?= $this->fungsi->FormatRupiah($data['BESAR_PENARIKAN'],2); ?>" onkeyup="this.value = ThausandSeperator('BESAR_PENARIKAN',this.value,2);checkSaldo();"/>
						<input type="hidden" id="BESAR_PENARIKAN" name="DATA[BESAR_PENARIKAN]" value="<?=$data["BESAR_PENARIKAN"]?>" >
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">Keterangan Penarikan<span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <textarea class="form-control" wajib="yes" maxlength="255" name="DATA[KET_PENARIKAN]"><?=$data["KET_PENARIKAN"]?></textarea>
                    </div>
                </div>
            </div><!-- row -->
        </div><!-- panel-body -->
        <div class="panel-footer">
          <div class="row"
            <div class="col-sm-9 col-sm-offset-3">
                <a href="javascript:void(0);" class="btn btn-primary mr5" onclick="save_header('#tarikan','msg_');">
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
		jQuery('#select-jenis-penarikan').select2({
			formatResult: format,
			formatSelection: format,
			escapeMarkup: function(m) {return m;}
		});
	});
	
	function getSaldoPenarikan() {
		var nik = $("#NIK").val();
		var status = $("#status").val();
		if(nik == "") {
			jAlert('Mohon Pilih Anggota terlebih dahulu.','KOPPEDI');
			$("#select-jenis-penarikan").val('');
			$("#select2-chosen-1 i")[0].nextSibling.remove();
			return false;
		} else {
			$.ajax({
				type: 'POST',
				url: site_url + '/simpanan/get_saldo_penarikan',
				data: {'nik':nik, 'status':status},
				success: function(data){
					$("#UR_SALDO_TABUNGAN").val(ThausandSeperator('',data,2));
					$("#SALDO_TABUNGAN").val(data);
					$("#UR_BESAR_PENARIKAN").val('');
					$("#BESAR_PENARIKAN").val('');
					if(status != "1") {
						$("#UR_BESAR_PENARIKAN").val(ThausandSeperator('',data,2));
						$("#BESAR_PENARIKAN").val(data);
						$("#UR_BESAR_PENARIKAN").attr('readonly','readonly');
					} else {
						$("#UR_BESAR_PENARIKAN").removeAttr('readonly');
					}
				}
			});
		}
	}
	
	function checkSaldo() {
		var saldo = $("#SALDO_TABUNGAN").val();
		var jumlah_penarikan = $("#BESAR_PENARIKAN").val();
		
		if(parseFloat(jumlah_penarikan) > parseFloat(saldo)) {
			jAlert('Maaf Total Penarikan melebihin Jumlah Saldo yang ada.\n Jumlah Saldo Anda Rp. '+ThausandSeperator('',saldo,2),'KOPPEDI');
			$("#UR_BESAR_PENARIKAN").val(ThausandSeperator('',saldo,2));
			$("#BESAR_PENARIKAN").val(saldo);
		}
	}
</script>