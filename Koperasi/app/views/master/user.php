<div class="col-md-12">
<form action="<?=site_url();?>/master/set_data/user" method="post" id="user" novalidate>
	<input type="hidden" readonly name="act" id="act" value="<?=$act?>" />
	<input type="hidden" readonly name="id" id="id" value="<?=$id?>" />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Form Input Master User</h4>
            <p>Keterangan : <span style="color:red">*</span> adalah form input yg wajib diisi</p>
        </div><!-- panel-heading -->
        <div class="panel-body">
            <div class="row">
				<div class="form-group">
                    <label class="col-sm-3 control-label">ID User <span class="asterisk"></span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" wajib="yes" readonly name="DATA[ID_USER]" value="<?=$id?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Lengkap <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="DATA[NAMA_USER]" value="<?=$data["NAMA_USER"]?>" wajib="yes" maxlength="50">
                    </div>
                </div><!-- form-group -->
              
                <div class="form-group">
                    <label class="col-sm-3 control-label">Alamat <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="DATA[ALAMAT_USER]" wajib="yes" maxlength="255" ><?=$data["ALAMAT_USER"]?></textarea>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">No. Telepon <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="phone" wajib="yes" name="DATA[NO_TELP_USER]" value="<?=$data["NO_TELP_USER"]?>" onkeypress="return intInput(event, /[.0-9]/)" maxlength="13">
                    </div>
                </div>
				<div class="form-group">
                    <label class="col-sm-3 control-label">User Level <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
						<?= form_dropdown('DATA[JABATAN_USER]', array(""=>"","1"=>"Staff KOPPEDI","2"=>"Ketua KOPPEDI"), $data['JABATAN_USER'], 'id="select-jabatan-user" data-placeholder="Pilih Level User" wajib="yes" class="width300"');  ?>
                    </div>
                </div>
                
				<div class="form-group">
                    <label class="col-sm-3 control-label">Status User <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
						<?= form_dropdown('DATA[STATUS_USER]', array(""=>"","1"=>"Aktif","0"=>"Non Aktif"), $data['STATUS_USER'], 'id="select-status-user" data-placeholder="Pilih Status User"  wajib="yes" class="width300" ');  ?>
                    </div>
                </div>
				<?php if($act=="save"){?>
				<div class="form-group">
                    <label class="col-sm-3 control-label">Username <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" wajib="yes" name="DATA[USERNAME]" value="<?=$data["USERNAME"]?>" maxlength="20">
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label">Password <span class="asterisk" style="color:red">*</span></label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" wajib="yes" name="DATA[PASSWORD]" value="<?=$data["PASSWORD"]?>">
                    </div>
                </div>
                <?php } ?>
				
            </div><!-- row -->
        </div><!-- panel-body -->
        <div class="panel-footer">
          <div class="row">
            <div class="col-sm-9 col-sm-offset-3">
                 <a href="javascript:void(0);" class="btn btn-primary mr5" onclick="save_header('#user','msg_');">
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
<script>
jQuery(document).ready(function(){
	jQuery('#select option:first-child').text('');
	function format(item) {
		return '<i class="fa ' + ((item.element[0].getAttribute('rel') === undefined)?"":item.element[0].getAttribute('rel') ) + ' mr10"></i>' + item.text;
	}
	jQuery('#select-jabatan-user').select2({
		formatResult: format,
		formatSelection: format,
		escapeMarkup: function(m) {return m;}
	});
	jQuery('#select-status-user').select2({
		formatResult: format,
		formatSelection: format,
		escapeMarkup: function(m) {return m;}
	});
})
</script>