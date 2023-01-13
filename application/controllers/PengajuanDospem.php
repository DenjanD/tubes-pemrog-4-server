<?php

//import library dari Format dan RestController
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class PengajuanDospem extends RestController {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data pengajuan dospem
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $this->db->select('pengajuan_dospem.*, mahasiswa.nama as mahasiswa, dosen.nama as dosen');
            $this->db->join('mahasiswa', 'pengajuan_dospem.mahasiswa_id = mahasiswa.mahasiswa_id');
            $this->db->join('dosen', 'pengajuan_dospem.dosen_id = dosen.dosen_id');
            $mhs = $this->db->get('pengajuan_dospem')->result();
        } else {
             $this->db->select('pengajuan_dospem.*, mahasiswa.nama as mahasiswa, dosen.nama as dosen');
            $this->db->join('mahasiswa', 'pengajuan_dospem.mahasiswa_id = mahasiswa.mahasiswa_id');
            $this->db->join('dosen', 'pengajuan_dospem.dosen_id = dosen.dosen_id');
            $this->db->where('id', $id);
            $mhs = $this->db->get('pengajuan_dospem')->result();
        }
        $this->response($mhs, 200);
    }

    //Mengirim atau menambah data pengajuan dospem baru
    function index_post() {
        $data = array(
            'mahasiswa_id' => $this->post('mahasiswa_id'),
            'dosen_id' => $this->post('dosen_id'),
            'is_diterima' => $this->post('is_diterima'),
        );
        $insert = $this->db->insert('pengajuan_dospem', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'Something went wrong when insert supervisor submission', 502));
        }
    }

    //Memperbarui data pengajuan dospem yang telah ada
    function index_put() {
        $id = $this->put('pengajuan_id');
         $data = array(
            'mahasiswa_id' => $this->put('mahasiswa_id'),
            'dosen_id' => $this->put('dosen_id'),
            'is_diterima' => $this->put('is_diterima'),
        );
        $this->db->where('mahasiswa_id', $id);
        $update = $this->db->update('pengajuan_dospem', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'Something went wrong when update supervisor submission', 502));
        }
    }

    //Menghapus salah satu data mahasiswa
    function index_delete() {
        $id = $this->delete('pengajuan_id');
        $this->db->where('pengajuan_id', $id);
        $delete = $this->db->delete('pengajuan_dospem');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>