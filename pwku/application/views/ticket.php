<div class="row">
			<div class="col-md-12"><div id="mutiara"></div>
    <section class="panel">
		<header class="panel-heading"><i class="fa fa-ticket"></i> Layanan Bantuan Tiket OXGNPANEL</header>
                                <div class="panel-body">
                                    <div class="box-tools m-b-15">
										<form method="get" role="form">
											<div class="input-group">
												<input type="text" name="find" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Cari Subyek"/>
												<div class="input-group-btn">
													<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
												</div>
											</div>
										</form>
                                    </div>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Tiket ID</th>
                                            <th>Subyek</th>
                                            <th>Status</th>
                                            <th>Terakhir Diperbarui</th>
                                        </tr><b>0 hasil yang di temukan.</b>	                                        <tr>
											<td>No Data</td>
											<td>No Data</td>
											<td>No Data</td>
											<td>No Data</td></tr></table><div class="table-foot">
    </div></div></section>
                          <section class="panel">
                              <header class="panel-heading">
                                  <i class="fa fa-ticket"></i> Tiket
                              </header>
                              <div class="panel-body">
					                                  <form role="form" method="post">
                                      <div class="form-group">
                                          <label for="subject">Subyek</label>
                                          <input type="text" class="form-control" id="subject" name="subject" placeholder="Masukkan Subyek" required="required">
                                      </div>
                                      <div class="form-group">
                                          <label for="message">Pesan</label>
                                          <textarea class="form-control" rows="12" id="message" name="message" placeholder="Masalah yang ada di panel ini.." required="required"></textarea>
                                      </div>
									  <input type="hidden" name="csrf" value="2ebbe9eb2b192ff7f373a99d73a5f5fd">
                                      <button type="submit" class="btn btn-info">Kirim</button>
                                  </form>

                              </div>