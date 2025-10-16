<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_hasil');
        $this->load->library('session');
        $this->load->helper('url');

        // Cegah akses tanpa login
        if (!$this->session->userdata('id')) {
            redirect('auth');
        }
    }

    /**
     * Halaman utama: menampilkan nilai & hasil ujian mahasiswa
     */
    public function index()
    {
        $id_mahasiswa = $this->session->userdata('id');
        $data['title'] = 'Lihat Nilai & Hasil Ujian';
        $data['rekap'] = $this->M_hasil->get_rekap_nilai($id_mahasiswa);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_mahasiswa', $data);
        $this->load->view('mahasiswa/hasil_nilai', $data);
        $this->load->view('templates/footer');
    }
}
