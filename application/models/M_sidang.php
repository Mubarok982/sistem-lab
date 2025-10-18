<?php
class M_sidang extends CI_Model {

    public function get_jadwal_by_mahasiswa($id_mahasiswa)
    {
        return $this->db->select('u.tanggal, u.waktu_ujian, u.ruang')
                        ->from('ujian_skripsi u')
                        ->where('u.id', "(SELECT id FROM skripsi WHERE id_mahasiswa = {$id_mahasiswa} LIMIT 1)", false)
                        ->order_by('u.tanggal', 'DESC')
                        ->limit(1)
                        ->get()
                        ->row_array();
    }
}
