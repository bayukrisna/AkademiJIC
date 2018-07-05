<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Dosen</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Id Prodi</th>
                  <th>Nama Prodi</th>
                  <th>Ketua Prodi</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($prodi as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_prodi.'
                  </td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>'.$data->ketua_prodi.'</td>
                  <td>
                      <a href="'.base_url('index.php/master_prodi/hapus_prodi/'.$data->id_prodi).'" class="btn btn-danger btn-sm">Hapus</a>
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