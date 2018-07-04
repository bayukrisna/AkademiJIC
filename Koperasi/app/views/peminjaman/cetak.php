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
        <td width="15%"><strong>Nomor Transaksi</strong></td>
        <td width="1%">:</td>
        <td width="84%"><?=$sess["ID_PINJAMAN"]?></td>
    </tr>
    <tr>
        <td><strong>Tanggal Transaksi</strong></td>
        <td>:</td>
        <td><?=$sess["TGL_PINJAMAN"]?></td>
    </tr>
    <tr>
        <td><strong>Jenis Transaksi</strong></td>
        <td>:</td>
        <td>Peminjaman</td>
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
    	<td><strong>Total Pinjaman</strong></td>
        <td>:</td>
        <td>Rp.&nbsp;<?=number_format($sess["BESAR_PINJAMAN"],2)." (".$this->fungsi->Terbilang($sess["BESAR_PINJAMAN"])." Rupiah)"?></td>
    </tr>
    <tr>
    	<td><strong>Lama Angsuran</strong></td>
        <td>:</td>
        <td><?=$sess["TOTAL_ANGSURAN"]?></td>
    </tr>
    <tr>
    	<td><strong>Jumlah Angsuran</strong></td>
        <td>:</td>
        <td>Rp.&nbsp;<?=number_format($sess["BESAR_ANGSURAN"],2)." (".$this->fungsi->Terbilang($sess["BESAR_ANGSURAN"])." Rupiah)"?></td>
    </tr>
    <tr>
    	<td><strong>Alasan Pinjaman</strong></td>
        <td>:</td>
        <td><?=$sess["ALASAN_PINJAMAN"]?></td>
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