<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_akun', 'm_akun');
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard Admin';
        $data['user']  = $this->m_akun->get_user_by_username($this->session->userdata('username'));
        $this->load_template('admin/dashboard', $data);
    }

    public function akun_dosen()
    {
        $data['title'] = 'Manajemen Akun Dosen';
        $data['list_dosen'] = $this->m_akun->get_all_dosen();
        $this->load_template('admin/akun_dosen/index', $data);
    }

    public function akun_dosen_tambah()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[mstr_akun.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Akun Dosen';
            $this->load_template('admin/akun_dosen/tambah', $data);
        } else {
            $insert = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'nama'     => $this->input->post('nama'),
                'role'     => 'dosen'
            ];
            $this->m_akun->insert($insert);
            $this->session->set_flashdata('success', 'Akun dosen berhasil ditambahkan!');
            redirect('admin/akun/dosen');
        }
    }

    public function akun_dosen_edit($id)
    {
        $data['dosen'] = $this->m_akun->get_by_id($id);
        if (!$data['dosen']) show_404();

        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Akun Dosen';
            $this->load_template('admin/akun_dosen/edit', $data);
        } else {
            $update = [
                'nama' => $this->input->post('nama')
            ];

            // Jika password diubah
            if (!empty($this->input->post('password'))) {
                $update['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            $this->m_akun->update($id, $update);
            $this->session->set_flashdata('success', 'Akun dosen berhasil diperbarui!');
            redirect('admin/akun/dosen');
        }
    }

    public function akun_dosen_hapus($id)
    {
        $this->m_akun->delete($id);
        $this->session->set_flashdata('success', 'Akun dosen berhasil dihapus!');
        redirect('admin/akun/dosen');
    }

    public function mahasiswa()
{
    $data['title'] = 'Manajemen Mahasiswa';
    $data['user']  = $this->m_akun->get_user_by_username($this->session->userdata('username'));
    $this->load->model('M_mahasiswa', 'm_mahasiswa');
    $data['mahasiswa'] = $this->m_mahasiswa->get_all();

    $this->load_template('admin/mahasiswa/index', $data);
}

public function tambah_mahasiswa()
{
    $data['title'] = 'Tambah Mahasiswa';
    $this->load_template('admin/mahasiswa/form', $data);
}

public function simpan_mahasiswa()
{
    $this->load->model('M_mahasiswa', 'm_mahasiswa');
    $data = [
        'nim' => $this->input->post('nim'),
        'nama' => $this->input->post('nama'),
        'prodi' => $this->input->post('prodi'),
        'angkatan' => $this->input->post('angkatan'),
        'email' => $this->input->post('email'),
    ];

    $this->m_mahasiswa->insert($data);
    $this->session->set_flashdata('success', 'Data mahasiswa berhasil ditambahkan!');
    redirect('admin/mahasiswa');
}

public function hapus_mahasiswa($nim)
{
    $this->load->model('M_mahasiswa', 'm_mahasiswa');
    $this->m_mahasiswa->delete($nim);
    $this->session->set_flashdata('success', 'Data mahasiswa berhasil dihapus!');
    redirect('admin/mahasiswa');
}

}
