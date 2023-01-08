<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test_model extends CI_Model
{ 
    public function getTestData() {
        $this->db->from('test');
        $query = $this->db->get()->result_array();
        return $query;
    }
}