<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php echo $this->session->flashdata('message');?>
              <h3 class="box-title">Data Konsentrasi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
              <a href="<?php echo base_url() ?>master_konsentrasi/page_tambah_konsentrasi" class="btn btn-info btn-sm" > Tambah Konsentrasi</a> <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Id Konsentrasi</th>
                  <th>Nama Konsentrasi</th>
                  <th>Nama Prodi</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($konsentrasi as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_konsentrasi.'
                  </td>
                  <td>'.$data->nama_konsentrasi.'</td>
                  <td>'.$data->nama_prodi.'</td>
                  <td>
                      <a href="'.base_url('master_konsentrasi/edit_konsentrasi/'.$data->id_konsentrasi).'" class="btn btn-warning btn-sm" >Edit </a>
                      <a href="'.base_url('master_konsentrasi/hapus_konsentrasi/'.$data->id_konsentrasi).'" class="btn btn-danger btn-sm">Hapus</a>
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