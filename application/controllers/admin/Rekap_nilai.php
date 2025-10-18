<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_nilai extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        $data['title'] = 'Rekapitulasi Nilai Skripsi';
        $this->db->select('
            skripsi.id,
            skripsi.judul,
            skripsi.tema,
            akun.nama AS nama_mahasiswa,
            ujian_skripsi.tanggal,
            nilai.nilai_total
        ');
        $this->db->from('skripsi');
        $this->db->join('mstr_akun AS akun', 'akun.id = skripsi.id_mahasiswa', 'left');
        $this->db->join('ujian_skripsi', 'ujian_skripsi.id_skripsi = skripsi.id', 'left');
        $this->db->join('nilai', 'nilai.id_mahasiswa = skripsi.id_mahasiswa', 'left');
        $data['rekap'] = $this->db->get()->result();

        $this->load_template('admin/nilai/rekap', $data);
    }
}
