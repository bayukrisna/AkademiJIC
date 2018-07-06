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
											  <label for="email">Nama Dosen</label>
											  <input type="text" name="nama_dosen" class="form-control" id="nama_dosen" placeholder="Masukkan Subject Code">
										  </div>
										  <div class="form-group">
											  <label for="email">Kode Dosen</label>
											  <input type="text" name="subjectname" class="form-control" id="subjectname" placeholder="Masukkan Nama Lengkap">
										  </div>
										  <div class="form-group">
											  <label for="email">No HP</label>
											  <input type="text" name="credits" class="form-control" id="credits" placeholder="Masukkan Credits">
										  </div>
										  <div class="form-group">
											  <label for="email">keterangan</label>
											  <input type="text" name="semester" class="form-control" id="semester" placeholder="Masukkan Semester">
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