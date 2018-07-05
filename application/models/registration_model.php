<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function signup()
    {
        $data = array(
            'id'                => NULL,
            'fullname'      => $this->input->post('fullname', TRUE),
            'sex'      => $this->input->post('sex', TRUE),
            'placedate'     => $this->input->post('placedate', TRUE),
            'address'     => $this->input->post('address', TRUE),
            'phone'     => $this->input->post('phone', TRUE),
            'mphone'     => $this->input->post('mphone', TRUE),
            'religion'     => $this->input->post('religion', TRUE),
            'preschool'     => $this->input->post('preschool', TRUE),
            'nik'     => $this->input->post('nik', TRUE),
            'management'     => $this->input->post('management', TRUE),
            'accounting'     => $this->input->post('accounting', TRUE),
            'time'     => $this->input->post('time', TRUE),
            'intake'     => $this->input->post('intake', TRUE),
            'beasiswa'     => $this->input->post('beasiswa', TRUE)
        );
    
        $this->db->insert('registration', $data);

        if($this->db->affected_rows() > 0){
            
                return true;
        } else {
            return false;
            
        }

    }

    

}

/* End of file dosen_model.php */
/* Location: ./application/models/dosen_model.php */

