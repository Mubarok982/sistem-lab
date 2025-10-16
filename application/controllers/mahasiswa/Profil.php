<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_akun', 'm_akun');
        $this->_cek_login();
    }

    private function _cek_login()
    {
        if (!$this->session->userdata('id') || $this->session->userdata('role') !== 'mahasiswa') {
            redirect('auth/mahasiswa');
        }
    }

    public function index()
    {
        $id = $this->session->userdata('id');
        $data['mahasiswa'] = $this->m_akun->get_user_by_id($id);
        $data['title'] = 'Profil Mahasiswa';
        $this->load->view('mahasiswa/profil', $data);
    }
}
