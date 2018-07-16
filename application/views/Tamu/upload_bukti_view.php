<form  method="post" action="<?php echo base_url(); ?>tamu/save_bukti_transfer/<?php echo $edit->id_pendaftaran; ?>" enctype="multipart/form-data">
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Edit Prodi</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  <?php echo $this->session->flashdata('message');?>
                       <div class="form-group">
                            <label>Foto</label> <br>
                            <img style="height:400px;" src="<?php echo base_url(); ?>uploads/<?php echo $edit->bukti_transfer; ?>">
                        </div>
                        <div class="form-group">
                                            <input type="file" id="bukti_transfer" name="bukti_transfer">
                                          </div>
                                        <div>
                      
                      <div class="form-group mb-n">
                  <div class="col-sm-8">
                  <label for="exampleInputFile" class="">    </label>
                    <input type="submit" name="submit" class="btn btn-default" background_color="orange" id="largeinput" placeholder="Large Input" value="Edit">
                  </div>
                </div>      
              </div></div>
            </div>
          </div>
        </div>
          </div>
        </div>
        </form>