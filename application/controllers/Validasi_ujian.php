<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi_ujian extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        $data['title'] = 'Validasi Syarat Ujian';

        // Ambil data validasi + mahasiswa
        $this->db->select('
            vss.id,
            vss.nama_field_syarat,
            vss.status,
            vss.catatan,
            vss.updated_at,
            akun.nama AS nama_mahasiswa
        ');
        $this->db->from('validasi_syarat_sempro AS vss');
        $this->db->join('syarat_sempro AS ss', 'ss.id = vss.id_syarat_sempro', 'left');
        $this->db->join('ujian_skripsi AS uj', 'uj.id = ss.id_ujian_skripsi', 'left');
        $this->db->join('skripsi AS s', 's.id = uj.id_skripsi', 'left');
        $this->db->join('mstr_akun AS akun', 'akun.id = s.id_mahasiswa', 'left');
        $this->db->order_by('vss.updated_at', 'DESC');

        $data['validasi'] = $this->db->get()->result();

        $this->load_template('admin/ujian/validasi', $data);
    }

    public function setujui($id)
    {
        $this->db->where('id', $id);
        $this->db->update('validasi_syarat_sempro', [
            'status' => 'Diterima',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        redirect('admin/validasi_ujian');
    }

    public function revisi($id)
    {
        $this->db->where('id', $id);
        $this->db->update('validasi_syarat_sempro', [
            'status' => 'Revisi',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        redirect('admin/validasi_ujian');
    }
}
