<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Ganti CI_Controller menjadi MY_Controller untuk TAMPILAN yang benar
class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        // Logika Anda untuk memuat model tetap sama
        $this->load->model('Dashboard_model');
    }

    public function index() {
        $data['title'] = 'Dashboard Dosen';

        // Logika Anda untuk mengambil data TIDAK diubah
        $id_dosen = $this->session->userdata('user_id'); // Menggunakan 'user_id' dari sistem login kita
        $data['jumlah_bimbingan'] = $this->Dashboard_model->count_mahasiswa_bimbingan($id_dosen);
        $data['jadwal_ujian'] = $this->Dashboard_model->get_jadwal_ujian($id_dosen);

        // KUNCI UTAMA: Gunakan fungsi ini untuk merakit halaman dengan TAMPILAN yang benar
        $this->load_template('dosen/dashboard', $data);
    }
}

