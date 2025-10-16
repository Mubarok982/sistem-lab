<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $data = [];

    public function __construct()
    {
        parent::__construct();

        // Cek login kecuali halaman auth
        if (!$this->session->userdata('logged_in') && $this->router->fetch_class() !== 'auth') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Silakan login terlebih dahulu!</div>');
            redirect('auth');
        }

        // Data dasar
        $this->data['user'] = $this->session->userdata();
        $this->data['title'] = 'Sistem Lab Skripsi';

        // Sidebar otomatis sesuai role
        $this->load_sidebar();
    }

    private function load_sidebar()
    {
        if ($this->session->userdata('logged_in')) {
            $role = $this->session->userdata('role');

            switch ($role) {
                case 'operator':
                case 'tata_usaha':
                    $sidebar_view = 'templates/sidebar_admin';
                    break;
                case 'dosen':
                    $sidebar_view = 'templates/sidebar_dosen';
                    break;
                case 'mahasiswa':
                    $sidebar_view = 'templates/sidebar_mahasiswa';
                    break;
                default:
                    $sidebar_view = '';
                    break;
            }

            if ($sidebar_view !== '') {
                // Simpan hasil view sidebar (jangan tampilkan di sini)
                $this->data['sidebar'] = $this->load->view($sidebar_view, $this->data, TRUE);
            }
        }
    }

    protected function load_template($content_view, $data = [])
    {
        // Gabungkan data controller + global
        $this->data = array_merge($this->data, $data);

        // Simpan path view konten
        $this->data['content_view'] = $content_view;

        // Load layout utama (1x sidebar)
        $this->load->view('templates/main', $this->data);
    }
}
