<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public $data = [];

    public function __construct()
    {
        parent::__construct();

        // Cek login kecuali untuk halaman auth
        if (!$this->session->userdata('logged_in') && $this->router->fetch_class() !== 'auth') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Silakan login terlebih dahulu!</div>');
            redirect('auth');
        }

        // Siapkan data dasar
        $this->data['user'] = $this->session->userdata();
        $this->data['title'] = isset($this->data['title']) ? $this->data['title'] : 'Sistem Lab Skripsi';
        
        // Load sidebar sesuai role
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
                $this->data['sidebar'] = $this->load->view($sidebar_view, $this->data, TRUE);
            }
        }
    }

    /**
     * Load template utama dengan header, sidebar, dan footer.
     * Cukup panggil: $this->load_template('dosen/dashboard', $data);
     */
    protected function load_template($content_view, $data = [])
    {
        // Gabungkan data dari controller dan base controller
        $this->data = array_merge($this->data, $data);

        // Load header, sidebar, konten, footer
        $this->load->view('templates/header', $this->data);
        echo isset($this->data['sidebar']) ? $this->data['sidebar'] : '';
        $this->load->view($content_view, $this->data);
        $this->load->view('templates/footer', $this->data);
    }
}
