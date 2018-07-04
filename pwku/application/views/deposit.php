<div class="row">
			<div class="col-md-12">
			    
							<div class="col-md-12">
							    
                            <div class="panel">
                                <header class="panel-heading"><i class="fa fa-clock-o"></i> Riwayat Deposit Via BANK dan MTRONIK Saya
                                </header>
                                <div class="panel-body table-responsive">
                                    <div class="box-tools m-b-15">
										<form method="get" role="form">
											<!-- <div class="input-group">
												<input type="text" name="find" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Cari Invoice ID"/>
												<div class="input-group-btn">
													<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
												</div>
											</div> -->
										</form>
                                    </div>
                                    <table class="table table-hover">
                                        <tr>
											<th>Invoice ID</th>
											<th>Tanggal</th>
											<th>VIA</th>
											<th>Jumlah</th>
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
                                                <td>'.$data->pengirim.'</td><td>';
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
	                                <div class="table-foot">
	                                	<?php echo $pagination ?>
    								</div>
    							</div>
    						</div>
		
								<div class="panel panel-danger">
		<header class="panel-heading"><i class="fa fa-money"></i> Deposit Saldo Via TRANSFER PULSA</header>
									<div class="panel-body">
										<table class="table table-bordered">
												<th>Provider</th>
												<th>Nomor</th>
												<th>Info</th>
											</tr>
			
														<tr>
															<td>TELKOMSEL</td>
															<td>082 213 821 597</td>
															<td>Rate 0.80</td>
											</tr>
														<tr>
															<td>XL/AXIS</td>
															<td>087 752 452 360</td>
															<td>Rate 0.80</td>
											</tr>
														<tr>
															<td>INDOSAT</td>
															<td>085 851 213 031</td>
															<td>Rate 0.80</td>
											</tr>
											</table>
									</div>
								</div>
    <section class="panel panel-primary">
		<header class="panel-heading"><i class="fa fa-money"></i> Deposit Saldo Via BANK dan MTRONIK</header>
                              <div class="panel-body">
							  <?php echo $this->session->flashdata('message');?>
							  <!-- <?php echo form_open('deposit/simpan'); ?> -->
							  <form method="post" id="form-pendaftaran" enctype="multipart/form-data" action="<?php echo base_url(); ?>deposit/simpan">
			<div class="alert alert-info"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>Mohon dana  ditransfer terlebih dahulu</div>                                              
            <div class="form-group">
											  <label for="methode">Metode Pembayaran</label>

									<!-- <select id="layanan_area" class="form-control">
                                            <option>Pilih Layanan</option>
                                            <option value="IG">Instagram Followers</option>
                                            <option value="IGLIKE">Instagram Like</option>
                                            <option value="IGVIEW">Instagram View</option>
                                            <option value="TW">Twitter</option>
                                            <option value="YT">YouTube</option>
                                            <option value="FB">Facebook</option>
                                            <option value="SC">Soundcloud</option>
                                    </select>    -->

									<select id="depositku" name="depositku" class="form-control">
									<option value="0" type="">-- Select Payment Options --</option>
									<option value="1" >[ BANK MANDIRI ] 365201013546530 .a/n Bfam Corporation</option>
									<option value="2" >[ Telkomsel ] 082 213 821 597</option>
                                    <option value="3" >[ XL ] 087 752 452 360</option>
                                    <option value="4" >[ Indosat ] 085 851 213 031</option>

									</select></div>
                                      <div class="form-group">
                                          <label for="deposit">Jumlah Deposit</label>
                                          <input type="number" class="form-control"  id="jumlah" name="jumlah">
                                      </div>
                                    <div class="form-group">
											  <label for="email">Nama Pengirim</label>
											  <input type="text" name="pengirim" class="form-control" id="pengirim" placeholder="Masukkan Nama Pengirim">
									</div>
                                    <div class="form-group">
									<label for="deposit">Unggah Bukti Pembayaran</label>
									<input type="file" id="foto" name="foto" autofocus class="form-control" required />
									</div>
									<br>
                                      <!-- <div class="form-group">
                                          <label for="funds">Saldo Yang Diterima</label>
                                          <span class="form-control" id="funds">0</span>
                                      </div> -->
									  <div class="form-group">
										  <button type="submit" class="btn btn-info">Submit</button>
										</div>
                                  </form>

                              </div>