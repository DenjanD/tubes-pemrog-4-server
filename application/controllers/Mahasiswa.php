<?php

//import library dari Format dan RestController
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Mahasiswa extends RestController {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data mahasiswa
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $this->db->select('mahasiswa.*, dosen.nama as dosen');
            $this->db->join('dosen', 'mahasiswa.dosen_id = dosen.dosen_id');
            $mhs = $this->db->get('mahasiswa')->result();
        } else {
            $this->db->select('mahasiswa.*, dosen.nama as dosen');
            $this->db->join('dosen', 'mahasiswa.dosen_id = dosen.dosen_id');
            $this->db->where('id', $id);
            $mhs = $this->db->get('mahasiswa')->result();
        }
        $this->response($mhs, 200);
    }

    //Mengirim atau menambah data mahasiswa baru
    function index_post() {
        $data = array(
            'npm' => $this->post('npm'),
            'nama' => $this->post('nama'),
            'password' => $this->post('password'),
            'foto' => $this->post('foto'),
            'dosen_id' => $this->post('dosen_id')
        );
        $insert = $this->db->insert('mahasiswa', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'Something went wrong when insert student', 502));
        }
    }

    //Memperbarui data mahasiswa yang telah ada
    function index_put() {
        $id = $this->put('mahasiswa_id');
         $data = array(
            'npm' => $this->put('npm'),
            'nama' => $this->put('nama'),
            'password' => $this->put('password'),
            'foto' => $this->put('foto'),
            'dosen_id' => $this->put('dosen_id')
        );
        $this->db->where('mahasiswa_id', $id);
        $update = $this->db->update('mahasiswa', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'Something went wrong when update student', 502));
        }
    }

    //Menghapus salah satu data mahasiswa
    function index_delete() {
        $id = $this->delete('mahasiswa_id');
        $this->db->where('mahasiswa_id', $id);
        $delete = $this->db->delete('mahasiswa');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>