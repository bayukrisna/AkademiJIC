
      <div class="row">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="panel panel-primary">
                        <div class="panel-heading">
                        <i class="fa fa-sign-in"></i> Masuk</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                  <?php echo $this->session->flashdata('message');
                                  $alert = "'Apakah anda yakin mengapus data ini ?'";

                                  ?>
                                    <?php echo form_open('login/login'); ?>
                                                              <div class="form-group">
                                              <label for="email">Alamat Email</label><label for="daftar"></label> <a href="registration"><i>Belum punya akun? daftar DISINI</i></a>
                                              <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email Anda" required>
                                          </div>
                                          <div class="form-group">
                                              <label for="password">Kata Sandi</label> <a href="login/lupa"><i>Lupa?</i></a>
                                              <input type="password" name="password" class="form-control" id="password" placeholder="*****" required>
                                          </div>
                                          <button type="submit" class="btn btn-info">Masuk</button>
                                          <button type="reset" class="btn btn-default">Reset</button>
                                    <?php echo form_close();?>
                            </div></div>
                        </div>
                    </div>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
      <!-- /.row -->
    

