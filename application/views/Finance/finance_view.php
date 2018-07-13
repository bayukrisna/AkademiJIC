<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php echo $this->session->flashdata('message');?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pendaftar</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Id Pendaftaran</th>
                  <th>Nama Pendaftar</th>
                  <th>Status Pendaftar</th>
                  <th>Gambar</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($mahasiswa as $data) {
                  $form_konfirmasi = '';
                $form_close = '';
                $form_konfirmasi .= form_open('finance/konfirmasi/'.$data->id_pendaftaran);
                $form_close .= form_close();

                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td name="id_pendaftaran">'.$data->id_pendaftaran.'
                  </td>
                  <td>'.$data->nama_pendaftar.'</td>
                  <td>'.$data->status_bayar.'</td>
                  <td> <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                    Lihat
              </button>
                  </td>
                  <td>
                  <a type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default2">
                    Konfirmasi
              </a>
                  <a href="'.base_url('finance/konfirmasi_gagal/'.$data->id_pendaftaran).'" class="btn btn-success btn-sm" >Data Tidak Valid </a>
                  
                </tr>
                <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
              <div class="modal-body">
                <img src= '.base_url('uploads/'.$data->bukti_transfer.''). '>
              </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" id="modal-default2">
          <div class="modal-dialog">
          '.$form_konfirmasi.'
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
              <div class="form-horizontal">
                <div class="form-group">
                  <div class="col-md-3">
                  <label for="inputEmail3" class="control-label pull-left">ID Daftar Ulang</label>
                </div>
                  <div class="col-md-3">
                    <input type="text" name="id_daftar_ulang" class="form-control input-sm pull-left" id="inputEmail3" placeholder="" required="">
                  </div>
                </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info pull-right">Konfirmasi</button>
              </div>
            </div>
            '.$form_close.'
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
                ' ;
                
              }
              ?>
                </tbody>
              </table>
            </div>
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>