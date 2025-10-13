<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_akun', 'm_akun');
        $this->load->library(['form_validation','session']);
    }

    /** LOGIN ADMIN/OPERATOR/TATA_USAHA */
    public function index()
    {
        // Jika sudah login sebagai admin/operator/tata_usaha
        if (in_array($this->session->userdata('role'), ['operator','tata_usaha'])) {
            redirect('admin/dashboard');
        }

        $this->form_validation->set_rules('username','Username','required|trim');
        $this->form_validation->set_rules('password','Password','required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login Admin';
            $this->load->view('auth/login_admin', $data);
        } else {
            $this->_proses_login('operator,tata_usaha','admin/dashboard');
        }
    }

    /** LOGIN MAHASISWA */
  public function mahasiswa()
{
    // load form login mahasiswa
    if ($this->session->userdata('role') === 'mahasiswa') {
        redirect('mahasiswa'); // redirect ke index Mahasiswa.php
    }

    $this->form_validation->set_rules('username','Username','required|trim');
    $this->form_validation->set_rules('password','Password','required|trim');

    if ($this->form_validation->run() == FALSE) {
        $data['title'] = 'Login Mahasiswa';
        $this->load->view('auth/login_mahasiswa', $data);
    } else {
        $this->_proses_login('mahasiswa','mahasiswa'); // redirect ke controller Mahasiswa
    }
}


    /** LOGIN DOSEN */
    public function dosen()
    {
        if ($this->session->userdata('role') === 'dosen') {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('username','Username','required|trim');
        $this->form_validation->set_rules('password','Password','required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login Dosen';
            $this->load->view('auth/login_dosen', $data);
        } else {
            $this->_proses_login('dosen','dashboard');
        }
    }

    /** Fungsi umum untuk memproses login */
    private function _proses_login($role_allowed, $redirect_dashboard)
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->m_akun->get_user_by_username($username);

        if ($user) {
            // Password teks biasa (bisa ganti password_verify jika pakai hashing)
            if ($password === $user->password) {

                // Cek role
                $roles = explode(',', $role_allowed);
                if (in_array($user->role, $roles)) {

                    $session_data = [
                        'id'        => $user->id,
                        'username'  => $user->username,
                        'nama'      => $user->nama,
                        'role'      => $user->role,
                        'logged_in' => TRUE
                    ];

                    $this->session->set_userdata($session_data);
                    redirect($redirect_dashboard);

                } else {
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda tidak memiliki akses!</div>');
                    redirect(current_url());
                }

            } else {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Username atau password salah!</div>');
                redirect(current_url());
            }

        } else {
            $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Username tidak ditemukan!</div>');
            redirect(current_url());
        }
    }

    /** Logout */
    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Anda berhasil logout.</div>');
        redirect('auth');
    }
}
