<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tabungan_act extends Model{
	
	function daftar($tipe="",$ajax=""){
        $this->load->library('newtable');
		$SQL = "SELECT A.NIK, A.NAMA_ANGGOTA 'Nama Anggota',
				CASE A.STATUS_ANGGOTA 
					WHEN '0' THEN 'TIDAK AKTIF' 
					WHEN '1' THEN 'AKTIF' 
				END AS 'Status Anggota', 
				FORMAT((f_tabungan(A.NIK,'SIMPAN','ALL','','') - f_tabungan(A.NIK,'TARIK','ALL','','')),2) AS 'Saldo'
				FROM MST_ANGGOTA A";

		$prosesnya = array('Cetak Tabungan' => array('GETNEW', site_url().'/tabungan/cetakTabungan', 'user','fa fa-print red')
						   );	

		$this->newtable->search(array(array('A.NAMA_ANGGOTA', 'NAMA'),array('A.NIK', 'NIK')));			
		$ciuri = (!$this->input->post("ajax"))?$this->uri->segment_array():$this->input->post("uri");	
		$this->newtable->action(site_url()."/tabungan/daftar");
		$this->newtable->detail(site_url() . "/tabungan/detilTabungan");
        $this->newtable->detail_tipe("detil_priview_bottom");		
        $this->newtable->keys(array("NIK"));	
		$this->newtable->cidb($this->db);
		$this->newtable->show_chk(true);
		$this->newtable->ciuri($ciuri);
		$this->newtable->orderby(1);
		$this->newtable->sortby("ASC");
		$this->newtable->group("A.NIK");
		$this->newtable->set_formid("ftabungan");
		$this->newtable->set_divid("divtabungan");
		$this->newtable->rowcount(20);
		$this->newtable->clear();  
		$this->newtable->menu($prosesnya);
		$this->newtable->header_bg('#2494F2');	
		$this->newtable->tipe_proses('button');	
		$tabel .= $this->newtable->generate($SQL);		
		$arrdata = array("judul" => "Data Tabungan Anggota KOPPEDI",
						"tabel" => $tabel);	
		if($this->input->post("ajax")||$tipe=="ajax") return $tabel;				 
		else return $arrdata;
    }

    function detilTabungan($id) {
        $func = get_instance();
        $func->load->model("main");
		$SQL = "SELECT A.ID_SIMPANAN 'ID', DATE_FORMAT(A.TGL_SIMPANAN,'%d %M %Y') 'TGL', 
				CASE A.JENIS_SIMPANAN
					WHEN '1' THEN 'POKOK'
					WHEN '2' THEN 'WAJIB'
					WHEN '3' THEN 'SUKARELA'
				END AS 'JENIS', A.BESAR_SIMPANAN 'JUMLAH', A.TGL_SIMPANAN
				FROM TR_SIMPANAN A LEFT JOIN MST_ANGGOTA C ON C.NIK = A.NIK WHERE A.NIK = '".$id."'
				UNION ALL 
				SELECT B.ID_PENARIKAN 'ID', DATE_FORMAT(B.TGL_PENARIKAN,'%d %M %Y') 'TGL', 
				CASE B.JENIS_PENARIKAN 
					WHEN '1' THEN 'SUKARELA' 
					WHEN '2' THEN 'KESELURUHAN' 
				END AS 'JENIS', B.BESAR_PENARIKAN 'JUMLAH', B.TGL_PENARIKAN
				FROM TR_PENARIKAN B LEFT JOIN MST_ANGGOTA D ON D.NIK = B.NIK WHERE B.NIK = '".$id."'
				ORDER BY 5 ASC";
		$hasil = $func->main->get_result($SQL);
		$html .= '<table class="tabelajax">';
		$html .= '<th width="1px" style="background-color:#36D7B7 !important;">No</th>';
		$html .= '<th style="background-color:#36D7B7 !important;">NOMOR TRANSAKSI</th>';
		$html .= '<th style="background-color:#36D7B7 !important;">TANGGAL TRANSAKSI</th>';
		$html .= '<th style="background-color:#36D7B7 !important;">JENIS TRANSAKSI</th>';
		$html .= '<th style="background-color:#36D7B7 !important;">PEMASUKAN</th>';
		$html .= '<th style="background-color:#36D7B7 !important;">PENGELUARAN</th>';
		$html .= '<th style="background-color:#36D7B7 !important;">SALDO</th>';
		$html .= '</tr>';
		if($hasil) {
			$no=1;
			$SALDO = 0;
			$TOTAL_MASUK = 0;
			$TOTAL_KELUAR = 0;
			$TOTAL_SALDO = 0;
			foreach($SQL->result_array() as $row) {
				$html .= '<tr>';
				$html .= '<td>'.$no.'</td>';
				$html .= '<td>'.$row['ID'].'</td>';
				$html .= '<td>'.$row['TGL'].'</td>';
				if(substr($row['ID'],0,1) == "S"){
					$html .= '<td>SIMPANAN '.$row["JENIS"].'</td>';
					$html .= '<td align="right">'.number_format($row['JUMLAH'],2).'</td>';
					$html .= '<td>&nbsp;</td>';
					$SALDO = (float)$SALDO+(float)$row['JUMLAH'];
					$TOTAL_MASUK = (float)$TOTAL_MASUK+(float)$row['JUMLAH'];
				}else{
					$html .= '<td>PENARIKAN '.$row["JENIS"].'</td>';
					$html .= '<td>&nbsp;</td>';
					$html .= '<td align="right">'.number_format($row['JUMLAH'],2).'</td>';
					$SALDO = (float)$SALDO-(float)$row['JUMLAH'];
					$TOTAL_KELUAR = (float)$TOTAL_KELUAR+(float)$row['JUMLAH'];
				}
				$TOTAL_SALDO = (float)$TOTAL_SALDO+(float)$SALDO;
				$html .= '<td align="right">'.number_format($SALDO,2).'</td>';
				$html .= '</tr>';	
				$no++;
			}
			$html .= '<tr>';		
			$html .= '<td colspan="4" align="right"><b>TOTAL :</b></td>';		
			$html .= '<td align="right"><b>'.number_format($TOTAL_MASUK,2).'</b></td>';		
			$html .= '<td align="right"><b>'.number_format($TOTAL_KELUAR,2).'</b></td>';		
			$html .= '<td align="right"><b>'.number_format($SALDO,2).'</b></td>';	
		} else {
		
		}
		echo $html;
    }

    function cetakTabungan($id="",$type=""){
		$func = get_instance();
		$func->load->model("main","main", true);
		$SQL = "SELECT A.ID_SIMPANAN 'ID', DATE_FORMAT(A.TGL_SIMPANAN,'%d %M %Y') 'TGL', 
				CASE A.JENIS_SIMPANAN
					WHEN '1' THEN 'POKOK'
					WHEN '2' THEN 'WAJIB'
					WHEN '3' THEN 'SUKARELA'
				END AS 'JENIS', A.BESAR_SIMPANAN 'JUMLAH', A.TGL_SIMPANAN
				FROM TR_SIMPANAN A LEFT JOIN MST_ANGGOTA C ON C.NIK = A.NIK WHERE A.NIK = '".$id."'
				UNION ALL 
				SELECT B.ID_PENARIKAN 'ID', DATE_FORMAT(B.TGL_PENARIKAN,'%d %M %Y') 'TGL', 
				CASE B.JENIS_PENARIKAN 
					WHEN '1' THEN 'SUKARELA' 
					WHEN '2' THEN 'KESELURUHAN' 
				END AS 'JENIS', B.BESAR_PENARIKAN 'JUMLAH', B.TGL_PENARIKAN 
				FROM TR_PENARIKAN B LEFT JOIN MST_ANGGOTA D ON D.NIK = B.NIK WHERE B.NIK = '".$id."'
				ORDER BY 5 ASC";
		$ID = $this->db->query($SQL)->row()->NIK;
		$result = $func->main->get_result($SQL);
		$html = '<table width="1000%" border="0" style="padding-top:110px;">';
		$html .= '<tr>';
		$html .= '<td>';
		if($result){
			$html .= '<table class="tabelajax" id="fCari" style="width:100%;">';
			$html .= '<tbody>';
			$html .= '<tr><th style="width:3%;">No</th>';
			$html .= '<th width="200">Nomor Transaksi</th><th width="185">Tanggal Transaksi</th><th width="185">Jenis Transaksi</th><th width="150">Pemasukan</th><th width="150">Pengeluaran</th><th width="150">Saldo</th></tr>';
			$no=1;
			$SALDO = 0;
			$TOTAL_MASUK = 0;
			$TOTAL_KELUAR = 0;
			$TOTAL_SALDO = 0;
			foreach($SQL->result_array() as $data){
				$JUM = $JUM + $data["BESAR_ANGSURAN_BULAN"];
				$html .= '<tr>';
				$html .= '<td class="alt">'.$no.'</td>';
				$html .= '<td class="alt">'.$data["ID"].'</td>';
				$html .= '<td class="alt">'.$data["TGL"].'</td>';
				if(substr($data['ID'],0,1) == "S"){
					$html .= '<td class="alt">SIMPANAN '.$data["JENIS"].'</td>';
					$html .= '<td class="alt" align="right">'.number_format($data["JUMLAH"],2).'</td>';
					$html .= '<td class="alt">&nbsp;</td>';
					$SALDO = (float)$SALDO+(float)$data['JUMLAH'];
					$TOTAL_MASUK = (float)$TOTAL_MASUK+(float)$data['JUMLAH'];
				}else{
					$html .= '<td class="alt">PENARIKAN '.$data["JENIS"].'</td>';
					$html .= '<td class="alt">&nbsp;</td>';
					$html .= '<td class="alt" align="right">'.number_format($data["JUMLAH"],2).'</td>';
					$SALDO = (float)$SALDO-(float)$data['JUMLAH'];
					$TOTAL_KELUAR = (float)$TOTAL_KELUAR+(float)$data['JUMLAH'];
				}
				$TOTAL_SALDO = (float)$TOTAL_SALDO+(float)$SALDO;
				$html .= '<td class="alt" align="right">'.number_format($SALDO,2).'</td>';
				$html .= '</tr>';	
				$no++;
			}
			$html .= '<tr>';		
			$html .= '<td colspan="4" align="right"><b>TOTAL :</b></td>';		
			$html .= '<td align="right"><b>'.number_format($TOTAL_MASUK,2).'</b></td>';		
			$html .= '<td align="right"><b>'.number_format($TOTAL_KELUAR,2).'</b></td>';		
			$html .= '<td align="right"><b>'.number_format($SALDO,2).'</b></td></tr>';
			$html .= '</tbody>';
			$html .= '</table>';
		}else{
			$html .= '<table class="tabelajax" id="fCari">';
			$html .= '<tbody>';
			$html .= '<tr>';
			$html .= '<th width="10">No</th><th width="200">No Transaksi</th><th width="185">Tanggal Transaksi</th><th width="185">Jenis Transaksi</th><th width="150">Pemasukan</th><th width="150">Pengeluaran</th><th width="150">Saldo</th></tr>';
			$html .= '<tr>';
			$html .= '<td class="alt" colspan="9" align="center">Data Not Found</td>';
			$html .= '<tr>';
			$html .= '</tbody>';
			$html .= '</table>';
		}
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</table>';
		return $html;
	}
	
	function get_mutasi() {
		$func = get_instance();
		$func->load->model("main");
		
		$NIK = $this->input->post("NIK");
		$TGL_AWAL = $this->input->post("TGL_AWAL");
		$TGL_AKHIR = $this->input->post("TGL_AKHIR");
		$SQL = "SELECT A.ID_SIMPANAN 'ID', DATE_FORMAT(A.TGL_SIMPANAN,'%d %M %Y') 'TGL', 
				CASE A.JENIS_SIMPANAN
					WHEN '1' THEN 'POKOK'
					WHEN '2' THEN 'WAJIB'
					WHEN '3' THEN 'SUKARELA'
				END AS JENIS, A.BESAR_SIMPANAN 'JUMLAH', A.TGL_SIMPANAN
				FROM TR_SIMPANAN A WHERE A.NIK = '".$NIK."' AND A.TGL_SIMPANAN BETWEEN '".$TGL_AWAL."' AND '".$TGL_AKHIR."' 
				UNION ALL 
				SELECT B.ID_PENARIKAN 'ID', DATE_FORMAT(B.TGL_PENARIKAN,'%d %M %Y') 'TGL', 
				CASE B.JENIS_PENARIKAN 
					WHEN '1' THEN 'SUKARELA' 
					WHEN '2' THEN 'KESELURUHAN' 
				END AS JENIS, B.BESAR_PENARIKAN 'JUMLAH',B.TGL_PENARIKAN
				FROM TR_PENARIKAN B WHERE B.NIK = '".$NIK."' AND B.TGL_PENARIKAN BETWEEN '".$TGL_AWAL."' AND '".$TGL_AKHIR."' 
				ORDER BY 5 ASC";
		$hasil = $func->main->get_result($SQL);
		$html .= '<a href="'.site_url().'/tabungan/cetakMutasi/'.$NIK.'/'.$TGL_AWAL.'/'.$TGL_AKHIR.'" target="_blank" class="btn btn-danger btn-small"><i class="fa fa-print"></i>&nbsp;Cetak Mutasi</a><br /><br />';
		$html .= '<table class="tabelajax">';
		$html .= '<th width="1px">No</th>';
		$html .= '<th>NOMOR TRANSAKSI</th>';
		$html .= '<th>TANGGAL TRANSAKSI</th>';
		$html .= '<th>JENIS TRANSAKSI</th>';
		$html .= '<th>PEMASUKAN</th>';
		$html .= '<th>PENGELUARAN</th>';
		$html .= '<th>SALDO</th>';
		$html .= '</tr>';
		if($hasil) {
			$no=1;
			$SALDO = 0;
			$TOTAL_MASUK = 0;
			$TOTAL_KELUAR = 0;
			$TOTAL_SALDO = 0;
			foreach($SQL->result_array() as $row) {
				$html .= '<tr>';
				$html .= '<td>'.$no.'</td>';
				$html .= '<td>'.$row['ID'].'</td>';
				$html .= '<td>'.$row['TGL'].'</td>';
				if(substr($row['ID'],0,1) == "S"){
					$html .= '<td>SIMPANAN '.$row["JENIS"].'</td>';
					$html .= '<td align="right">'.number_format($row['JUMLAH'],2).'</td>';
					$html .= '<td>&nbsp;</td>';
					$SALDO = (float)$SALDO+(float)$row['JUMLAH'];
					$TOTAL_MASUK = (float)$TOTAL_MASUK+(float)$row['JUMLAH'];
				}else{
					$html .= '<td>PENARIKAN '.$row["JENIS"].'</td>';
					$html .= '<td>&nbsp;</td>';
					$html .= '<td align="right">'.number_format($row['JUMLAH'],2).'</td>';
					$SALDO = (float)$SALDO-(float)$row['JUMLAH'];
					$TOTAL_KELUAR = (float)$TOTAL_KELUAR+(float)$row['JUMLAH'];
				}
				$TOTAL_SALDO = (float)$TOTAL_SALDO+(float)$SALDO;
				$html .= '<td align="right">'.number_format($SALDO,2).'</td>';
				$html .= '</tr>';	
				$no++;
			}
			$html .= '<tr>';		
			$html .= '<td colspan="4" align="right"><b>TOTAL :</b></td>';		
			$html .= '<td align="right"><b>'.number_format($TOTAL_MASUK,2).'</b></td>';		
			$html .= '<td align="right"><b>'.number_format($TOTAL_KELUAR,2).'</b></td>';		
			$html .= '<td align="right"><b>'.number_format($SALDO,2).'</b></td>';	
		} else {
		
		}
		return $html;
	}

	function cetakMutasi($id="",$TGL_AWAL="",$TGL_AKHIR="",$type=""){
		$func = get_instance();
		$func->load->model("main","main", true);
		$NIK = $id;
		$SQL = "SELECT A.ID_SIMPANAN 'ID', DATE_FORMAT(A.TGL_SIMPANAN,'%d %M %Y') 'TGL', 
				CASE A.JENIS_SIMPANAN
					WHEN '1' THEN 'POKOK'
					WHEN '2' THEN 'WAJIB'
					WHEN '3' THEN 'SUKARELA'
				END AS JENIS, A.BESAR_SIMPANAN 'JUMLAH', A.TGL_SIMPANAN
				FROM TR_SIMPANAN A WHERE A.NIK = '".$NIK."' AND A.TGL_SIMPANAN BETWEEN '".$TGL_AWAL."' AND '".$TGL_AKHIR."' 
				UNION ALL 
				SELECT B.ID_PENARIKAN 'ID', DATE_FORMAT(B.TGL_PENARIKAN,'%d %M %Y') 'TGL', 
				CASE B.JENIS_PENARIKAN 
					WHEN '1' THEN 'SUKARELA' 
					WHEN '2' THEN 'KESELURUHAN' 
				END AS JENIS, B.BESAR_PENARIKAN 'JUMLAH', B.TGL_PENARIKAN
				FROM TR_PENARIKAN B WHERE B.NIK = '".$NIK."' AND B.TGL_PENARIKAN BETWEEN '".$TGL_AWAL."' AND '".$TGL_AKHIR."' 
				ORDER BY 5 ASC";
		$ID = $this->db->query($SQL)->row()->NIK;
		$result = $func->main->get_result($SQL);
		$html = '<table width="1000%" border="0" style="padding-top:120px;">';
		$html .= '<tr>';
		$html .= '<td>';
		if($result){
			$html .= '<table class="tabelajax" id="fCari" style="width:100%;">';
			$html .= '<tbody>';
			$html .= '<tr><th style="width:3%;">No</th>';
			$html .= '<th width="200">Nomor Transaksi</th><th width="185">Tanggal Transaksi</th><th width="185">Jenis Transaksi</th><th width="150">Pemasukan</th><th width="150">Pengeluaran</th><th width="150">Saldo</th></tr>';
			$no=1;
			$SALDO = 0;
			$TOTAL_MASUK = 0;
			$TOTAL_KELUAR = 0;
			$TOTAL_SALDO = 0;
			foreach($SQL->result_array() as $data){
				$JUM = $JUM + $data["BESAR_ANGSURAN_BULAN"];
				$html .= '<tr>';
				$html .= '<td class="alt">'.$no.'</td>';
				$html .= '<td class="alt">'.$data["ID"].'</td>';
				$html .= '<td class="alt">'.$data["TGL"].'</td>';
				if(substr($data['ID'],0,1) == "S"){
					$html .= '<td class="alt">SIMPANAN '.$data["JENIS"].'</td>';
					$html .= '<td class="alt" align="right">'.number_format($data["JUMLAH"],2).'</td>';
					$html .= '<td class="alt">&nbsp;</td>';
					$SALDO = (float)$SALDO+(float)$data['JUMLAH'];
					$TOTAL_MASUK = (float)$TOTAL_MASUK+(float)$data['JUMLAH'];
				}else{
					$html .= '<td class="alt">PENARIKAN '.$data["JENIS"].'</td>';
					$html .= '<td class="alt">&nbsp;</td>';
					$html .= '<td class="alt" align="right">'.number_format($data["JUMLAH"],2).'</td>';
					$SALDO = (float)$SALDO-(float)$data['JUMLAH'];
					$TOTAL_KELUAR = (float)$TOTAL_KELUAR+(float)$data['JUMLAH'];
				}
				$TOTAL_SALDO = (float)$TOTAL_SALDO+(float)$SALDO;
				$html .= '<td class="alt" align="right">'.number_format($SALDO,2).'</td>';
				$html .= '</tr>';	
				$no++;
			}
			$html .= '<tr>';		
			$html .= '<td colspan="4" align="right"><b>TOTAL :</b></td>';		
			$html .= '<td align="right"><b>'.number_format($TOTAL_MASUK,2).'</b></td>';		
			$html .= '<td align="right"><b>'.number_format($TOTAL_KELUAR,2).'</b></td>';		
			$html .= '<td align="right"><b>'.number_format($SALDO,2).'</b></td></tr>';	
			$html .= '</tbody>';
			$html .= '</table>';
		}else{
			$html .= '<table class="tabelajax" id="fCari">';
			$html .= '<tbody>';
			$html .= '<tr>';
			$html .= '<th width="10">No</th><th width="200">No Transaksi</th><th width="185">Tanggal Transaksi</th><th width="185">Jenis Transaksi</th><th width="150">Pemasukan</th><th width="150">Pengeluaran</th><th width="150">Saldo</th></tr>';
			$html .= '<tr>';
			$html .= '<td class="alt" colspan="9" align="center">Data Not Found</td>';
			$html .= '<tr>';
			$html .= '</tbody>';
			$html .= '</table>';
		}
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '</table>';
		return $html;
	}
}
?>