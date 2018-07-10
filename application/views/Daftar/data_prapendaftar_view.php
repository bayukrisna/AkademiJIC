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
                  
                  <th>Email</th>
                  
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($pra_pendaftar as $data) {
                  if ($data->status_tes != 'done') {
                  
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_pendaftaran.'
                  </td>
                  <td>'.$data->nama_pendaftar.'</td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->email.'</td>
                  
                  <td>
                     <a href="'.base_url('index.php/pendaftaran/print_pendaftaran/'.$data->id_pendaftaran).'" class="btn btn-warning btn-sm" >Print </a>
                    
                      <a href="'.base_url('index.php/hasil_tes/index/'.$data->id_pendaftaran).'" class="btn btn-info btn-sm" >Input Nilai</a>
                  </td>
                </tr>
                ';
                
              } else {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_pendaftaran.'
                  </td>
                  <td>'.$data->nama_pendaftar.'</td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->email.'</td>
                  
                  <td>
                     <a href="'.base_url('index.php/pendaftaran/print_pendaftaran/'.$data->id_pendaftaran).'" class="btn btn-warning btn-sm" >Print </a>
                     <a href="'.base_url('index.php/daftar_ulang/index/'.$data->id_pendaftaran).'" class="btn btn-info btn-sm" >Daftar Ulang</a>
                     
                  </td>
                </tr>
                ';

              } }
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