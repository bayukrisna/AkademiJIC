<div class="col-md-12">
	<form action="<?=site_url();?>/master/set_data/jabatan" method="post" id="jabatan" novalidate>
		<input type="hidden" readonly name="act" id="act" value="<?=$act?>" />
		<input type="hidden" readonly name="id" id="act" value="<?=$id?>" />
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Form Input Master Jabatan</h4>
				<p>Keterangan : <span style="color:red">*</span> adalah form input yg wajib diisi</p>
			</div><!-- panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div class="form-group">
						<label class="col-sm-3 control-label">ID Jabatan <span class="asterisk"></span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" wajib="yes" readonly name="DATA[ID_JABATAN]" value="<?=$id?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Jabatan <span class="asterisk" style="color:red">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="DATA[JABATAN]" value="<?=$data["JABATAN"]?>" wajib="yes" maxlength="50">
						</div>
					</div><!-- form-group -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Gaji <span class="asterisk" style="color:red">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="URGAJI" onkeyup="this.value = ThausandSeperator('gaji', this.value,2);" value="<?=$this->fungsi->FormatRupiah($data["GAJI"], 2)?>" wajib="yes" maxlength="10">
							<input type="hidden" readonly name="DATA[GAJI]" id="gaji" value="<?=$data["GAJI"]?>">
						</div>
					</div>
				</div><!-- row -->
			</div><!-- panel-body -->
			<div class="panel-footer">
			  <div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					 <a href="javascript:void(0);" class="btn btn-primary mr5" onclick="save_header('#jabatan','msg_');">
						<i class="fa fa-save"></i>&nbsp;<?=ucwords($act)?>
					</a>
					<button class="btn btn-dark" type="reset"><i class="fa fa-times"></i>&nbsp;Reset</button>&nbsp;<span class="msg_">&nbsp;</span>
				</div>
			  </div>
			</div><!-- panel-footer -->  
		</div><!-- panel -->
    </form>
</div>