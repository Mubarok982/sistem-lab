<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Saran_model');
        $this->load->library('session'); // pastikan session sudah di-load
    }

    public function index() {
        $id_mahasiswa = $this->session->userdata('id_mahasiswa'); // ambil id mahasiswa dari session
        $data['saran_list'] = $this->Saran_model->get_saran_by_mahasiswa($id_mahasiswa); // ubah method
        $this->load->view('mahasiswa/saran_view', $data);
    }

}
