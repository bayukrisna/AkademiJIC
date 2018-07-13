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