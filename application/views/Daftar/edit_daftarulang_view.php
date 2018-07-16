<form  method="post" action="<?php echo base_url(); ?>index.php/daftar_ulang/save_edit_du/<?php echo $du->id_du; ?>" enctype="multipart/form-data">
<div class="row"> 
    <div class="col-md-12">
        <div>
          <div class="panel panel-primary">
            <div class="panel-heading">
            <i class="fa fa-user-plus"></i> Detail Peserta Tes <?php echo $du->nama_du; ?></div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-6">
                  <?php echo $this->session->flashdata('message');?>
      <div class="form-group">
                  <label for="no">No. Daftar Ulang</label>
                  <input type="text" name="no_du" class="form-control" id="no_du" placeholder="" required .input-sm value="<?php echo $du->no_du; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="email">Nama Lengkap</label>
                  <input type="text" name="nama_du" class="form-control" id="nama_du" placeholder="Input Full Name" required value="<?php echo $du->nama_du; ?>">
                </div>
                <div class="form-group">
                  <label for="gender">Jenis Kelamin</label>
                  <select id="gender" name="gender" class="form-control">
            <option value="<?php echo $du->jk_daftar_du; ?>"><?php echo $du->jk_daftar_du; ?></option>
            <option value="laki-laki">Laki - laki</option>
            <option value="perempuan">Perempuan</option>

          </select>                                     
                  
                </div>
                <div class="form-group">
                  <label for="email">Tanggal Lahir</label>
                  <input type="date" name="tgl_lahir_du" class="form-control" id="tgl_lahir_du" required value="<?php echo $du->tgl_lahir_du; ?>">
                </div>
                <div class="form-group">
                  <label for="place">Tempat Lahir</label>
                  <input type="text" name="tpt_lahir_du" class="form-control" id="tpt_lahir_du" placeholder="Input Birth Place" required value="<?php echo $du->tpt_lahir_du; ?>">
                </div>
                <div class="form-group">
                  <label for="religion">Agama</label>
                <select id="agama_du" name="agama_du" class="form-control">
                  <option value="<?php echo $du->agama_du; ?>"><?php echo $du->agama_du; ?></option>
                  <option value="kristen">Kristen</option>
                  <option value="islam">Islam</option>
                  <option value="hindu">Hindu</option>
                  <option value="buddha">Buddha</option>
                  <option value="konghuchu">Konghuchu</option>

                </select>                                     
                </div>
                <div class="form-group">
                  <label for="address">Alamat Rumah</label>
                  <input type="text" name="alamat_du" class="form-control" id="alamat_du" placeholder="Input Home Address" required value="<?php echo $du->alamat_du; ?>">
                </div>
                <div class="form-group">
                  <label for="phone">Nomor Telepon</label>
                  <input type="number" name="no_telp_du" class="form-control" id="no_telp_du" placeholder="Input Phone Number" required value="<?php echo $du->no_telp_du; ?>">
                </div>
                <div class="form-group">
                  <label for="phone">Nomor HP</label>
                  <input type="number" name="no_telpm_du" class="form-control" id="no_telpm_du" placeholder="Input Mobile Phone Number" required value="<?php echo $du->no_telpm_du; ?>">
                </div>

              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email_du" class="form-control" id="email_du" placeholder="Input Email" required value="<?php echo $du->email_du; ?>">
                </div>
                <div class="form-group">
                  <label for="preschool">Asal Sekolah</label>
                  <select id="id_sekolah" name="id_sekolah"class="form-control">
                  <option value="<?php echo $du->id_sekolah; ?>"><?php echo $du->nama_sekolah; ?></option>
                   <?php 

                  foreach($getPreschool as $row)
                  { 
                    echo '<option value="'.$row->id_sekolah.'">'.$row->nama_sekolah.'</option>';
                  }
                  ?>

                </select>   
                </div>
                <div class="form-group">
                  <label for="major">Jurusan Asal Sekolah</label>
                <select id="jurusan" name="jurusan" class="form-control" >
                  <option value="<?php echo $du->jurusan; ?>"><?php echo $du->jurusan; ?></option>
                  <option value="ipa">IPA</option>
                  <option value="ips">IPS</option>
                  <option value="tkj">TKJ</option>
                  <option value="rpl">RPL</option>
                </select>                                     
                </div>
                <div class="form-group">
                  <label for="nik">NIK</label>
                  <input type="number" name="nik_du" class="form-control" id="nik_du" placeholder="Input NIK" required value="<?php echo $du->nik_du; ?>">
                </div>
                <div class="form-group">
                  <label for="mother">Nama Ibu</label>
                  <input type="text" name="ibu_kandung_du" class="form-control" id="ibu_kandung_du" placeholder="Input your mother Name" required value="<?php echo $du->ibu_kandung_du; ?>">
                </div>
                <div class="form-group">
                  <label for="prodi">Program Studi</label>
                  <select id="id_prodi" class="form-control" name="id_prodi" onchange="return get_concentrate(this.value)">
                    <option value="<?php echo $du->id_prodi; ?>"><?php echo $du->nama_prodi; ?></option>   
                     <?php 

                  foreach($getProdi as $row)
                  { 
                    echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
                  }
                  ?>
                  </select>                                     
                </div>
                <div class="form-group">
                  <label for="concentrate">Konsentrasi</label>
                  <select id="concentrate" name="concentrate" class="form-control">
                  <option value="<?php echo $du->id_konsentrasi; ?>"><?php echo $du->nama_konsentrasi; ?></option>
                  </select>                                     
                </div>
                <div class="form-group">
                  <label for="intake">Intake</label>
                  <select id="intake" name="intake" class="form-control" >
                    <option value="<?php echo $du->intake; ?>"><?php echo $du->intake; ?></option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                  </select>                                                                          
                </div>
                <br>
                <br>
                <br>
                <br>
                <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Update</button>
                	</div>
                  
                            </form>
                        </div></div>
                          
                      </div>
                          </div>
                </div>
</div>
<script type="text/javascript">
            function get_concentrate(p) {
                var prodi = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>daftar_ulang/get_concentrate/'+prodi,
                    data: 'prodi='+prodi,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#concentrate").html(msg);

                    }
                });
            }
            // function get_price(p) {
            //     var produk = p;

            //     $.ajax({
            //         url: 'order/order_price/'+produk,
            //         data: 'produk='+produk,
            //         type: 'GET',
            //         dataType: 'html',
            //         success: function(msg) {
            //             var data = msg.split("|");
            //             var harga = data[0] * 1000;
            //             $("#js_hts").html(harga);
            //             $("#js_min").html(data[1]);
            //             $("#js_max").html(data[2]);
            //         }
            //     });
            // };
        </script>