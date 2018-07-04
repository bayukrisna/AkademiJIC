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
											  <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Input Full Name">
										  </div>
										  <div class="form-group">
										  	<label for="sex">Sex	:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										  <input type ="radio" name = "sex" value="male"/> Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        								  <input type ="radio" name = "sex" value= "female"/> Female
        								</div>
        								<div class="form-group">
											  <label for="email">Place & date of birth</label>
											  <input type="text" name="placedate" class="form-control" id="placedate" placeholder="Input Place & Date of birth">
										  </div>
										  <div class="form-group">
											  <label for="address">Home Address</label>
											  <input type="text" name="address" class="form-control" id="address" placeholder="Input Home Address">
										  </div>
										  <div class="form-group">
											  <label for="phone">Phone Number</label>
											  <input type="number" name="phone" class="form-control" id="phone" placeholder="Input Phone Number">
										  </div>
										  <div class="form-group">
											  <label for="phone">Mobile Phone Number</label>
											  <input type="number" name="mphone" class="form-control" id="mphone" placeholder="Input Mobile Phone Number">
										  </div>
										  <div class="form-group">
											  <label for="religion">Religion</label>
											  <input type="text" name="religion" class="form-control" id="religion" placeholder="Input Religion">
										  </div>
										  <div class="form-group">
											  <label for="preschool">Previous School</label>
											  <input type="text" name="preschool" class="form-control" id="preschool" placeholder="Input Previous School">
										  </div>
										  <div class="form-group">
											  <label for="nik">NIK</label>
											  <input type="number" name="nik" class="form-control" id="nik" placeholder="Input NIK">
										  </div>
										  <h4><b>II. PROGRAM STUDY</b></h4>
										  <ol type="1">
										  <li>Management :</li>
										  <ul>
										  	<input type ="radio" name = "management" value="marketing"/> Marketing Management<br>
										  	<input type ="radio" name = "management" value="finance"/> Finance Management
										  </ul>
										  <li>Accounting :</li>
										  <ul>
										  	<input type ="radio" name = "accounting" value="auditing"/> Auditing<br>
										  	<input type ="radio" name = "accounting" value="taxation"/>Taxation
										  </ul>
										  <li>Time :</li>
										  <ul>
										  	<input type ="radio" name = "time" value="morning"/> Morning<br>
										  	<input type ="radio" name = "time" value="evening"/> Evening
										  </ul>
										  </ol>
										  <h4><b>III. INTAKE</b></h4>
										  <ul>
										  	<input type ="radio" name = "intake" value="february"/> February<br>
										  	<input type ="radio" name = "intake" value="september"/> September<br><br>
										  </ul>
										  <h4><b>IV. BEASISWA</b></h4>
										  <ul>
										  	<input type ="radio" name = "beasiswa" value="grade_a"/> 100% / Grade A<br>
										  	<input type ="radio" name = "beasiswa" value="grade_b"/> 75% / Grade B<br>
										  	<input type ="radio" name = "beasiswa" value="grade_c"/> 50% / Grade C<br><br>
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