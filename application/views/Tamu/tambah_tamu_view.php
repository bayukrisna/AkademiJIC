<div class="row"> 
	<?php echo $this->session->flashdata('message');?>
	<?php echo form_open('tamu/save_tamu'); ?>
	<div class="col-md-12">

	<div class="box box-primary">

		<h3 style="text-align:center">Tambah Tamu</h3>
	<div class="box-body">
    <div class="col-md-6">
            <!-- /.box-header -->
            <!-- form start -->
                <div class="form-group">
                  <label for="no">No. Tamu</label>
                  <input type="text" name="id_pendaftaran" class="form-control" id="id_pendaftaran" placeholder=""  .input-sm value="<?php echo $kodeunik; ?>" readonly required>
                </div>
                <div class="form-group">
                  <label for="email">Nama Lengkap</label>
                  <input type="text" name="nama_pendaftar" class="form-control" id="nama_pendaftar" placeholder="Input Full Name" required="">
                </div>
                <div class="form-group">
                  <label for="gender">Jenis Kelamin</label>
                  <select id="jk_pendaftar" name="jk_pendaftar" class="form-control" ="" required="">
            <option value="">Select Gender</option>
            <option value="laki-laki">Laki - laki</option>
            <option value="perempuan">Perempuan</option>

          </select>                                     
                  
                </div>
                                                
                
                <div class="form-group">
                  <label for="address">Alamat Rumah</label>
                  <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Input Home Address" required="">
                </div>
                <div class="form-group">
                  <label for="phone">Nomor Telepon</label>
                  <input type="number" name="no_telp" class="form-control" id="no_telp" placeholder="Input Phone Number" required="">
                </div>
                   <div class="form-group">
                  <label for="waktu">Waktu</label>
                  <select id="waktu" name="waktu" class="form-control" ="" required="">
                    <option value="">Pilih Waktu Kuliah</option>
                    <option value="Pagi">Pagi</option>
                    <option value="Sore">Sore</option>

                  </select>                                     
                  
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Input Email" required="">
                </div>

                 <div class="form-group">
                  <label for="mother">Nama Ibu</label>
                  <input type="text" name="ibu_kandung" class="form-control" id="ibu_kandung" placeholder="Masukan nama ibu" required="">
                </div>

                <div class="form-group">
                  <label for="preschool">Asal Sekolah</label>
                  <select id="id_sekolah" name="id_sekolah"class="form-control" required="">
                  <option value="">Pilih Sekolah</option>
                  <?php 

                  foreach($getPreschool as $row)
                  { 
                    echo '<option value="'.$row->id_sekolah.'">'.$row->nama_sekolah.'</option>';
                  }
                  ?>

                </select>   
                </div>
                <div class="form-group">
                  <label for="major">Jurusan di Sekolah Sebelumnya</label>
                <select id="jurusan" name="jurusan" class="form-control" ="">
                  <option value="">Pilih Jurusan</option>
                  <option value="ipa">IPA</option>
                  <option value="ips">IPS</option>
                  <option value="tkj">TKJ</option>
                  <option value="rpl">RPL</option>
                </select>                                     
                </div>
               


                <div class="form-group">
                  <label for="prodi">Program Studi</label>
                  <select id="id_prodi" class="form-control" name="id_prodi" ="" onchange="return get_concentrate(this.value)">
                    <option value="">Pilih Program Studi</option>   
                    <?php 

                  foreach($getProdi as $row)
                  { 
                    echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                  }
                  ?>
                  </select>                                     
                </div>   

                <div class="form-group">
                  <label for="major">Sumber Informasi</label>
                <select id="sumber" name="sumber" class="form-control" ="">
                  <option value="">Pilih Sumber</option>
                  <option value="ipa">Brosur</option>
                  <option value="ips">Iklan</option>
                  <option value="tkj">Marketing</option>
                  <option value="rpl">Student get Student</option>
                </select>                                     
                </div>

                <button type="submit" class="btn btn-info pull-right">Daftar</button>
              		<?php echo form_close();?>
            
          
	</div>
            </form>
        </div></div>
          
      </div>
          </div>
</div>
</div>

       