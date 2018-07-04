<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class model_pw extends CI_Model
{

    function __construct() {
        parent::__construct();
    }
    public function ganti_password($username) {
        $password = $this->input->post('oldpass');
        $password_baru = $this->input->post('newpass');
        $this->db->where('username',$username);
        $result = $this->getUsersku($username,$password, $password_baru);        

        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }

    function getUsersku($username,$password, $password_baru) {
        $query = $this->db->get('user');

        if ($query->num_rows() == 1) {
            
            $result = $query->row_array();

            if ($this->bcrypt->check_password($password, $result['password'])) {
                $hash = $this->bcrypt->hash_password($password_baru);
                $this->db->query("UPDATE user SET password = '$hash' WHERE username = '$username'");
                $this->session->set_flashdata('message', '<div class="alert alert-success"> Password berhasil diganti </div>');
                redirect('setting');

            } else {
                //Wrong password
                $this->session->set_flashdata('message', '<div class="alert alert-danger"> Password berhasil diganti </div>');
                redirect('setting');
            }

        } else {
            return array();
        }
    }

    public function masuk() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->db->where('email',$email);
        $result = $this->getUsers($password);        

        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }
    
    function getUsers($password) {
        $query = $this->db->get('user');

        if ($query->num_rows() == 1) {
            
            $result = $query->row_array();

            if ($this->bcrypt->check_password($password, $result['password'])) {
                foreach ($query->result() as $sess) {
                $sess_data['logged_in'] = TRUE;
                $sess_data['username'] = $sess->username;
                }
                $this->session->set_userdata($sess_data);
                return $result;
            } else {
                //Wrong password
                return array();
            }

        } else {
            return array();
        }
    }
    public function admin_masuk() {
        
        $email = $this->input->post('email');
        if($email = "admin@gmail.com"){
                $password = $this->input->post('password');

        $this->db->where('email',$email);
        $result = $this->getUsersea($password);        

        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }    

        }
        
        
    }
    function getUsersea($password) {
        $query = $this->db->get('user');

        if ($query->num_rows() == 1) {
            
            $result = $query->row_array();

            if ($this->bcrypt->check_password($password, $result['password'])) {
                foreach ($query->result() as $sess) {
                $sess_data['logged_in'] = TRUE;
                $sess_data['username'] = $sess->username;
                }
                $this->session->set_userdata($sess_data);
                return $result;
            } else {
                //Wrong password
                return array();
            }

        } else {
            return array();
        }
    }

    public function cek_user($username)
    {
        return $this->db->where('username' , $username)
                        ->get('user')
                        ->row();
    }

    public function cek_saldo($username)
    {
        $saldo = $this->db->where('username' , $username)
                        ->get('user')
                        ->row();
        return $saldo->saldo;
    }
    public function cek_pesanan_sukses($username)
    {
    return $this->db->where('buyer', $username)
             ->where('status', 'completed')
             ->get('history')
             ->num_rows();

    }
    public function cek_semua_pesanan($username)
    {
    return $this->db->where('buyer', $username)
             ->get('history')
             ->num_rows();

    }
    public function cek_deposit($username)
    {
    return $this->db->where('username', $username)
             ->get('deposit')
             ->num_rows();

    }
    public function cek_riwayat($username)
    {
    return $this->db->where('buyer', $username)
             ->limit(7)
             ->order_by('id', 'DESC')
             ->get('history')
             ->result();

    }
    public function data_deposit($username)
    {
    return $this->db->where('username', $username)
             ->limit(7)
             ->order_by('id', 'DESC')
             ->get('deposit')
             ->result();

    }
    
    // public function lis_service()
    // {
    //     $no = $this->input->post('produk_area');

    //     $this->db->where('no', $no)
    //              ->where('status', 'Tersedia')
    //              ->get('service')
    // }

    public function cek_order($username)
    {
        $balance = $this->cek_saldo($username);
        $no = $this->input->post('produk_area');
        $link = $this->input->post('link');
        $quantity = $this->input->post('total_area');

        $dataservice = $this->db->query("SELECT * FROM service WHERE no = '$no' AND status = 'Tersedia'");
        if ($dataservice->num_rows() > 0){
            $result = $dataservice->result();
            foreach ($result as $row) {
                $min = $row->min;
                $max = $row->max;
                $service = $row->service;
                $rate = $row->rate;
                $provider_id = $row->provider_id;
                $price = $quantity*$rate;
                $scount = $dataservice->num_rows();                
            }

            if ($scount == 0){
            $this->session->set_flashdata('message', '<div class="alert alert-danger"> <strong>Error: </strong> Service Tidak ditemukan. </div>');
            redirect('order');
            } else if (!$quantity || !$link){
            $this->session->set_flashdata('message', '<div class="alert alert-danger"> <strong>Error: </strong> Masih ada data yang kosong. </div>');
            redirect('order');
            } else if($quantity < $min){
            $this->session->set_flashdata('message', '<div class="alert alert-danger"><p> <strong>Error: </strong> Jumlah pemesanan tidak sesuai. minimal '.$min.'.</p></div>');
            redirect('order');
            } else if($quantity > $max){
            $this->session->set_flashdata('message', '<div class="alert alert-danger"> <strong>Error: </strong> Jumlah pemesanan tidak sesuai. max '.$max.'. </div>');
            redirect('order');
            } else if ($balance < $price){
            $this->session->set_flashdata('message', '<div class="alert alert-danger"> <strong>Error: </strong> Balance tidak mencukupi, silahkan topup. </div>');
            redirect('order');
            } else {
                $dataa = array('key' => '9de19f4a7b6b15d54af8f41cf18e3236','action' => 'add','link' => $link ,'service' => $provider_id,'quantity' => $quantity);
                $hasilnya = $this->uksmm($dataa); 
                $order = json_decode($hasilnya,true);
                if ($order->error == true) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger"> <strong>Error: </strong> Please contact Admin. </div>');
                    redirect('order');
                } else {
                    $this->db->query("UPDATE user SET saldo = saldo-$price WHERE username = '$username'");
                    $dataku = array (
                        'id'    => NULL,
                        'order_id' => $provider_id,
                        'buyer' => $username,
                        'service'  => $service,
                        'link' => $link,
                        'quantity' => $quantity,
                        'price' => $price,
                        'status' => 'Pending',
                        'date' => date('Y-m-d'),

                    );
                    $this->db->insert('history', $dataku);
                    $this->session->set_flashdata('message', 
                    '<div class="alert alert-info">
                    <font color="white">
                    <strong>Success: </strong> Transaksi berhasil!<br />
                    Layanan: '.$service.'<br />
                    Jumlah: '.$quantity.'<br />
                    Harga: '.$price.'<br />
                    Link/Username: '.$link.'<br />
                    Date: '.$dataku['date'].'
                    </font>
                    </div>'
                    );
                    redirect('order');
                    
                }
                
            }

            
        }
    }
    public function total_records($username)
    {
        return $this->db->where('buyer', $username)
                        ->from('history')
                        ->count_all_results();
    }

    public function get_data_history($limit, $start, $username){
    return $this->db->where('buyer', $username)
                    ->order_by('id', 'DESC')
                    ->limit($limit, $start)
                    ->get('history')
                    ->result();
    }
    public function total_records_admin()
    {
        return $this->db->where('status', 'Pending')
                        ->from('deposit')
                        ->count_all_results();
    }

    public function get_data_admin($limit, $start){
    return $this->db->where('status', 'Pending')
                    ->order_by('id', 'DESC')
                    ->limit($limit, $start)
                    ->get('deposit')
                    ->result();
    }
    public function total_data_harga()
    {
        return $this->db->from('service')
                        ->count_all_results();
    }

    public function get_data_harga($limit, $start){
    return $this->db->limit($limit, $start)
                    ->get('service')
                    ->result();
    }

    public function total_data_deposit($username)
    {
        return $this->db->where('username', $username)
                        ->from('deposit')
                        ->count_all_results();
    }

    public function get_data_deposit($limit, $start, $username){
    return $this->db->where('username', $username)
                    ->order_by('id', 'DESC')
                    ->limit($limit, $start)
                    ->get('deposit')
                    ->result();
    }

    // function order($link, $provider_id, $quantity)
    // {
    //         $dataa = array('key' => '9de19f4a7b6b15d54af8f41cf18e3236','action' => 'add','link' => $link ,'service' => $provider_id,'quantity' => $quantity);
    //         $hasilnya = $this->uksmm($dataa); 
    //         $order = json_decode($hasilnya,true);
    //         // if ($order->error == true) {
    //         //     return FALSE;
    //         // } else {
    //         //     return TRUE;
    //         // }
    // }
    function uksmm($post) {
        $apiServer = 'https://uksmm.com/api/v2';
        $_post = Array();
        if (is_array($post)) {
          foreach ($post as $name => $value) {
            $_post[] = $name.'='.urlencode($value);
          }
        } else {
            $_post = FALSE;
        }
        $method = 'post';
        $ch = curl_init($apiServer);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if($_post !== FALSE){
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);   
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if (is_array($post) AND $_post !== FALSE) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, join('&', $_post));
        }

        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        $result = curl_exec($ch);
        if (curl_errno($ch)) { 
            $result = curl_error($ch); 
        } 
        curl_close($ch);
        return $result;
    }
    public function saldoku(){
        $user = $this->input->post('username');
        $saldo = $this->input->post('saldo');
        $this->db->query("UPDATE user SET saldo = saldo+$saldo WHERE username = '$user'");
        $this->session->set_flashdata('message', '<div class="alert alert-info">
        <font color="White">
        <strong>Success: </strong> Transfer Saldo berhasil!<br />
        Username: '.$user.'<br />
        Jumlah: '.$saldo.'
        </font>
        </div>');
        redirect('dashboard_admin/saldo');
    }

    public function add_history($username, $price, $provider_id, $service, $link, $quantity)
    {
        $this->db->query("UPDATE user SET saldo = saldo-$price WHERE username = '$username'");
        $data = array (
            'id'    => NULL,
            'order_id' => $provider_id,
            'buyer' => $username,
            'service'  => $service,
            'link' => $link,
            'quantity' => $quantity,
            'price' => $price,
            'status' => 'Completed',
            'date' => date('Y-m-d'),

        );
        $this->db->insert('history', $data);

    }

    public function signup()
    {
        $password = $this->input->post('password', TRUE);
        $hash = $this->bcrypt->hash_password($password);
        $data = array(
            'id'                => NULL,
            'username'      => $this->input->post('username', TRUE),
            'nama_lengkap'      => $this->input->post('nama_lengkap', TRUE),
            'email'     => $this->input->post('email', TRUE),
            'password'  => $hash,
            'date' => date('Y-m-d')
        );
    
        $this->db->insert('user', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }
    public function insert($foto){
        $username = $this->session->userdata('username');
        $data = array(
            'id'                => NULL,
            'username'          => $username,
            'tanggal'        => date('Y-m-d'),
            'via'       => $this->input->post('depositku'),
            'jumlah'  => $this->input->post('jumlah'),
            'pengirim'       => $this->input->post('pengirim'),
            'gambar'          => $foto['file_name'],
            'status' => 'pending'
        );
        $this->db->insert('deposit', $data);
        
        if($this->db->affected_rows() > 0){
            return true;
        } else {
            return false;
            
        }
    }


    public function get_produk($data)
    {
        return $this->db->where('status', 'Tersedia')->where($data)->get('service')->result();
    }
    public function get_price($produk)
    {
        return $this->db->where('no',$produk)->get('service')->row();
    }
}
