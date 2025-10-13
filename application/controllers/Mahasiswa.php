<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_akun','m_akun');
        $this->load->model('M_skripsi','m_skripsi');
        $this->load->model('M_ujian','m_ujian');
        $this->load->model('M_nilai','m_nilai');
        $this->load->library(['form_validation','session']);

        // Cek login mahasiswa
        if ($this->session->userdata('role') !== 'mahasiswa') {
            $this->session->set_flashdata('message','<div class="alert alert-danger">Silahkan login sebagai mahasiswa terlebih dahulu!</div>');
            redirect('auth/mahasiswa');
        }
    }

    /** Dashboard Mahasiswa */
    public function index()
    {
        $id_mahasiswa = $this->session->userdata('id');
        $data['skripsi'] = $this->m_skripsi->get_latest_by_mahasiswa($id_mahasiswa);

        $data['title'] = 'Dashboard Mahasiswa';

        $this->load->view('mahasiswa/dashboard', $data);
    }

    /** Profil Mahasiswa */
    public function profil()
    {
        $id_mahasiswa = $this->session->userdata('id');
        $data['mahasiswa'] = $this->m_akun->get_user_by_id($id_mahasiswa);

        $data['title'] = 'Profil Mahasiswa';
        $data['sidebar'] = $this->load->view('templates/sidebar_mahasiswa', $data, TRUE);
        $data['header']  = $this->load->view('templates/header', $data, TRUE);
        $data['footer']  = $this->load->view('templates/footer', $data, TRUE);

        $this->load->view('mahasiswa/profil', $data);
    }

    /** Ajukan Judul Skripsi */
    public function ajukan_skripsi()
    {
        $id_mahasiswa = $this->session->userdata('id');
        $this->form_validation->set_rules('tema','Judul Skripsi','required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['judul_terakhir'] = $this->m_skripsi->get_latest_by_mahasiswa($id_mahasiswa);
            $data['title'] = 'Ajukan Judul Skripsi';
            $data['sidebar'] = $this->load->view('templates/sidebar_mahasiswa', $data, TRUE);
            $data['header']  = $this->load->view('templates/header', $data, TRUE);
            $data['footer']  = $this->load->view('templates/footer', $data, TRUE);

            $this->load->view('mahasiswa/ajukan_skripsi', $data);
        } else {
            $tema = $this->input->post('tema');
            $this->m_skripsi->insert_skripsi([
                'id_mahasiswa' => $id_mahasiswa,
                'tema' => $tema,
                'status' => 'Diajukan'
            ]);
            $this->session->set_flashdata('message','<div class="alert alert-success">Judul skripsi berhasil diajukan!</div>');
            redirect('mahasiswa/ajukan_skripsi');
        }
    }

    /** Pendaftaran Ujian (Sempro/Sidang) */
    public function daftar_ujian($tipe='sempro')
    {
        $id_mahasiswa = $this->session->userdata('id');

        $skripsi = $this->m_skripsi->get_latest_by_mahasiswa($id_mahasiswa);
        if (!$skripsi) {
            $this->session->set_flashdata('message','<div class="alert alert-danger">Silahkan ajukan judul skripsi terlebih dahulu!</div>');
            redirect('mahasiswa/ajukan_skripsi');
        }

        $ujian = $this->m_ujian->get_by_skripsi($skripsi->id, $tipe);
        $data['aktif'] = ($ujian && $ujian->persetujuan_pembimbing1=='Disetujui' && $ujian->persetujuan_pembimbing2=='Disetujui');

        $data['syarat'] = $this->m_ujian->get_syarat_by_mahasiswa($id_mahasiswa, $tipe);

        $data['title'] = 'Daftar Ujian '.strtoupper($tipe);
        $data['sidebar'] = $this->load->view('templates/sidebar_mahasiswa', $data, TRUE);
        $data['header']  = $this->load->view('templates/header', $data, TRUE);
        $data['footer']  = $this->load->view('templates/footer', $data, TRUE);

        $this->load->view('mahasiswa/daftar_ujian', $data);
    }

    /** Lihat Hasil Ujian */
    public function hasil_ujian()
    {
        $id_mahasiswa = $this->session->userdata('id');

        $data['nilai'] = $this->m_nilai->get_nilai_by_mahasiswa($id_mahasiswa);

        $data['title'] = 'Hasil Ujian Mahasiswa';
        $data['sidebar'] = $this->load->view('templates/sidebar_mahasiswa', $data, TRUE);
        $data['header']  = $this->load->view('templates/header', $data, TRUE);
        $data['footer']  = $this->load->view('templates/footer', $data, TRUE);

        $this->load->view('mahasiswa/hasil_ujian', $data);
    }

    /** Logout Mahasiswa */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/mahasiswa');
    }
}
