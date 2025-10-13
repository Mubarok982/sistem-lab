<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    // Hitung jumlah mahasiswa bimbingan aktif
    public function count_mahasiswa_bimbingan($id_dosen) {
        $this->db->from('skripsi');
        $this->db->where('pembimbing1', $id_dosen);
        $this->db->or_where('pembimbing2', $id_dosen);
        return $this->db->count_all_results();
    }

    // Ambil jadwal ujian yang akan datang untuk dosen penguji
    public function get_jadwal_ujian($id_dosen) {
        $this->db->select('u.id_skripsi, s.judul, u.tanggal AS tanggal, u.waktu_ujian');
        $this->db->from('ujian_skripsi AS u');
        $this->db->join('skripsi AS s', 'u.id_skripsi = s.id', 'left');
        $this->db->where('u.penguji1', $id_dosen);
        $this->db->or_where('u.penguji2', $id_dosen);
        $this->db->or_where('u.penguji3', $id_dosen);
        $this->db->order_by('u.tanggal', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

}
