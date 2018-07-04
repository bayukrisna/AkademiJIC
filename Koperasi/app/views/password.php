<div class="col-md-12">
	<form action="<?=site_url();?>/password/change" method="post" id="password" novalidate>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Ubah Password</h4>
			</div><!-- panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div class="form-group">
						<label class="col-sm-3 control-label">Password Lama <span class="asterisk" style="color:red">*</span></label>
						<div class="col-sm-9">
							<input type="password" class="form-control" wajib="yes" name="passwordlama">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Password Baru <span class="asterisk" style="color:red">*</span></label>
						<div class="col-sm-9">
							<input type="password" class="form-control" name="passwordbaru" wajib="yes">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Konfirmasi Password Baru <span class="asterisk" style="color:red">*</span></label>
						<div class="col-sm-9">
							<input type="password" class="form-control" name="konfirmpassword" wajib="yes">
						</div>
					</div>
					
				</div><!-- row -->
			</div>
			<div class="panel-footer">
			  <div class="row">
				<div class="col-sm-9 col-sm-offset-3">
					 <a href="javascript:void(0);" class="btn btn-primary mr5" onclick="save_header('#password','msg_');">
						<i class="fa fa-save"></i>&nbsp;Ubah Password
					</a>
					<button class="btn btn-dark" type="reset"><i class="fa fa-times"></i>&nbsp;Reset</button>&nbsp;<span class="msg_">&nbsp;</span>
				</div>
			  </div>
			</div><!-- panel-footer -->  
		</div><!-- panel -->
    </form>
</div>