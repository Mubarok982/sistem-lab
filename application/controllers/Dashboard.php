<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model');
        $this->load->library('session');
    }

    public function index() {
        $id_dosen = $this->session->userdata('id'); // id dosen login
        $data['jumlah_bimbingan'] = $this->Dashboard_model->count_mahasiswa_bimbingan($id_dosen);
        $data['jadwal_ujian'] = $this->Dashboard_model->get_jadwal_ujian($id_dosen);

        $this->load->view('templates/header');
        $this->load->view('dosen/dashboard', $data);
        $this->load->view('templates/footer');
    }

}
