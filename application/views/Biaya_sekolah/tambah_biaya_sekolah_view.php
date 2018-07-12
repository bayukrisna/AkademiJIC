<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Tambah Konsentrasi</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  <?php echo $this->session->flashdata('message');?>
                  <?php echo form_open('master_biaya_sekolah/save_biaya_sekolah'); ?>
                      <div class="form-group">
                        <label for="email">Id Biaya</label>
                        <input type="text" name="id_biaya" class="form-control" id="id_biaya" placeholder="Masukkan Id Konsentrasi" value="<?= $kodeunik; ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="email">Nama Biaya</label>
                        <input type="text" name="nama_biaya" class="form-control" id="nama_biaya" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="email">Jumlah Biaya</label>
                        <input type="number" name="jumlah_biaya" class="form-control" id="jumlah_biaya" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="email">Tahun Akademik</label>
                        <input type="text" name="periode" class="form-control" id="periode" placeholder="ex 2000/2001">
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