<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
error_reporting(E_ERROR);
$uri = strtolower($this->uri->segment(1));
$uri_parent = strtolower($this->uri->segment(2));
$active0="";$active1='class="parent"';$active2='class="parent"';$active3='class="parent"';$active4='class="parent"';$active5='class="parent"';
$parentactive1="";$parentactive2="";$parentactive3="";$parentactive4="";$parentactive5="";$parentactive6="";$parentactive7="";
if($uri=="master"){
	$active1 = 'class="active parent nav-hover"';
	if($uri_parent=="jabatan") $parentactive1 = 'class="active nav-hover"';
	else if($uri_parent=="anggota") $parentactive2 = 'class="active nav-hover"';
	else if($uri_parent=="user") $parentactive3 = 'class="active nav-hover"';
}else if($uri=="simpanan"){
	$active2 = 'class="active parent nav-hover"';
	if($uri_parent=="sukarela") $parentactive1 = 'class="active nav-hover"';
	else if($uri_parent=="wajib") $parentactive2 = 'class="active nav-hover"';
	else if($uri_parent=="penarikan") $parentactive3 = 'class="active nav-hover"';
}else if($uri=="peminjaman"){
	$active3 = 'class="active parent nav-hover"';
	if($uri_parent=="pinjaman") $parentactive1 = 'class="active nav-hover"';
	else if($uri_parent=="angsuran") $parentactive2 = 'class="active nav-hover"';
	else if($uri_parent=="tagihan") $parentactive3 = 'class="active nav-hover"';
	else if($uri_parent=="pelunasan") $parentactive4 = 'class="active nav-hover"';
}else if($uri=="laporan"){
	$active4 = 'class="active parent nav-hover"';
	if($uri_parent=="simpanan") $parentactive1 = 'class="active nav-hover"';
	else if($uri_parent=="pinjaman") $parentactive2 = 'class="active nav-hover"';
	else if($uri_parent=="penarikan") $parentactive3 = 'class="active nav-hover"';
	else if($uri_parent=="angsuran") $parentactive4 = 'class="active nav-hover"';
	else if($uri_parent=="pelunasan") $parentactive5 = 'class="active nav-hover"';
	else if($uri_parent=="shu") $parentactive6 = 'class="active nav-hover"';
	else if($uri_parent=="rekap_simpanan") $parentactive7 = 'class="active nav-hover"';
}elseif($uri=="tabungan"){
	$active5 = 'class="active parent nav-hover"';
	if($uri_parent=="daftar") $parentactive1 = 'class="active nav-hover"';
	else if($uri_parent=="mutasi_tabungan") $parentactive2 = 'class="active nav-hover"';
}else{
	$active0 ='class="active"';
}
?>
{_header_}
<title>{_appname_}</title>
</head>
<body>
	<header>
		<div class="headerwrapper">
			<div class="header-left">
				<a href="<?=base_url()?>" class="logo">
					<img src="<?=base_url();?>img/koppedi.jpg" width="80px" height="25px" alt="" /> 
				</a>
				<div class="pull-right">
					<a href="#" class="menu-collapse">
						<i class="fa fa-bars"></i>
					</a>
				</div>
			</div>
			<div class="header-right">
				<div class="pull-right">
					<div class="btn-group btn-group-option">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        	<i class="fa fa-caret-down"></i>
                        </button>
						<ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="<?=site_url();?>/password/change"><i class="glyphicon glyphicon-lock"></i> Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="<?=site_url();?>/home/logout"><i class="glyphicon glyphicon-log-out"></i>Sign Out</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>

	<section>
		<div class="mainwrapper">
			<div class="leftpanel">
				<div class="media profile-left">
                    <a class="pull-left profile-thumb" href="profile.html">
                    	<img class="img-circle" src="<?=base_url();?>img/pp.png" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?= $this->newsession->userdata("NAMA_USER");?></h4>
                        <small class="text-muted"><?= $this->newsession->userdata("JABATAN_USER");?></small>
                    </div>
				</div>
				<h5 class="leftpanel-title">Navigation</h5>
                <ul class="nav nav-pills nav-stacked">
                    <li <?=$active0?>><a href="<?=base_url();?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
					<?php if($this->newsession->userdata("JABATAN_USER")=='Staff KOPPEDI') { ?>
                    <li <?=$active1?>><a href="#"><i class="fa fa-bars"></i> <span>Master</span></a>
                        <ul class="children">
                            <li <?=$parentactive1?>><a href="<?=site_url();?>/master/jabatan">Entry Master Jabatan</a></li>
                            <li <?=$parentactive2?>><a href="<?=site_url();?>/master/anggota">Entry Master Anggota</a></li>
                            <li <?=$parentactive3?>><a href="<?=site_url();?>/master/user">Entry Master User</a></li>
                        </ul>
					</li>
                    <li <?=$active2?>><a href="#"><i class="fa fa-book"></i> <span>Simpanan</span></a>
                        <ul class="children">
							<li <?=$parentactive2?>><a href="<?=site_url();?>/simpanan/wajib">Entry Simpanan Wajib</a></li>
							<li <?=$parentactive1?>><a href="<?=site_url();?>/simpanan/sukarela">Entry Simpanan Sukarela</a></li>
                            <li <?=$parentactive3?>><a href="<?=site_url();?>/simpanan/tarikan">Entry Penarikan Simpanan</a></li>
						</ul>
                    </li>
                    <li <?=$active3?>><a href="#"><i class="fa fa-book"></i> <span>Pinjaman</span></a>
                        <ul class="children">
							<li <?=$parentactive1?>><a href="<?=site_url();?>/peminjaman/pinjaman">Entry Pinjaman</a></li>
                            <!--<li <?=$parentactive2?>><a href="<?=site_url();?>/peminjaman/angsuran">Angsuran Pinjaman</a></li>-->
                            <li <?=$parentactive2?>><a href="<?=site_url();?>/peminjaman/angsuran">Angsuran Pinjaman</a></li>
                            <li <?=$parentactive4?>><a href="<?=site_url();?>/peminjaman/pelunasan">Pelunasan Pinjaman</a></li>
						</ul>
                    </li>
					<li <?=$active5?>><a href="#"><i class="fa fa-money"></i> <span>Tabungan</span></a>
                        <ul class="children">
							<li <?=$parentactive1?>><a href="<?=site_url();?>/tabungan/daftar">Daftar Tabungan</a></li>
                            <li <?=$parentactive2?>><a href="<?=site_url();?>/tabungan/mutasi">Mutasi Tabungan</a></li>
						</ul>
                    </li>
                    <?php } ?>
                    <li <?=$active4?>><a href="#"><i class="fa fa-file-text"></i> <span>Laporan</span></a>
                    	<ul class="children">
                            <li <?=$parentactive1?>><a href="<?=site_url();?>/laporan/simpanan">Cetak Laporan Simpanan</a></li>
                            <li <?=$parentactive3?>><a href="<?=site_url();?>/laporan/penarikan">Cetak Laporan Penarikan Simpanan</a></li>
                            <li <?=$parentactive2?>><a href="<?=site_url();?>/laporan/pinjaman">Cetak Laporan Pinjaman</a></li>
                            <!--<li <?=$parentactive4?>><a href="<?=site_url();?>/laporan/angsuran">Cetak Laporan Angsuran</a></li>-->
                            <li <?=$parentactive5?>><a href="<?=site_url();?>/laporan/pelunasan">Cetak Laporan Pelunasan</a></li>
							<li <?=$parentactive6?>><a href="<?=site_url();?>/laporan/shu">Cetak Laporan SHU</a></li>
							<li <?=$parentactive7?>><a href="<?=site_url();?>/laporan/rekap_simpanan">Cetak Laporan Rekapitulasi Simpanan</a></li>
                        </ul>
                    </li>
				</ul>
			</div>

			<div class="mainpanel">
				<div class="pageheader">
					<div class="media">
						{_breadcrumb_}
					</div><!-- media -->
				</div><!-- pageheader -->

				<div class="contentpanel">
					<div class="row row-stat">
						{_content_}
					</div>
              	</div>
			</div>
		</div>
	</section>
</body>
</html>