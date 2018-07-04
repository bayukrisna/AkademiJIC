<section>
	<div class="panel panel-signin">
		<div class="panel-body">
			<div class="logo text-center">
				<img src="<?=base_url();?>img/koppedi.jpg" width="200px" alt="Chain Logo" >
			</div>
			<br />
            <h4 class="text-center mb5">Sign in to your account</h4>
            <p class="text-center">Sistem Simpan Pinjam KOPPEDI</p>
			<div class="mb30"></div>
			<form name="frmLogin" id="frmLogin" onsubmit="javascript:return login()" autocomplete=off action="<?= site_url(); ?>/login/ceklogin/<?= $this->session->userdata('session_id'); ?>" method="post">
				<div class="input-group mb15">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input type="text" class="form-control" placeholder="Username" name="_usr" id="_usr">
				</div><!-- input-group -->
                <div class="input-group mb15">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	                <input type="password" class="form-control" placeholder="Password" name="_pass" id="_pass">
                </div><!-- input-group -->
				<div class="input-group mb15">
                    <span class="input-group-addon">
						<img src="<?= base_url(); ?>app/libraries/captcha/captcha.php" alt="" id="captcha"  height="25" onClick="change_captcha()" style="cursor:pointer" title="Klik untuk merubah kode"/>
					</span>
	                <input type="text" placeholder="Key Code" id="_code" name="_code" class="form-control">
                </div><!-- input-group -->
				
                <div class="clearfix">
                    <div class="pull-right">
                   		<button class="btn btn-success" onClick="javascript:return login()">Sign In <i class="fa fa-angle-right ml5"></i></button>
                    </div>
				</div>
                <br />
                <span id="notify"></span>              
			</form>
		</div>
 	</div>
</section>