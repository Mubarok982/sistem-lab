<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_akun extends CI_Model {

    protected $table = 'mstr_akun';

    public function get_user_by_username($username)
    {
        return $this->db->where('username', $username)->get($this->table)->row();
    }

    public function get_all_dosen()
    {
        return $this->db->where('role', 'dosen')->get($this->table)->result();
    }

    public function get_by_id($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete($this->table);
    }
}
