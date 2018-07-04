<table style="margin-top:-30px;" width="100%">
	<tr>
		<td colspan="3" style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; border-bottom:1px solid #000; font-size:14px; text-align:center;">
        	<b style="text-align:center;"><h2><br/>Tanda Terima<h2></b>
       	</td>
	</tr>
	<tr>
    	<td colspan="3"><strong>&nbsp;</strong></td>
    </tr>
	<tr>
    	<td width="20%"><strong>Nomor Transaksi</strong></td>
        <td width="1%">:</td>
        <td width="79%"><?=$sess["ID_PENARIKAN"]?></td>
    </tr>
    <tr>
        <td><strong>Tanggal Transaksi</strong></td>
        <td>:</td>
        <td><?=date("d F Y", strtotime($sess["TGL_PENARIKAN"]))?></td>
    </tr>
    <tr>
        <td><strong>Jenis Transaksi</strong></td>
        <td>:</td>
        <td><?=$sess["JENIS_PENARIKAN"]?></td>
    </tr>
    <tr>
    	<td><strong>NIK</strong></td>
        <td>:</td>
        <td><?=$sess["NIK"]?></td>
    </tr>
    <tr>
    	<td><strong>Nama Anggota</strong></td>
        <td>:</td>
        <td><?=$sess["NAMA_ANGGOTA"]?></td>
    </tr>
    <tr>
    	<td><strong>Terima Uang Sebesar</strong></td>
        <td>:</td>
        <td>Rp.&nbsp;<?=number_format($sess["BESAR_PENARIKAN"],2)?></td>
    </tr>
    <tr>
        <td><strong>Terbilang</strong></td>
        <td>:</td>
        <td><?=$this->fungsi->terbilang($sess["BESAR_PENARIKAN"])." Rupiah"?></td>
    </tr>
</table>
<br><br>
<table width="100%">
	<tr>
    	<td colspan="2"  style="text-align:center;"><strong>Mengetahui,</strong></td>
    </tr>
    <tr>
        <td style="text-align:center;">&nbsp;</td>
        <td style="text-align:center;">Jakarta, <?php echo date('d M Y'); ?></td>
    </tr>
    <tr>
    	<td style="text-align:center;"><strong>Yang Menyerahkan</strong></td>
        <td style="text-align:center;"><strong>Yang Menerima</strong></td>
    </tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr>
    	<td style="text-align:center;">( <?=$this->newsession->userdata('NAMA_USER');?> )</td>
    	<td style="text-align:center;">( <?=$sess["NAMA_ANGGOTA"]?> )</td>
    </tr>
</table>