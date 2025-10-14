<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa_bimbingan extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

   public function index()
{
    // Ambil ID dosen dari session
    $id_dosen = $this->session->userdata('id'); // Ganti dari id_akun ke id
    
    if (empty($id_dosen)) {
        show_error('ID Dosen tidak ditemukan di session. Silakan login ulang.', 403);
        return;
    }

    $data['title'] = 'Mahasiswa Bimbingan';

    // Query daftar mahasiswa bimbingan
    $this->db->select('
        skripsi.id,
        skripsi.tema,
        skripsi.tgl_pengajuan_judul,
        skripsi.skema,
        skripsi.naskah,
        akun.nama AS nama_mahasiswa,
        CASE
            WHEN skripsi.pembimbing1 = '.$this->db->escape($id_dosen).' THEN "Pembimbing 1"
            WHEN skripsi.pembimbing2 = '.$this->db->escape($id_dosen).' THEN "Pembimbing 2"
        END AS peran
    ');
    $this->db->from('skripsi');
    $this->db->join('mstr_akun AS akun', 'akun.id = skripsi.id_mahasiswa', 'left');
    $this->db->where("(skripsi.pembimbing1 = {$id_dosen} OR skripsi.pembimbing2 = {$id_dosen})");
    $data['mahasiswa_bimbingan'] = $this->db->get()->result();

    $this->load_template('dosen/mahasiswa_bimbingan', $data);
}


    public function detail($id)
    {
        $data['title'] = 'Detail Skripsi Mahasiswa';

        // Ambil data skripsi + mahasiswa + pembimbing
        $this->db->select('
            skripsi.*,
            akun_mhs.nama AS nama_mahasiswa,
            akun_d1.nama AS nama_pembimbing1,
            akun_d2.nama AS nama_pembimbing2
        ');
        $this->db->from('skripsi');
        $this->db->join('mstr_akun AS akun_mhs', 'akun_mhs.id = skripsi.id_mahasiswa', 'left');
        $this->db->join('mstr_akun AS akun_d1', 'akun_d1.id = skripsi.pembimbing1', 'left');
        $this->db->join('mstr_akun AS akun_d2', 'akun_d2.id = skripsi.pembimbing2', 'left');
        $this->db->where('skripsi.id', $id);
        $data['skripsi'] = $this->db->get()->row();

        // Ambil data ujian (jika sudah dijadwalkan)
        $this->db->select('
            ujian_skripsi.tanggal,
            ujian_skripsi.tanggal_daftar,
            ujian_skripsi.ruang,
            ujian_skripsi.status,
            jenis_ujian_skripsi.nama AS jenis_ujian
        ');
        $this->db->from('ujian_skripsi');
        $this->db->join('jenis_ujian_skripsi', 'jenis_ujian_skripsi.id = ujian_skripsi.id_jenis_ujian_skripsi', 'left');
        $this->db->where('ujian_skripsi.id_skripsi', $id);
        $data['ujian'] = $this->db->get()->result();

        $this->load_template('dosen/detail_skripsi', $data);
    }
}
