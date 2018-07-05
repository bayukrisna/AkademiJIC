<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Tambah Dosen</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  <?php echo $this->session->flashdata('message');?>
                  <?php echo form_open('master_dosen/save_dosen'); ?>
                      <div class="form-group">
                        <label for="email">Nama Dosen</label>
                        <input type="text" name="nama_dosen" class="form-control" id="nama_dosen" placeholder="Masukkan Nama Dosen">
                      </div>
                      <div class="form-group">
                        <label for="email">Kode Dosen</label>
                        <input type="text" name="kode_dosen" class="form-control" id="kode_dosen" placeholder="Masukkan Kode Dosen">
                      </div>
                      <div class="form-group">
                        <label for="email">No HP</label>
                        <input type="number" name="no_hp" class="form-control" id="no_hp" placeholder="Masukkan No HP">
                      </div>
                      <div class="form-group">
                        <label for="email">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Masukkan Keterangan">
                      </div>
                      <button type="submit" class="btn btn-info">Tambah</button>
                      <button type="reset" class="btn btn-default">Reset</button>
                  <?php echo form_close();?>
              </div></div>
            </div>
          </div>
        </div>
          </div>
        </div></div>