<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_ujian_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // Contoh fungsi ambil semua data jadwal
    public function get_all()
    {
        return $this->db->get('tbl_jadwal_ujian')->result();
    }

    // Contoh fungsi insert
    public function insert($data)
    {
        return $this->db->insert('tbl_jadwal_ujian', $data);
    }

    // Contoh fungsi update
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tbl_jadwal_ujian', $data);
    }

    // Contoh fungsi delete
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('tbl_jadwal_ujian');
    }
}
