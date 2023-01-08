<?php

//import library dari Format dan RestController
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Alamat extends RestController {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data alamat
    function index_get() {
        $id = $this->get('id_alamat');
        if ($id == '') {
            $alamat = $this->db->get('alamat')->result();
        } else {
            $this->db->where('id', $id);
            $alamat = $this->db->get('alamat')->result();
        }
        $this->response($alamat, 200);
    }

    //Mengirim atau menambah data alamat baru
    function index_post() {
        $data = array(
                    'id_alamat'           => $this->post('id_alamat'),
                    'id_user'          => $this->post('id_user'),
                    'alamat'    => $this->post('alamat'));
        $insert = $this->db->insert('alamat', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Memperbarui data alamat yang telah ada
    function index_put() {
        $id = $this->put('id_alamat');
        $data = array(
                    'id_alamat'       => $this->put('id_alamat'),
                    'id_user'          => $this->put('id_user'),
                    'alamat'    => $this->put('alamat'));
        $this->db->where('id_alamat', $id);
        $update = $this->db->update('alamat', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Menghapus salah satu data alamat
    function index_delete() {
        $id = $this->delete('id_alamat');
        $this->db->where('id_alamat', $id);
        $delete = $this->db->delete('alamat');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>