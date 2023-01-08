<?php

class Coba_model extends CI_Model {
    // Mengambil data dari tabel yang ada di database
    public function getAllDatas() {
        $this->db->from('test');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function getById() {
        $this->db->from('test');
        $this->db->where('id', '2');
        return $this->db->get()->result_array();
    }
}

?>