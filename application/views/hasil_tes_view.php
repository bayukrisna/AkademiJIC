<div class="row"> 
  <?php echo $this->session->flashdata('message');?>
  <?php echo form_open('hasil_tes/save_hasil_tes'); ?>
  <div class="col-md-12">

  <div class="box box-primary">
    <div class="form-horizontal">
  <div class="box-body">
    <div class="col-md-6"><br>
            <!-- /.box-header -->
            <!-- form start -->
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left">Kode Tes</label>
                </div>
                  <div class="col-md-4">
                    <input type="input" class="form-control input-sm" id="id_hasil_tes" name="id_hasil_tes" placeholder="Email" value="<?php echo $hasil_tes->kode_tes; ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                 
                </div>
                  <div class="col-md-6">
                   
                  </div>
                </div>
                <div class="box-header with-border">
                <h3 class="box-title">Data Personal</h3>
                </div>
                <br>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left">Nama</label>
                </div>
                  <div class="col-md-9">
                    <input type="text" name="nama_du" class="form-control input-sm" id="inputEmail3" placeholder="" value="<?php echo $hasil_tes->nama_du; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left">Alamat</label>
                </div>
                  <div class="col-md-9">
                    <textarea type="text" class="form-control input-sm" id="inputEmail3" placeholder=""><?php echo $hasil_tes->alamat_du; ?>
                      </textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left">Kode Pos</label>
                </div>
                  <div class="col-md-3">
                    <input type="text" class="form-control input-sm" id="inputEmail3" placeholder="" >
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left">Email</label>
                </div>
                  <div class="col-md-9">
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="" value="<?php echo $hasil_tes->email_du; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left">No. Telp</label>
                </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control input-sm" id="inputEmail3" placeholder="" value="<?php echo $hasil_tes->no_telp_du; ?>">
                  </div>
                </div>
                <div class="box-header with-border">
                  <br>
                <h3 class="box-title">Input Nilai Tes</h3>
                </div>
                <br>
                <div class="form-group">
                  
                </div>
               
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">Nilai</label>
                </div>
                  <div class="col-md-2">
                    <input type="text" id="mtk" name="mtk" class="form-control input-sm"  placeholder="MTK" onkeyup="sum();" >
                  </div>
                  <div class="col-md-2">
                    <input type="text" id="psikotes" name="psikotes" class="form-control input-sm"  placeholder="PSIKOTES" onkeyup="sum()" >
                  </div>
                  <div class="col-md-2">
                    <input type="text" id="bing" name="bing" class="form-control input-sm"  placeholder="B.ing" onkeyup="sum()" >
                  </div> 
                  <div class="col-md-2">
                  <button  class=" btn pull-left input-sm ">Input Nilai</button></div>
                </div>
                  

              </div>
              <div class="col-md-6">
          <!-- Horizontal Form -->
          
            <!-- /.box-header -->
            <!-- form start --><br>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left"></label>
                </div>
                  <div class="col-md-4">
                  </div>
                  
                    <div class="col-md-2 btn pull-left input-sm "></div>
                  
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left"></label>
                </div>
                  <div class="col-md-4">
                  </div>
                  
                    <div class="col-md-2 btn pull-left input-sm "></div>
                  
                </div>
                <div class="box-header with-border">
                <h3 class="box-title">Data Sekolah</h3>
                </div>
                <br>
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">Kode Sekolah</label>
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm" id="inputEmail3" placeholder="" value="<?php echo $hasil_tes->id_sekolah; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">Nama Sekolah</label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" class="form-control input-sm" id="inputEmail3" placeholder="" value="<?php echo $hasil_tes->nama_sekolah; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">Alamat Sekolah</label>
                  </div>
                  <div class="col-md-9">
                    <textarea type="text" class="form-control input-sm" id="inputEmail3" placeholder=""><?php echo $hasil_tes->alamat_sekolah; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">Jenis Sekolah</label>
                  </div>
                  <div class="col-md-2">
                    <input type="text" class="form-control input-sm" id="inputEmail3" placeholder="" >
                  </div>
                </div>
                <br><br>
                 <div class="box-header with-border">
                  <br>
                <h3 class="box-title">Keterangan Grade</h3>
                </div>
                
                <div class="bg-gray disabled color-palette col-md-12"><br>
                <div class="form-group">
                  <div class="col-md-5">
                  <label for="inputEmail3" class="control-label pull-left">Total Jawaban Benar</label>
                  </div>
                  <div class="col-md-5">
                    <input type="text" name="total_jawaban" id="total_jawaban" class="form-control input-sm" id="inputEmail3" placeholder="" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-5">
                  <label for="inputEmail3" class="control-label pull-left">Total Nilai</label>
                  </div>
                  <div class="col-md-5">
                    <input id="nilai" name="nilai" type="number" class="form-control input-sm" id="inputEmail3" placeholder="" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-5">
                  <label for="inputEmail3" class="control-label pull-left">Ranking</label>
                  </div>
                  <div class="col-md-5">
                    <input id="grade" name="grade" type="text" class="form-control input-sm" placeholder="" readonly="">
                  </div>
                </div>
              </div>
        </div></div>
          </div>
      </div>
          </div>
</div>

</div>
<?php echo form_close(); ?>
        
         <script type="text/javascript">
            
            function sum() {
            var mtk = document.getElementById('mtk').value;
            var bing = document.getElementById('bing').value;
            var psikotes = document.getElementById('psikotes').value;
            var result = parseInt(mtk) + parseInt(psikotes) + parseInt(bing);
            var nilai = result / 9 * 10;
            var pembulatan = nilai.toFixed(1);
            var grade = ""
            if (nilai <= 75){
              grade = "Non-Beasiswa"
            } else if(nilai <= 79.9){
              grade = "Ranking 3"
            } else if(nilai <= 89.9){
              grade = "Ranking 2"
            } else {
              grade ="Ranking 1"
            }
            if (!isNaN(result)) {
            document.getElementById('total_jawaban').value = result;
            document.getElementById('nilai').value = pembulatan;
            document.getElementById("grade").value = grade;
            }
          }
        </script>
