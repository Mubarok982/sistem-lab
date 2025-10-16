<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jadwal_ujian extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_ujian');
    }

    public function index()
    {
        $data['title'] = 'Jadwal Ujian Skripsi';
        $data['jadwal'] = $this->M_ujian->get_jadwal();
        $this->load->view('admin/skripsi/jadwal_ujian', $data);
    }
}
