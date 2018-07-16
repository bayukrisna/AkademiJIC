<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <?php echo $this->session->flashdata('message');?>
              <h3 class="box-title">Data Asal Sekolah</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
              <a href="<?php echo base_url() ?>master_asal_sekolah/page_tambah_asal_sekolah" class="btn btn-info btn-sm" > Tambah Asal Sekolah</a> <br> <br>
                <thead>
                <tr>
                  <th>No</th>
                  <th>Id Sekolah</th>
                  <th>Nama Sekolah</th>
                  <th>Alamat</th>
                  <th>Jenis</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($asal_sekolah as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->id_sekolah.'
                  </td>
                  <td>'.$data->nama_sekolah.'</td>
                  <td>'.$data->alamat_sekolah.'</td>
                  <td>'.$data->jenis_sekolah.'</td>
                  <td>
                      <a href="'.base_url('master_asal_sekolah/edit_asal_sekolah/'.$data->id_sekolah).'" class="btn btn-warning btn-sm" >Edit </a>
                      <a href="'.base_url('master_asal_sekolah/hapus_asal_sekolah/'.$data->id_sekolah).'" class="btn btn-danger btn-sm">Hapus</a>
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