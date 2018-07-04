 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE)
		{
			$data['main_view'] = 'order';
			$this->load->view('template2', $data);
		} else {
			redirect('login');
		}
			
	}
	public function order()
	{
		$username = $this->session->userdata('username');
		$this->model_pw->cek_order($username);
	}
	public function order_coba($param = NULL) {
		// $layanan =$this->input->post('layanan');
		$layanan = $param;
		$dt = array('category' => $layanan);
		$result = $this->model_pw->get_produk($dt);
		$option = "";
		$option .= '<option value="">Pilih Produk</option>';
		foreach ($result as $data) {
			$option .= "<option value='".$data->no."' >".$data->service."</option>";
			
		}
		echo $option;

	}

	public function order_price($param = NULL){
		$produk = $param;
		$result = $this->model_pw->get_price($produk);
		echo $result->rate."|".$result->min."|".$result->max;

	}
}