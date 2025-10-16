<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_akun', 'm_akun');
        $this->load->database();
    }

    // =====================
    //  AKUN DOSEN
    // =====================
    public function dosen()
    {
        $data['title'] = 'Manajemen Akun Dosen';
        $data['list_dosen'] = $this->db->get_where('mstr_akun', ['role' => 'dosen'])->result();
        $this->load_template('admin/akun_dosen/index', $data);
    }

    // =====================
    //  AKUN MAHASISWA
    // =====================
    public function mahasiswa()
    {
        $data['title'] = 'Manajemen Akun Mahasiswa';
        // Ambil dari mstr_akun dengan role mahasiswa
        $data['list_mahasiswa'] = $this->db->get_where('mstr_akun', ['role' => 'mahasiswa'])->result();
        $this->load_template('admin/mahasiswa/index', $data);
    }

    // Halaman tambah akun mahasiswa
    public function tambah_mahasiswa()
    {
        $data['title'] = 'Tambah Akun Mahasiswa';
        $this->load_template('admin/mahasiswa/form', $data);
    }

    // Proses tambah mahasiswa
    public function simpan_mahasiswa()
    {
        $data = [
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'nama'     => $this->input->post('nama'),
            'role'     => 'mahasiswa'
        ];

        $this->db->insert('mstr_akun', $data);
        redirect('admin/akun/mahasiswa');
    }

    // Edit akun mahasiswa
    public function edit_mahasiswa($id)
    {
        $data['title'] = 'Edit Akun Mahasiswa';
        $data['mahasiswa'] = $this->db->get_where('mstr_akun', ['id' => $id, 'role' => 'mahasiswa'])->row();
        $this->load_template('admin/mahasiswa/form', $data);
    }

    // Simpan perubahan
    public function update_mahasiswa($id)
    {
        $update = [
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
        ];

        if ($this->input->post('password')) {
            $update['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $this->db->where('id', $id);
        $this->db->update('mstr_akun', $update);

        redirect('admin/akun/mahasiswa');
    }

    // Hapus akun
    public function hapus_mahasiswa($id)
    {
        $this->db->delete('mstr_akun', ['id' => $id, 'role' => 'mahasiswa']);
        redirect('admin/akun/mahasiswa');
    }
}
