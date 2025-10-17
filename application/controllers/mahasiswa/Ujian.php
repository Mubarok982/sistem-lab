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
        // Pastikan hanya mahasiswa yang bisa mengakses
        if (!$this->session->userdata('id') || $this->session->userdata('role') !== 'mahasiswa') {
            redirect('auth/mahasiswa');
        }
    }

    public function sempro()
    {
        $id = $this->session->userdata('id');

        // Ambil data skripsi terbaru mahasiswa
        $skripsi = $this->m_skripsi->get_latest_by_mahasiswa($id);

        // Default tidak bisa daftar
        $bisa_daftar = false;

        // Pastikan objek valid dan kolom status ada
        if ($skripsi && isset($skripsi->status)) {
            // Bisa daftar jika status skripsi sudah disetujui dosen
            if (strtolower($skripsi->status) === 'disetujui') {
                $bisa_daftar = true;
            }
        }

        // Kirim data ke view
        $data = [
            'title'        => 'Pendaftaran Seminar Proposal',
            'skripsi'      => $skripsi,
            'bisa_daftar'  => $bisa_daftar,
            'sidebar'      => $this->load->view('templates/sidebar_mahasiswa', NULL, TRUE),
        ];

        $this->load->view('mahasiswa/pendaftaran_sempro', $data);
    }

public function sidang()
{
    $id = $this->session->userdata('id');
    $skripsi = $this->m_skripsi->get_latest_by_mahasiswa($id);

    $bisa_daftar = false;

    // Validasi objek & status
    if ($skripsi && isset($skripsi->status)) {
        // Bisa daftar sidang jika sudah lulus sempro
        if (strtolower($skripsi->status) === 'lulus sempro') {
            $bisa_daftar = true;
        }
    }

    // Tambahkan ini untuk menghindari error:
    $ujian = $this->db->get_where('syarat_pendadaran', ['id_mahasiswa' => $id])->row();
    if (!$ujian) $ujian = null;

    $data = [
        'title'        => 'Pendaftaran Sidang Skripsi',
        'skripsi'      => $skripsi,
        'bisa_daftar'  => $bisa_daftar,
        'ujian'        => $ujian, // ← tambahkan ini
        'sidebar'      => $this->load->view('templates/sidebar_mahasiswa', NULL, TRUE),
    ];

    $this->load->view('mahasiswa/pendaftaran_ujian', $data);
}


    public function pendaftaran()
{
    $id_mahasiswa = $this->session->userdata('id');

    // Ambil data skripsi mahasiswa
    $skripsi = $this->db->get_where('tbl_skripsi', ['id_mahasiswa' => $id_mahasiswa])->row();

    // Cek apakah boleh daftar (sudah disetujui dosen)
    $bisa_daftar = ($skripsi && $skripsi->status_persetujuan == 'disetujui');

    // Ambil data ujian (jika sudah pernah daftar)
    $ujian = $this->db->get_where('syarat_pendadaran', ['id_mahasiswa' => $id_mahasiswa])->row();

    // Pastikan $ujian tetap didefinisikan meskipun kosong
    if (!$ujian) {
        $ujian = null;
    }

    $data = [
        'title' => 'Pendaftaran Ujian',
        'skripsi' => $skripsi,
        'bisa_daftar' => $bisa_daftar,
        'ujian' => $ujian
    ];

    $this->load->view('templates/header_mahasiswa', $data);
    $this->load->view('mahasiswa/pendaftaran_ujian', $data);
    $this->load->view('templates/footer_mahasiswa');
}

}
