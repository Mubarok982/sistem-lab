<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjadwalan_ujian extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        $data['title'] = 'Penjadwalan Ujian Skripsi';

        $this->db->select('
            ujian_skripsi.id,
            ujian_skripsi.tanggal,
            ujian_skripsi.tanggal_daftar,
            ujian_skripsi.ruang,
            ujian_skripsi.status,
            jenis_ujian_skripsi.nama AS jenis_ujian,
            akun.nama AS nama_mahasiswa,
            d1.nama AS penguji1,
            d2.nama AS penguji2,
            d3.nama AS penguji3
        ');
        $this->db->from('ujian_skripsi');
        $this->db->join('skripsi', 'skripsi.id = ujian_skripsi.id_skripsi', 'left');
        $this->db->join('jenis_ujian_skripsi', 'jenis_ujian_skripsi.id = ujian_skripsi.id_jenis_ujian_skripsi', 'left');
        $this->db->join('mstr_akun AS akun', 'akun.id = skripsi.id_mahasiswa', 'left');
        $this->db->join('mstr_akun AS d1', 'd1.id = ujian_skripsi.penguji1', 'left');
        $this->db->join('mstr_akun AS d2', 'd2.id = ujian_skripsi.penguji2', 'left');
        $this->db->join('mstr_akun AS d3', 'd3.id = ujian_skripsi.penguji3', 'left');
        $this->db->order_by('ujian_skripsi.tanggal', 'DESC');

        $data['jadwal'] = $this->db->get()->result();

        $this->load_template('admin/ujian/jadwal', $data);
    }
}
