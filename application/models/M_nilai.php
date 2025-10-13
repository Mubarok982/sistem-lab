<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_nilai extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // Contoh fungsi: ambil nilai mahasiswa
    public function get_nilai_by_mahasiswa($id_mahasiswa)
    {
        return $this->db->get_where('nilai', ['id_mahasiswa' => $id_mahasiswa])->result();
    }
}
