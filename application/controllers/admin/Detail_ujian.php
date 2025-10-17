<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_ujian extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Menampilkan list semua ujian
    public function index()
    {
        $data['title'] = 'Daftar Ujian';
        $this->db->select('
            ujian_skripsi.id,
            ujian_skripsi.tanggal,
            ujian_skripsi.ruang,
            skripsi.tema,
            akun.nama AS nama_mahasiswa
        ');
        $this->db->from('ujian_skripsi');
        $this->db->join('skripsi', 'skripsi.id = ujian_skripsi.id_skripsi', 'left');
        $this->db->join('mstr_akun AS akun', 'akun.id = skripsi.id_mahasiswa', 'left');
        $this->db->order_by('ujian_skripsi.tanggal', 'DESC');

        $data['ujian'] = $this->db->get()->result(); 
        $this->load_template('admin/nilai/list_ujian', $data);
    }

    // Menampilkan detail ujian berdasarkan ID
public function view($id)
{
    $data['title'] = 'Detail Ujian';
    $this->db->reset_query(); // bersihkan query builder

    $sql = "
        SELECT 
            ujian_skripsi.*,
            skripsi.tema,
            akun.nama AS nama_mahasiswa,
            d1.nama AS penguji1,
            d2.nama AS penguji2,
            d3.nama AS penguji3
        FROM ujian_skripsi
        LEFT JOIN skripsi ON skripsi.id = ujian_skripsi.id_skripsi
        LEFT JOIN mstr_akun AS akun ON akun.id = skripsi.id_mahasiswa
        LEFT JOIN mstr_akun AS d1 ON d1.id = ujian_skripsi.penguji1
        LEFT JOIN mstr_akun AS d2 ON d2.id = ujian_skripsi.penguji2
        LEFT JOIN mstr_akun AS d3 ON d3.id = ujian_skripsi.penguji3
        WHERE ujian_skripsi.id = ?
    ";

    $data['ujian'] = $this->db->query($sql, [$id])->row();

    if (!$data['ujian']) {
        show_404();
    }

    $this->load_template('admin/nilai/detail_ujian', $data);
}


}
