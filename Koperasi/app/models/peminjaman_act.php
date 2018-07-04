<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Peminjaman_act extends Model{
	
	function pinjaman($tipe=""){
        $this->load->library('newtable');
        $SQL = "SELECT B.NAMA_ANGGOTA 'Nama Anggota', DATE_FORMAT(A.TGL_PINJAMAN,'%d %M %Y') AS 'TANGGAL PINJAMAN', 
				FORMAT(A.BESAR_PINJAMAN,2) AS 'BESAR PINJAMAN', 
				FORMAT(A.BESAR_ANGSURAN_BULAN,2) AS 'BESAR ANGSURAN', 
				A.ALASAN_PINJAMAN AS 'ALASAN PINJAMAN', CONCAT(A.ANGSURAN_SELAMA,' - ','Kali') AS 'TOTAL ANGSURAN', 
				CONCAT(f_totangsuran(A.ID_PINJAMAN),' - ','Kali') 'ANGSURAN TERBAYAR', A.ID_PINJAMAN,
				f_totangsuran(A.ID_PINJAMAN) AS X, C.NAMA_USER AS 'DIBUAT OLEH', 
				CASE A.STATUS_ANGSURAN
					WHEN '1' THEN 'LUNAS'
					WHEN '0' THEN 'BELUM LUNAS'
				END AS 'STATUS PINJAMAN'
				FROM TR_PINJAMAN A
				LEFT JOIN MST_ANGGOTA B ON A.NIK = B.NIK
				LEFT JOIN MST_USER C ON A.ID_USER = C.ID_USER";

        $prosesnya = array('Tambah' => array('GET2', site_url()."/peminjaman/pinjaman/save", '0','fa fa-plus'),
                           'Ubah' => array('GET2', site_url()."/peminjaman/pinjaman/update", '1','fa fa-edit'),
                           'Cetak Tanda Terima Pinjaman' => array('GETNEW', site_url().'/peminjaman/cetak', 'user','fa fa-print red')
						   );	

        $this->newtable->search(array(array('B.NAMA_ANGGOTA', 'NAMA'),array('A.TGL_PINJAMAN', 'Tanggal Peminjaman','tag-tanggal')));			
        $ciuri = (!$this->input->post("ajax"))?$this->uri->segment_array():$this->input->post("uri");	
        $this->newtable->action(site_url()."/peminjaman/pinjaman");
		$this->newtable->detail(site_url() . "/peminjaman/detilPeminjaman");
        $this->newtable->detail_tipe("detil_priview_bottom");		
        $this->newtable->hiddens(array('ID_PINJAMAN','X'));			
        $this->newtable->keys(array("ID_PINJAMAN","X"));
        $this->newtable->cidb($this->db);
        $this->newtable->ciuri($ciuri);
        $this->newtable->orderby(2);
        $this->newtable->sortby("ASC");
        $this->newtable->set_formid("fdraftPeminjaman");
        $this->newtable->set_divid("divdraftPeminjaman");
        $this->newtable->rowcount(20);
        $this->newtable->clear();  
        $this->newtable->menu($prosesnya);
        $this->newtable->header_bg('#2494F2');	
        $this->newtable->tipe_proses('button');	
        $tabel .= $this->newtable->generate($SQL);		
        $arrdata = array("judul" => "Data Peminjaman KOPPEDI",
                        "tabel" => $tabel);	
        if($this->input->post("ajax")||$tipe=="ajax") return $tabel;				 
        else return $arrdata;								
    }
	
	function detilPeminjaman($id) {
        $func = get_instance();
        $func->load->model("main");
        $this->load->library('newtable');
        $SQL = "SELECT A.ANGSURAN_KE AS 'ANGSURAN KE', DATE_FORMAT(A.TGL_ANGSURAN,'%M %Y') AS 'BULAN ANGSURAN',
				CASE A.STATUS_ANGSURAN
					WHEN '1' THEN 'Sudah Terbayar' 
					WHEN '2' THEN 'Sudah Terbayar dengan Pelunasan'
				END AS 'Status Bayar' 
				FROM tr_angsuran A INNER JOIN tr_pinjaman B ON A.ID_PINJAMAN = B.ID_PINJAMAN
				WHERE B.ID_PINJAMAN = '".$id."' AND A.STATUS_ANGSURAN IN('1','2')";
        $ciuri = (!$this->input->post("ajax")) ? $this->uri->segment_array() : $this->input->post("uri");
        $this->newtable->action(site_url() . "/peminjaman/detilPeminjaman/" . $id);
        $this->newtable->cidb($this->db);
        $this->newtable->ciuri($ciuri);
        $this->newtable->set_formid("fdetilpeminjaman");
        $this->newtable->set_divid("divfdetilpeminjaman");
        $this->newtable->orderby(1);
        $this->newtable->sortby("ASC");
        $this->newtable->rowcount(10);
        $this->newtable->show_chk(false);
		$this->newtable->show_search(false);
        $this->newtable->clear();
		$this->newtable->header_bg("#4cae4c");
        $this->newtable->menu($prosesnya);
        $table = $this->newtable->generate($SQL);
        if($this->input->post("ajax")){
			echo $table;
		}else{
			$data ='<h4>Data Angsuran </h4>';
			$data.=$table;  
			echo $data;
		}
    }
	
	function get_data($type="",$act="",$id=""){
		$id = explode("|",$id);
		$func = get_instance();
		$func->load->model("main");
		if($act=="save"){
			$ids = $func->main->get_uraian("SELECT MAX(SUBSTRING(ID_PINJAMAN,-3)) AS ID FROM TR_PINJAMAN", 'ID')+1;
			$ids = "M".date("Ymd").sprintf("%03d", $ids);
			$arraydata = array('act' => $act, 'id' => $ids);
		}else{
			$SQL = "SELECT A.ID_PINJAMAN AS ID, B.NAMA_ANGGOTA, B.NIK, C.JABATAN, C.GAJI, A.TGL_PINJAMAN, A.BESAR_PINJAMAN,
					A.ALASAN_PINJAMAN, A.ANGSURAN_SELAMA, A.BULAN_MULAI, A.BULAN_SELESAI, A.PROVISI, A.TOTAL_PENGEMBALIAN, A.BESAR_ANGSURAN_BULAN
					FROM TR_PINJAMAN A LEFT JOIN MST_ANGGOTA B ON A.NIK=B.NIK
					LEFT JOIN MST_JABATAN C ON B.ID_JABATAN = C.ID_JABATAN
					WHERE A.ID_PINJAMAN = '".$id[0]."'";
			$hasil = $func->main->get_result($SQL);
			if($hasil){
				foreach($SQL->result_array() as $row){
					$data = $row;
					$id = $row["ID"];
				}
			}
			$arraydata = array('act' => $act, 'data'=>$data, 'id'=>$id);
		}
		return $arraydata;
	}
	
	function set_data(){
		$func = get_instance();
		$func->load->model("main");
		$act = $this->input->post("act");
		$ret = "MSG#ERR#Data Gagal Disimpan.";
		foreach($this->input->post("DATA") as $a=>$b){
			$DATA[$a]=$b;
		}
		if($act=="save"||$act=="update"){
			if($act=="save"){
				$sql ="SELECT A.NIK FROM TR_PINJAMAN A INNER JOIN TR_ANGSURAN B ON A.ID_PINJAMAN = B.ID_PINJAMAN 
						WHERE B.STATUS_ANGSURAN = 'N' AND A.NIK = '".$DATA["NIK"]."'";
				$rs = $this->db->query($sql);
				if($rs->num_rows() > 0) {
					$ret = "MSG#ERR#Maaf data tidak dapat diproses karena Anggota tersebut masih memiliki Pinjaman.";
				} else {
					if($DATA["ANGSURAN_SELAMA"] > 24) {
						$ret = "MSG#ERR#Maaf, proses angsuran maksimal hanya 24 Kali";
					} else {
						$DATA["ID_USER"] = $this->newsession->userdata("ID_USER");
						$this->db->insert("TR_PINJAMAN",$DATA);
						$month = strtotime($DATA["BULAN_MULAI"]);
						for($i=1;$i<=$DATA["ANGSURAN_SELAMA"];$i++){
							$ids = $func->main->get_uraian("SELECT MAX(SUBSTRING(ID_ANGSURAN,-3)) AS ID FROM tr_angsuran", 'ID')+1;
							$ids = "T".date("Ymd").sprintf("%03d", $ids);

							$blan =  date('Y-m-d', $month);
							$month = strtotime("+1 month", $month);
							$DTL["ID_ANGSURAN"] = $ids;
							$DTL["ID_PINJAMAN"] = $DATA["ID_PINJAMAN"];
							$DTL["TGL_ANGSURAN"] = $blan;
							$exec = $this->db->insert("TR_ANGSURAN",$DTL);
						}
						$ret = "MSG#OK#Data Berhasil Disimpan.#".site_url()."/peminjaman/pinjaman";
					}
				}
			}elseif($act=="update"){	
				$this->db->where(array('ID_PINJAMAN'=>$DATA["ID_PINJAMAN"]));
				$this->db->update('TR_PINJAMAN',$DATA);
				$this->db->where(array('ID_PINJAMAN'=>$DATA["ID_PINJAMAN"]));
				$this->db->delete("TR_ANGSURAN");
				$month = strtotime($DATA["BULAN_MULAI"]);
				$i = 1;
				for($i=1;$i<=$DATA["ANGSURAN_SELAMA"];$i++){
					$ids = $func->main->get_uraian("SELECT MAX(SUBSTRING(ID_ANGSURAN,-3)) AS ID FROM tr_angsuran", 'ID')+1;
					$ids = "T".date("Ymd").sprintf("%03d", $ids);
					$blan =  date('Y-m-d', $month);
					$month = strtotime("+1 month", $month);
					$DTL["ID_PINJAMAN"] = $DATA["ID_PINJAMAN"];
					$DTL["ID_ANGSURAN"] = $ids;
					$DTL["STATUS_ANGSURAN"] = "0";
					$DTL["TGL_ANGSURAN"] = $blan;
					$exec = $this->db->insert("TR_ANGSURAN",$DTL);
				}
				$ret = "MSG#OK#Data Berhasil Disimpan.#".site_url()."/peminjaman/pinjaman";
			}
		}
		echo $ret;
	}
	
	function cetak($id){
		$func = get_instance();
		$func->load->model("main");
		$id = explode("|",$id);
		$sql = "SELECT B.NAMA_ANGGOTA, DATE_FORMAT(A.TGL_PINJAMAN,'%d %M %Y') AS TGL_PINJAMAN, A.BESAR_PINJAMAN, 
				A.BESAR_ANGSURAN_BULAN AS BESAR_ANGSURAN, A.ALASAN_PINJAMAN, CONCAT(A.ANGSURAN_SELAMA,' - ','Kali') AS TOTAL_ANGSURAN, 
				B.NIK, A.ALASAN_PINJAMAN, A.ID_PINJAMAN
				FROM TR_PINJAMAN A
				LEFT JOIN MST_ANGGOTA B ON A.NIK = B.NIK
				WHERE A.ID_PINJAMAN = '".$id[0]."'";
		$hasil = $func->main->get_result($sql);
		if($hasil){
			foreach($sql->result_array() as $data){
				return array("sess"=>$data);
			}
		}
	}
	
	function getTagihan($tglAwal=""){
		$func = get_instance();
		$func->load->model("main","main", true);
		$tanggal_awal = $this->input->post("tgl_angsuran");
		if($tanggal_awal==""){
			$tanggal_awal = str_replace("~"," ",$tglAwal);
		}
		$QUERY = "SELECT TGL_ANGSURAN FROM tr_angsuran WHERE DATE_FORMAT(TGL_ANGSURAN,'%M %Y') = '".$tanggal_awal."' AND STATUS_ANGSURAN = '1'";
		$SQL = "SELECT A.NIK, B.NAMA_ANGGOTA, C.ID_ANGSURAN, 
				CASE C.STATUS_ANGSURAN
					WHEN 0 THEN f_totangsuran(A.ID_PINJAMAN)
					ELSE C.ANGSURAN_KE
				END AS ANGSURAN_KE, 
				A.ANGSURAN_SELAMA, C.ID_PINJAMAN,
				FORMAT(A.BESAR_ANGSURAN_BULAN,2) AS BESAR_ANGSURAN_BULAN,
				CASE C.STATUS_ANGSURAN
					WHEN 0 THEN 'Belum Terbayar'
					WHEN 1 THEN 'Sudah Terbayar'
				END AS STATUS, C.STATUS_ANGSURAN AS STATUS_ANGSUR, C.TGL_ANGSURAN , C.STATUS_ANGSURAN AS HIDE_STATUS
				FROM tr_pinjaman A LEFT JOIN MST_ANGGOTA B ON A.NIK=B.NIK 
				LEFT JOIN tr_angsuran C 
					ON A.ID_PINJAMAN=C.ID_PINJAMAN 
				WHERE DATE_FORMAT(C.TGL_ANGSURAN,'%M %Y') = '".$tanggal_awal."' AND C.STATUS_ANGSURAN <> '2'
				GROUP BY C.ID_PINJAMAN	";
		$rs = $this->db->query($QUERY);
		$result = $func->main->get_result($SQL);
		if($result){
			$html = '<form id="fCari">';
			if($rs->num_rows() == 0) {
				$html .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm" onClick="prosestagihan(\'fCari\')" ><i class="fa fa-save"></i>&nbsp;Proses Angsuran</a>&nbsp;';
			}
			$html .= '<a href="javascript:void(0)" onclick="cetakExcel(\''.$tanggal_awal.'\')" class="btn btn-success btn-sm" ><i class="fa fa-print"></i>&nbsp;Cetak Daftar Angsuran</a>';
			$html .= '&nbsp;<a href="'.site_url().'/peminjaman/cetakKwitansi/'.$tanggal_awal.'" class="btn btn-danger btn-sm" target="blank_"><i class="fa fa-print"></i>&nbsp;Cetak Kwitansi Angsuran</a>';
			$html .= '<table class="tabelajax" id="fCari" style="margin-top:5px;">';
			$html .= '<tbody>';
			$html .= '<input type="hidden" readonly name="tgl_angsuran" value="'.$tanggal_awal.'" />';
			$html .= '<tr><th style="width:3%;">No</th>';
			$html .= '<th>Nama Anggota</th><th>Bulan Angsuran</th><th>Angsuran Ke</th><th>Sisa Angsuran</th><th>Besar Angsuran</th><th>Status</th></tr>';
			$no = 1;
			foreach($SQL->result_array() as $data){
				if($data["HIDE_STATUS"] == 0) {
					$disabled = "";
					$angsuran_ke = $data["ANGSURAN_KE"] + 1;
				} else {
					$disabled = 'disabled = "disabled"';
					$angsuran_ke = $data["ANGSURAN_KE"];
				}
				
				$sisa_angsuran = $data["ANGSURAN_SELAMA"] - $angsuran_ke;
				$disabled = "";
				if($data["STATUS_ANGSUR"]!=0){
					$disabled = 'disabled="disabled"';
				}
				$time = strtotime($tanggal_awal);
				$html .= '<input type="hidden" readonly="true" name="DATA[ID_PINJAMAN][]" value="'.$data["ID_PINJAMAN"].'" '.$disabled.' /><input type="hidden" readonly="true" name="DATA[ID_ANGSURAN][]" value="'.$data["ID_ANGSURAN"].'" '.$disabled.' /><input type="hidden" readonly="true" name="DATA[ANGSURAN_KE][]" value="'.$angsuran_ke.'" '.$disabled.' />';
				$html .= '<tr>';
				$html .= '<td class="alt">'.$no.'</td>';
				$html .= '<td class="alt">'.$data["NAMA_ANGGOTA"].'</td>';
				$html .= '<td class="alt">'.$tanggal_awal.'</td>';
				$html .= '<td class="alt" align="right">'.$angsuran_ke.'</td>';
				$html .= '<td class="alt" align="right">'.$sisa_angsuran.'</td>';
				$html .= '<td class="alt" align="right">'.$data["BESAR_ANGSURAN_BULAN"].'</td>';
				$html .= '<td class="alt">'.$data["STATUS"].'</td>';
				$html .= '</tr>';
				$no++;
			}
			$html .= '</tbody>';
			$html .= '</table>';
			$html .= '</form>';
			return $html;
		}else{
			$html .= '<br />';
			$html .= '<table class="tabelajax" id="fCari">';
			$html .= '<tbody>';
			$html .= '<tr><th style="width:3%;">No</th><th style="width:2%;"><input type="checkbox" id="tb_chkallfCari" onclick="tb_chkall(\'fCari\')" class="tb_chkall"></th>';
			$html .= '<th>Nama Anggota</th><th>Bulan Angsuran</th><th>Angsuran Ke</th><th>Sisa Angsuran</th><th>Besar Angsuran</th><th>Status</th></tr>';
			$html .= '<tr>';
			$html .= '<td class="alt" colspan="8" align="center">Data Not Found</td>';
			$html .= '<tr>';
			$html .= '</tbody>';
			$html .= '</table>';
			return $html;
		}
	}
	
	function getPelunasan($id=""){
		$func = get_instance();
		$func->load->model("main","main", true);
		$id_anggota = $this->input->post("ID_ANGGOTA");
		if($id_anggota=="") $id_anggota = $id;
		$SQL = "SELECT A.NIK, B.NAMA_ANGGOTA, 
				FORMAT(A.BESAR_PINJAMAN,2) AS BESAR_PINJAMAN, 
				f_totangsuran(A.ID_PINJAMAN) AS ANGSURAN_KE, DATE_FORMAT(C.TGL_ANGSURAN,'%M %Y') AS TGL_ANGSURAN, 
				A.BESAR_ANGSURAN_BULAN, A.ANGSURAN_SELAMA,
				CASE C.STATUS_ANGSURAN
					WHEN 0 THEN 'Belum Terbayar'
				END AS STATUS
				FROM tr_pinjaman A LEFT JOIN MST_ANGGOTA B ON A.NIK=B.NIK 
				LEFT JOIN tr_angsuran C ON A.ID_PINJAMAN = C.ID_PINJAMAN 
				WHERE A.NIK = '".$id_anggota."' AND C.STATUS_ANGSURAN = '0' 
				ORDER BY C.TGL_ANGSURAN ASC";
		$ID = $this->db->query($SQL)->row()->NIK;
		$LAMA_ANGSURAN_BLM_BAYAR = $func->main->get_uraian("SELECT COUNT(*) AS JUM FROM TR_ANGSURAN A INNER JOIN TR_PINJAMAN B ON A.ID_PINJAMAN = B.ID_PINJAMAN WHERE B.NIK = '".$id_anggota."'  AND A.STATUS_ANGSURAN = '0'","JUM");
		$TOTAL = $func->main->get_uraian("SELECT SUM(BESAR_ANGSURAN_BULAN) AS JUM FROM TR_PINJAMAN WHERE NIK = '".$id_anggota."'","JUM");
		$result = $func->main->get_result($SQL);
		$html = '<fieldset>';
		$html .= '<legend>DETIL PELUNASAN</legend>';
		$SQL1 = "SELECT * FROM TR_ANGSURAN A LEFT JOIN TR_PINJAMAN B ON A.ID_PINJAMAN = B.ID_PINJAMAN 
				 WHERE B.NIK = '".$id_anggota."' AND A.STATUS_ANGSURAN = '2'";
		$result1 = $func->main->get_result($SQL1);
		if($result){
			$html .= '<a href="javascript:void(0);" onClick="Dialog(\''.site_url().'/peminjaman/pelunasanAngsuran/'.$ID.'/'.($TOTAL * $LAMA_ANGSURAN_BLM_BAYAR).'\',\'dialog-tbl\',\'Pelunasan\',650,400)" class="btn btn-success btn-small"><i class="fa fa-file"></i>&nbsp;Pelunasan</a>&nbsp;';
		}
		if($result1){
			$html .= '<a href="'.site_url().'/peminjaman/cetakPelunasan/'.$id_anggota.'" target="_blank" class="btn btn-danger btn-small"><i class="fa fa-print"></i>&nbsp;Cetak Kwitansi Pelunasan</a>';
		}
		$html .= '<br /><br /><div class="col-xl">';
		$html .= '<div class="panel panel-warning-alt">
				  <div class="panel-heading">
					<h3 class="panel-title">Daftar Angsuran yang belum terbayar</h3>
				  </div>
				  <div class="panel-body">';
		if($result){
			$html .= '<table class="tabelajax" id="fCari">';
			$html .= '<tbody>';
			$html .= '<tr><th style="width:3%;">No</th>';
			$html .= '<th>Bulan Angsuran</th><th>Angsuran Ke</th><th>Sisa Angsuran</th><th>Besar Angsuran</th><th>Status</th></tr>';
			$no = 1;
			foreach($SQL->result_array() as $data){
				if($data["ANGSURAN_KE"]==0){
					$angsuran_ke = 0+$no;
					$sisa_angsuran = $data["ANGSURAN_SELAMA"] - $angsuran_ke;
				}else{
					if($data["ANGSURAN_SELAMA"] == $data["ANGSURAN_KE"]){
						$angsuran_ke = $data["ANGSURAN_KE"];
						$sisa_angsuran = $data["ANGSURAN_SELAMA"] - $data["ANGSURAN_KE"];
					}else{
						$angsuran_ke = $data["ANGSURAN_KE"] +$no;
						$sisa_angsuran = $data["ANGSURAN_SELAMA"] - $angsuran_ke;
					}
				}
				$JUM = $JUM + $data["BESAR_ANGSURAN_BULAN"];
				$html .= '<tr>';
				$html .= '<td class="alt">'.$no.'</td>';
				$html .= '<td class="alt">'.$data["TGL_ANGSURAN"].'</td>';
				$html .= '<td class="alt" align="right">'.$angsuran_ke.'</td>';
				$html .= '<td class="alt" align="right">'.$sisa_angsuran.'</td>';
				$html .= '<td class="alt" align="right">'.number_format($data["BESAR_ANGSURAN_BULAN"],2).'</td>';
				$html .= '<td class="alt">'.$data["STATUS"].'</td>';
				$html .= '</tr>';
				$no++;
			}
			$html .= '<tr><td colspan="4" align="right"><b>Total</b></td><td align="right">'.number_format($JUM,2).'</td><td>&nbsp;</td></tr>';
			$html .= '</tbody>';
			$html .= '</table>';
		}else{
			$html .= '<br />';
			$html .= '<table class="tabelajax" id="fCari">';
			$html .= '<tbody>';
			$html .= '<tr>';
			$html .= '<th>Bulan Angsuran</th><th>Angsuran Ke</th><th>Sisa Angsuran</th><th>Besar Angsuran</th><th>Status</th></tr>';
			$html .= '<tr>';
			$html .= '<td class="alt" colspan="8" align="center">Data Not Found</td>';
			$html .= '<tr>';
			$html .= '</tbody>';
			$html .= '</table>';
		}
		
		$html .= '</div></div>';
		$html .= '</div>';
		
		$SQL1 = "SELECT A.NIK, B.NAMA_ANGGOTA, 
				FORMAT(A.BESAR_PINJAMAN,2) AS BESAR_PINJAMAN, 
				C.ANGSURAN_KE, DATE_FORMAT(C.TGL_ANGSURAN,'%M %Y') AS TGL_ANGSURAN, 
				A.BESAR_ANGSURAN_BULAN, A.ANGSURAN_SELAMA,
				CASE C.STATUS_ANGSURAN
					WHEN 1 THEN 'Sudah Terbayar'
					WHEN 2 THEN 'Terbayar dengan Metode Pelunasan'
				END AS STATUS
				FROM tr_pinjaman A LEFT JOIN MST_ANGGOTA B ON A.NIK=B.NIK 
				LEFT JOIN tr_angsuran C ON A.ID_PINJAMAN=C.ID_PINJAMAN 
				WHERE A.NIK = '".$id_anggota."' AND C.STATUS_ANGSURAN IN('1','2') 
				ORDER BY C.TGL_ANGSURAN ASC";
		$result1 = $func->main->get_result($SQL1);
		$html .= '<div class="col-xl">';
		$html .= '<div class="panel panel-success-alt">
				  <div class="panel-heading">
					<h3 class="panel-title">Daftar Angsuran yang sudah terbayar</h3>
				  </div>
				  <div class="panel-body">';
		if($result1){
			$html .= '<table class="tabelajax" id="fCari">';
			$html .= '<tbody>';
			$html .= '<tr><th style="width:3%;">No</th>';
			$html .= '<th>Bulan Angsuran</th><th>Angsuran Ke</th><th>Sisa Angsuran</th><th>Besar Angsuran</th><th>Status</th></tr>';
			$nox = 1;
			foreach($SQL1->result_array() as $data){
				$angsuran_ke = $data["ANGSURAN_KE"];
				$sisa_angsuran = $data["ANGSURAN_SELAMA"] - $angsuran_ke;
				$JUM1 = $JUM1 + $data["BESAR_ANGSURAN_BULAN"];
				$html .= '<tr>';
				$html .= '<td class="alt">'.$nox.'</td>';
				$html .= '<td class="alt">'.$data["TGL_ANGSURAN"].'</td>';
				$html .= '<td class="alt" align="right">'.$angsuran_ke.'</td>';
				$html .= '<td class="alt" align="right">'.$sisa_angsuran.'</td>';
				$html .= '<td class="alt" align="right">'.number_format($data["BESAR_ANGSURAN_BULAN"],2).'</td>';
				$html .= '<td class="alt">'.$data["STATUS"].'</td>';
				$html .= '</tr>';
				$no++;
			}
			$html .= '<tr><td colspan="4" align="right"><b>Total</b></td><td align="right">'.number_format($JUM1,2).'</td><td>&nbsp;</td></tr>';
			$html .= '</tbody>';
			$html .= '</table>';
		}else{
			$html .= '<br />';
			$html .= '<table class="tabelajax" id="fCari">';
			$html .= '<tbody>';
			$html .= '<tr><th style="width:3%;">No</th>';
			$html .= '<th>Bulan Angsuran</th><th>Angsuran Ke</th><th>Sisa Angsuran</th><th>Besar Angsuran</th><th>Status</th></tr>';
			$html .= '<tr>';
			$html .= '<td class="alt" colspan="8" align="center">Data Not Found</td>';
			$html .= '<tr>';
			$html .= '</tbody>';
			$html .= '</table>';
		}
		
		$html .= '</div></div>';
		$html .= '</div>';
		$html .= '</fieldset>';
		return $html;
	}
	
	function proses_tagihan() {
		$func = get_instance();
		$func->load->model("main");		

		$tgl_simpan = $this->input->post("tgl_angsuran");
		$date=date_create($tgl_simpan);
		$arrdetil = $this->input->post('DATA');

		$arrkeys = array_keys($arrdetil);
		for($i=0;$i<count($arrdetil[$arrkeys[0]]);$i++){			
			for($j=0;$j<count($arrkeys);$j++){
				$data[$arrkeys[$j]] = $arrdetil[$arrkeys[$j]][$i];
			}
			#----- UPDATE TR_SIMPANAN BERDASARKAN ID_ANGSURAN DAN ID_PINJAMAN
			$this->db->where(array("ID_ANGSURAN"=>$data["ID_ANGSURAN"],"ID_PINJAMAN"=>$data["ID_PINJAMAN"]));
			$exec = $this->db->update("TR_ANGSURAN",array("STATUS_ANGSURAN"=>"1","ANGSURAN_KE"=>$data["ANGSURAN_KE"]));
			if($exec){
				$LAMA_ANGSURAN = $func->main->get_uraian("SELECT ANGSURAN_SELAMA FROM TR_PINJAMAN WHERE ID_PINJAMAN = '".$data["ID_PINJAMAN"]."'","ANGSURAN_SELAMA");
				if($data["ANGSURAN_KE"] == $LAMA_ANGSURAN ){
					$this->db->where(array("ID_PINJAMAN"=>$data["ID_PINJAMAN"]));
					$this->db->update("TR_PINJAMAN",array("STATUS_ANGSURAN"=>"1"));
				}
			}
		}
		if($exec) {
			return "MSG#OK#Data Berhasil Diproses.#".site_url()."/peminjaman/getTagihan/".str_replace(" ","~",$this->input->post("tgl_angsuran"));
		} else {
			return "MSG#ERR#Data Gagal Diproses.";
		}
	}

	function proses_tagihan1(){
		$func = get_instance();
		$func->load->model("main","main", true);
		$data = $this->input->post("tb_chkfCari");
		$ret = "MSG#ERR#Data Gagal Diproses.";
		$query = "SELECT STATUS FROM DTL_PINJAMAN  WHERE STATUS = '1'";
		$rs = $this->db->query($query);
		if($data){
			if($rs->num_rows()>0){
				$ret = "MSG#ERR#Maaf Data tidak dapat diproses. \n Data tagihan sebelumnya masih menunggu Approval.";
			}else{
				foreach($data as $chk_item){
					$data = explode("|",$chk_item);
					unset($TAGIHAN);
					$MAX = $func->main->get_uraian("SELECT MAX(ANGSURAN_KE) AS JUM FROM dtl_pinjaman WHERE ID_HDR_PINJAMAN = '".$data[2]."'","JUM")+1;
					$ID_TEMP = $func->main->get_uraian("SELECT MAX(SUBSTRING(ID_TAGIHAN,-1)) AS ID FROM TR_TAGIHAN", 'ID')+1;
					$ID_TAGIHAN = "T".sprintf("%03d", $ID_TEMP);
					$TAGIHAN["ID_TAGIHAN"] = $ID_TAGIHAN;
					$TAGIHAN["TGL_TAGIHAN"] = $data[1];
					$TAGIHAN["ID_HDR_PINJAMAN"] = $data[2];
					$TAGIHAN["TAGIHAN_KE"] = $MAX;
				
					$this->db->insert("tr_tagihan",$TAGIHAN);
					$this->db->where(array("ID_HDR_PINJAMAN"=>$data[2],"TGL_ANGSURAN"=>$data[1]));
					$exec = $this->db->update("dtl_pinjaman",array("STATUS"=>"1"));
				}
				if($exec){
					$ret = "MSG#OK#Data Berhasil Diproses.#".site_url()."/peminjaman/getAngsuran/".str_replace(" ","~",$this->input->post("tgl_awal"));
				}
			}
		}else{
			$ret = "MSG#OK#Data sedang dalam proses Menunggu Tagihan.#".site_url()."/peminjaman/getAngsuran/".str_replace(" ","~",$this->input->post("tgl_awal"));
		}
		if($rs->num_rows()==0){
			foreach($this->input->post("SKIP") as $post){
				$post = explode("|",$post);
				$tgl_angsuran = $post[0];
				$id_hdr = $post[1];
				$STATUS = $func->main->get_uraian("SELECT STATUS FROM dtl_pinjaman WHERE TGL_ANGSURAN = '".$tgl_angsuran."' AND ID_HDR_PINJAMAN = '".$id_hdr."'","STATUS");
				$TGL = $func->main->get_uraian("SELECT MAX(TGL_ANGSURAN) AS TGL FROM dtl_pinjaman WHERE ID_HDR_PINJAMAN = '".$id_hdr."'","TGL");
				if($STATUS=='0'){
					$this->db->query("UPDATE dtl_pinjaman SET TGL_ANGSURAN = DATE_ADD('".$TGL."', INTERVAL 1 MONTH) WHERE TGL_ANGSURAN = '".$tgl_angsuran."' AND ID_HDR_PINJAMAN = '".$id_hdr."'");
				}
			}
		}
		
		echo $ret;
	}
	
	function cetak_tagihan($bulan_tagihan){
		$func = get_instance();
		$func->load->model("main","main", true);
		$SQL = "SELECT A.NIK, B.NAMA_ANGGOTA, 
				CASE C.STATUS_ANGSURAN 
					WHEN 0 THEN f_totangsuran(A.ID_PINJAMAN)
					ELSE C.ANGSURAN_KE
				END AS ANGSURAN_KE, 
				A.ANGSURAN_SELAMA, C.ID_PINJAMAN, A.BESAR_ANGSURAN_BULAN,
				CASE C.STATUS_ANGSURAN
					WHEN 0 THEN 'Belum Terbayar'
					WHEN 1 THEN 'Sudah Terbayar'
					WHEN 2 THEN 'Sudah Terbayar dengan Metode Pelunasan'
				END AS STATUS, C.STATUS_ANGSURAN AS STATUS_ANGSUR, C.TGL_ANGSURAN , C.STATUS_ANGSURAN AS HIDE_STATUS
				FROM tr_pinjaman A LEFT JOIN MST_ANGGOTA B ON A.NIK=B.NIK 
				LEFT JOIN TR_ANGSURAN C 
					ON A.ID_PINJAMAN=C.ID_PINJAMAN 
				WHERE DATE_FORMAT(C.TGL_ANGSURAN,'%M %Y') = '".$bulan_tagihan."' AND C.STATUS_ANGSURAN IN(0,1)
				GROUP BY C.ID_PINJAMAN	";
		$result = $func->main->get_result($SQL);
		if($result){
			$html = '<table class="tabelajax" id="fCari">';
			$html .= '<tbody>';
			$html .= '<tr><td colspan="7" align="center"><h4>Daftar Angsuran Karyawan Bulan '.$bulan_tagihan.'</h4></td></tr>';
			$html .= '<tr><td colspan="7">&nbsp;</td></tr>';
			$html .= '<tr><th style="width:3%;" style="background-color:#DBEAF9">No</th>';
			$html .= '<th style="background-color:#DBEAF9">Nama Anggota</th><th style="background-color:#DBEAF9">Bulan Angsuran</th><th style="background-color:#DBEAF9">Angsuran Ke</th><th style="background-color:#DBEAF9">Sisa Angsuran</th><th style="background-color:#DBEAF9">Besar Angsuran</th><th style="background-color:#DBEAF9">Status</th></tr>';
			$no = 1;
			foreach($SQL->result_array() as $data){
				if($data["HIDE_STATUS"] == 0) {
					$angsuran_ke = $data["ANGSURAN_KE"] + 1;
				} else {
					$angsuran_ke = $data["ANGSURAN_KE"];
				}
				
				$sisa_angsuran = $data["ANGSURAN_SELAMA"] - $angsuran_ke;
				$JUM1 = $JUM1 + $data["BESAR_ANGSURAN_BULAN"];
				$html .= '<tr>';
				$html .= '<td class="alt">'.$no.'</td>';
				$html .= '<td class="alt">'.$data["NAMA_ANGGOTA"].'</td>';
				$html .= '<td class="alt">'.$bulan_tagihan.'</td>';
				$html .= '<td class="alt">'.$angsuran_ke.'</td>';
				$html .= '<td class="alt">'.$sisa_angsuran.'</td>';
				$html .= '<td class="alt" align="right">'.number_format($data["BESAR_ANGSURAN_BULAN"],2).'</td>';
				$html .= '<td class="alt">'.$data["STATUS"].'</td>';
				$html .= '</tr>';
				$no++;
			}
			$html .= '<tr><td colspan="5" align="right"><b>Total</b></td><td align="right">'.number_format($JUM1,2).'</td><td>&nbsp;</td></tr>';			
			$html .= "<tr><td colspan=\"7\">&nbsp;</td></tr>";
			$html .= "<tr><td colspan=\"5\" align=\"right\"></td><td colspan=\"2\" align=\"center\">Jakarta, ".date('d M Y')."</td></tr>";
			$html .= "<tr><td colspan=\"5\" align=\"right\">&nbsp;</td><td colspan=\"2\" align=\"center\"><b>Ketua Koperasi</b></td></tr>";
			$html .= '<tr><td colspan="7">&nbsp;</td></tr>';
			$html .= '<tr><td colspan="7">&nbsp;</td></tr>';
			$html .= '<tr><td colspan="7">&nbsp;</td></tr>';
			$html .= "<tr><td colspan=\"5\" align=\"right\">&nbsp;</td><td colspan=\"2\" align=\"center\">Ali Ma'ruf</td></tr>";
			$html .= '</tbody>';
			$html .= '</table>';
		}else{
			$html .= '<table class="tabelajax" id="fCari">';
			$html .= '<tbody>';
			$html .= '<tr><th style="width:3%;">No</th>';
			$html .= '<th>Nama Anggota</th><th>Bulan Angsuran</th><th>Angsuran Ke</th><th>Sisa Angsuran</th><th>Besar Angsuran</th><th>Status</th></tr>';
			$html .= '<tr>';
			$html .= '<td class="alt" colspan="8" align="center">Data Not Found</td>';
			$html .= '<tr>';
			$html .= '</tbody>';
			$html .= '</table>';
		}
		echo $html;
	}

	function pelunasanAngsuran(){
		$func = get_instance();
		$func->load->model("main","main", true);
		$NIK = $this->input->post("ID");
		$SQL = "SELECT A.ANGSURAN_KE, A.ID_PINJAMAN, B.ANGSURAN_SELAMA, A.TGL_ANGSURAN, A.ID_ANGSURAN
				FROM TR_ANGSURAN A INNER JOIN TR_PINJAMAN B ON A.ID_PINJAMAN = B.ID_PINJAMAN
				WHERE B.NIK = '".$NIK."' AND A.STATUS_ANGSURAN = '0' 
				ORDER BY A.TGL_ANGSURAN ASC";
		$result = $func->main->get_result($SQL);
		if($result){
			foreach($SQL->result_array() as $data){
				$ANGSURAN_KE = $func->main->get_uraian("SELECT MAX(ANGSURAN_KE) AS JUM FROM TR_ANGSURAN WHERE ID_PINJAMAN = '".$data["ID_PINJAMAN"]."'","JUM")+1;
				#echo $ANGSURAN_KE;die();
				$this->db->where(array(
									"ID_PINJAMAN"	=> $data["ID_PINJAMAN"],
									"ID_ANGSURAN"	=> $data["ID_ANGSURAN"],
									"TGL_ANGSURAN"	=> $data["TGL_ANGSURAN"]

								));
				$this->db->update("TR_ANGSURAN",array("STATUS_ANGSURAN"=>"2","ANGSURAN_KE"=>$ANGSURAN_KE));
				if($ANGSURAN_KE == $data["ANGSURAN_SELAMA"]){
					$this->db->where(array("ID_PINJAMAN"=>$data["ID_PINJAMAN"]));
					$this->db->update("TR_PINJAMAN",array("STATUS_ANGSURAN"=>"1"));
				}
			}
		}
		echo "MSG#OK#Proses Pelunasan Berhasil.#".site_url()."/peminjaman/getPelunasan/".$NIK;
	}
	
	function cetakPelunasan($id="",$type=""){
		$func = get_instance();
		$func->load->model("main","main", true);
		$id_anggota = $id;
		$SQL = "SELECT A.NIK, B.NAMA_ANGGOTA, 
				SUM(A.BESAR_ANGSURAN_BULAN) AS BESAR_ANGSURAN_BULAN
				FROM tr_pinjaman A LEFT JOIN MST_ANGGOTA B ON A.NIK=B.NIK 
				LEFT JOIN tr_angsuran C ON A.ID_PINJAMAN=C.ID_PINJAMAN 
				WHERE A.NIK = '".$id_anggota."' AND C.STATUS_ANGSURAN = '2'";
		$result = $func->main->get_result($SQL);
		$html = '<table width="1000%" border="0" style="padding-top:70px;">';
		$html .= '<tr>';
		$html .= '<td>';
		if($result){
			foreach ($SQL->result_array() as $sess) {
				$html = '<table style="margin-top:-30px;" width="100%">
							<tr>
								<td colspan="3" style="font-family:Gotham, \'Helvetica Neue\', Helvetica, Arial, sans-serif; border-bottom:1px solid #000; font-size:14px; text-align:center;">
						        	<b style="text-align:center;"><h2><br/>Kwitansi Pembayaran<h2></b>
						       	</td>
							</tr>
							<tr>
						    	<td colspan="3"><strong>&nbsp;</strong></td>
						    </tr>
						    <tr>
						        <td width="20%"><strong>Jenis Transaksi</strong></td>
						        <td width="1%">:</td>
						        <td width="79%">Pembayaran Pelunasan</td>
						    </tr>
						    <tr>
						    	<td><strong>NIK</strong></td>
						        <td>:</td>
						        <td>'.$sess["NIK"].'</td>
						    </tr>
						    <tr>
						    	<td><strong>Nama Anggota</strong></td>
						        <td>:</td>
						        <td>'.$sess["NAMA_ANGGOTA"].'</td>
						    </tr>
						    <tr>
						    	<td><strong>Total Pembayaran</strong></td>
						        <td>:</td>
						        <td>Rp.&nbsp;'.number_format($sess["BESAR_ANGSURAN_BULAN"],2).'</td>
						    </tr>
						    <tr>
						    	<td><strong>Terbilang</strong></td>
						        <td>:</td>
						        <td>'.$this->fungsi->Terbilang($sess["BESAR_ANGSURAN_BULAN"])." Rupiah".'</td>
						    </tr>
						</table>
						<br><br>
						<table width="90%">
						    <tr>
						        <td style="text-align:right;">Jakarta, '.date('d M Y').'</td>
						    </tr>
						    <tr>
						        <td style="text-align:right;"><strong>Staff KOPPEDI</strong></td>
						    </tr>
						    <tr><td>&nbsp;</td></tr>
						    <tr><td>&nbsp;</td></tr>
						    <tr><td>&nbsp;</td></tr>
						    <tr><td>&nbsp;</td></tr>
						    <tr>
						    	<td style="text-align:right;">( '.$this->newsession->userdata("NAMA_USER").' )</td>
						    </tr>
						</table>';
			}
		}
		return $html;
	}
	
	function cetakKwitansi($tgl) {
		$func = get_instance();
		$func->load->model("main","main", true);
		$id_anggota = $id;
		$SQL = "SELECT SUM(A.BESAR_ANGSURAN_BULAN) AS BESAR_ANGSURAN_BULAN
				FROM tr_pinjaman A LEFT JOIN MST_ANGGOTA B ON A.NIK=B.NIK LEFT JOIN tr_angsuran C 
				ON A.ID_PINJAMAN=C.ID_PINJAMAN 
				WHERE DATE_FORMAT(C.TGL_ANGSURAN,'%M %Y') = '".$tgl."' AND C.STATUS_ANGSURAN IN(0,1)";
		$result = $func->main->get_result($SQL);
		$html = '<table width="1000%" border="0" style="padding-top:70px;">';
		$html .= '<tr>';
		$html .= '<td>';
		if($result){
			foreach ($SQL->result_array() as $sess) {
				$html = '<table style="margin-top:-30px;" width="100%">
							<tr>
								<td colspan="3" style="font-family:Gotham, \'Helvetica Neue\', Helvetica, Arial, sans-serif; border-bottom:1px solid #000; font-size:14px; text-align:center;">
						        	<b style="text-align:center;"><h2><br/>Kwitansi Pembayaran<h2></b>
						       	</td>
							</tr>
							<tr>
						    	<td colspan="3"><strong>&nbsp;</strong></td>
						    </tr>
						    <tr>
						        <td width="20%"><strong>Tanggal Transaksi</strong></td>
						        <td width="1%">:</td>
						        <td width="79%">'.$tgl.'</td>
						    </tr>
						    <tr>
						        <td width="20%"><strong>Jenis Transaksi</strong></td>
						        <td width="1%">:</td>
						        <td width="79%">Pembayaran Angsuran</td>
						    </tr>
						    <tr>
						    	<td><strong>Nama</strong></td>
						        <td>:</td>
						        <td>PT. EDI INDONESIA</td>
						    </tr>
						    <tr>
						    	<td><strong>Total angsuran</strong></td>
						        <td>:</td>
						        <td>Rp. '.number_format($sess["BESAR_ANGSURAN_BULAN"],2).'</td>
						    </tr>
						    <tr>
						    	<td><strong>Terbilang</strong></td>
						        <td>:</td>
						        <td>'.$this->fungsi->Terbilang($sess["BESAR_ANGSURAN_BULAN"])." Rupiah".'</td>
						    </tr>
						</table>
						<br><br>
						<table width="90%">
						    <tr>
						        <td style="padding-left:500px;text-align:center;">Jakarta, '.date('d M Y').'</td>
						    </tr>
						    <tr>
						        <td style="padding-left:500px;text-align:center;"><strong>Staff KOPPEDI</strong></td>
						    </tr>
						    <tr><td>&nbsp;</td></tr>
						    <tr><td>&nbsp;</td></tr>
						    <tr><td>&nbsp;</td></tr>
						    <tr><td>&nbsp;</td></tr>
						    <tr>
						    	<td style="padding-left:500px;text-align:center;">( '.$this->newsession->userdata("NAMA_USER").' )</td>
						    </tr>
						</table>';
			}
		}
		return $html;
	}

}
?>