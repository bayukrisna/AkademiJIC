<div class="col-md-12">
<form action="<?=site_url();?>/laporan/set_data" method="post" id="laporan  " novalidate>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Pencarian Data Simpanan</h4>
        </div><!-- panel-heading -->
        <div class="panel-body">
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><center>Periode Tanggal</center><span class="asterisk"></span></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" wajib="yes" id="periode_bulan" onFocus="ShowDP('periode_bulan')" onMouseOver="ShowDP('periode_bulan')">
                    </div>
                    <label class="col-sm-2 control-label"><center>Sampai Tanggal</center><span class="asterisk"></span></label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" wajib="yes" id="sampai_bulan" onFocus="ShowDP('sampai_bulan')" onMouseOver="ShowDP('sampai_bulan')">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">&nbsp;</label>
                    <div style="margin-left:17.5%;">
                        <br/><a href="javascript:void(0)" onclick="showRekap()" class="btn btn-primary" onClick="" /><i class="fa fa-search"></i>&nbsp;Cari</a>
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
    function showRekap(){
        if($("#periode_bulan").val()=="" || $("#sampai_bulan").val()==""){
            jAlert('Harap isi periode terlebih dahulu.','Sistem Simpan Pinjam KOPPEDI');
            return false;
        }else{
            $.ajax({
                type: 'POST',
                url: site_url + '/laporan/rekap_simpanan',
                data: {'action':'cari','periode_bulan':$("#periode_bulan").val(),'sampai_bulan':$("#sampai_bulan").val()},
                success: function(data){
                    $("#tbl-data").html(data);
                }
            });
        }
    }
</script>