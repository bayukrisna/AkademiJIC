<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE)
		{
			$this->deposit_history();
		} else {
			redirect('login');
		}
		
	}
	public function simpan()
	{

				//konfigurasi upload foto
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2000';

				//load library upload file
				$this->load->library('upload');
				$this->upload->initialize($config);

				//jika upload file berhasil
				if ($this->upload->do_upload('foto'))
				{
					if($this->model_pw->insert($this->upload->data()) == TRUE){						
						$this->session->set_flashdata('message', '<div class="alert alert-success"> Upload Berhasil. </div>');
            			redirect('deposit');
					} else{
						$this->session->set_flashdata('message', '<div class="alert alert-danger"> Upload Gagal. </div>');
            			redirect('deposit');
					}
				} else{
					$this->session->set_flashdata('message', '<div class="alert alert-danger">'.$this->upload->display_errors().' </div>');
            		redirect('deposit');
			}
	}
	public function deposit_history()
	{
		if($this->session->userdata('logged_in') == TRUE){
		$username = $this->session->userdata('username');

			$this->load->library('pagination');
				
				$config['base_url'] = base_url().'deposit/deposit_history';
				$config['total_rows'] = $this->model_pw->total_data_deposit($username);
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
				
				$rows = $this->model_pw->get_data_deposit($config['per_page'], $start, $username);
				
				$data['deposit'] = $rows;
				$data['pagination'] = $this->pagination->create_links();
				$data['start'] = $start;

			// $data['riwayat'] = $this->model_pw->cek_riwayat($username);
			$data['main_view'] = 'deposit';
			$this->load->view('template2', $data);
		} else {
			redirect('login');
		}
	}
}