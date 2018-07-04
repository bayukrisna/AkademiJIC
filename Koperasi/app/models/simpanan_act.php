<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Simpanan_act extends Model{
	
	function simpan($tipe="", $ajax=""){
        $this->load->library('newtable');
		if($tipe == "sukarela") {
			$SQL = "SELECT A.ID_SIMPANAN 'Nomor Transaksi', B.NIK, B.NAMA_ANGGOTA 'Nama Anggota', DATE_FORMAT(A.TGL_SIMPANAN,'%d %b %Y') AS 'TANGGAL SIMPANAN', 
					FORMAT(A.BESAR_SIMPANAN,2) 'Besar Simpanan'
					FROM TR_SIMPANAN A
					LEFT JOIN MST_ANGGOTA B ON A.NIK = B.NIK 
					WHERE A.JENIS_SIMPANAN = '3'";

			$prosesnya = array(
							'Tambah' 				=> array('GET2', site_url()."/simpanan/sukarela/save", '0','fa fa-plus'),
							'Cetak Kwitansi Simpanan' 	=> array('GETNEW', site_url().'/simpanan/cetak/sukarela', 'user','fa fa-print red')
							);
			$this->newtable->keys(array("Nomor Transaksi"));
			$this->newtable->search(array(array('B.NAMA_ANGGOTA', 'NAMA'),array('A.TGL_SIMPANAN', 'Tanggal Simpanan','tag-tanggal')));
			$this->newtable->orderby("ID_SIMPANAN");
			$this->newtable->sortby("DESC");
		} else if($tipe == "wajib") {
			$SQL = "SELECT DATE_FORMAT(TGL_SIMPANAN,'%M %Y') AS 'TANGGAL SIMPANAN', 
					FORMAT(SUM(BESAR_SIMPANAN),2) 'Total Simpanan', TGL_SIMPANAN
					FROM TR_SIMPANAN
					WHERE JENIS_SIMPANAN = '2'";

			$prosesnya = array(
							'Tambah' 				=> array('GET2', site_url()."/simpanan/wajib/save", '0','fa fa-plus'),
							'Cetak Bukti Simpanan' 	=> array('GETNEW', site_url().'/simpanan/cetak/kwitansiWajib', 'user','fa fa-print red')
							);
			$this->newtable->group(array("TGL_SIMPANAN"));
			$this->newtable->keys(array("TGL_SIMPANAN"));
			$this->newtable->hiddens(array("TGL_SIMPANAN"));
			$this->newtable->detail(site_url()."/simpanan/wajib/view");
			$this->newtable->detail_tipe("detil_priview_bottom");
			$this->newtable->show_search(false);
			$this->newtable->search(array(array('TGL_SIMPANAN', 'Tanggal Simpanan','tag-tanggal')));
			$this->newtable->orderby("TGL_SIMPANAN");
			$this->newtable->sortby("DESC");
		}	
		$ciuri = (!$this->input->post("ajax"))?$this->uri->segment_array():$this->input->post("uri");	
		$this->newtable->action(site_url()."/simpanan/".$tipe);	
		$this->newtable->cidb($this->db);
		$this->newtable->ciuri($ciuri);
		$this->newtable->set_formid("fdetilSimpanan");
		$this->newtable->set_divid("divdetilSimpanan");
		$this->newtable->rowcount(20);
		$this->newtable->clear();  
		$this->newtable->menu($prosesnya);
		$this->newtable->header_bg('#2494F2');	
		$this->newtable->tipe_proses('button');	
		$tabel .= $this->newtable->generate($SQL);		
		$arrdata = array("tabel" => $tabel);	
		if($this->input->post("ajax")||$tipe=="ajax") return $tabel;				 
		else return $arrdata;
    }

    function get_rincian_wajib($id) {
        $this->load->library('newtable');
    	$SQL = "SELECT A.ID_SIMPANAN 'Nomor Transaksi', B.NIK, B.NAMA_ANGGOTA 'Nama Anggota', 
    			DATE_FORMAT(A.TGL_SIMPANAN,'%d %b %Y') AS 'TANGGAL SIMPANAN', 
				FORMAT(A.BESAR_SIMPANAN,2) 'Besar Simpanan'
				FROM TR_SIMPANAN A
				LEFT JOIN MST_ANGGOTA B ON A.NIK = B.NIK 
				WHERE A.JENIS_SIMPANAN = '2' AND A.TGL_SIMPANAN = '".$id."'";
		$ciuri = (!$this->input->post("ajax"))?$this->uri->segment_array():$this->input->post("uri");	
		$this->newtable->action(site_url()."/simpanan/wajib/view/".$id);	
		$this->newtable->search(array(array('B.NAMA_ANGGOTA', 'NAMA'),array('A.TGL_SIMPANAN', 'Tanggal Simpanan','tag-tanggal')));
		$this->newtable->cidb($this->db);
		$this->newtable->ciuri($ciuri);
		$this->newtable->orderby(1);
		$this->newtable->sortby("ASC");
		$this->newtable->show_chk(false);
		$this->newtable->set_formid("fdraftSimpanan");
		$this->newtable->set_divid("divdraftSimpanan");
		$this->newtable->rowcount(20);
		$this->newtable->clear();  
		$this->newtable->menu($prosesnya);
		$this->newtable->header_bg('#36D7B7');	
		$this->newtable->tipe_proses('button');	
		$tabel .= $this->newtable->generate($SQL);		
		return $tabel;
    }
	
	function tarikan($tipe="", $ajax=""){
        $this->load->library('newtable');
        $SQL = "SELECT A.ID_PENARIKAN 'Nomor Transaksi', B.NIK 'NIK', B.NAMA_ANGGOTA 'Nama Anggota', DATE_FORMAT(A.TGL_PENARIKAN,'%d %M %Y') AS 'Tanggal Penarikan', 
				FORMAT(A.BESAR_PENARIKAN,2) AS 'Besar Penarikan', A.KET_PENARIKAN AS 'Keterangan'
				FROM TR_PENARIKAN A
				LEFT JOIN MST_ANGGOTA B ON A.NIK = B.NIK";

        $prosesnya = array('Tambah' => array('GET2', site_url()."/simpanan/tarikan/save", '0','fa fa-plus'),
                           //'Ubah' => array('GET2', site_url()."/simpanan/tarikan/update", '1','fa fa-edit'),
                           'Cetak Tanda Terima Penarikan' => array('GETNEW', site_url().'/simpanan/cetak/tarikan', 'user','fa fa-print red')
						   );	

        $this->newtable->search(array(array('B.NAMA_ANGGOTA', 'NAMA'),array('A.TGL_PENARIKAN', 'Tanggal Penarikan','tag-tanggal')));			
        $ciuri = (!$this->input->post("ajax"))?$this->uri->segment_array():$this->input->post("uri");	
        $this->newtable->action(site_url()."/simpanan/tarikan");	
        //$this->newtable->hiddens(array('ID_PENARIKAN','X'));			
        $this->newtable->keys(array("Nomor Transaksi"));
        $this->newtable->cidb($this->db);
        $this->newtable->ciuri($ciuri);
        $this->newtable->orderby("A.ID_PENARIKAN");
        $this->newtable->sortby("DESC");
        $this->newtable->set_formid("fdraftSimpanan");
        $this->newtable->set_divid("divdraftSimpanan");
        $this->newtable->rowcount(20);
        $this->newtable->clear();  
        $this->newtable->menu($prosesnya);
        $this->newtable->header_bg('#2494F2');	
        $this->newtable->tipe_proses('button');	
        $tabel .= $this->newtable->generate($SQL);		
        $arrdata = array("judul" => "Data Penarikan Simpanan KOPPEDI",
                        "tabel" => $tabel);	
        if($this->input->post("ajax")||$tipe=="ajax") return $tabel;				 
        else return $arrdata;								
    }
	
	
	function get_data($type="",$act="",$id=""){
		$id = explode("|",$id);
		$func = get_instance();
		$func->load->model("main");
		if($act=="save"){
			if ($type=="sukarela"){
				$ids = $func->main->get_uraian("SELECT MAX(SUBSTRING(ID_SIMPANAN,-3)) AS ID FROM TR_SIMPANAN", 'ID')+1;
				$ids = "S".date("Ymd").sprintf("%03d", $ids);
				$arraydata = array('act' => $act, 'id' => $ids);
			}elseif($type=="tarikan"){
				$ids = $func->main->get_uraian("SELECT MAX(SUBSTRING(ID_PENARIKAN,-3)) AS ID FROM TR_PENARIKAN", 'ID')+1;
				$ids = "P".date("Ymd").sprintf("%03d", $ids);
				$arraydata = array('act' => $act, 'id' => $ids);
			} elseif($type == "wajib") {
				$tgl_simpanan = $this->input->post('tgl_simpanan');

				$QUERY = "SELECT TGL_SIMPANAN FROM tr_simpanan 
						  WHERE DATE_FORMAT(TGL_SIMPANAN,'%M %Y') = '".$tgl_simpanan."' AND JENIS_SIMPANAN = '2'";
				$rs = $this->db->query($QUERY);
				if($rs->num_rows() > 0) { 
					$SQL = "SELECT A.NIK, A.NAMA_ANGGOTA, A.SIMPANAN_WAJIB FROM mst_anggota A 
							INNER JOIN tr_simpanan B ON A.NIK = B.NIK 
							WHERE A.STATUS_ANGGOTA = '1' AND DATE_FORMAT(B.TGL_SIMPANAN,'%M %Y') = '".$tgl_simpanan."' 
							AND JENIS_SIMPANAN = '2'";//echo $SQL;die();
				} else {
					$tgl = date_create($tgl_simpanan);
					$tgl_daftar = date_format($tgl,"Y-m");
					$SQL = "SELECT A.NIK, A.NAMA_ANGGOTA, A.SIMPANAN_WAJIB FROM mst_anggota A
							WHERE A.STATUS_ANGGOTA = '1' AND DATE_FORMAT(TANGGAL_DAFTAR,'%Y-%m') < '".$tgl_daftar."' ";
				}

				$hasil = $func->main->get_result($SQL);
				if($hasil) {
					$arraydata = '<form id="fCari" method="post">';
					if($rs->num_rows() == 0) {
						$arraydata .= '<a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="prosesSimpananWajib(\'fCari\')"><i class="fa fa-save"></i>&nbsp;Proses Simpanan Wajib</a>&nbsp;';
					}
					$arraydata .= '<a href="'.site_url().'/simpanan/cetak/daftarwajib/'.$tgl_simpanan.'" class="btn btn-danger btn-sm" target="blank_"><i class="fa fa-print"></i>&nbsp;Cetak Simpanan Wajib</a>';
					//$arraydata .= '&nbsp;<a href="'.site_url().'/simpanan/cetak/kwitansiWajib/'.$tgl_simpanan.'" class="btn btn-warning btn-sm" target="blank_"><i class="fa fa-print"></i>&nbsp;Cetak Kwitansi Simpanan</a>';
					$arraydata .= '<table class="tabelajax" id="fCari" style="margin-top: 5px;">';
					$arraydata .= '<tbody><input type="hidden" name="tgl_simpanan" value="'.$tgl_simpanan.'" readonly />';
					$arraydata .= '<tr><th style="width:3%;">No</th>';
					$arraydata .= '<th style="width:32%;">NIK</th><th style="width:32%;">Nama Anggota</th><th style="width:32%;">Besar Simpanan Wajib</th></tr>';
					$no = 1;
					foreach($SQL->result_array() as $data) {
						$arraydata .= '<tr>';
						$arraydata .= '<input type="hidden" name="DATA[NIK][]" value="'.$data["NIK"].'" readonly />';
						$arraydata .= '<input type="hidden" name="DATA[BESAR_SIMPANAN][]" value="'.$data["SIMPANAN_WAJIB"].'" readonly />';
						$arraydata .= '<td class="alt">'.$no.'</td>';
						$arraydata .= '<td class="alt">'.$data["NIK"].'</td>';
						$arraydata .= '<td class="alt">'.$data["NAMA_ANGGOTA"].'</td>';
						$arraydata .= '<td class="alt" align="right">Rp. '.number_format($data["SIMPANAN_WAJIB"],2).'</td>';
						$arraydata .= '</tr>';
						$no++;
					}
				} else {
					$arraydata .= '<table class="tabelajax" id="fCari" style="margin-top: 5px;"><tbody><tr><th style="text-align:center;">Data Not Found</th></tr></tbody></table>';
				}
			}
		}else{
			if ($type=="simpan"){
				$SQL = "SELECT A.ID_SIMPANAN AS ID, B.NAMA_ANGGOTA, B.NIK, A.TGL_SIMPANAN, A.BESAR_SIMPANAN,
						A.JENIS_SIMPANAN FROM TR_SIMPANAN A LEFT JOIN MST_ANGGOTA B ON A.NIK=B.NIK
						WHERE A.ID_SIMPANAN = '".$id[0]."'";
			}elseif($type=="tarikan"){
				$SQL = "SELECT A.ID_PENARIKAN AS ID, B.NAMA_ANGGOTA, B.NIK, A.TGL_PENARIKAN, A.BESAR_PENARIKAN, A.KET_PENARIKAN
						FROM TR_PENARIKAN A LEFT JOIN MST_ANGGOTA B ON A.NIK=B.NIK
						WHERE A.ID_PENARIKAN = '".$id[0]."'";
			}
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
	
	function set_data($type="",$act=""){
		$func = get_instance();
		$func->load->model("main");
		$act = $this->input->post("act");
		$ret = "MSG#ERR#Data Gagal Disimpan.";
		foreach($this->input->post("DATA") as $a=>$b){
			$DATA[$a]=$b;
		}
		if ($type=="simpan"){
			if($act=="save"||$act=="update"){
				if($act=="save"){
					#---------- simpan ke tabel simpanan ---------
					$DATA["JENIS_SIMPANAN"] = 3;
					$this->db->insert("TR_SIMPANAN",$DATA);
					
					// #---------- tabungan berdasarkan NIK dan jenis tabungan sukarela ---------
					// $query = "SELECT NIK FROM tr_tabungan WHERE NIK = '".$DATA["NIK"]."' AND JENIS_TABUNGAN = '3'";
					// $rs = $this->db->query($query);
					// if($rs->num_rows()==0){ 
					// 	#---------- jika sudah belum ada di table tabungan maka insert ---------
					// 	$INSERT = array(
					// 					"NIK"			=>$DATA["NIK"],
					// 					"SALDO"			=>$DATA["BESAR_SIMPANAN"],
					// 					"JENIS_TABUNGAN"=>"3"
					// 				);
					// 	$this->db->insert("TR_TABUNGAN",$INSERT);
					// } else { 
					// 	#---------- jika sudah ada update berdasarkan nik dan jenis tabungan ---------
					// 	$this->db->set("SALDO","SALDO + ".$DATA["BESAR_SIMPANAN"], FALSE);
					// 	$this->db->where(array(
					// 							"NIK"			=> $DATA["NIK"],
					// 							"JENIS_TABUNGAN"=> "3"
					// 						));
					// 	$this->db->update("TR_TABUNGAN");
					// }
					$ret = "MSG#OK#Data Berhasil Disimpan.#".site_url()."/simpanan/sukarela";
				}elseif($act=="update"){	
					$this->db->where(array('ID_SIMPANAN'=>$DATA["ID_SIMPANAN"]));
					$this->db->update('TR_SIMPANAN',$DATA);
					$ret = "MSG#OK#Data Berhasil Disimpan.#".site_url()."/simpanan/sukarela";
				}
			}
			echo $ret;
		} else if ($type=="tarikan"){
			if($act=="save"||$act=="update"){
				if($act=="save"){
					if($this->input->post("SALDO_TABUNGAN") == "0") {
						$ret = "MSG#ERR#Maaf Saldo Tabungan Anda Sudah Tidak Mencukupi.";
					} else {
						#---------- jika sudah ada update berdasarkan nik dan jenis tabungan ---------
						if($this->input->post("status") == "1") {
							$DATA["JENIS_PENARIKAN"] = "1";
							
							// $this->db->set("SALDO","SALDO - ".$DATA["BESAR_PENARIKAN"], FALSE);
							// $this->db->where(array(
							// 						"NIK"			=> $DATA["NIK"],
							// 						"JENIS_TABUNGAN"=> 3
							// 					));
							// $this->db->update("TR_TABUNGAN");
						} else {
							$DATA["JENIS_PENARIKAN"] = "2";
							
							// $this->db->set("SALDO","0");
							// $this->db->where(array(
							// 						"NIK"	=> $DATA["NIK"]
							// 					));
							// $this->db->update("TR_TABUNGAN");
						}
						#---------- Insert Ke Table Penarikan ---------
						$this->db->insert("TR_PENARIKAN",$DATA);
						$ret = "MSG#OK#Data Berhasil Disimpan.#".site_url()."/simpanan/tarikan";
					}
				}elseif($act=="update"){	
					$this->db->where(array('ID_PENARIKAN'=>$DATA["ID_PENARIKAN"]));
					$this->db->update('TR_PENARIKAN',$DATA);
					$ret = "MSG#OK#Data Berhasil Disimpan.#".site_url()."/simpanan/tarikan";
				}
			}
			echo $ret;
		}
	}
	
	function cetak($tipe,$id){
		$func = get_instance();
		$func->load->model("main");
		if ($tipe=="sukarela") {
			$sql = "SELECT A.ID_SIMPANAN, B.NAMA_ANGGOTA, DATE_FORMAT(A.TGL_SIMPANAN,'%d %M %Y') AS TGL_SIMPANAN, 
					A.BESAR_SIMPANAN, B.NIK,
					CASE A.JENIS_SIMPANAN
						WHEN '1' THEN 'Simpanan Pokok'
						WHEN '2' THEN 'Simpanan Wajib'
						WHEN '3' THEN 'Simpanan Sukarela'
					END AS 'JENIS_SIMPANAN'
					FROM TR_SIMPANAN A
					LEFT JOIN MST_ANGGOTA B ON A.NIK = B.NIK
					WHERE A.ID_SIMPANAN = '".$id."'";
		} else if($tipe=="wajib") {
			$sql = "SELECT DATE_FORMAT(TGL_SIMPANAN,'%d %M %Y') AS TGL_SIMPANAN, 
					FORMAT(SUM(BESAR_SIMPANAN),2) AS BESAR_SIMPANAN
					FROM TR_SIMPANAN WHERE TGL_SIMPANAN = '".$id."' AND JENIS_SIMPANAN='2'";
		} else if($tipe=="tarikan") {
			$sql = "SELECT A.ID_PENARIKAN, B.NAMA_ANGGOTA, A.TGL_PENARIKAN, 
					A.BESAR_PENARIKAN, B.NIK,
					CASE A.JENIS_PENARIKAN
						WHEN '1' THEN 'Penarikan Sukarela'
						WHEN '2' THEN 'Penarikan Keseluruhan'
					END AS 'JENIS_PENARIKAN'
					FROM TR_PENARIKAN A
					LEFT JOIN MST_ANGGOTA B ON A.NIK = B.NIK
					WHERE A.ID_PENARIKAN = '".$id."'";
		} elseif($tipe == "kwitansiWajib") {
			$tgl = date_format(date_create($id),"F Y");
			$QUERY = "SELECT TGL_SIMPANAN FROM tr_simpanan 
				  WHERE DATE_FORMAT(TGL_SIMPANAN,'%M %Y') = '".$tgl."' AND JENIS_SIMPANAN = '2'";
			$rs = $this->db->query($QUERY);
			if($rs->num_rows() > 0) { 
				$sql = "SELECT SUM(A.SIMPANAN_WAJIB) AS SIMPANAN_WAJIB FROM mst_anggota A 
						INNER JOIN tr_simpanan B ON A.NIK = B.NIK 
						WHERE A.STATUS_ANGGOTA = '1' AND DATE_FORMAT(B.TGL_SIMPANAN,'%M %Y') = '".$tgl."' 
						AND JENIS_SIMPANAN = '2'";
			} else {
				$sql = "SELECT SUM(A.SIMPANAN_WAJIB) SIMPANAN_WAJIB FROM mst_anggota A 
						WHERE A.STATUS_ANGGOTA = '1'";
			}
		}
		$hasil = $func->main->get_result($sql);
		if($hasil){
			foreach($sql->result_array() as $data){
				return array("sess"=>$data);
			}
		}
	}
	
	function get_simpanan_wajib() {
		$func = get_instance();
		$func->load->model("main");
		
		$nik = $this->input->post("nik");
		return $func->main->get_uraian("SELECT SIMPANAN_WAJIB FROM mst_anggota WHERE NIK = '".$nik."'","SIMPANAN_WAJIB"); 
	}
	
	function get_saldo_penarikan() {
		$func = get_instance();
		$func->load->model("main");
		
		$nik = $this->input->post("nik");
		$status = $this->input->post("status");

		if($status == "1") {
			$SQL = "SELECT (f_tabungan(A.NIK,'SIMPAN','SUKARELA','','') - f_tabungan(A.NIK,'TARIK','ALL','','')) AS SALDO 
					FROM mst_anggota A
					WHERE A.NIK = '".$nik."'";
		}else{
			$SQL = "SELECT (f_tabungan(A.NIK,'SIMPAN','ALL','','') - f_tabungan(A.NIK,'TARIK','ALL','','')) AS SALDO 
					FROM mst_anggota A
					WHERE A.NIK = '".$nik."'";
		}
		return $func->main->get_uraian($SQL,"SALDO"); 
	}

	function proses_simpan_wajib() {
		$func = get_instance();
		$func->load->model("main");

		$tgl_simpan = $this->input->post("tgl_simpanan");
		$date=date_create($tgl_simpan);
		$arrdetil = $this->input->post('DATA');

		$arrkeys = array_keys($arrdetil);
		for($i=0;$i<count($arrdetil[$arrkeys[0]]);$i++){			
			for($j=0;$j<count($arrkeys);$j++){
				$data[$arrkeys[$j]] = $arrdetil[$arrkeys[$j]][$i];
			}
			$ids = $func->main->get_uraian("SELECT MAX(SUBSTRING(ID_SIMPANAN,-3)) AS ID FROM TR_SIMPANAN", 'ID')+1;
			$ids = "S".date("Ymd").sprintf("%03d", $ids);
			$data["ID_SIMPANAN"] = $ids;
			$data["JENIS_SIMPANAN"] = "2";
			$data["TGL_SIMPANAN"] = date_format($date,"Y-m-d");
			
			#----- Simpan Ke Table TR_SIMPANAN
			$exec = $this->db->insert("TR_SIMPANAN",$data);

			// #---------- cehck tabungan berdasarkan NIK dan jenis tabungan 2.wajib ---------
			// $query = "SELECT NIK FROM tr_tabungan WHERE NIK = '".$data["NIK"]."' AND JENIS_TABUNGAN = '2'";
			// $rs = $this->db->query($query);
			// if($rs->num_rows()==0){ 
			// 	#---------- jika sudah belum ada di table tabungan maka insert ---------
			// 	$exec = $this->db->insert("TR_TABUNGAN",array("NIK"=>$data["NIK"],"SALDO"=>$data["BESAR_SIMPANAN"],"JENIS_TABUNGAN"=>"2"));
			// } else { 
			// 	#---------- jika sudah ada update berdasarkan nik dan jenis tabungan ---------
			// 	$this->db->set("SALDO","SALDO + ".$data["BESAR_SIMPANAN"], FALSE);
			// 	$this->db->where(array(
			// 							"NIK"			=> $data["NIK"],
			// 							"JENIS_TABUNGAN"=> "2"
			// 						));
			// 	$exec = $this->db->update("TR_TABUNGAN");
			// }
		}
		if($exec) {
			return "MSG#OK#Data Berhasil Disimpan.#".site_url()."/simpanan/wajib";
		} else {
			return "MSG#ERR#Data Gagal Disimpan.";
		}
	}

	function cetakWajib($tgl_simpanan){
		$func = get_instance();
		$func->load->model("main","main", true);
		$QUERY = "SELECT TGL_SIMPANAN FROM tr_simpanan 
				  WHERE DATE_FORMAT(TGL_SIMPANAN,'%M %Y') = '".$tgl_simpanan."' AND JENIS_SIMPANAN = '2'";
		$rs = $this->db->query($QUERY);
		if($rs->num_rows() > 0) { 
			$SQL = "SELECT A.NIK, A.NAMA_ANGGOTA, A.SIMPANAN_WAJIB FROM mst_anggota A 
					INNER JOIN tr_simpanan B ON A.NIK = B.NIK 
					WHERE A.STATUS_ANGGOTA = '1' AND DATE_FORMAT(B.TGL_SIMPANAN,'%M %Y') = '".$tgl_simpanan."' 
					AND JENIS_SIMPANAN = '2'";
		} else {
			$SQL = "SELECT A.NIK, A.NAMA_ANGGOTA, A.SIMPANAN_WAJIB FROM mst_anggota A 
					WHERE A.STATUS_ANGGOTA = '1'";
		}
		$result = $func->main->get_result($SQL);
		$ketua = $func->main->get_uraian("SELECT NAMA_USER FROM mst_user WHERE JABATAN_USER='2'", 'NAMA_USER');
		$html = '<table width="1000%" border="0" style="padding-top:50px;">';
		$html .= '<tr>';
		$html .= '<td>';
		if($result){
			$html .= '<div><h3><center>Daftar Simpanan Wajib Anggota KOPPEDI '.$tgl_simpanan.'</center></h3></div><br/>';
			$html .= '<table class="tabelajax" id="fCari" style="width:100%;">';
			$html .= '<tbody>';
			$html .= '<tr><th style="width:3%;">No</th>';
			$html .= '<th width="20%">NIK</th><th width="50%">Nama Anggota</th><th width="30%">Besar Simpanan Wajib</th></tr>';
			$no = 1;
			foreach($SQL->result_array() as $data){
				$JUM = $JUM + $data["SIMPANAN_WAJIB"];
				$html .= '<tr>';
				$html .= '<td class="alt">'.$no.'</td>';
				$html .= '<td class="alt">'.$data["NIK"].'</td>';
				$html .= '<td class="alt">'.$data["NAMA_ANGGOTA"].'</td>';
				$html .= '<td class="alt" align="right">'.number_format($data["SIMPANAN_WAJIB"],2).'</td>';
				$html .= '</tr>';
				$no++;
			}
			$html .= '<tr><td colspan="3" align="right"><b>Total</b></td><td align="right">'.number_format($JUM,2).'</td></tr>';
			$html .= '</tbody>';
			$html .= '</table>';
		}else{
			$html .= '<div class="red">Daftar Simpanan Wajib Anggota KOPPEDI</div>';
			$html .= '<table class="tabelajax" id="fCari">';
			$html .= '<tbody>';
			$html .= '<tr>';
			$html .= '<th width="10">No</th><th width="200">NIK</th><th width="185">Nama Anggota</th><th width="185">Besar Simpanan Wajib</th></tr>';
			$html .= '<tr>';
			$html .= '<td class="alt" colspan="8" align="center">Data Not Found</td>';
			$html .= '<tr>';
			$html .= '</tbody>';
			$html .= '</table>';
		}
		$html .= '</td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td style="padding-left:500px;" align="center">Mengetahui, '.date("d-m-Y").'</td>';
		$html .= '</tr><br/><br/>';
		$html .= '<br/><br/><tr>';
		$html .= '<td style="padding-left:500px;" align="center">('.$ketua.')</td>';
		$html .= '</tr>';
		$html .= '</table>';
		return $html;
	}
}
?>