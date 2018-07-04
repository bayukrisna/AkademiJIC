<div class="row" style="margin-bottom:5px;">


							<div class="col-md-3">
								<div class="sm-st clearfix">
									<span class="sm-st-icon st-blue"><i class="fa fa-dollar"></i></span>
									<div class="sm-st-info">
										<span>Rp.<?php echo $user->saldo; ?></span>
										Total Saldo
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="sm-st clearfix">
									<span class="sm-st-icon st-green"><i class="fa fa-shopping-bag"></i></span>
									<div class="sm-st-info">
										<span><?php echo $total_pesanan_sukses; ?></span>
										Total Pesanan Sukses
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="sm-st clearfix">
									<span class="sm-st-icon st-violet"><i class="fa fa-shopping-cart"></i></span>
									<div class="sm-st-info">
										<span><?php echo $total_pesanan; ?></span>
										Total Pesanan
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="sm-st clearfix">
									<span class="sm-st-icon st-red"><i class="fa fa-credit-card"></i></span>
									<div class="sm-st-info">
										<span><?php echo $total_deposit	; ?></span>
										Total Jumlah Deposit
									</div>
								</div>
							</div>

							<div class="col-md-12">

														<div class="alert alert-info">
															<button data-dismiss="alert" class="close close-sm" type="button">
																<i class="fa fa-times"></i>
															</button>
															<h3 align="center">INFORMASI</h3><hr>
															<p>1. Pilih type layanan sesuai yang akan dibeli. sebelum submit pastikan akun tidak diprivate / link benar. kesalahan submit akan mengakibatkan kerugian dan tidak bisa dicancel ( berlaku jg untuk followers real indo ).<br>
													  2. Pastikan Membaca halaman  <b><font color="red">FAQ</font></b><br>
													  3. Jika ada masalah, silahkan hubungi ADMIN lewat tiket atau chat ke line : @bfam<br>

4. WAJIB MEMBACA NEWS BOX<br>
5. TIKET HANYA DI BALAS SESUAI DENGAN FORMAT ATAU SUBJECT YANG SESUAI . TIDAK SESUAI MAKA TIKET AKAN DI TUTUP!
<br>
<br>
**No Refill, No Refund For SMM Services**</p>														</div>
								<div class="panel panel-primary">
									<header class="panel-heading">
										7 Informasi Terakhir
									</header>
									<div class="panel-body">
										<table class="table table-bordered">
											<tr>
												<th>Tanggal</th>
												<th>Bagian</th>
												<th>Info</th>
											</tr>
			
														<tr>
															<td><span class="label label-info">01/12 2017</span></td>
															<td>TOP UP ( ATM/SETOR TUNAI/I - BANKING)</td>
															<td>Semua top up yang menggunakan ATM/SETOR TUNAI/I-BANKING hanya berlaku konfirmasi via UPLOAD BUKTI TRANSFER YANG SAH ( ss mutasi, foto jernih ) , TANPA konfirmasi ke line@.  Selain itu tidak kami konfirmasi.</td>
											</tr>
														<tr>
															<td><span class="label label-info">01/12 2017</span></td>
															<td>TOP UP ( VIA KONTER/INDOMART/ALFAMART )</td>
															<td>Semua top up yang menggunakan KONTER PULSA hanya berlaku konfirmasi via UPLOAD BUKTI NO SN , TANPA konfirmasi ke line@.  Selain itu tidak kami konfirmasi.</td>
											</tr>
														<tr>
															<td><span class="label label-info">01/12 2017</span></td>
															<td>TOP UP ( TRANSFER PULSA )</td>
															<td>NOMOR SAMA SEPERTI TOP UP VIA KONTER . Semua top up yang menggunakan TRANSFER PULSA hanya berlaku konfirmasi via line@ chat , selain itu tidak kami konfirmasi. Jadi setelah TRANSFER PULSA ke nomor di menu isi saldo, langsung hubungi line@ kami => @bfam</td>
											</tr>										</table>
									</div>
								</div>
								<div class="panel panel-primary">
									<header class="panel-heading">
										7 Pesanan Terakhir
									</header>
									<div class="panel-body table-responsive">
										<table class="table table-hover">
											<tr>
												<th>Order ID</th>
												<th>Link</th>
												<th>Order</th>
												<th>Status</th>
												<th>Harga</th>
												<th>Service</th>
												<th>Tanggal</th>
											</tr>
											<?php
                                                foreach ($riwayat as $data) {
                                                echo'<tr>
                                                <td>'.$data->id.'</td>';
                                                echo'
                                                <td>'.$data->link.'</td>';
                                                echo'
                                                <td>'.$data->quantity.'</td><td>';
                                                if ($data->status == "Completed") { ?>
                                                <!-- <span class="alert alert-success">Tersedia</button> -->
                                                <span class="badge badge-success">
                                                Completed</div>
                                                <?php } else if ($data->status == "Processing") { ?>
                                                <button type="button" class="btn btn-sm btn-info waves-effect waves-light">
                                                <span class="btn-label"><i class="fa fa-refresh"></i></span>
                                                <?php } else if ($data->status == "pending") { ?>
                                                <button type="button" class="btn btn-sm btn-warning waves-effect waves-light">
                                                <span class="btn-label"><i class="fa fa-ellipsis-h"></i></span>
                                                <?php } else if ($data->status == "Refunded") { ?>
                                                <button type="button" class="btn btn-sm btn-purple waves-effect waves-light">
                                                <span class="btn-label"><i class="fa fa-exchange"></i></span>
                                                <?php } else if ($data->status == "Pending") { ?>
                                                <span class="badge badge-danger">
                                                Pending</div>
                                                <?php } else if ($data->status == "Inserted") { ?>
                                                <button type="button" class="btn btn-sm btn-secondary waves-effect waves-light">
                                                <span class="btn-label"><i class="fa fa-plus"></i></span>
                                                <?php }
                                                '</td>';
                                                echo'
                                                <td>'.$data->price.'</td>';
                                                echo'
                                                <td>'.$data->service.'</td>';
                                                echo'
                                                <td>'.$data->date.'</td>';

                                            '</tr>';
                                                }
                                                ?>
												
														
																								</table>
									</div>
								</div>
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
									</div>
								</div>
	</div></div>