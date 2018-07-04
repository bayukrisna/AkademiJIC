<div class="row">
			<div class="col-md-6">
    <section class="panel panel-primary">
		<header class="panel-heading"><i class="fa fa-cart-plus"></i> Pesanan Baru</header>
                              <div class="panel-body">
                                <?php echo $this->session->flashdata('message');?>
							  <?php echo form_open('order/order'); ?>
									<div class="form-group">
                                        <label for="produk_area">Layanan</label>

                                        <select id="layanan_area" class="form-control" onchange="return get_produk(this.value)">
                                            <option>Pilih Layanan</option>
                                            <option value="IG">Instagram Followers</option>
                                            <option value="IGLIKE">Instagram Like</option>
                                            <option value="IGVIEW">Instagram View</option>
                                            <option value="TW">Twitter</option>
                                            <option value="YT">YouTube</option>
                                            <option value="FB">Facebook</option>
                                            <option value="SC">Soundcloud</option>
                                        </select>                                     
                                    </div>

                                    <div class="form-group">
										<label for="produk_area">Produk</label>

                                        <select id="produk_area" name="produk_area" class="form-control" onchange="return get_price(this.value)">
											<option value="0">Harap terlebih dahulu pilih layanan</option>
										</select>
                                    </div>

                                    <div class="col-sm-4">

                                        <div class="form-group">
        									<label for="section_area">Harga /1K</label>

                                            <div class="input-group">
        										<span class="input-group-addon">Rp.</span>
        										<span type="text" id="js_hts" class="form-control harga"></span>
        									</div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <div class="form-group">
    										<label for="section_area">Minimum</label>
                                            <span id="js_min" class="form-control minimum" type="text"></span>
                                        </div>
                                    </div>
                                         
                                   <div class="col-sm-4">
                                        <div class="form-group">
    										<label for="section_area">Maksimum</label>
                                            <span id="js_max" class="form-control maksimum" type="text"></span>
                                        </div>

                                    </div>
                                    
                                    <div class="col-sm-12">
                                        <div class="form-group">
										    <label for="section_area">Data</label>
                                            <input id="link" name="link" class="form-control" type="text">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
											<label for="section_area">Jumlah</label>
                                            <input id="total_area" onkeyup="getcut(this.value).value;"  name="total_area"  class="form-control" type="number">
                                        </div>

                                        <div class="checkbox">
    									   <label>
    										  <input type="checkbox" class="styled" required>
    										      Dengan klik ini kamu sudah membaca Peraturan <b>SEBELUM ORDER</b>
    									   </label>
    								    </div>
                                        
                                        <div class="form-group">
    										<button type="submit" class="btn btn-info">Submit</button>
    										<button type="reset" class="btn btn-warning">Reset</button>
    									</div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
											<label for="section_area">Total Harga</label>
                                            <div class="input-group">
												<span class="input-group-addon">Rp.</span>
												<span type="text" id="js_price" class="form-control"></span>
											</div>
                                        </div>
                                    </div>
							        
                                    <Input type="hidden" name="csrf" value="a42c5df8cc8e79772d7d7c06288bb03b"/>
                                <?php echo form_close(); ?>
                                </div>
    </section>
        </div>
        
        <div class="col-sm-6">
            <section class="panel panel-primary">
		      <header class="panel-heading"><i class="fa fa-user"></i> PERATURAN</header>
                <div class="panel-body">
                    <p><i><span style="color: red;">FYI</span> : <br>
                        1. Please do not use more than one server at the same time for the same page. We cannot give you correct followers/likes number in that case. We will not refund for these orders. Please keep attention!<br>
                        2. After sending orders, if you delete your page/account or change it to private or change username , We will not refund for this cases. Please keep attention!<br>
                        3. If you order on our panel for a account, please don't order any other panel for that same account.There no refund or no excuse will be accepted.</i></p>
                    <p>Berikut beberapa contoh data yang disesuaikan dengan produk :</p>
                   <ul>												
						<li>Instagram Likes/Views Video : <b>https://www.instagram.com/p/BDnpC6dAB9U/</b></li>
						<li>Instagram Followers : <b>https://www.instagram.com/aldirahmanws | atau usernamee :  aldirahmanws ( samakan dengan perintah )</b></li>
						<li>Facebook Likes : <b>https://www.facebook.com/aldirahmanws/posts/1753519224884662</b></li>
				    </ul>											    
                    <p>Pilih type layanan sesuai yang akan dibeli. sebelum submit pastikan akun tidak diprivate / link benar. <br>kesalahan submit akan mengakibatkan kerugian dan tidak bisa dicancel.</p> <br>
                    <center><b><span style="color: red;"><font size="3">ada masalah ? 
                    <br> kirim tiket atau email<br>
                    <br> <div class="line-it-button" style="display: none;" data-lang="en" data-type="friend" data-lineid="@oxgncorp" data-count="true" data-home="true"></div>

                    <br> SERVING WITH LOVE , SUCCESS WITH US</font></span></b>
                </div>


        <script type="text/javascript">
            function get_produk(p) {
                var layanan = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>order/order_coba/'+layanan,
                    data: 'layanan='+layanan,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#produk_area").html(msg);

                    }
                });
            }
            function get_price(p) {
                var produk = p;

                $.ajax({
                    url: 'order/order_price/'+produk,
                    data: 'produk='+produk,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        var data = msg.split("|");
                        var harga = data[0] * 1000;
                        $("#js_hts").html(harga);
                        $("#js_min").html(data[1]);
                        $("#js_max").html(data[2]);
                    }
                });
            };

         function getcut(quantity) {
            var rate = $("#js_hts").html() / 1000;
            // alert(quantity);
            var hasil = eval(quantity) * rate;
            $('#js_price').html(hasil);
        }
        </script>