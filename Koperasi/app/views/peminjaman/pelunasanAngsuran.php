<form id="pelunasanAngsuran" name="pelunasanAngsuran" method="post" autocomplete="off" action="<?=site_url();?>/peminjaman/pelunasanAngsuran">
	<input type="hidden" readonly name="ID" id="ID" value="<?=$NIK?>" />
	<div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Proses Pelunasan</h4>
        </div><!-- panel-heading -->
        <div class="panel-body">
			<div class="row">
				<div class="form-group">
                    <label class="col-sm-3 control-label">Nama Anggota <span class="asterisk"></span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" wajib="yes" readonly value="<?=$NAMA?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label">Besar Pelunasan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" readonly value="<?=$this->fungsi->formatRupiah($BESAR_ANGSURAN,2)?>" wajib="yes">
                    </div>
                </div><!-- form-group -->
              
                <!--<div class="form-group">
                    <label class="col-sm-3 control-label">Pilih File <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <table>
							<tr>
								<td><input type="file" name="uploadPhoto1" id="uploadPhoto1" /></td>
								<td><span id="imgDataPhoto1"></span></td>
							</tr>
							<tr>
								<td>
								 <input type="text" name="PHOTO1" id="PHOTO1" style="border-style: none;background-color: transparent; background-color:#fff" readonly="readonly" value="<?=$sess["PATHURL"]?>" />
								</td>
							</tr>
						</table>
                    </div>
                </div>-->
			</div>
		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					 <a href="javascript:void(0);" class="btn btn-success mr5" onclick="save_popup('#pelunasanAngsuran','msg_','tbl-data');">
						<i class="fa fa-save"></i>&nbsp;Save
					</a>
				</div>
			</div>
        </div>
	</div>
</form>