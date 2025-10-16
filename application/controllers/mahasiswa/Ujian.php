<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujian extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_ujian' => 'm_ujian', 'M_skripsi' => 'm_skripsi']);
        $this->_cek_login();
    }

    private function _cek_login()
    {
        if (!$this->session->userdata('id') || $this->session->userdata('role') !== 'mahasiswa') {
            redirect('auth/mahasiswa');
        }
    }

    public function sempro()
    {
        $id = $this->session->userdata('id');
        $skripsi = $this->m_skripsi->get_latest_by_mahasiswa($id);

        // Tambahkan logika apakah mahasiswa bisa daftar atau tidak
        $bisa_daftar = false;
        if ($skripsi && $skripsi->status == 'disetujui') {
            $bisa_daftar = true;
        }

        $data = [
            'title'        => 'Pendaftaran Seminar Proposal',
            'skripsi'      => $skripsi,
            'bisa_daftar'  => $bisa_daftar,
            'sidebar'      => $this->load->view('templates/sidebar_mahasiswa', NULL, TRUE)
        ];

        $this->load->view('mahasiswa/pendaftaran_sempro', $data);
    }

    public function sidang()
    {
        $id = $this->session->userdata('id');
        $skripsi = $this->m_skripsi->get_latest_by_mahasiswa($id);

        $bisa_daftar = false;
        if ($skripsi && $skripsi->status == 'lulus sempro') {
            $bisa_daftar = true;
        }

        $data = [
            'title'        => 'Pendaftaran Sidang Skripsi',
            'skripsi'      => $skripsi,
            'bisa_daftar'  => $bisa_daftar,
            'sidebar'      => $this->load->view('templates/sidebar_mahasiswa', NULL, TRUE)
        ];

        $this->load->view('mahasiswa/pendaftaran_ujian', $data);
    }
}
