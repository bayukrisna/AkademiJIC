<form  method="post" action="<?php echo base_url(); ?>master_biaya_sekolah/save_edit_biaya_sekolah/<?php echo $edit->id_biaya; ?>" enctype="multipart/form-data">
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Tambah konsentrasi</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  <?php echo $this->session->flashdata('message');?>
                      <div class="form-group">
                        <label for="email">Id Biaya</label>
                        <input type="text" name="id_biaya" class="form-control" id="id_biaya" placeholder="Masukkan Id konsentrasi" value="<?php echo $edit->id_biaya; ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="email">Nama Biaya</label>
                        <input type="text" name="nama_biaya" class="form-control" id="nama_biaya" placeholder="Masukkan Nama konsentrasi" value="<?php echo $edit->nama_biaya; ?>">
                      </div>
                      <div class="form-group">
                        <label for="email">Jumlah Biaya</label>
                        <input type="text" name="jumlah_biaya" class="form-control" id="jumlah_biaya" placeholder="Masukkan Nama konsentrasi" value="<?php echo $edit->jumlah_biaya; ?>">
                      </div>
                      <div class="form-group">
                        <label for="email">Tahun Akademik</label>
                        <input type="text" name="periode" class="form-control" id="periode" placeholder="Masukkan Nama konsentrasi" value="<?php echo $edit->periode; ?>">
                      </div>
                      </div>
                        <br>
                       <div class="form-group mb-n">

                  <div class="col-sm-8">
                  <label for="exampleInputFile" class="">    </label>
                    <input type="submit" name="submit" class="btn btn-iinfo" background_color="orange" id="largeinput" placeholder="Large Input" value="Update">
                  </div>
               
              </div></div>
            </div>
          </div>
        </div>
          </div>
        </div></div>
        </form>