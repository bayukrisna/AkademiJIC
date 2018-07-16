<form  method="post" action="<?php echo base_url(); ?>master_asal_sekolah/save_edit_asal_sekolah/<?php echo $edit->id_sekolah; ?>" enctype="multipart/form-data">
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Update Asal Sekolah</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  <?php echo $this->session->flashdata('message');?>
                      <div class="form-group">
                        <label for="email">Id Sekolah</label>
                        <input type="text" name="id_sekolah" class="form-control" id="id_sekolah" placeholder="Masukkan Id konsentrasi" value="<?php echo $edit->id_sekolah; ?>" readonly>
                      </div>
                      <div class="form-group">
                        <label for="email">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" class="form-control" id="nama_sekolah" placeholder="Masukkan Nama Sekolah" value="<?php echo $edit->nama_sekolah; ?>">
                      </div> 
                      <div class="form-group">
                        <label for="email">ALamat Sekolah</label>
                        <input type="text" name="alamat_sekolah" class="form-control" id="alamat_sekolah" placeholder="Masukkan Nama konsentrasi" value="<?php echo $edit->alamat_sekolah; ?>">
                      </div>
                      <div class="form-group">
                        <label for="email">Jenis Sekolah</label>
                        <input type="text" name="jenis_sekolah" class="form-control" id="jenis_sekolah" placeholder="Masukkan Nama konsentrasi" value="<?php echo $edit->jenis_sekolah; ?>">
                      </div>

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