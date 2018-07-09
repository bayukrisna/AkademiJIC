<div class="row"> 
  <?php echo $this->session->flashdata('message');?>
  <div class="col-md-12">
   <div class="box box-primary">
     <div class="box-body">

        <div class="form-group">
          <h3>Pilihan Kelas  : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type ="radio" name = "kelas" value="k_pagi" required onchange="return get_kelas(this.value)"/> Pagi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type ="radio" name = "kelas" value="k_sore" required onchange="return get_kelas(this.value)"/> Sore
          </h3>
        </div><hr>

        <div class="form-group">
          <section id="form_kelas" name="form_kelas" required="">
          </section>
        </div>

     </div>
   </div>
  </div>
</div>
<script type="text/javascript">
            function get_kelas(p) {
                var kelas = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>pendaftaran/get_kelas/'+kelas,
                    data: 'kelas='+kelas,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#form_kelas").html(msg);

                    }
                });
            }
        </script>

        <script type="text/javascript">
            function get_concentrate(p) {
                var prodi = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>daftar_ulang/get_concentrate/'+prodi,
                    data: 'prodi='+prodi,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#concentrate").html(msg);

                    }
                });
            }
            // function get_price(p) {
            //     var produk = p;

            //     $.ajax({
            //         url: 'order/order_price/'+produk,
            //         data: 'produk='+produk,
            //         type: 'GET',
            //         dataType: 'html',
            //         success: function(msg) {
            //             var data = msg.split("|");
            //             var harga = data[0] * 1000;
            //             $("#js_hts").html(harga);
            //             $("#js_min").html(data[1]);
            //             $("#js_max").html(data[2]);
            //         }
            //     });
            // };
        </script>