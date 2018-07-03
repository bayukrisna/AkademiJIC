<div class="row"> 
    <div class="col-md-12">
				<div>
					<div class="panel panel-primary">
						<div class="panel-heading">
						<i class="fa fa-user-plus"></i> Daftar</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<?php echo $this->session->flashdata('message');?>
									<?php echo form_open('registration/signup'); ?>
										  <div class="form-group">
											  <label for="email">Username</label>
											  <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username">
										  </div>
										  <div class="form-group">
											  <label for="email">Nama Lengkap</label>
											  <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" placeholder="Masukkan Nama Lengkap">
										  </div>
										  <div class="form-group">
											  <label for="email">Email</label>
											  <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email">
										  </div>
										  <div class="form-group">
											  <label for="email">Password</label>
											  <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Kata Sandi">
										  </div>
										  <button type="submit" class="btn btn-info">Daftar</button>
										  <button type="reset" class="btn btn-default">Reset</button>
									<?php echo form_close();?>
							</div></div>
						</div>
					</div>
				</div>
					</div>
				</div></div>