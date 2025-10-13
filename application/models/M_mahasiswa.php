<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mahasiswa extends CI_Model {

    protected $table = 'data_mahasiswa';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function get_by_nim($nim)
    {
        return $this->db->get_where($this->table, ['nim' => $nim])->row();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($nim, $data)
    {
        $this->db->where('nim', $nim);
        return $this->db->update($this->table, $data);
    }

    public function delete($nim)
    {
        return $this->db->delete($this->table, ['nim' => $nim]);
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }
}
