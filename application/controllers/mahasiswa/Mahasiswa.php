<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session']);
        $this->load->helper('url');
        $this->load->model('M_skripsi', 'm_skripsi');
        $this->load->model('M_bimbingan', 'm_bimbingan');
        $this->load->model('M_sidang', 'm_sidang');

        if (!$this->session->userdata('id') || $this->session->userdata('role') !== 'mahasiswa') {
            $this->session->set_flashdata('message',
                '<div class="alert alert-danger">Silakan login sebagai mahasiswa terlebih dahulu!</div>'
            );
            redirect('auth/mahasiswa');
        }
    }

    public function index()
    {
        $id_mahasiswa = $this->session->userdata('id');

        // Data skripsi & progress
        $skripsi = $this->m_skripsi->get_latest_by_mahasiswa($id_mahasiswa);
        $progress = $this->m_skripsi->get_progress_by_mahasiswa($id_mahasiswa);

        // Data tambahan
        $pengingat_bimbingan = $this->m_bimbingan->get_upcoming_bimbingan($id_mahasiswa);
        $jadwal_sidang = $this->m_sidang->get_jadwal_by_mahasiswa($id_mahasiswa);

        // Konversi nilai angka → huruf mutu
        $huruf_mutu = '-';
        if (!empty($skripsi->nilai_akhir)) {
            $huruf_mutu = $this->convert_nilai_to_huruf($skripsi->nilai_akhir);
        }

        $data = [
            'title'             => 'Dashboard Mahasiswa',
            'skripsi'           => $skripsi,
            'status_skripsi'    => $skripsi->tahap ?? 'Belum ada data',
            'nilai_terakhir'    => !empty($skripsi->nilai_akhir) ? $skripsi->nilai_akhir . " ($huruf_mutu)" : '-',
            'dosen_pembimbing'  => $skripsi->nama_pembimbing ?? '-',
            'progress'          => $progress,
            'pengingat_bimbingan' => $pengingat_bimbingan,
            'jadwal_sidang'     => $jadwal_sidang,
        ];

        $this->load->view('mahasiswa/dashboard', $data);
    }

    // Konversi nilai angka ke huruf mutu
    private function convert_nilai_to_huruf($nilai)
    {
        if ($nilai >= 85) return 'A';
        elseif ($nilai >= 70) return 'B';
        elseif ($nilai >= 55) return 'C';
        elseif ($nilai >= 40) return 'D';
        else return 'E';
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/mahasiswa');
    }
}
