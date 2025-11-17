<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_notifikasi extends CI_Model {

    protected $table = 'notifikasi';

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_by_npm($npm) {
        $this->db->where('npm', $npm);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result_array();
    }
}
?>
