<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apresiasi extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Apresiasi_model');
        $this->load->library('session'); // pastikan session sudah ada
    }

    public function index() {
        $id_mahasiswa = $this->session->userdata('id_mahasiswa'); // ambil id mahasiswa login
        $data['apresiasi_list'] = $this->Apresiasi_model->get_apresiasi_by_mahasiswa($id_mahasiswa);
        $this->load->view('mahasiswa/apresiasi_view', $data);
    }

}
