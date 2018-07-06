<div class="row"> 
	<?php echo $this->session->flashdata('message');?>
	<?php echo form_open('pendaftaran/save_pendaftaran'); ?>
	<div class="col-md-12">

	<div class="box box-primary">

		<h3 style="text-align: center;">Form Pendaftaran</h3>
	<div class="box-body">
    <div class="col-md-8"><br>
            <!-- /.box-header -->
            <!-- form start -->
                <div class="form-group">
                  <label for="no">No. Pendaftaran</label>
                  <input type="text" name="id_pendaftaran" class="form-control" id="id_pendaftaran" placeholder="" required .input-sm value="<?= $kodeunik; ?>" readonly>
                </div>
              	<div class="form-group">
              		<label for="email">Nama Pendaftar</label>
              		<input type="text" name="nama_pendaftar" class="form-control" id="nama_pendaftar" placeholder="Masukan Nama Pendaftar" required .input-sm>
              	</div>
              	<div class="form-group">
              		<label for="gender">Asal Sekolah</label>
              		<select id="id_sekolah" name="id_sekolah" class="form-control" required="">
        						<option value="">Pilih Sekolah</option>
        						 <?php 

                        foreach($getPreschool as $row)
                        { 
                          echo '<option value="'.$row->id_sekolah.'">'.$row->nama_sekolah.'</option>';
                        }
                        ?>
					       </select>                                     
              		<!-- <input type ="radio" name = "sex" value="male" required/> Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              		<input type ="radio" name = "sex" value= "female" required/> Female -->
              	</div>
                 <div class="form-group">
                  <label for="major">Jurusan di Sekolah Sebelumnya</label>
                <select id="jurusan" name="jurusan" class="form-control" required="">
                  <option value="">Pilih Jurusan</option>
                  <option value="">IPA</option>
                  <option value="">IPS</option>
                  <option value="">TKJ</option>
                  <option value="">RPL</option>

                </select>                                     
                </div>
              	<div class="form-group">
              		<label for="place">Alamat</label>
              		<input type="text" name="alamat" class="form-control" id="alamat" placeholder="Masukan Alamat" required>
              	</div>

                <div class="form-group">
                  <label for="place">Email</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Masukan Email" required>
                </div>

                 <div class="form-group">
                  <label for="place">No Telepon</label>
                  <input type="number" name="no_telp" class="form-control" id="no_telp" placeholder="Masukan Nomor Telepon" required>
                </div>

                <div class="form-group">
                  <label for="major">Waktu Kuliah</label>
                <select id="jurusan" name="jurusan" class="form-control" required="">
                  <option value="">Pilih Waktu</option>
                  <option value="">Pagi</option>
                  <option value="">Sore</option>

                </select>                                     
                </div>

                <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Daftar</button>
              </div>

              	

              </div>
              
              <!-- /.box-body -->
              
              <!-- /.box-footer -->
              		<?php echo form_close();?>
            
          
	</div>
       