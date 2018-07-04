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
        <td width="15%"><strong>Tanggal Transaksi</strong></td>
        <td width="1%">:</td>
        <td width="84%"><?=date_format(date_create($tgl),"F Y");?></td>
    </tr>
    <tr>
        <td><strong>Jenis Transaksi</strong></td>
        <td>:</td>
        <td>Simpanan Wajib</td>
    </tr>
    <tr>
    	<td><strong>Nama</strong></td>
        <td>:</td>
        <td>PT. EDI INDONESIA</td>
    </tr>
    <tr>
    	<td><strong>Total Pembayaran</strong></td>
        <td>:</td>
        <td>Rp.&nbsp;<?=number_format($sess["SIMPANAN_WAJIB"],2)?></td>
    </tr>
    <tr>
        <td><strong>Terbilang</strong></td>
        <td>:</td>
        <td><?=$this->fungsi->Terbilang($sess["SIMPANAN_WAJIB"])?> Rupiah</td>
    </tr>
</table>
<br><br>
<table width="80%">
    <tr>
        <td style="text-align:center;padding-left:500px;">Jakarta, <?php echo date('d F Y'); ?></td>
    </tr>
    <tr>
        <td style="text-align:center;padding-left:500px;"><strong>Staf Koperasi</strong></td>
    </tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr><td>&nbsp;</td></tr>
    <tr>
    	<td style="text-align:center;padding-left:500px;"><?=$this->newsession->userdata('NAMA_USER');?></td>
    </tr>
</table>