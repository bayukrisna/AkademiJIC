<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php echo $this->session->flashdata('message');?>
              <h3 class="box-title">Data Mahasiswa</h3>
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
                foreach ($mahasiswa as $data) {
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
                       <a href="'.base_url('mahasiswa/detail_mahasiswa/'.$data->id_du).'" class="btn btn-info btn-sm">Detail</a>

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