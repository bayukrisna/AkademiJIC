<div class="col-md-12">
	<form action="<?=site_url();?>/tabungan/mutasi" method="post" id="mutasi" novalidate>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Pencarian Mutasi Tabungan</h4>
				<p>Keterangan : <span style="color:red">*</span> adalah form input yg wajib diisi</p>
			</div><!-- panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div class="form-group">
						<label class="col-sm-2 control-label">Nama Anggota <span class="asterisk" style="color:red">*</span></label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id="NAMA_ANGGOTA" disabled="disabled" wajib="yes">
						</div>
						<div class="col-sm-1">
							<input type="button" name="cari" id="cari" class="btn btn-small btn-primary" onclick="tb_search('anggota','NIK;NAMA_ANGGOTA','Pencarian Anggota',this.form.id,650,470)" value="...">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">NIK</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="NIK" id="NIK" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Tanggal Transaksi<span class="asterisk" style="color:red">*</span></label>
						<div class="col-sm-2">
							<input type="text" id="TGL_AWAL" onFocus="ShowDP('TGL_AWAL')" onMouseOver="ShowDP('TGL_AWAL')" class="form-control" wajib="yes" name="TGL_AWAL">
						</div>
						<div class="col-sm-2">
							<input type="text" id="TGL_AKHIR" onFocus="ShowDP('TGL_AKHIR')" onMouseOver="ShowDP('TGL_AKHIR')" class="form-control" wajib="yes" name="TGL_AKHIR">
						</div>
					</div>
				</div><!-- row -->
			</div><!-- panel-body -->
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-9 col-sm-offset-3">
						<a href="javascript:void(0);" class="btn btn-primary mr5" onclick="mutasi('#mutasi');">
							<i class="fa fa-save"></i>&nbsp;Cari
						</a>
						<button class="btn btn-dark" type="reset"><i class="fa fa-times"></i>&nbsp;Reset</button>&nbsp;<span class="msg_">&nbsp;</span>
					</div>
				</div>
			</div><!-- panel-footer -->
		</div><!-- panel -->
		<div id="view"></div>
    </form>
</div>

<script>
	function mutasi(formid) {
		var nik = $("#NIK").val();
		if(nik == "") {
			jAlert('Mohon Pilih Anggota terlebih dahulu.','KOPPEDI');
			return false;
		} else {
			$.ajax({
				type: 'POST',
				url: site_url + '/tabungan/mutasi',
				data:  $(formid).serialize(),
				success: function(data){
					$("#view").html(data);
				}
			});
		}
	}
</script>