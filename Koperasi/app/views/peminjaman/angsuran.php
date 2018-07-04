<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Pencarian Data Angsuran</h4>
        </div><!-- panel-heading -->
        <div class="panel-body">
			<form action="<?=site_url();?>/peminjaman/set_data" method="post" id="peminjaman" novalidate>
                <div class="row">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Periode<span class="asterisk"></span></label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" wajib="yes" id="tanggal_awal" onFocus="ShowA('tanggal_awal')" onMouseOver="ShowA('tanggal_awal')">
                        </div>
                        <!--<div class="col-sm-2">
                            <input type="text" class="form-control" wajib="yes" id="tanggal_akhir" onFocus="ShowDP('tanggal_akhir')" onMouseOver="ShowDP('tanggal_akhir')" placeholder="Tanggal Akhir">
                        </div>-->
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div style="margin-left:17.5%;">
                            <a href="javascript:void(0)" onclick="showAngsuran()" class="btn btn-primary" onClick="" /><i class="fa fa-search"></i>&nbsp;Cari</a>
                            <button class="btn btn-warning" type="reset"><i class="fa fa-undo"></i>&nbsp;Reset</button>
                        </div>
                    </div>
                </div><!-- row -->
            </form>
			<span id="tbl-data"></span>
        </div><!-- panel-body -->  
    </div><!-- panel -->
</div>
<script>
	function showAngsuran(){
		if($("#tanggal_awal").val()==""){
			jAlert('Harap isi periode terlebih dahulu.','Sistem Simpan Pinjam KOPPEDI');
			return false;
		}/*else if($("#tanggal_akhir").val()==""){
			jAlert('Harap isi periode terlebih dahulu.','Sistem Peminjaman Uang KOPPEDI');
			return false;
			,'tanggal_akhir':$("#tanggal_akhir").val()
		}*/else{
			$.ajax({
				type: 'POST',
				url: site_url + '/peminjaman/getAngsuran',
				data: {'action':'cari','tanggal_awal':$("#tanggal_awal").val()},
				success: function(data){
					$("#tbl-data").html(data);
				}
			});
		}
	}
</script>