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
        $data['title'] = 'Rekapitulasi Nilai';
        $this->db->select('
            skripsi.id,
            skripsi.tema,
            akun.nama AS nama_mahasiswa,
            ujian_skripsi.tanggal,
            ujian_skripsi.ruang
        ');
        $this->db->from('skripsi');
        $this->db->join('mstr_akun AS akun', 'akun.id = skripsi.id_mahasiswa', 'left');
        $this->db->join('ujian_skripsi', 'ujian_skripsi.id_skripsi = skripsi.id', 'left');
        $data['rekap'] = $this->db->get()->result();

        $this->load_template('admin/nilai/rekap', $data);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Ujian';
        $this->db->select('
            ujian_skripsi.*,
            skripsi.tema,
            akun.nama AS nama_mahasiswa,
            d1.nama AS penguji1,
            d2.nama AS penguji2,
            d3.nama AS penguji3
        ');
        $this->db->from('ujian_skripsi');
        $this->db->join('skripsi', 'skripsi.id = ujian_skripsi.id_skripsi', 'left');
        $this->db->join('mstr_akun AS akun', 'akun.id = skripsi.id_mahasiswa', 'left');
        $this->db->join('mstr_akun AS d1', 'd1.id = ujian_skripsi.penguji1', 'left');
        $this->db->join('mstr_akun AS d2', 'd2.id = ujian_skripsi.penguji2', 'left');
        $this->db->join('mstr_akun AS d3', 'd3.id = ujian_skripsi.penguji3', 'left');
        $data['ujian'] = $this->db->get_where('ujian_skripsi', ['ujian_skripsi.id' => $id])->row();

        $this->load_template('admin/nilai/detail_ujian', $data);
    }
}
