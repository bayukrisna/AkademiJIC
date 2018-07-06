<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function cetak(){
    ob_start();
    //$data['siswa'] = $this->siswa_model->view_row();
    $this->load->view('tes');
    $html = ob_get_contents();
        ob_end_clean();
        
        require_once('/assets/html2pdf/html2pdf.class.php');
    $pdf = new HTML2PDF('P','A4','en');
    $pdf->WriteHTML($html);
    $pdf->Output('Data JIC.pdf', 'D');
  }



	public function index()
	{
			$data['main_view'] = 'tes';
			$this->load->view('template', $data);
	}
}