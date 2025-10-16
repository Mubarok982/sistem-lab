<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skripsi extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        $data['title'] = 'Data Skripsi';
        $this->db->select('skripsi.*, data_mahasiswa.nama as nama_mahasiswa');
        $this->db->join('data_mahasiswa', 'data_mahasiswa.id = skripsi.id_mahasiswa');
        $data['skripsi'] = $this->db->get('skripsi')->result();

        $this->load_template('admin/skripsi/index', $data);
    }
}
