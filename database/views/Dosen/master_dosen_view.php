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
                  <th>Nama Dosen</th>
                  <th>Kode Dosen</th>
                  <th>No. HP</th>
                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($dosen as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->nama_dosen.'
                  </td>
                  <td>'.$data->kode_dosen.'</td>
                  <td>'.$data->no_hp.'</td>
                  <td>'.$data->keterangan.'</td>
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