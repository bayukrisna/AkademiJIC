<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php echo $this->session->flashdata('message');?>
              <h3 class="box-title">Data Daftar Ulang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
             
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Gender</th>
                  <th>Tanggal Lahir</th>
                  <th>Asal Sekolah</th>
                  <th>Nama Prodi</th>
                  <th>Nama Konsentrasi</th>
                  <th>Waktu</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($du as $data) {
                  if ($data->waktu == 'Pagi') {
                       echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->nama_du.'
                  </td>
                  <td>'.$data->jk_daftar_du.'</td>
                  <td>'.$data->tgl_lahir_du.'</td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->nama_konsentrasi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>
                    <a href="'.base_url('index.php/daftar_ulang/detail_du/'.$data->id_du).'" class="btn btn-warning btn-sm" >Detail</a>
                     <a href="'.base_url('index.php/daftar_ulang/print_ljk/'.$data->id_du).'" class="btn btn-info btn-sm" >Print</a>
                  </td>
                </tr>
                ';

                 } else {
                  echo '               
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->nama_du.'
                  </td>
                  <td>'.$data->jk_daftar_du.'</td>
                  <td>'.$data->tgl_lahir_du.'</td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->nama_konsentrasi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>
                    <a href="'.base_url('index.php/daftar_ulang/detail_du/'.$data->id_du).'" class="btn btn-warning btn-sm" >Detail</a>
                  </td>
                </tr>
                ';
                  }
               
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