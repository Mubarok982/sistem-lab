<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_skripsi extends CI_Model {

    public function get_all_skripsi()
    {
        $this->db->select('
            skripsi.*,
            mhs.nama as nama_mahasiswa,
            d1.nama as pembimbing1_nama,
            d2.nama as pembimbing2_nama
        ');
        $this->db->from('skripsi');
        // ambil id_mahasiswa dari skripsi lalu join ke mstr_akun untuk dapatkan nama mahasiswa
        $this->db->join('mstr_akun as mhs', 'mhs.id = skripsi.id_mahasiswa');
        // join dosen pembimbing dari tabel mstr_akun juga
        $this->db->join('mstr_akun as d1', 'd1.id = skripsi.pembimbing1', 'left');
        $this->db->join('mstr_akun as d2', 'd2.id = skripsi.pembimbing2', 'left');
        return $this->db->get()->result();
    }

    // Tambahkan method baru agar controller Mahasiswa bisa memanggil
    public function get_latest_by_mahasiswa($id_mahasiswa)
    {
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        return $this->db->get('skripsi')->row();
    }
}
