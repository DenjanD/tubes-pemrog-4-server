<?php

//import library dari Format dan RestController
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class Bimbingan extends RestController {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data $bimbingan
    function index_get() {
        $id = $this->get('bimbingan_id');
        if ($id == '') {
            $bimbingan = $this->db->get('bimbingan')->result();
        } else {
            $this->db->where('id', $id);
            $bimbingan = $this->db->get('bimbingan')->result();
        }
        $this->response($bimbingan, 200);
    }

    //Mengirim atau menambah data $bimbingan baru
    function index_post() {
        $data = array(
                    'bimbingan_id'           => $this->post('bimbingan_id'),
                    'mahasiswa_id'           => $this->post('mahasiswa_id'),
                    'file_bimbingan'         => $this->post('file_bimbingan'),
                    'judul_bimbingan'        => $this->post('judul_bimbingan'),
                    'deskripsi_bimbingan'    => $this->post('deskripsi_bimbingan'),
                    'status'                 => $this->post('status'),
                    'evaluasi_bimbingan'     => $this->post('evaluasi_bimbingan'));
        $insert = $this->db->insert('bimbingan', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Memperbarui data $bimbingan yang telah ada
    function index_put() {
        $id = $this->put('bimbingan_id');
        $data = array(
            'bimbingan_id'           => $this->put('bimbingan_id'),
            'mahasiswa_id'           => $this->put('mahasiswa_id'),
            'file_bimbingan'         => $this->put('file_bimbingan'),
            'judul_bimbingan'        => $this->put('judul_bimbingan'),
            'deskripsi_bimbingan'    => $this->put('deskripsi_bimbingan'),
            'status'                 => $this->put('status'),
            'evaluasi_bimbingan'     => $this->put('evaluasi_bimbingan'));
        $this->db->where('bimbingan_id', $id);
        $update = $this->db->update('bimbingan', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Menghapus salah satu data $bimbingan
    function index_delete() {
        $id = $this->delete('bimbingan_id');
        $this->db->where('bimbingan_id', $id);
        $delete = $this->db->delete('bimbingan');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>