<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dosen extends CI_Model {

    protected $table = 'data_dosen';

    public function get_by_nidk($nidk)
    {
        return $this->db->where('nidk', $nidk)->get($this->table)->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_by_nidk($nidk, $data)
    {
        return $this->db->where('nidk', $nidk)->update($this->table, $data);
    }

    public function delete_by_nidk($nidk)
    {
        return $this->db->where('nidk', $nidk)->delete($this->table);
    }

    public function get_all_joined()
    {
        $this->db->select('mstr_akun.*, data_dosen.prodi, data_dosen.is_kaprodi, data_dosen.is_praktisi');
        $this->db->from('mstr_akun');
        $this->db->join('data_dosen', 'data_dosen.nidk = mstr_akun.username', 'left');
        $this->db->where('mstr_akun.role', 'dosen');
        return $this->db->get()->result();
    }
}
