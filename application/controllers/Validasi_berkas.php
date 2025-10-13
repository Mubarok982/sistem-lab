<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi_berkas extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        $data['title'] = 'Validasi Berkas Skripsi';

        $this->db->select('
            vss.id,
            vss.nama_field_syarat,
            vss.status,
            vss.catatan,
            vss.updated_at,
            ss.id AS id_syarat_sempro,
            us.id AS id_ujian_skripsi,
            s.id AS id_skripsi,
            s.tema,
            akun.nama AS nama_mahasiswa
        ');
        $this->db->from('validasi_syarat_sempro AS vss');
        $this->db->join('syarat_sempro AS ss', 'ss.id = vss.id_syarat_sempro', 'left');
        $this->db->join('ujian_skripsi AS us', 'us.id = ss.id_ujian_skripsi', 'left');
        $this->db->join('skripsi AS s', 's.id = us.id_skripsi', 'left');
        $this->db->join('mstr_akun AS akun', 'akun.id = s.id_mahasiswa', 'left');
        $this->db->order_by('vss.updated_at', 'DESC');

        $data['berkas'] = $this->db->get()->result();

        $this->load_template('admin/skripsi/validasi', $data);
    }

    public function setujui($id)
    {
        $this->db->where('id', $id);
        $this->db->update('validasi_syarat_sempro', ['status' => 'Diterima']);
        redirect('admin/validasi_berkas');
    }

    public function tolak($id)
    {
        $this->db->where('id', $id);
        $this->db->update('validasi_syarat_sempro', ['status' => 'Revisi']);
        redirect('admin/validasi_berkas');
    }
}
