<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Master_act extends Model{
	
	function daftar($tipe="", $ajax=""){
		$func = get_instance();
		$func->load->model("main");
		$this->load->library('newtable');
		if ($tipe=="anggota"){
			$SQL = "SELECT A.NIK, A.KTP, A.NAMA_ANGGOTA 'NAMA ANGGOTA', B.JABATAN, A.NO_TELP_ANGGOTA 'NO TELEPON', 
					A.EMAIL, FORMAT(A.SIMPANAN_POKOK,2) AS 'SIMPANAN POKOK', FORMAT(A.SIMPANAN_WAJIB,2) AS 'SIMPANAN WAJIB', 
					CASE STATUS_ANGGOTA
						WHEN '0' THEN 'Tidak Aktif'
						WHEN '1' THEN 'Aktif'
					END AS 'STATUS ANGGOTA' , STATUS_ANGGOTA
					FROM MST_ANGGOTA A LEFT JOIN MST_JABATAN B ON A.ID_JABATAN= B.ID_JABATAN";
			$prosesnya = array( 'Tambah' => array('GET2', site_url().'/master/anggota/save', '0', 'fa fa-plus'),
								'Ubah' => array('GET', site_url()."/master/anggota/update", '1', 'fa fa-pencil'),
								//'Hapus' => array('DELETE', site_url().'/master/set_data/anggota', 'admin', 'fa fa-times'),
								'Proses Anggota Keluar' => array('GET2', site_url().'/master/anggota/keluar', '1', 'fa fa-times'),);	
			$this->newtable->action(site_url()."/master/anggota");
			$this->newtable->keys(array("NIK","STATUS_ANGGOTA"));
			$this->newtable->hiddens(array("STATUS_ANGGOTA"));
			$this->newtable->search(array(array('A.NIK', 'NIK'),array('A.NAMA_ANGGOTA', 'Nama Anggota')));	
		}else if ($tipe=="jabatan"){
			$SQL = "SELECT ID_JABATAN 'ID JABATAN', JABATAN, FORMAT(GAJI, 2) AS GAJI FROM MST_JABATAN";
			$prosesnya = array( 'Tambah' => array('GET2', site_url().'/master/jabatan/save', '0', 'fa fa-plus'),
								'Ubah' => array('GET', site_url()."/master/jabatan/update", '1', 'fa fa-pencil'),
								'Hapus' => array('DELETE', site_url().'/master/set_data/jabatan', 'admin', 'fa fa-times'));	
			$this->newtable->action(site_url()."/master/jabatan");
			$this->newtable->keys(array("ID JABATAN"));
			$this->newtable->search(array(array('JABATAN', 'Jabatan')));	
		}else if($tipe=="user"){
			$SQL = "SELECT ID_USER, NAMA_USER 'Nama User', ALAMAT_USER 'Alamat User', NO_TELP_USER AS 'NO TELEPON', 
					CASE JABATAN_USER 
						WHEN '1' THEN 'Admin Koperasi'
						WHEN '2' THEN 'Ketua Koperasi'
					END AS 'JABATAN USER', 
					CASE STATUS_USER
						WHEN '0' THEN 'Tidak Aktif'
						WHEN '1' THEN 'Aktif'
					END AS 'STATUS USER'
					FROM MST_USER";
			$prosesnya = array( 'Tambah' => array('GET2', site_url().'/master/user/save', '0', 'fa fa-plus'),
								'Ubah' => array('GET', site_url()."/master/user/update", '1', 'fa fa-pencil'),
								'Hapus' => array('DELETE', site_url().'/master/set_data/user', 'admin', 'fa fa-times'));	
			$this->newtable->action(site_url()."/master/user");
			$this->newtable->hiddens(array("ID_USER"));			
			$this->newtable->keys(array("ID_USER"));
			$this->newtable->search(array(array('NAMA_USER', 'Nama User')));
		}	
		$ciuri = (!$this->input->post("ajax"))?$this->uri->segment_array():$this->input->post("uri");
		$this->newtable->cidb($this->db);
		$this->newtable->ciuri($ciuri);
		$this->newtable->orderby(1);
		$this->newtable->sortby("ASC");
		$this->newtable->set_formid("f".$tipe);
		$this->newtable->set_divid("div".$tipe);
		$this->newtable->tipe_proses('button');	
		$this->newtable->rowcount(9);
		$this->newtable->clear(); 
		$this->newtable->menu($prosesnya);
		$tabel = $this->newtable->generate($SQL);			
		$arrdata = array("tabel" => $tabel);
		if($this->input->post("ajax")||$ajax) return $tabel;				 
		else return $arrdata;		
	}
	
	function get_data($type="",$act="",$id=""){
		$func = get_instance();
		$func->load->model("main");
		if($act=="save"){
			if ($type=="anggota"){
				$COMBO_JABATAN = $func->main->get_combobox("SELECT ID_JABATAN, JABATAN FROM MST_JABATAN","ID_JABATAN","JABATAN", TRUE);
				$arraydata = array('act' => $act, "jabatan"=>$COMBO_JABATAN);
			}elseif($type=="user"){
				$ids = $func->main->get_uraian("SELECT MAX(SUBSTRING(ID_USER,-2)) AS ID FROM MST_USER", 'ID')+1;
				$ids = "U".sprintf("%02d", $ids);
				$arraydata = array('act' => $act, 'id' => $ids);
			}elseif($type=="jabatan"){
				$ids = $func->main->get_uraian("SELECT MAX(SUBSTRING(ID_JABATAN,-2)) AS ID FROM MST_JABATAN", 'ID')+1;
				$ids = "J".sprintf("%02d", $ids);
				$arraydata = array('act' => $act, 'id' => $ids);
			}
		}else if($act=="update"){
			if($type=="anggota"){
				$id = explode("|",$id);
				$SQL = "SELECT A.NIK, A.KTP, A.NAMA_ANGGOTA, B.JABATAN, FORMAT(B.GAJI, 2) AS GAJI, A.DIVISI, A.ALAMAT_ANGGOTA, 
						A.NO_TELP_ANGGOTA, A.EMAIL, A.SIMPANAN_POKOK, A.SIMPANAN_WAJIB, A.STATUS_ANGGOTA, B.ID_JABATAN FROM MST_ANGGOTA A LEFT JOIN MST_JABATAN B ON A.ID_JABATAN=B.ID_JABATAN 
						WHERE A.NIK = '".$id[0]."'";
				
				$COMBO_JABATAN = $func->main->get_combobox("SELECT ID_JABATAN, JABATAN FROM MST_JABATAN","ID_JABATAN","JABATAN", TRUE);
			}elseif($type=="jabatan"){
				$SQL = "SELECT ID_JABATAN AS ID, JABATAN, GAJI FROM MST_JABATAN WHERE ID_JABATAN = '".$id."'";
			}elseif($type=="user"){
				$SQL = "SELECT ID_USER AS ID, NAMA_USER, ALAMAT_USER, NO_TELP_USER, JABATAN_USER, STATUS_USER FROM MST_USER WHERE ID_USER = '".$id."'";
			}
			$hasil = $func->main->get_result($SQL);
			if($hasil){
				foreach($SQL->result_array() as $row){
					$data = $row;
					$id = $row["ID"];
				}
			}
			$arraydata = array('act' => $act, 'data'=>$data, 'id'=>$id, "jabatan"=>$COMBO_JABATAN, 'disabled' => 'disabled="disabled"');
		}else{
			$SQL = "SELECT A.NIK, A.NAMA_ANGGOTA, B.JABATAN, A.ALAMAT_ANGGOTA, A.TANGGAL_DAFTAR,
					(f_tabungan(A.NIK,'SIMPAN','ALL','','') - f_tabungan(A.NIK,'TARIK','ALL','','')) AS SALDO,
					D.BESAR_ANGSURAN_BULAN,
					(
					SELECT COUNT(E.ID_PINJAMAN) AS ANGSURAN_KE
					FROM TR_ANGSURAN E
					WHERE E.ID_PINJAMAN = D.ID_PINJAMAN AND E.STATUS_ANGSURAN = '0'
					) AS SISA
					FROM MST_ANGGOTA A LEFT JOIN MST_JABATAN B ON A.ID_JABATAN = B.ID_JABATAN
					LEFT JOIN TR_PINJAMAN D ON A.NIK = D.NIK
					WHERE A.NIK='".$act."'";
			$hasil = $func->main->get_result($SQL);
			if($hasil){
				foreach($SQL->result_array() as $row){
					$data = $row;
					$id = $row["ID"];
				}
			}
			$arraydata = array('act' => 'keluar', 'data'=>$data);
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
		if($type=="anggota"){
			if($act=="save"||$act=="update"){
				if($act=="save"){
					$query = "SELECT NIK FROM MST_ANGGOTA WHERE NIK = '".$DATA["NIK"]."'";
					$rs = $this->db->query($query);
					if($rs->num_rows() > 0){
						$ret = "MSG#ERR#Maaf, NIK <b style=\"color:blue\">".$DATA["NIK"]."</b> sudah digunakan. Silahkan menggunakan NIK yang lainnya.";
					}else{
						$ids = $func->main->get_uraian("SELECT MAX(SUBSTRING(ID_SIMPANAN,-3)) AS ID FROM TR_SIMPANAN", 'ID')+1;
						$SIMPANAN = array(
										"ID_SIMPANAN"	=> "S".date("Ymd").sprintf("%03d", $ids),
										"NIK"			=> $DATA["NIK"],
										"TGL_SIMPANAN"	=> date("Y-m-d"),
										"JENIS_SIMPANAN"=> 1,
										"BESAR_SIMPANAN"=> $DATA["SIMPANAN_POKOK"]
									);
						$DATA["TANGGAL_DAFTAR"] = date("Y-m-d");
						$DATA["STATUS_ANGGOTA"] = 1;
						$this->db->insert("tr_simpanan",$SIMPANAN);
						//$this->db->insert("tr_tabungan",array("NIK"=>$DATA["NIK"],"SALDO"=>$DATA["SIMPANAN_POKOK"],"JENIS_TABUNGAN"=>"1"));
						$exec = $this->db->insert('MST_ANGGOTA',$DATA);
						$ret = "MSG#OK#Data Berhasil Disimpan.#".site_url()."/master/anggota";
					}
				}elseif($act=="update"){
					/*$query = "SELECT NIK FROM MST_ANGGOTA WHERE NIK = '".$DATA["NIK"]."'";
					$rs = $this->db->query($query);
					if($rs->num_rows() > 0){
						$ret = "MSG#ERR#Maaf, NIK <b style=\"color:blue\">".$DATA["NIK"]."</b> sudah digunakan. Silahkan menggunakan NIK yang lainnya.";
					}else{*/
						$ID = $this->input->post("id");
						$this->db->where(array('NIK'=>$ID));
						$exec = $this->db->update('MST_ANGGOTA',$DATA);
						$ret = "MSG#OK#Data Berhasil Disimpan.#".site_url()."/master/anggota";
					//}
				}
			}elseif($act=="delete"){
				foreach($this->input->post("tb_chkfanggota") as $chkitem){
					$this->db->where(array("NIK"=>$chkitem));
					$exec = $this->db->delete("MST_ANGGOTA");
				}
				$ret = "MSG#OK#Data Berhasil Disimpan.#".site_url()."/master/anggota/ajax";
			}elseif($act=="keluar"){
				$ID = $this->input->post("NIK");
				$DATA["TANGGAL_KELUAR"] = date("Y-m-d");
				$DATA["STATUS_ANGGOTA"] = 0;
				$this->db->where(array('NIK'=>$ID));
				$exec = $this->db->update('MST_ANGGOTA',$DATA);
				$ret = "MSG#OK#Data Berhasil Disimpan.#".site_url()."/master/anggota";
			}
			echo $ret;
		}
		else if($type=="jabatan"){
			if($act=="save"||$act=="update"){
				if($act=="save"){
					$exec = $this->db->insert('MST_JABATAN',$DATA);
				}elseif($act=="update"){	
					$ID = $this->input->post("id");
					$this->db->where(array('ID_JABATAN'=>$ID));
					$exec = $this->db->update('MST_JABATAN',$DATA);
				}
				$ret = "MSG#OK#Data Berhasil Disimpan.#".site_url()."/master/jabatan";
			}elseif($act=="delete"){
				foreach($this->input->post("tb_chkfjabatan") as $chkitem){
					$this->db->where(array("ID_JABATAN"=>$chkitem));
					$exec = $this->db->delete("MST_JABATAN");
				}
				$ret = "MSG#OK#Data Berhasil Disimpan.#".site_url()."/master/jabatan/ajax";
			}
			echo $ret;
		}
		else if($type=="user"){
			if($act=="save"||$act=="update"){
				if($act=="save"){
					$DATA["PASSWORD"] = md5($DATA["PASSWORD"]);
					$exec = $this->db->insert('MST_USER',$DATA);
				}elseif($act=="update"){	
					$ID = $this->input->post("id");
					$this->db->where(array('ID_USER'=>$ID));
					$exec = $this->db->update('MST_USER',$DATA);
				}
				$ret = "MSG#OK#Data Berhasil Disimpan.#".site_url()."/master/user";
			}elseif($act=="delete"){
				foreach($this->input->post("tb_chkfuser") as $chkitem){
					$this->db->where(array("ID_USER"=>$chkitem));
					$exec = $this->db->delete("MST_USER");
				}
				$ret = "MSG#OK#Data Berhasil Disimpan.#".site_url()."/master/user/ajax";
			}
			echo $ret;
		}
	}
	
	function getGaji(){		
		$func = get_instance();
		$func->load->model("main");
		$id_jabatan = $this->input->post("id_jabatan");
		$GAJI = $func->main->get_uraian("SELECT FORMAT(GAJI,2) AS GAJI FROM MST_JABATAN WHERE ID_JABATAN = '".$id_jabatan."'","GAJI");
		return $GAJI;
	}
}
?>