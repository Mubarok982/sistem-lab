<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller {

    public $data = [];

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in') && $this->router->fetch_class() !== 'auth') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Silakan login terlebih dahulu!</div>');
            redirect('auth');
        }
        $this->load_sidebar();
    }
    private function load_sidebar()
    {
        if ($this->session->userdata('logged_in')) {
            $role = $this->session->userdata('role');
            $sidebar_view = '';
            if ($role === 'operator' || $role === 'tata_usaha') {
                $sidebar_view = 'templates/sidebar_admin';
            } elseif ($role === 'dosen') {
                $sidebar_view = 'templates/sidebar_dosen';
            } elseif ($role === 'mahasiswa') {
                $sidebar_view = 'templates/sidebar_mahasiswa';
            }

            if (!empty($sidebar_view)) {
                $this->data['sidebar'] = $this->load->view($sidebar_view, $this->data, TRUE);
            }
        }
    }

    /**
     * Fungsi wrapper untuk memuat view template lengkap.
     * Ini menyederhanakan pemanggilan view di controller anak.
     *
     * @param string $content_view 
     * @param array  $data         
     */
    protected function load_template($content_view, $data = [])
    {
        // Menggabungkan data dari controller anak dengan data dari base controller
        $this->data = array_merge($this->data, $data);
        
        // Memuat template dengan path 'templates/' yang benar
        $this->load->view('templates/header', $this->data);
        $this->load->view($content_view, $this->data);
        $this->load->view('templates/footer', $this->data);
    }
}

