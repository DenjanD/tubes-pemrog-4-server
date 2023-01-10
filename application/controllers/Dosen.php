<?php

//import library dari format dan RestController
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Dosen extends RestController{

    function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data dosen
    function index_get() {
        $id = $this->get('dosen_id');
        if($id == ''){
            $dosen = $this->db->get('dosen')->result();
        } else {
            $this->db->where('dosen_id', $id);
            $dosen = $this->db->get('dosen')->result();
        }
        $this->response($dosen, 200);
    }
    
    //Mengirim atau menambah data dosen baru
    function index_post() {
        $data = array(
            'dosen_id' => $this->post('dosen_id'),
            'nip' => $this->post('nip'),
            'nama' => $this->post('nama'),
            'password' => $this->post('password'),
            'foto' => $this->post('foto')
        );
        $insert = $this->db->insert('dosen', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Memperbarui data dosen yang ada
    function index_put() {
        $id =  $this->put('dosen_id');
        $data = array(
            'dosen_id' => $this->put('dosen_id'),
            'nip' => $this->put('nip'),
            'nama' => $this->put('nama'),
            'password' => $this->put('password'),
            'foto' => $this->put('foto')
        );
        $this->db->where('dosen_id', $id);
        $update = $this->db->update('dosen', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('dosen_id');
        $this->db->where('dosen_id', $id);
        $delete = $this->db->delete('dosen');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

?>