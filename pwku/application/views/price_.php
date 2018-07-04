<div class="row">
			<div class="col-md-12">
				<div class="alert alert-info"><button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
					<h3 align="center">INFORMASI</h3><hr>
					<p>1. Pilih type layanan sesuai yang akan dibeli. sebelum submit pastikan akun tidak diprivate / link benar. kesalahan submit akan mengakibatkan kerugian dan tidak bisa dicancel ( berlaku jg untuk followers real indo ).<br>
													  2. Pastikan Membaca halaman  <b><font color="red">FAQ</font></b><br>
													  3. Jika ada masalah, silahkan hubungi ADMIN lewat tiket atau chat ke line : @bfam<br>

4. WAJIB MEMBACA NEWS BOX<br>
5. TIKET HANYA DI BALAS SESUAI DENGAN FORMAT ATAU SUBJECT YANG SESUAI . TIDAK SESUAI MAKA TIKET AKAN DI TUTUP!
<br>
<br>
**No Refill, No Refund For SMM Services**</p>                </div>
    <section class="panel">
		<header class="panel-heading"><i class="fa fa-list"></i> Daftar Harga & Layanan B-Fam Panel</header>
                                <div class="panel-body table-responsive">
                                    <div class="box-tools m-b-15">
										<form method="get" role="form">
											<div class="input-group">
												<input type="text" name="find" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Cari"/>
												<div class="input-group-btn">
													<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
												</div>
											</div>
										</form>
                                    </div>
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
    </div></div>