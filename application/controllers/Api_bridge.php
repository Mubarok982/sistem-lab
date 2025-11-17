<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_bridge extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // koneksi ke sistem_lab
    }

    public function kirim_komentar() {
        // contoh data komentar dari CI3
        $data = [
            "npm" => $this->input->post('npm'),
            "bab" => $this->input->post('bab'),
            "komentar_dosen1" => $this->input->post('komentar')
        ];

        // URL API dari web PHP native kamu
        $url = "http://localhost/sistem/api/komentar_insert.php";

        // cURL untuk kirim ke API
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);

        // decode hasil respon dari API
        $result = json_decode($response, true);

        if ($result['status'] == 'success') {
            echo "Komentar berhasil dikirim ke sistem utama!";
        } else {
            echo "Gagal kirim komentar: " . $result['message'];
        }
    }
}
