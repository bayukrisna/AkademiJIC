<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php echo $this->session->flashdata('message');?>
              <h3 class="box-title">Data Tamu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                 <a href="tamu/page_tambah_tamu" class="btn btn-info btn-sm" > Tambah Tamu</a> <br> <br>
             
                <thead>
                <tr>
                  <th>No</th>
                  <th>No. Tamu</th>
                  <th>Nama Tamu</th>
                  <th>Asal Sekolah</th>
                  <th>Minat Prodi</th>
                  <th>Waktu</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($tamu as $data) {
                  if ($data->status_bayar == 'Belum bayar') {
                  
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_pendaftaran.'
                  </td>
                  <td>'.$data->nama_pendaftar.'</td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->status_bayar.'</td>
                  
                  <td>
                     <a href="'.base_url('tamu/hapus_tamu/'.$data->id_pendaftaran).'" class="btn btn-danger btn-sm">Hapus</a>
                     <a href="'.base_url('tamu/page_upload/'.$data->id_pendaftaran).'" class="btn btn-info btn-sm">Upload</a>
                  

                  </td>
                </tr>
                ';
                
              } else if ($data->status_bayar == 'Lunas') {
                if ($data->waktu == 'Pagi') {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_pendaftaran.'
                  </td>
                  <td>'.$data->nama_pendaftar.'</td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->status_bayar.'</td>
                  
                  <td>
                     
                  <a href="'.base_url('daftar_ulang/page_du_pagi/'.$data->id_pendaftaran).'" class="btn btn-info btn-sm">Daftar Ulang</a>

                  </td>
                </tr>
                ';
                }
                else {
                   echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_pendaftaran.'
                  </td>
                  <td>'.$data->nama_pendaftar.'</td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->status_bayar.'</td>
                  
                  <td>
                      <a href="'.base_url('daftar_ulang/page_du_sore/'.$data->id_pendaftaran).'" class="btn btn-info btn-sm">Daftar Ulang</a>
                     
                  </td>
                </tr>
                ';
                }
              
              ?>

              <?php
            } else {
                   echo '
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_pendaftaran.'
                  </td>
                  <td>'.$data->nama_pendaftar.'</td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->waktu.'</td>
                  <td>'.$data->status_bayar.'</td>
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