<div class="panel panel-primary">
									<header class="panel-heading">
										7 Pembayaran Terakhir
									</header>
									<div class="panel-body table-responsive">
										<table class="table table-hover">
											<tr>
											<th>Invoice ID</th>
											<th>Tanggal</th>
											<th>VIA</th>
											<th>Jumlah</th>
											<th>Username</th>
											<th>Detail Pengirim</th>
											<!-- <th>Bukti Pembayaran</th> -->
											<th>Status</th>
                                        </tr>
                                        <?php

                                                foreach ($deposit as $data) {
                                                echo'<tr>
                                                <td>'.$data->id.'</td>';
                                                echo'
                                                <td>'.$data->tanggal.'</td><td>';
                                                if($data->via == "1"){?>
                                                <p>Bank Mandiri</p>
                                                <?php } else { ?>
                                                <p>Pulsa</p>
                                                <?php } 
                                                echo'
                                                </td><td>'.$data->jumlah.'</td>';
                                                echo'
                                                </td><td>'.$data->username.'</td>';
                                                echo'
                                                <td>'.$data->pengirim.'</td>';
                                                
                                                echo' <td>
														'."<img src= '".base_url('uploads/'.$data->gambar.'')." '>".'
														</td><td>';
                                                // echo'
                                                // <td>'.$data->gambar.'</td><td>';
                                                if ($data->status == "paid") { ?>
                                                <!-- <span class="alert alert-success">Tersedia</button> -->
                                                <span class="badge badge-success">
                                                Paid</div>
                                                <?php } else if ($data->status == "pending") { ?>
                                                <span class="badge badge-danger">
                                                Pending</div>
                                                <?php } else if ($data->status == "Pending") { ?>
                                                <button type="button" class="btn btn-sm btn-warning waves-effect waves-light">
                                                <span class="btn-label"><i class="fa fa-ellipsis-h"></i></span>
                                                <?php } else if ($data->status == "Refunded") { ?>
                                                <button type="button" class="btn btn-sm btn-purple waves-effect waves-light">
                                                <span class="btn-label"><i class="fa fa-exchange"></i></span>
                                                <?php } else if ($data->status == "Error") { ?>
                                                <button type="button" class="btn btn-sm btn-danger waves-effect waves-light">
                                                <span class="btn-label"><i class="fa fa-times"></i></span>
                                                <?php } else if ($data->status == "Inserted") { ?>
                                                <button type="button" class="btn btn-sm btn-secondary waves-effect waves-light">
                                                <span class="btn-label"><i class="fa fa-plus"></i></span>
                                                <?php }
                                                '</td>';

                                            '</tr>';
                                                }
                                                ?>
																								</table>
									</div>
								</div>

			<div class="panel panel-primary">
									<div class="panel-heading">
                        <i class="fa fa-sign-in"></i> Masuk</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                  <?php echo $this->session->flashdata('message');?>
                                    <?php echo form_open('dashboard_admin/isi_saldo'); ?>
                                                              <div class="form-group">
                                              <label for="username">username</label><label for="daftar"></label>
                                              <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username" required>
                                          </div>
                                          <div class="form-group">
                                              <label for="saldo">Kata Sandi</label>
                                              <input type="number" name="saldo" class="form-control" id="saldo" placeholder="" required>
                                          </div>
                                          <button type="submit" class="btn btn-info">Masuk</button>
                                          <button type="reset" class="btn btn-default">Reset</button>
                                    <?php echo form_close();?>
                            </div></div>
                        </div>
								</div>