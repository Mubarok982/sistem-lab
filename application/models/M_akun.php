<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_akun extends CI_Model {

    public function login_admin($username)
    {
        $admin = $this->db->where('username', $username)->get('admin')->row();

        if ($admin) {
            // normalisasi biar formatnya sama
            $admin->role = $admin->role ?? 'admin';
            $admin->id   = $admin->id; 
            $admin->nama = $admin->nama;

            return $admin;
        }

        return null;
    }
    public function login_dosen($nip)
    {
        $dosen = $this->db->where('nip', $nip)->get('akun_dosen')->row();

        if ($dosen) {
            $dosen->username = $dosen->nip;
            $dosen->role = 'dosen';
            return $dosen;
        }

        return null;
    }
    public function login_mahasiswa($npm)
    {
        $mhs = $this->db->where('npm', $npm)->get('akun_mahasiswa')->row();

        if ($mhs) {
            $mhs->username = $mhs->npm;
            $mhs->role = 'mahasiswa';
            return $mhs;
        }

        return null;
    }

    public function get_user_by_username($username)
    {
        // 1. cek admin
        if ($admin = $this->login_admin($username)) {
            return $admin;
        }

        // 2. cek dosen (username dianggap nip)
        if ($dosen = $this->login_dosen($username)) {
            return $dosen;
        }

        // 3. cek mahasiswa (username dianggap npm)
        if ($mhs = $this->login_mahasiswa($username)) {
            return $mhs;
        }

        return null;
    }

    public function get_user_by_npm($npm)
{
    return $this->db->get_where('akun_mahasiswa', ['npm' => $npm])->row();
}

}
