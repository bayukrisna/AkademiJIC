<div class="row"> 
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
            <p>ea</p>
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
                    url: '<?php echo base_url(); ?>daftar/get_kelas/'+kelas,
                    data: 'kelas='+kelas,
                    type: 'GET',
                    dataType: 'html',
                    success: function(msg) {
                        $("#form_kelas").html(msg);

                    }
                });
            }
        </script>