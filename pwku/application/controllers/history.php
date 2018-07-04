<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE)
		{
			redirect(base_url('history/order_history'));
		} else {
			redirect('login');
		}
		
	}
	public function order_history()
	{
		if($this->session->userdata('logged_in') == TRUE){
		$username = $this->session->userdata('username');

			$this->load->library('pagination');
				
				$config['base_url'] = base_url().'history/order_history';
				$config['total_rows'] = $this->model_pw->total_records($username);
				$config['per_page'] = 10;
				$config['uri_segment'] = 3;
				$config['full_tag_open'] = "<ul class='pagination'>";
				$config['full_tag_close'] = "</ul>";
				$config['num_tag_open'] = "<li>";
				$config['num_tag_close'] = "</li>";
				$config['cur_tag_open'] = "<li class='active'><a href='#'>";
				$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$config['next_tag_open'] = "<li>";
				$config['next_tagl_close'] = "</li>";
				$config['prev_tag_open'] = "<li>";
				$config['prev_tagl_close'] = "</li>";
				$config['first_tag_open'] = "<li>";
				$config['first_tagl_close'] = "</li>";
				$config['last_tag_open'] = "<li>";
				$config['last_tagl_close'] = "</li>";
				
				$this->pagination->initialize($config);
				$start = $this->uri->segment(3,0);
				
				$rows = $this->model_pw->get_data_history($config['per_page'], $start, $username);
				
				$data['riwayat'] = $rows;
				$data['pagination'] = $this->pagination->create_links();
				$data['start'] = $start;

			// $data['riwayat'] = $this->model_pw->cek_riwayat($username);
			$data['main_view'] = 'history';
			$this->load->view('template2', $data);
		} else {
			redirect('login');
		}
	}

}