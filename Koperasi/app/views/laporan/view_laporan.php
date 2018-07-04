<?php if(count($dataPinjaman)>0 && $tipe=="view" && $this->newsession->userdata("JABATAN_USER")=='Staff KOPPEDI'){ ?>
	<a href="javascript:void(0)" class="btn btn-danger btn-small" onclick="cetak_laporan('<?=$periode_bulan?>','<?=$sampai_bulan?>','peminjaman')" ><i class="fa fa-print red"></i>&nbsp;Cetak Pdf</a><br /><br />
<?php } ?>
<?php if($laporan=="peminjaman"){?>
	<?php if($tipe!="view"){?><br/><br/><br/><br/><?php } ?>
	<table class="tabelajax">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Jabatan</th>
			<th>Besar Pinjaman</th>
			<th>Lama Angsuran</th>
			<th>Bulan Mulai</th>
			<th>Bulan Selesai</th>
			<th>Besar Angsuran</th>
			<th>Total Pengembalian</th>
		<tr>
		<?php
		if(count($dataPinjaman)>0){
			$no = 1;
			foreach($dataPinjaman as $data){
				$totalpengembalian = $totalpengembalian + $data["SUB_TOTAL_PENGEMBALIAN"];
				echo '<tr width="100%">';
				echo '<td width="2%">'.$no.'</td>';
				echo '<td width="14%">'.$data["NAMA_ANGGOTA"].'</td>';
				echo '<td width="9%">'.$data["JABATAN"].'</td>';
				echo '<td width="9%">'.$data["BESAR_PINJAMAN"].'</td>';
				echo '<td width="9%">'.$data["ANGSURAN_SELAMA"].'</td>';
				echo '<td width="9%">'.$data["BULAN_MULAI"].'</td>';
				echo '<td width="9%">'.$data["BULAN_SELESAI"].'</td>';
				echo '<td width="9%" align="right">'.$data["BESAR_ANGSURAN_BULAN"].'</td>';
				echo '<td width="9%" align="right">'.$data["TOTAL_PENGEMBALIAN"].'</td>';
				echo '</tr>';
				$no++;
			}
			echo '<tr><td colspan="8" align="right"><b>Jumlah Total Peminjaman</b></td><td align="right">'.number_format($totalpengembalian,2).'</td></tr>';
		}else{
			echo '<tr><td colspan="9" align="center">Data not found.</td></tr>';
		}
		?>
	</table>
	<?php if($tipe!="view"){?>
	<table width="100%">
		<tr>
			<td align="right">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" style="padding-right:50px;">Mengetahui,&nbsp;<?= date("d-m-Y"); ?></td>
		</tr>
		<tr>
			<td align="right" height="50px">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" style="padding-right:80px;">(<?=$ketua?>)</td>
		</tr>
	</table>
	<?php } ?>
<?php }?>
	
<?php if(count($dataSimpanan)>0 && $tipe=="view" && $this->newsession->userdata("JABATAN_USER")=='Staff KOPPEDI'){ ?>
	<a href="javascript:void(0)" class="btn btn-danger btn-small" onclick="cetak_laporan('<?=$periode_bulan?>','<?=$sampai_bulan?>','simpanan')" ><i class="fa fa-print red"></i>&nbsp;Cetak Pdf</a><br /><br />
<?php } ?>
<?php if($laporan=="simpanan"){ 
?>
	<?php if($tipe!="view"){?><br/><br/><br/><br/><?php } ?>
	<table class="tabelajax">
		<tr>
			<th>No</th>
			<th>NIK</th>
			<th>Nama Anggota</th>
			<th>Jabatan</th>
			<th>Tanggal Daftar</th>
			<th>Simpanan Pokok</th>
			<th>Simpanan Wajib</th>
			<th>Simpanan Sukarela</th>
			<th>Besar Simpanan Anggota</th>
		<tr>
		<?php
		if(count($dataSimpanan)>0){
			$no = 1;
			foreach($dataSimpanan as $data){
				$besar_simpanan = (float)$data["SIMPANAN_POKOK"] + (float)$data["SIMPANAN_WAJIB"] + (float)$data["SIMPANAN_SUKARELA"];
				$total = $total + $besar_simpanan;
				echo '<tr width="100%">';
				echo '<td width="2%">'.$no.'</td>';
				echo '<td width="7%">'.$data["NIK"].'</td>';
				echo '<td width="15%">'.$data["NAMA_ANGGOTA"].'</td>';
				echo '<td width="8%">'.$data["JABATAN"].'</td>';
				echo '<td width="8%">'.date("d M Y", strtotime($data["TANGGAL_DAFTAR"])).'</td>';
				echo '<td width="10%" align="right">'.number_format($data["SIMPANAN_POKOK"],2).'</td>';
				echo '<td width="10%" align="right">'.number_format($data["SIMPANAN_WAJIB"],2).'</td>';
				echo '<td width="10%" align="right">'.number_format($data["SIMPANAN_SUKARELA"],2).'</td>';
				echo '<td width="12%" align="right">'.number_format($besar_simpanan,2).'</td>';
				echo '</tr>';
				$no++;
			}
			echo '<tr><td colspan="8" align="right"><b>Total Besar Simpanan</b></td><td align="right">'.number_format($total,2).'</td></tr>';
		}else{
			echo '<tr><td colspan="9" align="center">Data not found.</td></tr>';
		}
		?>
	</table>
	<?php if($tipe!="view"){?>
	<table width="100%">
		<tr>
			<td align="right">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" style="padding-right:50px;">Mengetahui,&nbsp;<?= date("d-m-Y"); ?></td>
		</tr>
		<tr>
			<td align="right" height="50px">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" style="padding-right:90px;">(<?=$ketua?>)</td>
		</tr>
	</table>
	<?php } ?>
<?php } ?>

<?php if(count($dataPenarikan)>0 && $tipe=="view" && $this->newsession->userdata("JABATAN_USER")=='Staff KOPPEDI'){ ?>
	<a href="javascript:void(0)" class="btn btn-danger btn-small" onclick="cetak_laporan('<?=$periode_bulan?>','<?=$sampai_bulan?>','penarikan')" ><i class="fa fa-print red"></i>&nbsp;Cetak Pdf</a><br /><br />
<?php } ?>
<?php if($laporan=="penarikan"){ 
?>
	<?php if($tipe!="view"){?><br/><br/><br/><br/><?php } ?>
	<table class="tabelajax">
		<tr>
			<th>No</th>
			<th>No Transaksi</th>
			<th>NIK</th>
			<th>Nama Anggota</th>
			<th>Jabatan</th>
			<th>Tanggal Penarikan</th>
			<th>Jenis Penarikan</th>
			<th>Besar Penarikan</th>
		<tr>
		<?php
		if(count($dataPenarikan)>0){
			$no = 1;
			foreach($dataPenarikan as $data){
				$total = $total + $data["SUB_BESAR_PENARIKAN"];
				echo '<tr width="100%">';
				echo '<td width="2%">'.$no.'</td>';
				echo '<td width="12%">'.$data["ID_PENARIKAN"].'</td>';
				echo '<td width="12%">'.$data["NIK"].'</td>';
				echo '<td width="12%">'.$data["NAMA_ANGGOTA"].'</td>';
				echo '<td width="12%">'.$data["JABATAN"].'</td>';
				echo '<td width="12%">'.$data["TGL_PENARIKAN"].'</td>';
				echo '<td width="12%">'.$data["JENIS_PENARIKAN"].'</td>';
				echo '<td width="12%" align="right">'.$data["BESAR_PENARIKAN"].'</td>';
				echo '</tr>';
				$no++;
			}
			echo '<tr><td colspan="7" align="right"><b>Jumlah Besar Penarikan Simpanan</b></td><td align="right">'.number_format($total,2).'</td></tr>';
		}else{
			echo '<tr><td colspan="8" align="center">Data not found.</td></tr>';
		}
		?>
	</table>
	<?php if($tipe!="view"){?>
	<table width="100%">
		<tr>
			<td align="right">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" style="padding-right:50px;">Mengetahui,&nbsp;<?= date("d-m-Y"); ?></td>
		</tr>
		<tr>
			<td align="right" height="50px">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" style="padding-right:80px;">(<?=$ketua?>)</td>
		</tr>
	</table>
	<?php } ?>
<?php } ?>
	
<?php if(count($dataAngsuran)>0 && $tipe=="view" && $this->newsession->userdata("JABATAN_USER")=='Staff KOPPEDI'){ ?>
	<a href="javascript:void(0)" class="btn btn-danger btn-small" onclick="cetak_laporan('<?=$periode_bulan?>','<?=$sampai_bulan?>','angsuran')" ><i class="fa fa-print red"></i>&nbsp;Cetak Pdf</a><br /><br />
<?php } ?>
<?php if($laporan=="angsuran"){ 
?>
	<?php if($tipe!="view"){?><br/><br/><br/><br/><?php } ?>
	<table class="tabelajax">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Tanggal Angsuran</th>
			<th>Angsuran Ke</th>
			<th>Sisa Angsuran</th>
			<th>Besar Angsuran</th>
		<tr>
		<?php
		if(count($dataAngsuran)>0){
			$no = 1;
			foreach($dataAngsuran as $data){
				$total = $total + $data["SUB_BESAR_ANGSURAN_BULAN"];
				$angsuran_ke = $data["ANGSURAN_KE"];
				$sisa_angsuran = $data["ANGSURAN_SELAMA"] - $angsuran_ke;
				echo '<tr width="100%">';
				echo '<td width="2%">'.$no.'</td>';
				echo '<td width="18%">'.$data["NAMA_ANGGOTA"].'</td>';
				echo '<td width="10%">'.$data["TGL_ANGSURAN"].'</td>';
				echo '<td width="10%">'.$angsuran_ke.'</td>';
				echo '<td width="10%">'.$sisa_angsuran.'</td>';
				echo '<td width="10%" align="right">'.$data["BESAR_ANGSURAN_BULAN"].'</td>';
				echo '</tr>';
				$no++;
			}
			echo '<tr><td colspan="5" align="right"><b>Jumlah Besar Angsuran</b></td><td align="right">'.number_format($total,2).'</td></tr>';
		}else{
			echo '<tr><td colspan="10" align="center">Data not found.</td></tr>';
		}
		?>
	</table>
	<?php if($tipe!="view"){?>
	<table width="100%">
		<tr>
			<td align="right">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" style="padding-right:50px;">Mengetahui,&nbsp;<?= date("d-m-Y"); ?></td>
		</tr>
		<tr>
			<td align="right" height="50px">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" style="padding-right:50px;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
		</tr>
	</table>
	<?php } ?>
<?php } ?>

<?php if(count($dataPelunasan)>0 && $tipe=="view" && $this->newsession->userdata("JABATAN_USER")=='Staff KOPPEDI'){ ?>
	<a href="javascript:void(0)" class="btn btn-danger btn-small" onclick="cetak_laporan('<?=$periode_bulan?>','<?=$sampai_bulan?>','pelunasan')" ><i class="fa fa-print red"></i>&nbsp;Cetak Pdf</a><br /><br />
<?php } ?>
<?php if($laporan=="pelunasan"){ 
?>
	<?php if($tipe!="view"){?><br/><br/><br/><br/><?php } ?>
	<table class="tabelajax">
		<tr>
			<th>No</th>
			<th>NIK</th>
			<th>Nama</th>
			<th>Jumlah Angsuran Pelunasan</th>
			<th>Keperluan</th>
			<th>Besar Angsuran</th>
			<th>Total Pelunasan</th>
		<tr>
		<?php
		if(count($dataPelunasan)>0){
			$no = 1;
			foreach($dataPelunasan as $data){
				$total = $total + ($data["TOTAL_ANGSURAN"] * $data["BESAR_ANGSURAN_BULAN"]);
				echo '<tr width="100%">';
				echo '<td width="2%">'.$no.'</td>';
				echo '<td width="5%">'.$data["NIK"].'</td>';
				echo '<td width="18%">'.$data["NAMA_ANGGOTA"].'</td>';
				echo '<td width="10%">'.number_format($data["BESAR_PINJAMAN"],2).'</td>';
				echo '<td width="10%">'.$data["ALASAN_PINJAMAN"].'</td>';
				echo '<td width="10%" align="right">'.number_format($data["BESAR_ANGSURAN_BULAN"],2).'</td>';
				echo '<td width="10%" align="right">'.number_format($data["TOTAL_ANGSURAN"] * $data["BESAR_ANGSURAN_BULAN"],2).'</td>';
				echo '</tr>';
				$no++;
			}
			echo '<tr><td colspan="6" align="right"><b>Jumlah Besar Pelunasan</b></td><td align="right">'.number_format($total,2).'</td></tr>';
		}else{
			echo '<tr><td colspan="10" align="center">Data not found.</td></tr>';
		}
		?>
	</table>
	<?php if($tipe!="view"){?>
	<table width="100%">
		<tr>
			<td align="right">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" style="padding-right:50px;">Mengetahui,&nbsp;<?= date("d-m-Y"); ?></td>
		</tr>
		<tr>
			<td align="right" height="50px">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" style="padding-right:80px;">(<?=$ketua?>)</td>
		</tr>
	</table>
	<?php } ?>
<?php } ?>
<?php if(count($dataSHU)>0 && $tipe=="view"){ ?>
	<a href="javascript:void(0)" class="btn btn-danger btn-small" onclick="cetak_laporan('<?=$tahun?>','<?=$persen_modal."~".$persen_pinjam?>','shu')" ><i class="fa fa-print red"></i>&nbsp;Cetak Pdf</a><br /><br />
<?php } ?>
<?php if($laporan=="shu"){ ?>
	<?php if($tipe!="view"){?><br/><br/><br/><br/><?php } ?>
	<div class="list-group contact-group" style="margin-top: -10px !important;">
	    <a class="list-group-item">
	        <div class="media">
	        	<table width="100%" cellpadding="0" cellspacing="0">
	        		<tr>
	        			<td width="70%" style="border-bottom: 1px dotted #DDD;" align="right">Tahun</td>
	        			<td width="1%" style="border-bottom: 1px dotted #DDD;" align="right">: </td>
	        			<td width="25%" style="border-bottom: 1px dotted #DDD;" align="right">2017</td>
	        		</tr>
	        		<tr>
	        			<td style="border-bottom: 1px dotted #DDD;" align="right">Total SHU</td>
	        			<td style="border-bottom: 1px dotted #DDD;" align="right">: </td>
	        			<td style="border-bottom: 1px dotted #DDD;" align="right">Rp. <?php echo number_format($total_shu,2); ?></td>
	        		</tr>
	        		<tr>
	        			<td style="border-bottom: 1px dotted #DDD;" align="right">Total SHU Jasa Modal</td>
	        			<td style="border-bottom: 1px dotted #DDD;" align="right">: </td>
	        			<td style="border-bottom: 1px dotted #DDD;" align="right">Rp. <?php echo number_format($jasa_modal,2); ?></td>
	        		</tr>
	        		<tr>
	        			<td style="border-bottom: 1px dotted #DDD;" align="right">Total SHU Jasa Pinjam</td>
	        			<td style="border-bottom: 1px dotted #DDD;" align="right">: </td>
	        			<td style="border-bottom: 1px dotted #DDD;" align="right">Rp. <?php echo number_format($jasa_pinjam,2); ?></td>
	        		</tr>
	        	</table>
	        </div><!-- media -->
    	</a>
	</div>
	<table class="tabelajax">
		<tr>
			<th>No</th>
			<th>NIK Aggota</th>
			<th>Nama Aggota</th>
			<th>Besar Simpanan</th>
			<th>Besar Pinjaman</th>
			<th>SHU Jasa Modal</th>
			<th>SHU Jasa Pinjam</th>
			<th>Total SHU</th>
		<tr>
		<?php
		if(count($dataSHU)>0){
			$no = 1;
			foreach($dataSHU as $data){
				$shu_modal = ($data["TOTAL_SIMPANAN"] / $simpanan) * $jasa_modal;
				$shu_pinjaman = ($data["TOTAL_PINJAMAN"] / $pinjaman) * $jasa_pinjam;
				$total_shu = $shu_pinjaman + $shu_modal;
				echo '<tr width="100%">';
				echo '<td width="2%">'.$no.'</td>';
				echo '<td width="14%">'.$data["NIK"].'</td>';
				echo '<td width="9%">'.$data["NAMA_ANGGOTA"].'</td>';
				echo '<td width="9%" align="right">Rp. '.number_format($data["TOTAL_SIMPANAN"],2).'</td>';
				echo '<td width="9%" align="right">Rp. '.number_format($data["TOTAL_PINJAMAN"],2).'</td>';
				echo '<td width="9%" align="right">Rp. '.number_format($shu_modal,2).'</td>';
				echo '<td width="9%" align="right">Rp. '.number_format($shu_pinjaman,2).'</td>';
				echo '<td width="9%" align="right">Rp. '.number_format($total_shu,2).'</td>';
				echo '</tr>';
				$no++;
			}
		}else{
			echo '<tr><td colspan="9" align="center">Data not found.</td></tr>';
		}
		?>
	</table>
	<?php if($tipe!="view"){?>
	<table width="100%">
		<tr>
			<td align="right">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" style="padding-right:50px;">Mengetahui,&nbsp;<?= date("d-m-Y"); ?></td>
		</tr>
		<tr>
			<td align="right" height="50px">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" style="padding-right:80px;">( <?php echo $ketua; ?> )</td>
		</tr>
	</table>
	<?php } ?>
<?php }?>
<?php if(count($dataRekap)>0 && $tipe=="view" && $this->newsession->userdata("JABATAN_USER")=='Staff KOPPEDI'){ ?>
	<a href="javascript:void(0)" class="btn btn-danger btn-small" onclick="cetak_laporan('<?=$tgl_awal?>','<?=$tgl_akhir?>','rekap_simpanan')" ><i class="fa fa-print red"></i>&nbsp;Cetak Pdf</a><br /><br />
<?php } ?>
<?php if($laporan=="rekap_simpanan"){ 
?>
	<?php if($tipe!="view"){?><br/><br/><br/><br/><?php } ?>
	<table class="tabelajax">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Total</th>
		<tr>
		<?php
		if(count($dataRekap)>0){
			$no = 1;
			foreach($dataRekap as $data){
				$total = $data["BESAR_SIMPANAN"] - $data["BESAR_PENARIKAN"];
				$grand_total = $grand_total + $total;
				echo '<tr width="100%">';
				echo '<td width="1%">'.$no.'</td>';
				echo '<td width="50%">'.$data["NAMA_ANGGOTA"].'</td>';
				echo '<td width="49%" align="right">'.number_format($total,2).'</td>';
				echo '</tr>';
				$no++;
			}
			echo '<tr><td colspan="2" align="right"><b>Grand Total</b></td><td align="right">'.number_format($grand_total,2).'</td></tr>';
		}else{
			echo '<tr><td colspan="3" align="center">Data not found.</td></tr>';
		}
		?>
	</table>
	<?php if($tipe!="view"){?>
	<table width="100%">
		<tr>
			<td align="right">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" style="padding-right:50px;">Mengetahui,&nbsp;<?= date("d-m-Y"); ?></td>
		</tr>
		<tr>
			<td align="right" height="50px">&nbsp;</td>
		</tr>
		<tr>
			<td align="right" style="padding-right:80px;">( <?php echo $ketua; ?> )</td>
		</tr>
	</table>
	<?php } ?>
<?php } ?>