<div class="col-md-12">
<form action="<?=site_url();?>/peminjaman/set_data" method="post" id="peminjaman" novalidate>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Pencarian Data Pelunasan</h4>
        </div><!-- panel-heading -->
        <div class="panel-body">
            <div class="row">
				<div class="form-group">
                    <label class="col-sm-3 control-label">Anggota </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="NAMA" disabled="disabled">
                    </div>
					<div class="col-sm-1">
						<input type="button" name="cari" id="cari" class="btn btn-small btn-primary" onclick="tb_search('pelunasan','ID_ANGGOTA;NAMA','Pencarian Anggota',this.form.id,650,470)" value="...">
						<input type="hidden" name="DATA[ID_ANGGOTA]" id="ID_ANGGOTA"/>
					</div>
                </div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-5">
						<a href="javascript:void(0)" onclick="showPelunasan()" class="btn btn-primary" onClick="" /><i class="fa fa-search"></i>&nbsp;Cari</a>
						<button class="btn btn-warning" type="reset"><i class="fa fa-undo"></i>&nbsp;Reset</button>
					</div>
				</div>
            </div><!-- row -->
			<span id="tbl-data"></span>
        </div><!-- panel-body -->  
    </div><!-- panel -->
    </form>
</div>
<script>
	function showPelunasan(){
		if($("#periode_bulan").val()==""){
			jAlert('Harap isi periode terlebih dahulu.','Sistem Simpan Pinjam KOPPEDI');
			return false;
		}else{
			$.ajax({
				type: 'POST',
				url: site_url + '/peminjaman/getPelunasan',
				data: {'action':'cari','ID_ANGGOTA':$("#ID_ANGGOTA").val()},
				success: function(data){
					$("#tbl-data").html(data);
				}
			});
		}
	}
</script>