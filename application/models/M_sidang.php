<?php
class M_sidang extends CI_Model {

    public function get_jadwal_by_mahasiswa($id_mahasiswa)
    {
        return $this->db->select('tanggal, waktu, tempat')
                        ->from('jadwal_sidang')
                        ->where('id_mahasiswa', $id_mahasiswa)
                        ->order_by('tanggal', 'DESC')
                        ->limit(1)
                        ->get()
                        ->row_array();
    }
}
