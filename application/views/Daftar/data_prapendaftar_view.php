<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php echo $this->session->flashdata('message');?>
              <h3 class="box-title">Data Pra Pendaftar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
             
                <thead>
                <tr>
                  <th>No</th>
                  <th>No. Pendafataran</th>
                  <th>Nama Pendaftaran</th>
                  <th>Asal Sekolah</th>
                  <th>Jurusan</th>
                  <th>Alamat</th>
                  <th>Email</th>
                  <th>No. Telp</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($pra_pendaftar as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_pendaftaran.'
                  </td>
                  <td>'.$data->nama_pendaftar.'</td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->jurusan.'</td>
                  <td>'.$data->alamat.'</td>
                  <td>'.$data->email.'</td>
                  <td>'.$data->no_telp.'</td>
                  <td>
                     <a href="'.base_url('index.php/pendaftaran/print_pendaftaran/'.$data->id_pendaftaran).'" class="btn btn-warning btn-sm" >Print </a>
                  </td>
                </tr>
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