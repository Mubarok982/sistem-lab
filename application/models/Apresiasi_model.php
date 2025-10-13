<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apresiasi_model extends CI_Model {

    public function get_apresiasi_by_mahasiswa($id_mahasiswa) {
        $this->db->select('
            a.id,
            m_mahasiswa.nama AS nama_mahasiswa,
            m_dosen.nama AS nama_dosen,
            a.apresiasi
        ');
        $this->db->from('apresiasi_ujian_skripsi AS a');
        $this->db->join('ujian_skripsi AS u', 'a.id_ujian_skripsi = u.id_skripsi', 'left');
        $this->db->join('skripsi AS sk', 'u.id_skripsi = sk.id', 'left');
        $this->db->join('mstr_akun AS m_mahasiswa', "sk.id_mahasiswa = m_mahasiswa.id AND m_mahasiswa.role = 'mahasiswa'", 'left');
        $this->db->join('mstr_akun AS m_dosen', "a.id_penguji = m_dosen.id AND m_dosen.role = 'dosen'", 'left');
        $this->db->where('sk.id_mahasiswa', $id_mahasiswa); // filter untuk mahasiswa login
        $this->db->order_by('a.id', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

}
