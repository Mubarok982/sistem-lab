<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_notifikasi');
    }

    // Endpoint: POST /api/terima_notifikasi
    public function terima_notifikasi() {
        $npm   = $this->input->post('npm');
        $pesan = $this->input->post('pesan');

        if (!$npm || !$pesan) {
            echo json_encode(['status' => 'error', 'message' => 'Parameter kurang']);
            return;
        }

        // Simpan ke DB
        $this->M_notifikasi->insert([
            'npm' => $npm,
            'pesan' => $pesan,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        echo json_encode(['status' => 'success', 'message' => 'Notifikasi diterima']);
    }
}
?>
