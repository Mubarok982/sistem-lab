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

        // CEK LOGIN MAHASISWA
        if (
            !$this->session->userdata('logged_in') || 
            $this->session->userdata('role') != 'mahasiswa'
        ) {
            redirect('auth/mahasiswa');
        }
    }

    public function index()
    {
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');  // ✔ FIXED

        $skripsi = $this->m_skripsi->get_latest_by_mahasiswa($id_mahasiswa);
        $progress = $this->m_skripsi->get_progress_by_mahasiswa($id_mahasiswa);
        $pengingat_bimbingan = $this->m_bimbingan->get_upcoming_bimbingan($id_mahasiswa);
        $jadwal_sidang = $this->m_sidang->get_jadwal_by_mahasiswa($id_mahasiswa);

        $huruf_mutu = '-';
        if (!empty($skripsi->nilai_akhir)) {
            $huruf_mutu = $this->convert_nilai_to_huruf($skripsi->nilai_akhir);
        }

        $data = [
            'title'             => 'Dashboard Mahasiswa',
            'skripsi'           => $skripsi,
            'status_skripsi'    => $skripsi->tahap ?? 'Belum ada data',
            'nilai_terakhir'    => !empty($skripsi->nilai_akhir) 
                                        ? $skripsi->nilai_akhir . " ($huruf_mutu)" 
                                        : '-',
            'dosen_pembimbing'  => $skripsi->nama_pembimbing ?? '-',
            'progress'          => $progress,
            'pengingat_bimbingan' => $pengingat_bimbingan,
            'jadwal_sidang'       => $jadwal_sidang,

            // Tambahkan nama untuk header
            'nama' => $this->session->userdata('nama'),
        ];

        $this->load->view('mahasiswa/dashboard', $data);
    }
}
