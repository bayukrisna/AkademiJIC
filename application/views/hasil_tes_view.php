<div class="row"> 
  <?php echo $this->session->flashdata('message');?>
  <?php echo form_open('registration/signup'); ?>
  <div class="col-md-12">

  <div class="box box-primary">
    <div class="form-horizontal">
  <div class="box-body">
    <div class="col-md-6"><br>
            <!-- /.box-header -->
            <!-- form start -->
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left">No Daftar</label>
                </div>
                  <div class="col-md-4">
                    <input type="input" class="form-control input-sm" id="id_pendaftaran2" name="id_pendaftaran2" placeholder="Email" value="<?php echo $hasil_tes->id_pendaftaran; ?>" readonly>
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
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="" value="<?php echo $hasil_tes->nama_pendaftar; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left">Alamat</label>
                </div>
                  <div class="col-md-9">
                    <textarea type="text" class="form-control input-sm" id="inputEmail3" placeholder=""><?php echo $hasil_tes->alamat; ?>
                      </textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left">Kode Pos</label>
                </div>
                  <div class="col-md-3">
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="" >
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left">Email</label>
                </div>
                  <div class="col-md-9">
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="" value="<?php echo $hasil_tes->email; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left">No. Telp</label>
                </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control input-sm" id="inputEmail3" placeholder="" value="<?php echo $hasil_tes->no_telp; ?>">
                  </div>
                </div>
                <div class="box-header with-border">
                  <br>
                <h3 class="box-title">Input Nilai Tes</h3>
                </div>
                <br>
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">Kode Tes</label>
                  </div>
                  <div class="col-md-4">
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="" value="<?= $kodeunik; ?>" readonly>
                  </div>
                </div>
               
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">Nilai</label>
                </div>
                  <div class="col-md-2">
                    <input type="email" id="mtk" name="mtk" class="form-control input-sm" id="inputEmail3" placeholder="MTK" onchange="sum();" >
                  </div>
                  <div class="col-md-2">
                    <input type="email" id="ipa" name="ipa" class="form-control input-sm" id="inputEmail3" placeholder="IPA" onchange="sum()" >
                  </div>
                  <div class="col-md-2">
                    <input type="email" id="bing" name="bing" class="form-control input-sm" id="inputEmail3" placeholder="B.ing" onchange="sum()" >
                  </div> 
                  <div class="col-md-2">
                  <button class=" btn pull-left input-sm ">Input Nilai</button></div>
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
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="" value="<?php echo $hasil_tes->id_sekolah; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">Nama Sekolah</label>
                  </div>
                  <div class="col-md-9">
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="" value="<?php echo $hasil_tes->nama_sekolah; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">Alamat Sekolah</label>
                  </div>
                  <div class="col-md-9">
                    <textarea type="email" class="form-control input-sm" id="inputEmail3" placeholder=""><?php echo $hasil_tes->alamat_sekolah; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">Jenis Sekolah</label>
                  </div>
                  <div class="col-md-2">
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="" >
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
                    <input type="email" id="total_nilai" class="form-control input-sm" id="inputEmail3" placeholder="" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-5">
                  <label for="inputEmail3" class="control-label pull-left">Total Nilai</label>
                  </div>
                  <div class="col-md-5">
                    <input id="nilai" type="number" class="form-control input-sm" id="inputEmail3" placeholder="" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-5">
                  <label for="inputEmail3" class="control-label pull-left">Grade</label>
                  </div>
                  <div class="col-md-2">
                    <input id="grade" type="text" class="form-control input-sm" id="inputEmail3" placeholder="" readonly="">
                  </div>
                </div>
              </div>
        </div></div>
          </div>
      </div>
          </div>
</div>
</div>

        
          <script type="text/javascript">
            
            function sum() {
            var mtk = document.getElementById('mtk').value;
            var ipa = document.getElementById('ipa').value;
            var bing = document.getElementById('bing').value;
            var result = parseInt(mtk) + parseInt(ipa) + parseInt(bing);
            var nilai = result / 9 * 10;
            var pembulatan = nilai.toFixed(2);
            var grade = ""
            if (nilai <= 100){
              grade = "A"
            } else if(nilai <= 75){
              grade = "B"
            } else if(nilai <= 50){
              grade = "C"
            } else {
              grade ="D"
            }

            

            if (!isNaN(result)) {
            document.getElementById('total_nilai').value = result;
            document.getElementById('nilai').value = pembulatan;
            document.getElementById("grade").value = grade;
            }
          }
          function get_jumlah(p) {
                var jumlah = p;

                $.ajax({
                    url: 'hasil_tes/get_jumlah/'+jumlah,
                    data: 'jumlah='+jumlah,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        var data = msg.split("|");
                        var jumlah = data[0] + data[1] + data[2];
                        $("#total_nilai").html(jumlah);
                    }
                });
            };

        </script>
