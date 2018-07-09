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
                  <label for="inputEmail3" class="control-label pull-left">Kode Tes</label>
                </div>
                  <div class="col-md-4">
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="Email">
                  </div>
                    <button type="button" class="col-md-2 btn pull-left input-sm " data-toggle="modal" data-target="#modal-default"><i class="fa fa-fw fa-search"></i>Browse</button>
                  
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputPassword3" class="control-label pull-left">Tanggal</label>
                </div>
                  <div class="col-md-6">
                    <input type="date" class="form-control input-sm" id="inputPassword3" placeholder="Password">
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
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left">Alamat</label>
                </div>
                  <div class="col-md-9">
                    <textarea type="text" class="form-control input-sm" id="inputEmail3" placeholder="">
                      </textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left">Kode Pos</label>
                </div>
                  <div class="col-md-3">
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left">Email</label>
                </div>
                  <div class="col-md-9">
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-2">
                  <label for="inputEmail3" class="control-label pull-left">No HP</label>
                </div>
                  <div class="col-md-6">
                    <input type="number" class="form-control input-sm" id="inputEmail3" placeholder="">
                  </div>
                </div>
                <div class="box-header with-border">
                <h3 class="box-title">Hasil Test</h3>
                </div>
                <br>
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">Kode Jenis Test</label>
                  </div>
                  <div class="col-md-4">
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="">
                  </div>
                  <button class="col-md-2 btn pull-left input-sm "><i class="fa fa-fw fa-search"></i>Browse</button>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">Nama Test</label>
                </div>
                  <div class="col-md-7">
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="">
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
                  <button class=" btn pull-left input-sm ">Submit</button></div>
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
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">Nama Sekolah</label>
                  </div>
                  <div class="col-md-9">
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">Alamat Sekolah</label>
                  </div>
                  <div class="col-md-9">
                    <textarea type="email" class="form-control input-sm" id="inputEmail3" placeholder=""></textarea>
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
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">Jenis Sekolah</label>
                  </div>
                  <div class="col-md-9">
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="">
                  </div>
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
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="" readonly="">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-5">
                  <label for="inputEmail3" class="control-label pull-left">Grade</label>
                  </div>
                  <div class="col-md-2">
                    <input type="email" class="form-control input-sm" id="inputEmail3" placeholder="" readonly="">
                  </div>
                </div>
              </div>
        </div></div>
          </div>
      </div>
          </div>
</div>
</div>

        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                <p>One fine body&hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
          <script type="text/javascript">
            
            function sum() {
            var mtk = document.getElementById('mtk').value;
            var ipa = document.getElementById('ipa').value;
            var bing = document.getElementById('bing').value;
            var result = parseInt(mtk) + parseInt(ipa) + parseInt(bing);
            if (!isNaN(result)) {
            document.getElementById('total_nilai').value = result;
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
