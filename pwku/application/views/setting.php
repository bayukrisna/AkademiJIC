<div class="row">
			<div class="col-md-12">
    <section class="panel">
		<header class="panel-heading"><i class="fa fa-cog"></i> Pengaturan Akun</header>
                              <div class="panel-body">
                                      
									  <h3>Informasi Akun</h3><hr>
									  <div class="form-group">
                                          <label for="firstname">Nama</label>
                                          <input type="text" class="form-control" id="firstname" disabled="disabled" value="<?php echo $user->username; ?>">
                                      </div>
                                      <div class="form-group">
                                          <label for="balance">Saldo</label>
                                          <input type="text" class="form-control" id="balance" disabled="disabled" value="Rp.<?php echo $user->saldo; ?>">
                                      </div>
                                      <div class="form-group">
                                          <label for="reg_date">Registration Date</label>
                                          <input type="text" class="form-control" id="reg_date" disabled="disabled" value="<?php echo $user->date; ?>">
                                      </div>
									  <h3>Ubah Kata Sandi</h3><hr>
                                  <?php echo $this->session->flashdata('message');?>
                                  <?php echo form_open('setting/ganti_password'); ?>
                                      <div class="form-group">
                                          <label for="oldpass">Kata Sandi Lama</label>
                                          <input type="password" class="form-control" id="oldpass" name="oldpass" required="">
                                      </div>
                                      <div class="form-group">
                                          <label for="newpass">Kata Sandi Baru</label>
                                          <input type="password" class="form-control" id="newpass" name="newpass" required="">
                                      </div>
                                      <!-- <div class="form-group">
                                          <label for="confirmnewpass">Konfirmasi Kata Sandi Baru</label>
                                          <input type="password" class="form-control" id="confirmnewpass" name="confirmnewpass">
                                      </div> -->
									  <input type="hidden" name="csrf" value="0430cfcdbb059e0467ddd19882ede21e"/>
									  <div class="form-group">
										  <button type="submit" class="btn btn-info">Masuk</button>
										  <button type="reset" class="btn btn-default">Reset</button>
										</div>
                                  <?php echo form_close();?>

                              </div>
                          </section>
		</div></div>