<div class="col-md-12">
<form method="post" id="laporan" novalidate>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Pencarian Data SHU</h4>
        </div><!-- panel-heading -->
        <div class="panel-body">
            <div class="row">
            	<div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label">Periode Tahun</label>
                    </div><!-- form-group -->
                </div>
				<div class="col-sm-2">
                    <div class="form-group">
                        <select id="periode_tahun" data-placeholder="Pilih Tahun" wajib="yes" class="form-control">
                        	<option value=""></option>
                        	<?php
                        		for ($i = 2010; $i <= date("Y"); $i++)
							    {
							    	$tahun=$i;
							    	echo "<option value='$tahun'>$tahun</option>";
							    }
                        	?>
                        </select>
                    </div><!-- form-group -->
                </div>
			</div>
			<div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label">Jasa Modal</label>
                    </div><!-- form-group -->
                </div>
				<div class="col-sm-2">
                    <div class="form-group">
                        <input type="text" class="form-control" maxlength="4" id="jasa_modal" onkeypress="return intInput(event, /[.0-9]/)">
                    </div><!-- form-group -->
                </div>
			</div>
			<div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label class="control-label">Jasa Pinjam</label>
                    </div><!-- form-group -->
                </div>
				<div class="col-sm-2">
                    <div class="form-group">
                        <input type="text" class="form-control" maxlength="4" id="jasa_pinjam" onkeypress="return intInput(event, /[.0-9]/)">
                    </div><!-- form-group -->
                </div>
            </div>
            <div class="row">
				<div class="col-sm-2">
                    <div class="form-group">
                    </div><!-- form-group -->
                </div>
            	<div class="col-sm-6">
                    <div class="form-group">
                        <a href="javascript:void(0)" onclick="showPelunasan()" class="btn btn-primary" onClick="" /><i class="fa fa-search"></i>&nbsp;Cari</a>
						<button class="btn btn-warning" type="reset"><i class="fa fa-undo"></i>&nbsp;Reset</button>
                    </div><!-- form-group -->
                </div>
            </div><!-- row -->
			<br/>
			<span id="tbl-data"></span>
        </div><!-- panel-body -->  
    </div><!-- panel -->
    </form>
</div>
<script>
	function showPelunasan(){
		if($("#periode_tahun").val()=="" && $("#jasa_pinjam").val()=="" && $("#jasa_modal").val()==""){
			jAlert('Harap isi inputan terlebih dahulu.','Sistem Simpan Pinjam KOPPEDI');
			return false;
		}else{
			$.ajax({
				type: 'POST',
				url: site_url + '/laporan/shu',
				data: {'action':'cari','periode_tahun':$("#periode_tahun").val(),'jasa_modal':$("#jasa_modal").val(),'jasa_pinjam':$("#jasa_pinjam").val()},
				success: function(data){
					$("#tbl-data").html(data);
				}
			});
		}
	}
</script>