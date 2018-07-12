<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Program Studi</h3>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
              <a href="<?php echo base_url() ?>master_prodi/page_tambah_prodi" class="btn btn-info btn-sm" > Tambah Prodi</a> <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Id Prodi</th>
                  <th>Nama Prodi</th>
                  <th>Ketua Prodi</th>
                  <th>Gambar</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($mahasiswa as $data) {
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
                  <a href="'.base_url('finance/konfirmasi/'.$data->id_pendaftaran).'" class="btn btn-success btn-sm" >konfirmasi </a>
                  
                </tr>
                <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                <img style="height:400px;" src= '.base_url('uploads/'.$data->bukti_transfer.''). '>
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
                ';
                
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