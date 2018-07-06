<div class="row"> 
    <div class="col-md-12">
				<div>
					<div class="panel panel-primary">
						<div class="panel-heading">
						<i class="fa fa-user-plus"></i> Daftar</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
									<?php echo $this->session->flashdata('message');?>
									<?php echo form_open('registration/signup'); ?>
									<h4><b>I. PERSONAL DATA</b></h4>
										  <div class="form-group">
											  <label for="email">Full Name/NIM</label>
											  <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Input Full Name" required>
										  </div>
										  <div class="form-group">
										  	<label for="sex">Sex	:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  <select id="layanan_area" class="form-control" required="">
						<option value="">Select Gender</option>
						<option value="male">Male</option>
						<option value="female">Female</option>

					</select>                          
        								</div>
        								
        								<div class="form-group">
											  <label for="email">Place & date of birth</label>
											  <input type="text" name="placedate" class="form-control" id="placedate" placeholder="Input Place & Date of birth" required>
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
											  <label for="religion">Religion</label>
											  <input type="text" name="religion" class="form-control" id="religion" placeholder="Input Religion" required>
										  </div>
										  <div class="form-group">
											  <label for="preschool">Previous School</label>
											  <input type="text" name="preschool" class="form-control" id="preschool" placeholder="Input Previous School" required>
										  </div>
										  <div class="form-group">
											  <label for="nik">NIK</label>
											  <input type="number" name="nik" class="form-control" id="nik" placeholder="Input NIK" required>
										  </div>
										  <h4><b>II. PROGRAM STUDY</b></h4>
										  <ol type="1">
										  <li>Management :</li>
										  <ul>
										  	<input type ="radio" name = "management" value="marketing" required/> Marketing Management<br>
										  	<input type ="radio" name = "management" value="finance" required/> Finance Management
										  </ul>
										  <li>Accounting :</li>
										  <ul>
										  	<input type ="radio" name = "accounting" value="auditing" required/> Auditing<br>
										  	<input type ="radio" name = "accounting" value="taxation" required/>Taxation
										  </ul>
										  <li>Time :</li>
										  <ul>
										  	<input type ="radio" name = "time" value="morning" required/> Morning<br>
										  	<input type ="radio" name = "time" value="evening" required/> Evening
										  </ul>
										  </ol>
										  <h4><b>III. INTAKE</b></h4>
										  <ul>
										  	<input type ="radio" name = "intake" value="february" required/> February<br>
										  	<input type ="radio" name = "intake" value="september" required/> September<br><br>
										  </ul>
										  <h4><b>IV. BEASISWA</b></h4>
										  <ul>
										  	<input type ="radio" name = "beasiswa" value="grade_a" required/> 100% / Grade A<br>
										  	<input type ="radio" name = "beasiswa" value="grade_b" required/> 75% / Grade B<br>
										  	<input type ="radio" name = "beasiswa" value="grade_c" required/> 50% / Grade C<br><br>
										  </ul>
										  <button type="submit" class="btn btn-info">Daftar</button>
										  <button type="reset" class="btn btn-default">Reset</button>
									<?php echo form_close();?>
							</div></div>
						</div>
					</div>
				</div>
					</div>
				</div></div>