<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Tambah Asal Sekolah</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  <?php echo $this->session->flashdata('message');?>
                  <?php echo form_open('master_asal_sekolah/save_asal_sekolah'); ?>
                      <div class="form-group">
                        <label for="email">Id Sekolah</label>
                        <input type="text" name="id_sekolah" class="form-control" id="id_sekolah" placeholder="Masukkan Id Sekolah" value="<?= $kodeunik; ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="email">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" class="form-control" id="nama_sekolah" placeholder="Masukkan Nama Sekolah" required>
                      </div>
                     
                          <div class="form-group">
                            <label for="email">Alamat Sekolah</label>
                            <input type="text" name="alamat_sekolah" class="form-control" id="alamat_sekolah" placeholder="Masukkan Alamat Sekolah" required>
                      </div>
                      <div class="form-group">
                        <label for="email">Jenis Sekolah</label>
                        <input type="text" name="jenis_sekolah" class="form-control" id="jenis_sekolah" placeholder="Masukkan Jenis Sekolah" required>
                      </div>
                        <br>

                      <button type="submit" class="btn btn-info">Tambah</button>
                      <button type="reset" class="btn btn-default">Reset</button>
                  <?php echo form_close();?>
              </div></div>
            </div>
          </div>
        </div>
          </div>
        </div></div>