<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
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
        $data['validasi'] = $this->db
            ->join('syarat_sempro s', 's.id = v.id_syarat_sempro')
            ->join('ujian_skripsi u', 'u.id = s.id_ujian_skripsi')
            ->join('skripsi sk', 'sk.id = u.id_skripsi')
            ->where('sk.id_mahasiswa', $id)
            ->get('validasi_syarat_sempro v')
            ->result();
        $data['title'] = 'Validasi Seminar Proposal';
        $this->load->view('mahasiswa/validasi_sempro', $data);
    }

    public function pendadaran()
    {
        $data['title'] = 'Validasi Pendadaran';
        $data['berkas'] = $this->db
            ->from('validasi_syarat_pendadaran v')
            ->join('syarat_pendadaran s', 's.id = v.id_syarat_pendadaran', 'left')
            ->get()->result();
        $this->load->view('mahasiswa/validasi_pendadaran', $data);
    }
}
