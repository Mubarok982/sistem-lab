<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_akun', 'akun');
        $this->load->library(['form_validation', 'session']);
    }

    // ====================================
    // LOGIN ADMIN (default)
    // URL: /auth
    // ====================================
    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            return $this->_redirect_by_role();
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login Admin';
            $this->load->view('auth/login_admin', $data);
        } else {
            $this->_proses_login_admin();
        }
    }


    private function _proses_login_admin()
    {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->akun->get_user_by_username($username);

        if (!$user || $password != $user->password) {
            $this->session->set_flashdata('message', 
                '<div class="alert alert-danger">Username atau password salah!</div>'
            );
            return redirect('auth');
        }

        $this->session->set_userdata([
            'logged_in' => TRUE,
            'role'      => 'admin',
            'id_admin'  => $user->id,
            'nama'      => $user->nama,
            'foto'      => 'assets/img/profile/default.png'
        ]);

        return redirect('admin/dashboard');
    }



    // ====================================
    // LOGIN MAHASISWA
    // URL: /auth/mahasiswa
    // ====================================
    public function mahasiswa()
    {
        if ($this->session->userdata('logged_in')) {
            return $this->_redirect_by_role();
        }

        $this->form_validation->set_rules('npm', 'NPM', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login Mahasiswa';
            $this->load->view('auth/login_mahasiswa', $data);
        } else {
            $this->_proses_login_mahasiswa();
        }
    }


    private function _proses_login_mahasiswa()
    {
        $npm      = $this->input->post('npm', TRUE);
        $password = $this->input->post('password', TRUE);

        $akun = $this->db->get_where('akun_mahasiswa', ['npm' => $npm])->row();

        if (!$akun || $password != $akun->password) {
            $this->session->set_flashdata('message', 
                '<div class="alert alert-danger">NPM atau password salah!</div>'
            );
            return redirect('auth/mahasiswa');
        }

        $bio = $this->db->get_where('akun_mahasiswa', [
            'id_mahasiswa' => $akun->id_mahasiswa
        ])->row();

        $nama = $bio->nama ?? "Mahasiswa";
        $foto = (!empty($bio->foto))
            ? 'uploads/foto_mhs/' . $bio->foto
            : 'assets/img/profile/default.png';

        $this->session->set_userdata([
            'logged_in'    => TRUE,
            'role'         => 'mahasiswa',
            'id_mahasiswa' => $akun->id_mahasiswa,
            'npm'          => $akun->npm,
            'nama'         => $nama,
            'foto'         => $foto
        ]);

        return redirect('mahasiswa/dashboard');
    }



    // ====================================
    // LOGIN DOSEN
    // URL: /auth/dosen
    // ====================================
    public function dosen()
    {
        if ($this->session->userdata('logged_in')) {
            return $this->_redirect_by_role();
        }

        $this->form_validation->set_rules('nip', 'NIP', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login Dosen';
            $this->load->view('auth/login_dosen', $data);
        } else {
            $this->_proses_login_dosen();
        }
    }


    private function _proses_login_dosen()
    {
        $username = $this->input->post('nip', TRUE);
        $password = $this->input->post('password', TRUE);

        $akun = $this->db->get_where('akun_dosen', ['nip' => $username])->row();

        if (!$akun || $password != $akun->password) {
            $this->session->set_flashdata('message', 
                '<div class="alert alert-danger">Username atau password salah!</div>'
            );
            return redirect('auth/dosen');
        }

        $bio = $this->db->get_where('akun_dosen', [
            'id_dosen' => $akun->id_dosen
        ])->row();

        $nama = $bio->nama ?? "Dosen";
        $foto = (!empty($bio->foto))
            ? 'uploads/foto_dosen/' . $bio->foto
            : 'assets/img/profile/default.png';

        $this->session->set_userdata([
            'logged_in' => TRUE,
            'role'      => 'dosen',
            'id_dosen'  => $akun->id_dosen,
            'username'  => $akun->username,
            'nama'      => $nama,
            'foto'      => $foto
        ]);

        return redirect('dosen/dashboard');
    }




    // ====================================
    // AUTO REDIRECT BERDASARKAN ROLE
    // ====================================
    private function _redirect_by_role()
    {
        switch ($this->session->userdata('role')) {
            case 'admin': return redirect('admin/dashboard');
            case 'mahasiswa': return redirect('mahasiswa/dashboard');
            case 'dosen': return redirect('dosen/dashboard');
        }
    }


    // ====================================
    // LOGOUT
    // ====================================
    public function logout()
{
    // Simpan role sebelum session dihapus
    $role = $this->session->userdata('role');

    // Hapus semua session
    $this->session->sess_destroy();

    // Redirect sesuai role
    switch ($role) {
        case 'admin':
            redirect('auth'); // login admin
            break;

        case 'mahasiswa':
            redirect('auth/mahasiswa'); // login mahasiswa
            break;

        case 'dosen':
            redirect('auth/dosen'); // login dosen
            break;

        default:
            redirect('auth'); // fallback
    }
}

}
