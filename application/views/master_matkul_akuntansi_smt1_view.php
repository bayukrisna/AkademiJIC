


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    

    <section class="content-header">
      <h1>
        Data Tables
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            
          <!-- /.box -->

          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Subject Code</th>
                  <th>SUbject Name</th>
                  <th>Credits</th>
                  <th>Dosen</th>
                  <th>Kode</th>
                  <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>

                <?php 
                $no = 0;
                foreach ($akuntansi as $data) {
                  echo '
                  
                <tr>
                  <td>'.++$no.'</td>
                  <td>'.$data->subject_code.'
                  </td>
                  <td>'.$data->subject_name.'</td>
                  <td>'.$data->credits.'</td>
                  <td>'.$data->dosen.'</td>
                  <td>'.$data->kode.'</td>
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
    <!-- /.content -->
  </div>