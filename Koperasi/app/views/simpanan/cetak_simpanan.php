<table style="margin-top:-30px;" width="100%">
	<tr>
		<td colspan="3" style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; border-bottom:1px solid #000; font-size:14px; text-align:center;">
        	<b style="text-align:center;"><h2><br/>Kwitansi Pembayaran<h2></b>
       	</td>
	</tr>
	<tr>
    	<td colspan="3"><strong>&nbsp;</strong></td>
    </tr>
	<tr>
    	<td width="15%"><strong>Nomor Transaksi</strong></td>
        <td width="1%">:</td>
        <td width="84%"><?=$sess["ID_SIMPANAN"]?></td>
    </tr>
    <tr>
        <td><strong>Tanggal Transaksi</strong></td>
        <td>:</td>
        <td><?=$sess["TGL_SIMPANAN"]?></td>
    </tr>
    <tr>
        <td><strong>Jenis Transaksi</strong></td>
        <td>:</td>
        <td><?=$sess["JENIS_SIMPANAN"]?></td>
    </tr>
    <tr>
    	<td width="15%"><strong>NIK</strong></td>
        <td width="1%">:</td>
        <td width="84%"><?=$sess["NIK"]?></td>
    </tr>
    <tr>
    	<td><strong>Nama Anggota</strong></td>
        <td>:</td>
        <td><?=$sess["NAMA_ANGGOTA"]?></td>
    </tr>
    <tr>
    	<td><strong>Total Simpanan</strong></td>
        <td>:</td>
        <td>Rp.&nbsp;<?=number_format($sess["BESAR_SIMPANAN"],2)?></td>
    </tr>
    <tr>
        <td><strong>Terbilang</strong></td>
        <td>:</td>
        <td><?=$this->fungsi->Terbilang($sess["BESAR_SIMPANAN"])?> Rupiah</td>
    </tr>
</table>
<br><br>
<table width="80%">
    <tr>
        <td style="text-align:right;">Jakarta, <?php echo date('d F Y'); ?></td>
    </tr>
    <tr>
        <td style="text-align:right;"><strong>Staff Koperasi</strong></td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
    	<td style="text-align:right;"><?=$this->newsession->userdata('NAMA_USER');?></td>
    </tr>
</table>