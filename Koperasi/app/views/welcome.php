<div class="list-group contact-group">
    <a class="list-group-item">
        <div class="media">
            <div class="pull-left">
                <img alt="..." src="<?=base_url()?>img/pp.png" class="img-circle img-online">
            </div>
            <div class="media-body">
                <h4 class="media-heading"><?= $this->newsession->userdata("NAMA_USER");?> <small><?= $this->newsession->userdata("JABATAN_USER");?> </small></h4>
                <div class="media-content">
                    <i class="fa fa-map-marker"></i> <?= $this->newsession->userdata("ALAMAT_USER");?> 
                    <ul class="list-unstyled">
                        <li><i class="fa fa-mobile"></i> <?= $this->newsession->userdata("NO_TELP_USER");?> </li>
                        <li><i class="fa fa-clock-o"></i> <?= $this->newsession->userdata("LAST_LOGIN");?> </li>
                    </ul>
                </div>
            </div>
        </div><!-- media -->
    </a>
</div>