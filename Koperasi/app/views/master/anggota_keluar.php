<?php
?>
<div class="col-md-12">
<form action="<?=site_url();?>/master/set_data/anggota/keluar" method="post" id="keluar" novalidate>
	<input type="hidden" readonly name="act" id="act" value="<?=$act?>" />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Form Pengunduran Diri Anggota</h4>
            <p>Keterangan : <span style="color:red">*</span> adalah form input yg wajib diisi</p>
        </div><!-- panel-heading -->
        <div class="panel-body">
            <div class="row">
				<div class="form-group">
					<label class="col-sm-3 control-label">NIK</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" value="<?=$data["NIK"]?>" name="NIK" wajib="yes" readonly="readonly">
					</div>
				</div><!-- form-group -->
              
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Anggota</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="<?=$data["NAMA_ANGGOTA"]?>" readonly="readonly">
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">Jabatan Anggota</label>
                    <div class="col-sm-5">
						<input type="text" class="form-control" value="<?=$data["JABATAN"]?>" readonly="readonly">
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">Alamat Rumah</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" readonly="readonly"><?=$data["ALAMAT_ANGGOTA"]?></textarea>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">Alasan Keluar<span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <textarea class="form-control" wajib="yes" maxlength="255" name="DATA[ALASAN_KELUAR]"></textarea>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">Jumlah Saldo Simpanan</label>
                    <div class="col-sm-3">
						<input type="text" class="form-control" value="<?=number_format($data["SALDO"],2)?>" readonly="readonly">
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">Jumlah Sisa Pinjaman</label>
                    <div class="col-sm-3">
						<input type="text" class="form-control" value="<?=number_format($data["BESAR_ANGSURAN_BULAN"] * $data["SISA"],2)?>" readonly="readonly">
                    </div>
                </div>
            </div><!-- row -->
        </div><!-- panel-body -->
        <div class="panel-footer">
          <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                 <a href="javascript:void(0);" class="btn btn-primary mr5" onclick="save_header('#keluar','msg_');">
                    <i class="fa fa-save"></i>&nbsp;<?=ucwords($act)?>
                </a>
                <button class="btn btn-dark" type="reset"><i class="fa fa-times"></i>&nbsp;Reset</button>&nbsp;<span class="msg_">&nbsp;</span>
            </div>
          </div>
        </div><!-- panel-footer -->  
    </div><!-- panel -->
    </form>
</div>
<script src="<?= base_url(); ?>js/toggles.min.js"></script>