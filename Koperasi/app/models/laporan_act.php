<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Laporan_act extends Model{

	function getSimpanan($tgl_awal="", $tgl_akhir=""){
		$func = get_instance();
		$func->load->model("main","main", true);
		$periode_bulan = $this->input->post("periode_bulan");
		$sampai_bulan = $this->input->post("sampai_bulan");
		if($periode_bulan=="") $periode_bulan = $tgl_awal;
		if($sampai_bulan=="") $sampai_bulan = $tgl_akhir;
		$SQL = "SELECT A.NIK, A.NAMA_ANGGOTA, DATE_FORMAT(A.TANGGAL_DAFTAR, '%d-%m-%Y') AS TANGGAL_DAFTAR, E.JABATAN,
				(SELECT B.BESAR_SIMPANAN FROM TR_SIMPANAN B WHERE B.NIK = A.NIK AND B.JENIS_SIMPANAN = '1') AS SIMPANAN_POKOK,
				(
					SELECT SUM(C.BESAR_SIMPANAN) FROM TR_SIMPANAN C WHERE C.NIK = A.NIK AND C.JENIS_SIMPANAN = '2' 
					AND C.TGL_SIMPANAN BETWEEN '".$periode_bulan."' AND '".$sampai_bulan."'
				) AS SIMPANAN_WAJIB,
				(
					SELECT (f_tabungan(D.NIK,'SIMPAN','SUKARELA','".$periode_bulan."','".$sampai_bulan."') - f_tabungan(D.NIK,'TARIK','','".$periode_bulan."','".$sampai_bulan."')) 
					FROM TR_SIMPANAN D WHERE D.NIK = A.NIK AND D.JENIS_SIMPANAN = '3' GROUP BY D.NIK
				) AS SIMPANAN_SUKARELA 
				FROM MST_ANGGOTA A LEFT JOIN mst_jabatan E ON E.ID_JABATAN = A.ID_JABATAN 
				WHERE A.STATUS_ANGGOTA = '1' ORDER BY A.NIK ASC";#echo $SQL;die();
		$dataSimpanan = $func->main->get_result($SQL);
		$ketua = $func->main->get_uraian("SELECT NAMA_USER FROM mst_user WHERE JABATAN_USER='2'", 'NAMA_USER');
		if($dataSimpanan){
			$arrdata = $SQL->result_array();
		}
		$hasil = array('dataSimpanan'=>$arrdata, 'periode_bulan'=>$periode_bulan, 'sampai_bulan'=>$sampai_bulan, 'laporan'=>'simpanan', 'ketua'=>$ketua);
		return $hasil;
	}
	
	function getPenarikan($tgl_awal="", $tgl_akhir=""){
		$func = get_instance();
		$func->load->model("main","main", true);
		$periode_bulan = $this->input->post("periode_bulan");
		$sampai_bulan = $this->input->post("sampai_bulan");
		if($periode_bulan=="") $periode_bulan = $tgl_awal;
		if($sampai_bulan=="") $sampai_bulan = $tgl_akhir;
		$SQL = "SELECT A.ID_PENARIKAN, A.NIK, B.NAMA_ANGGOTA, C.JABATAN, DATE_FORMAT(A.TGL_PENARIKAN,'%d %M %Y') AS TGL_PENARIKAN, FORMAT(A.BESAR_PENARIKAN,2) AS BESAR_PENARIKAN, A.BESAR_PENARIKAN AS SUB_BESAR_PENARIKAN,
				CASE A.JENIS_PENARIKAN
					WHEN '1' THEN 'Penarikan Sukarela'
					WHEN '2' THEN 'Penarikan Keseluruhan'
				END AS 'JENIS_PENARIKAN'
				FROM TR_PENARIKAN A
				LEFT JOIN MST_ANGGOTA B ON A.NIK = B.NIK
				LEFT JOIN MST_JABATAN C ON C.ID_JABATAN = B.ID_JABATAN
				WHERE A.TGL_PENARIKAN BETWEEN '".$periode_bulan."' AND '".$sampai_bulan."'";
		$dataPenarikan = $func->main->get_result($SQL);
		$ketua = $func->main->get_uraian("SELECT NAMA_USER FROM mst_user WHERE JABATAN_USER='2'", 'NAMA_USER');
		if($dataPenarikan){
			$arrdata = $SQL->result_array();
		}
		$hasil = array('dataPenarikan'=>$arrdata, 'periode_bulan'=>$periode_bulan, 'sampai_bulan'=>$sampai_bulan, 'laporan'=>'penarikan', 'ketua'=>$ketua);
		return $hasil;
	}
	
	function getPinjaman($tgl_awal="", $tgl_akhir=""){
		$func = get_instance();
		$func->load->model("main","main", true);
		$periode_bulan = $this->input->post("periode_bulan");
		$sampai_bulan = $this->input->post("sampai_bulan");
		if($periode_bulan=="") $periode_bulan = $tgl_awal;
		if($sampai_bulan=="") $sampai_bulan = $tgl_akhir;
		$SQL = "SELECT A.NIK, B.NAMA_ANGGOTA, C.JABATAN, CONCAT('<span style=\"float:right;\">',FORMAT(A.BESAR_PINJAMAN,2),'</span>') AS BESAR_PINJAMAN, 
				A.ANGSURAN_SELAMA, A.BULAN_MULAI, A.BULAN_SELESAI, 
				CONCAT('<span style=\"float:right;\">',FORMAT(A.BESAR_ANGSURAN_BULAN,2),'</span>') AS BESAR_ANGSURAN_BULAN, 
				CONCAT('<span style=\"float:right;\">',FORMAT(A.TOTAL_PENGEMBALIAN,2),'</span>') AS TOTAL_PENGEMBALIAN,
				A.TOTAL_PENGEMBALIAN AS SUB_TOTAL_PENGEMBALIAN
				FROM TR_PINJAMAN A LEFT JOIN MST_ANGGOTA B ON A.NIK=B.NIK LEFT JOIN MST_JABATAN C ON C.ID_JABATAN = B.ID_JABATAN
				WHERE A.TGL_PINJAMAN BETWEEN '".$periode_bulan."' AND '".$sampai_bulan."' ORDER BY B.NAMA_ANGGOTA";
		$dataPinjaman = $func->main->get_result($SQL);
		$ketua = $func->main->get_uraian("SELECT NAMA_USER FROM mst_user WHERE JABATAN_USER='2'", 'NAMA_USER');
		if($dataPinjaman){
			$arrdata = $SQL->result_array();
		}
		$hasil = array('dataPinjaman'=>$arrdata, 'periode_bulan'=>$periode_bulan, 'sampai_bulan'=>$sampai_bulan, 'laporan'=>'peminjaman', 'ketua'=>$ketua);
		return $hasil;
	}
	
	function getAngsuran($tgl_awal="", $tgl_akhir=""){
		$func = get_instance();
		$func->load->model("main","main", true);
		$periode_bulan = $this->input->post("periode_bulan");
		$sampai_bulan = $this->input->post("sampai_bulan");
		if($periode_bulan=="") $periode_bulan = $tgl_awal;
		if($sampai_bulan=="") $sampai_bulan = $tgl_akhir;
		$SQL = "SELECT A.NIK, B.NAMA_ANGGOTA, C.TGL_ANGSURAN, CONCAT('',FORMAT(A.BESAR_PINJAMAN,2),'') AS BESAR_PINJAMAN, 
				CONCAT('',FORMAT(A.BESAR_ANGSURAN_BULAN,2),'') AS BESAR_ANGSURAN_BULAN, C.ANGSURAN_KE, A.ANGSURAN_SELAMA,
				A.BESAR_ANGSURAN_BULAN AS SUB_BESAR_ANGSURAN_BULAN
				FROM HDR_PINJAMAN A LEFT JOIN MST_ANGGOTA B ON A.NIK=B.NIK
				LEFT JOIN DTL_PINJAMAN C ON A.ID_HDR_PINJAMAN = C.ID_HDR_PINJAMAN 
				WHERE C.STATUS IN('1','2') AND C.TGL_ANGSURAN BETWEEN '".$periode_bulan."' AND '".$sampai_bulan."'";
		$dataAngsuran = $func->main->get_result($SQL);
		if($dataAngsuran){
			$arrdata = $SQL->result_array();
		}
		$hasil = array('dataAngsuran'=>$arrdata, 'periode_bulan'=>$periode_bulan, 'sampai_bulan'=>$sampai_bulan, 'laporan'=>'angsuran');
		return $hasil;
	}
	
	function getPelunasan($tgl_awal="", $tgl_akhir=""){
		$func = get_instance();
		$func->load->model("main","main", true);
		$periode_bulan = $this->input->post("periode_bulan");
		$sampai_bulan = $this->input->post("sampai_bulan");
		if($periode_bulan=="") $periode_bulan = $tgl_awal;
		if($sampai_bulan=="") $sampai_bulan = $tgl_akhir;
		$SQL = "SELECT A.NIK, B.NAMA_ANGGOTA, COUNT(C.STATUS_ANGSURAN) AS TOTAL_ANGSURAN, A.BESAR_PINJAMAN, A.ALASAN_PINJAMAN, A.BESAR_ANGSURAN_BULAN
				FROM tr_pinjaman A LEFT JOIN MST_ANGGOTA B ON A.NIK=B.NIK
				LEFT JOIN tr_angsuran C ON A.ID_PINJAMAN = C.ID_PINJAMAN 
				WHERE C.STATUS_ANGSURAN  = '2' AND C.TGL_ANGSURAN BETWEEN '".$periode_bulan."' AND '".$sampai_bulan."'
				GROUP BY A.NIK";
		$dataPelunasan = $func->main->get_result($SQL);
		$ketua = $func->main->get_uraian("SELECT NAMA_USER FROM mst_user WHERE JABATAN_USER='2'", 'NAMA_USER');
		if($dataPelunasan){
			$arrdata = $SQL->result_array();
		}
		$hasil = array('dataPelunasan'=>$arrdata, 'periode_bulan'=>$periode_bulan, 'sampai_bulan'=>$sampai_bulan, 'laporan'=>'pelunasan', 'ketua'=>$ketua);
		return $hasil;
	}

	function getSHU($tipe,$periode_tahun) {
		$func = get_instance();
		$func->load->model("main","main", true);
		if($tipe == "peminjaman") {
			$SQL = "SELECT COUNT(ANGSURAN_KE) AS ANGSURAN_KE, A.BESAR_ANGSURAN_BULAN 
					FROM tr_angsuran B LEFT JOIN tr_pinjaman A ON B.ID_PINJAMAN = A.ID_PINJAMAN WHERE B.STATUS_ANGSURAN IN(1,2)
					AND DATE_FORMAT(B.TGL_ANGSURAN,'%Y') = '".$periode_tahun."' GROUP BY A.ID_PINJAMAN";
			$result = $func->main->get_result($SQL);
			if($result) {
				foreach ($SQL->result_array() as $data) {
					$besar_pinjaman = (float)($data["BESAR_ANGSURAN_BULAN"] * $data["ANGSURAN_KE"]);
					$hasil_bagi =  $besar_pinjaman * (5/100);
					$tnp_bunga = $tnp_bunga + ($besar_pinjaman - $hasil_bagi);
					$return = $return + ($hasil_bagi);
				}
			}
			return array("bungaPinjaman"=>$return,"pinjamanTnpBunga"=>$tnp_bunga);
		} elseif($tipe == "simpanan") {
			$SQL = "SELECT IFNULL(SUM(BESAR_SIMPANAN),0) AS TOTAL_SIMPAN 
					FROM tr_simpanan 
					WHERE DATE_FORMAT(TGL_SIMPANAN,'%Y') = '".$periode_tahun."'";
			$RS = $this->db->query($SQL)->row();
			$total_simpan = $RS->TOTAL_SIMPAN;
			return $total_simpan;
		} elseif($tipe == "utama") {
			$SQL = "SELECT A.NIK, A.NAMA_ANGGOTA, 
					(
						SELECT SUM(BESAR_SIMPANAN) FROM tr_simpanan WHERE NIK = A.NIK AND DATE_FORMAT(TGL_SIMPANAN, '%Y') = '".$periode_tahun."'
					) AS TOTAL_SIMPANAN, 
					(
						SELECT (B.BESAR_ANGSURAN_BULAN * COUNT(C.ANGSURAN_KE)) - (B.BESAR_ANGSURAN_BULAN * COUNT(C.ANGSURAN_KE) * (5/100)) 
						FROM tr_pinjaman B INNER JOIN tr_angsuran C ON B.ID_PINJAMAN = C.ID_PINJAMAN 
						WHERE DATE_FORMAT(C.TGL_ANGSURAN,'%Y') = '".$periode_tahun."' AND C.STATUS_ANGSURAN IN(1,2)
					) AS TOTAL_PINJAMAN
					FROM mst_anggota A WHERE A.STATUS_ANGGOTA = '1' GROUP BY A.NIK";//echo $SQL;die();
			return $this->db->query($SQL)->result_array();
		}
	}

	function rekap_simpanan($tgl_awal, $tgl_akhir) {
		$func = get_instance();
		$func->load->model("main","main", true);
		$SQL = "SELECT A.NAMA_ANGGOTA, 
				(
					SELECT SUM(B.BESAR_SIMPANAN) FROM tr_simpanan B WHERE B.NIK = A.NIK AND B.TGL_SIMPANAN BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."'
				) AS BESAR_SIMPANAN,
				(
					SELECT SUM(C.BESAR_PENARIKAN) FROM tr_penarikan C WHERE C.NIK = A.NIK AND C.TGL_PENARIKAN BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."'
				) AS BESAR_PENARIKAN,
				( 
					SELECT (f_tabungan(D.NIK,'SIMPAN','ALL','".$tgl_awal."','".$tgl_akhir."') - f_tabungan(D.NIK,'TARIK','','".$tgl_awal."','".$tgl_akhir."')) 
					FROM TR_SIMPANAN D WHERE D.NIK = A.NIK GROUP BY D.NIK 
				) AS TOTAL
				FROM mst_anggota A WHERE A.STATUS_ANGGOTA = '1' ORDER BY 4 DESC";
		return $this->db->query($SQL)->result_array();
	}
	
}
?>