<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_validasi');
        $this->load->library('session');
        $this->load->helper('url');

        // Pastikan user sudah login sebagai mahasiswa
        if (!$this->session->userdata('id')) {
            redirect('auth');
        }
    }

    public function sempro()
    {
        $id_mahasiswa = $this->session->userdata('id');
        $data['title'] = 'Status Validasi Berkas Seminar Proposal';
        $data['validasi'] = $this->M_validasi->get_validasi_sempro($id_mahasiswa);
        $this->load->view('templates/header', $data);
        $this->load->view('mahasiswa/validasi_sempro', $data);
        $this->load->view('templates/footer');
    }

    public function pendadaran()
    {
        $id_mahasiswa = $this->session->userdata('id');
        $data['title'] = 'Status Validasi Berkas Pendadaran';
        $data['validasi'] = $this->M_validasi->get_validasi_pendadaran($id_mahasiswa);
        $this->load->view('templates/header', $data);
        $this->load->view('mahasiswa/validasi_pendadaran', $data);
        $this->load->view('templates/footer');
    }
}
