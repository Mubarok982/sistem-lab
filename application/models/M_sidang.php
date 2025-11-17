<?php
class M_sidang extends CI_Model {

    public function get_jadwal_by_mahasiswa()
    {
        // ambil id_mahasiswa dari session
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');

        if (!$id_mahasiswa) {
            return null; // biar tidak error SQL
        }

        // Ambil id skripsi terbaru milik mahasiswa
        $sub = $this->db->select('id')
                        ->from('skripsi')
                        ->where('id_mahasiswa', $id_mahasiswa)
                        ->order_by('id', 'DESC')
                        ->limit(1)
                        ->get_compiled_select();

        return $this->db->select('u.tanggal, u.waktu_ujian, u.ruang')
                        ->from('ujian_skripsi u')
                        ->where("u.id = ($sub)", NULL, FALSE)
                        ->order_by('u.tanggal', 'DESC')
                        ->limit(1)
                        ->get()
                        ->row_array();
    }
}
