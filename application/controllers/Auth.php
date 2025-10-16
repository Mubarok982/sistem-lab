<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_akun', 'm_akun');
        $this->load->library(['form_validation', 'session']);
    }

    /** ====================== LOGIN ADMIN / OPERATOR / TATA USAHA ====================== */
    public function index()
    {
        if (in_array($this->session->userdata('role'), ['operator', 'tata_usaha'])) {
            redirect('admin/dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login Admin';
            $this->load->view('auth/login_admin', $data);
        } else {
            $this->_proses_login(['operator', 'tata_usaha'], 'admin/dashboard');
        }
    }

    /** ====================== LOGIN MAHASISWA ====================== */
    public function mahasiswa()
    {
        if ($this->session->userdata('role') === 'mahasiswa') {
            redirect('mahasiswa/dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login Mahasiswa';
            $this->load->view('auth/login_mahasiswa', $data);
        } else {
            $this->_proses_login(['mahasiswa'], 'mahasiswa/dashboard');
        }
    }

    /** ====================== LOGIN DOSEN ====================== */
    public function dosen()
    {
        if ($this->session->userdata('role') === 'dosen') {
            redirect('dosen/dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login Dosen';
            $this->load->view('auth/login_dosen', $data);
        } else {
            $this->_proses_login(['dosen'], 'dosen/dashboard');
        }
    }

    /** ====================== FUNGSI PROSES LOGIN UMUM ====================== */
    private function _proses_login($role_allowed = [], $redirect_dashboard = '')
    {
        // Pastikan parameter role_allowed adalah array
        if (!is_array($role_allowed)) {
            $role_allowed = [$role_allowed];
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->m_akun->get_user_by_username($username);

        if ($user) {
            if ($password === $user->password) {

                if (in_array($user->role, $role_allowed)) {
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
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">Anda tidak memiliki akses ke halaman ini!</div>');
                    redirect(current_url());
                }

            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Password salah!</div>');
                redirect(current_url());
            }

        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Username tidak ditemukan!</div>');
            redirect(current_url());
        }
    }

    /** ====================== LOGOUT ====================== */
    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success">Anda berhasil logout.</div>');
        redirect('auth');
    }
}
