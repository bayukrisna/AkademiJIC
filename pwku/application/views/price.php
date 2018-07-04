<div class="row"> 
    <div class="col-md-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading"><i class="fa fa-list"></i> List Harga B-Fam</div>
                                        <div class="panel-body table-responsive">
                    <h4 align="center">Daftar Harga dan Informasi Layanan B-Fam</h4><hr>
                                    <table class="table table-hover">
                                        <tr>
                                          <th>ID Layanan</th>
                                          <th>Nama Layanan</th>
                                          <th>Min</th>
                                          <th>Maks</th>
                                          <th>Status</th>
                                          <th>Harga /1K</th>
                                        </tr>
                                        <?php
                                                foreach ($harga as $data) {
                                                echo'<tr>
                                                <td>'.$data->provider_id.'</td>';
                                                echo'
                                                <td>'.$data->service.'</td>';
                                                echo'
                                                <td>'.$data->min.'</td>';
                                                echo'
                                                <td>'.$data->max.'</td><td>';
                                                if ($data->status == "Tersedia") { ?>
                                                <!-- <span class="alert alert-success">Tersedia</button> -->
                                                <span class="badge badge-success">
                                                Tersedia</span>
                                                <?php } else { ?>
                                                <span class="badge badge-danger">
                                                Tidak Tersedia</div>
                                                <?php }
                                                '</td>';
                                                echo'
                                                <td>'.$data->rate * 1000 .'</td>';

                                            '</tr>';
                                                }
                                                ?>

                                      </table>
                                      <div class="table-foot">
                                        <?php echo $pagination ?>
                                      </div>
                                  </div>
          </div></div>
        </div>
      </div>