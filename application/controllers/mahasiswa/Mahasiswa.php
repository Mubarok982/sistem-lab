<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->library(['session']);
        $this->load->helper('url');

        $this->load->model('M_skripsi', 'm_skripsi');

        if (
            !$this->session->userdata('id') || 
            $this->session->userdata('role') !== 'mahasiswa'
        ) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger">Silakan login sebagai mahasiswa terlebih dahulu!</div>'
            );
            redirect('auth/mahasiswa');
        }
    }

    public function index()
    {
        $id_mahasiswa = $this->session->userdata('id');
        $data['skripsi'] = $this->m_skripsi->get_latest_by_mahasiswa($id_mahasiswa);
        $data['title'] = 'Dashboard Mahasiswa';

        $this->load->view('mahasiswa/dashboard', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/mahasiswa');
    }

}
