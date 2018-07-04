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
                            <input type="text" class="form-control" wajib="yes" id="periode_bulan" onFocus="ShowA('periode_bulan')" onMouseOver="ShowA('periode_bulan')">
                        </div>
                        <div style="margin-left:17.5%;">
                            <a href="javascript:void(0)" onclick="showTagihan()" class="btn btn-primary" onClick="" /><i class="fa fa-search"></i>&nbsp;Cari</a>
                        </div>
                    </div>
                </div><!-- row -->
            </form>
			<span id="tbl-data"></span>
        </div><!-- panel-body -->  
    </div><!-- panel -->
    
</div>
<script>
	function showTagihan(){
		if($("#periode_bulan").val()==""){
			jAlert('Harap isi periode terlebih dahulu.','Sistem Simpan Pinjam KOPPEDI');
			return false;
		}else{
			$.ajax({
				type: 'POST',
				url: site_url + '/peminjaman/getTagihan',
				data: {'action':'cari','tgl_angsuran':$("#periode_bulan").val()},
				success: function(data){
					$("#tbl-data").html(data);
				}
			});
		}
	}
</script>