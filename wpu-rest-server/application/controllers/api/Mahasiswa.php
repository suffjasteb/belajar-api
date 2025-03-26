<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require_once APPPATH . 'libraries/Format.php';

class Mahasiswa extends REST_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('Mahasiswa_model');

        // limit per method per jam 
        // $this->methods['index_get']['limit'] = 10; // per key sejam cuma bole 2x

    }

    public function index_get() {
        $id = $this->get('id');
        if ($id === null) {
            $mahasiswa = $this->Mahasiswa_model->getMahasiswa();
        } else {
            $mahasiswa = $this->Mahasiswa_model->getMahasiswa($id);   
        }
        if ($mahasiswa) {
            $this->response([
                'status' =>  true,
                'response' => $mahasiswa,
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'id not found'
            ], http_code: REST_Controller::HTTP_NOT_FOUND);
        }
    }

    // user bisa hapus data mahasiswa
    public function index_delete() {
        // method delete bukan get
        $id = $this->delete('id');

        if ($id === null) {
            // id nya gak boleh kosong
        $this->response([
                'status' => false,
                'message' => 'provide an id!'
            ], REST_Controller::HTTP_BAD_REQUEST); 
        } else {
            // berati id gak kosong
            if ($this->Mahasiswa_model->deleteMahasiswa($id) > 0) {
            // ok
            $this->response([
                'status' =>  true,
                'id' => $id,
                'message' => 'success deleted'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            // id di isi tapi gaada di db
            $this->response([
                'status' => false,
                'message' => 'id not found in the database'
            ], REST_Controller::HTTP_BAD_REQUEST );
        }
    };
}

public function index_post() {
    $data = [
        'nrp' => $this->post('nrp'),
        'nama' => $this->post('nama'),
        'email' => $this->post('email'),
        'jurusan' => $this->post('jurusan')
    ];
    if ($this->Mahasiswa_model->createMahasiswa($data) > 0) {
        $this->response([
            'status' =>  true,
            'message' => 'success add mahasiswa'
        ], REST_Controller::HTTP_CREATED);
    } else {
        $this->response([
            'status' => false,
            'message' => 'failed to create new mahasiswa'
        ], REST_Controller::HTTP_BAD_REQUEST );
    }
}

public function index_put() {

    $id = $this->put('id');

    $data = [
        'nrp' => $this->put('nrp'),
        'nama' => $this->put('nama'),
        'email' => $this->put('email'),
        'jurusan' => $this->put('jurusan')
    ];
    
    if ($this->Mahasiswa_model->editMahasiswa($data, $id) > 0) {
        $this->response([
            'status' =>  true,
            'message' => 'success edit mahasiswa data'
        ], REST_Controller::HTTP_NO_CONTENT);
    } else {
        $this->response([
            'status' => false,
            'message' => 'failed to edit data mahasiswa'
        ], REST_Controller::HTTP_BAD_REQUEST );
    }

}

}
?>