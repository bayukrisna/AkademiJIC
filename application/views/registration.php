<div class="row"> 
	<?php echo $this->session->flashdata('message');?>
	<?php echo form_open('registration/signup'); ?>
	<div class="col-md-12">

	<div class="box box-primary">

		<h3 style="text-align:center">Enrolment Form</h3>
	<div class="box-body">
    <div class="col-md-6"><br>
            <!-- /.box-header -->
            <!-- form start -->
                <div class="form-group">
                  <label for="email">No. Pendaftaran</label>
                  <input type="text" name="no_pendaftaran" class="form-control" id="no_pendaftaran" placeholder="" required .input-sm value="<?= $kodeunik; ?>" readonly>
                </div>
              	<div class="form-group">
              		<label for="email">Full Name/NIM</label>
              		<input type="text" name="fullname" class="form-control" id="fullname" placeholder="Input Full Name" required .input-sm>
              	</div>
              	<div class="form-group">
              		<label for="gender">Gender</label>
              		<select id="gender" name="gender" class="form-control" required="">
						<option value="">Select Gender</option>
						<option value="male">Male</option>
						<option value="female">Female</option>

					</select>                                     
              		<!-- <input type ="radio" name = "sex" value="male" required/> Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              		<input type ="radio" name = "sex" value= "female" required/> Female -->
              	</div>
              	<div class="form-group">
              		<label for="email">Date of birth</label>
              		<input type="date" name="date" class="form-control" id="date" required>
              	</div>
              	<div class="form-group">
              		<label for="place">Birth Place</label>
              		<input type="text" name="birth_place" class="form-control" id="birth_place" placeholder="Input Birth Place" required>
              	</div>
              	<div class="form-group">
              		<label for="religion">Religion</label>
              		<input type="text" name="religion" class="form-control" id="religion" placeholder="Input Religion" required>
              	</div>
              	<div class="form-group">
              		<label for="address">Home Address</label>
              		<input type="text" name="address" class="form-control" id="address" placeholder="Input Home Address" required>
              	</div>
              	<div class="form-group">
              		<label for="phone">Phone Number</label>
              		<input type="number" name="phone" class="form-control" id="phone" placeholder="Input Phone Number" required>
              	</div>
              	<div class="form-group">
              		<label for="phone">Mobile Phone Number</label>
              		<input type="number" name="mphone" class="form-control" id="mphone" placeholder="Input Mobile Phone Number" required>
              	</div>
              	<div class="form-group">
              		<label for="email">Email</label>
              		<input type="email" name="email" class="form-control" id="email" placeholder="Input Email" required>
              	</div>

              </div>
              <div class="col-md-6">
          <!-- Horizontal Form -->
          
            <!-- /.box-header -->
            <!-- form start -->
                <br>
                <div class="form-group">
              		<label for="preschool">Previous School</label>
              		<select id="preschool" name="preschool"class="form-control" required="">
                  <option value="">Select Intake</option>
                  <?php 

                  foreach($getPreschool as $row)
                  { 
                    echo '<option value="'.$row->id_sekolah.'">'.$row->nama_sekolah.'</option>';
                  }
                  ?>

                </select>   
              	</div>
              	<div class="form-group">
              		<label for="nik">NIK</label>
              		<input type="number" name="nik" class="form-control" id="nik" placeholder="Input NIK" required>
              	</div>
              	<div class="form-group">
              		<label for="mother">Mother's Name</label>
              		<input type="text" name="mother" class="form-control" id="mother" placeholder="Input Mother's Nmae" required>
              	</div>
              	<div class="form-group">
              		<label for="prodi">Program Study</label>
              		<select id="prodi" class="form-control" name="prodi" required="" onchange="return get_concentrate(this.value)">
              			<option value="">Select Program Study</option>

              			 <?php 

            			foreach($getProdi as $row)
            			{ 
              			echo '<option value="'.$row->id_prodi.'">'.$row->nama_prodi.'</option>';
            			}
            			?>


					</select>                                     
              		<!-- <input type ="radio" name = "sex" value="male" required/> Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              		<input type ="radio" name = "sex" value= "female" required/> Female -->
              	</div>
              	<div class="form-group">
              		<label for="concentrate">Concentrate</label>
              		<select id="concentrate" name="concentrate" class="form-control" required="">
						<option value="">Select Concentrate</option>

					</select>                                     
              		<!-- <input type ="radio" name = "sex" value="male" required/> Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              		<input type ="radio" name = "sex" value= "female" required/> Female -->
              	</div>
              	<div class="form-group">
              		<label for="intake">Intake</label>
              		<select id="intake" name="intake"class="form-control" required="">
						<option value="">Select Intake</option>
						      <?php 

                  foreach($getIntake as $row)
                  { 
                    echo '<option value="'.$row->id_intake.'">'.$row->intake.'</option>';
                  }
                  ?>

					</select>                                     
              		<!-- <input type ="radio" name = "sex" value="male" required/> Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              		<input type ="radio" name = "sex" value= "female" required/> Female -->
              	</div>
              	<div class="form-group">
              		<label for="time">Time</label>
              		<select id="time" name="time" class="form-control" required="">
						<option value="">Select Time</option>
						<option value="morning">Morning</option>
						<option value="evening">Evening</option>

					</select>                                     
              		<!-- <input type ="radio" name = "sex" value="male" required/> Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              		<input type ="radio" name = "sex" value= "female" required/> Female -->
              	</div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
              		<?php echo form_close();?>
            
          
	</div>
            </form>
        </div></div>
          
      </div>
          </div>
</div>
</div>
<script type="text/javascript">
            function get_concentrate(p) {
                var prodi = p;

                $.ajax({
                    url: '<?php echo base_url(); ?>registration/get_concentrate/'+prodi,
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