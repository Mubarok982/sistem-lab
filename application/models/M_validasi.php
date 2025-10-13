<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_validasi extends CI_Model {

    /**
     * Ambil status validasi syarat sempro berdasarkan mahasiswa
     */
    public function get_validasi_sempro($id_mahasiswa)
    {
        $this->db->select('
            v.id,
            v.status,
            v.catatan,
            v.tanggal_validasi,
            s.id_ujian_skripsi
        ');
        $this->db->from('validasi_syarat_sempro v');
        $this->db->join('syarat_sempro s', 's.id = v.id_syarat_sempro');
        $this->db->join('ujian_skripsi u', 'u.id = s.id_ujian_skripsi');
        $this->db->join('skripsi sk', 'sk.id = u.id_skripsi');
        $this->db->where('sk.id_mahasiswa', $id_mahasiswa);
        return $this->db->get()->result();
    }

    /**
     * Ambil status validasi syarat pendadaran berdasarkan mahasiswa
     */
    public function get_validasi_pendadaran($id_mahasiswa)
    {
        $this->db->select('
            v.id,
            v.status,
            v.catatan,
            v.tanggal_validasi,
            s.id_ujian_skripsi
        ');
        $this->db->from('validasi_syarat_pendadaran v');
        $this->db->join('syarat_pendadaran s', 's.id = v.id_syarat_pendadaran');
        $this->db->join('ujian_skripsi u', 'u.id = s.id_ujian_skripsi');
        $this->db->join('skripsi sk', 'sk.id = u.id_skripsi');
        $this->db->where('sk.id_mahasiswa', $id_mahasiswa);
        return $this->db->get()->result();
    }
}
