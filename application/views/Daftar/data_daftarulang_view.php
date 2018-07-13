<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php echo $this->session->flashdata('message');?>
              <h3 class="box-title">Data Peserta Tes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
             
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                 
                 
                  <th>Asal Sekolah</th>
                  <th>Nama Prodi</th>
                  <th>Nama Konsentrasi</th>
                  <th>Waktu</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($du as $data) {
                  if ($data->waktu == 'Pagi') {
                    if ($data->status_du == 'Nilai Kosong') {
                       echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->nama_du.'
                  </td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->nama_konsentrasi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->status_du.'</td>
                  <td>
                    
                     <a href="'.base_url('index.php/daftar_ulang/print_ljk/'.$data->id_du).'" class="btn btn-info btn-sm" >Print</a>
                     <a href="'.base_url('index.php/hasil_tes/page_input_nilai/'.$data->id_du).'" class="btn btn-success  btn-sm" >Nilai</a>
                  </td>
                </tr>
                ';
                  } else {

                      echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->nama_du.'
                  </td>
                 
                
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->nama_konsentrasi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->status_du.'</td>
                  <td>
                    <a href="'.base_url('index.php/daftar_ulang/detail_nilai/'.$data->id_du).'" class="btn btn-warning btn-sm" >Detail</a>
                     <a href="'.base_url('index.php/hasil_tes/print_hasil_tes/'.$data->id_du).'" class="btn btn-info btn-sm" >Hasil Tes</a>
                  </td>
                </tr>
                ';
                }

                 } else {
                  echo '               
                    }
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->nama_du.'
                  </td>
                 
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->nama_konsentrasi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->status_du.'</td>
                  <td>
                  
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