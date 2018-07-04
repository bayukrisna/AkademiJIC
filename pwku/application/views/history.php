<div class="row">
			<div class="col-md-12">
                            <div class="panel">
                                <header class="panel-heading"><i class="fa fa-cart-arrow-down"></i> Riwayat Pesanan Saya
                                </header>
                                <div class="panel-body table-responsive">
                                    <div class="box-tools m-b-15">
										<form method="get" role="form">
											<div class="input-group">
												<input type="text" name="find" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Cari Order ID"/>
												<div class="input-group-btn">
													<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
												</div>
											</div>
										</form>
                                    </div>
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
                                    <div class="table-foot">
                                        <?php echo $pagination ?>
                                    </div>
                                </div>
                            </div>
								</div>
							</div>
						</div>
					</div>