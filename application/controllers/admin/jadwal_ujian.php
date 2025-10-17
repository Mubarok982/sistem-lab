<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_ujian extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model kalau perlu
        // $this->load->model('Jadwal_ujian_model');

        // Cek login & role admin
    }

    public function index() {
        $data['title'] = 'Jadwal Ujian Skripsi';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/skripsi/jadwal_ujian', $data);
        $this->load->view('templates/footer');
    }
}
