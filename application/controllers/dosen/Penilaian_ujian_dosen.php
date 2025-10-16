<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian_ujian_dosen extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function index()
    {
        $id_dosen = $this->session->userdata('id');

        if (!$id_dosen) {
            show_error('ID Dosen tidak ditemukan. Silakan login ulang.');
            return;
        }

        $data['title'] = 'Penilaian Ujian';

        // ambil daftar ujian di mana dosen ini adalah penguji
        $this->db->select('
            ujian_skripsi.id,
            ujian_skripsi.tanggal,
            ujian_skripsi.ruang,
            ujian_skripsi.status,
            jenis_ujian_skripsi.nama AS jenis_ujian,
            akun.nama AS nama_mahasiswa,
            skripsi.tema AS judul_skripsi
        ');
        $this->db->from('ujian_skripsi');
        $this->db->join('skripsi', 'skripsi.id = ujian_skripsi.id_skripsi', 'left');
        $this->db->join('mstr_akun AS akun', 'akun.id = skripsi.id_mahasiswa', 'left');
        $this->db->join('jenis_ujian_skripsi', 'jenis_ujian_skripsi.id = ujian_skripsi.id_jenis_ujian_skripsi', 'left');
        $this->db->where("($id_dosen IN (ujian_skripsi.penguji1, ujian_skripsi.penguji2, ujian_skripsi.penguji3))");
        $data['ujian'] = $this->db->get()->result();

        $this->load_template('dosen/penilaian_ujian', $data);
    }

    public function nilai($id_ujian)
    {
        $id_dosen = $this->session->userdata('id');

        if (!$id_dosen) {
            show_error('ID Dosen tidak ditemukan. Silakan login ulang.');
            return;
        }

        // cek apakah dosen berhak menilai ujian ini
        $cek = $this->db->query("
            SELECT id FROM ujian_skripsi 
            WHERE id = ? AND ? IN (penguji1, penguji2, penguji3)
        ", [$id_ujian, $id_dosen])->row();

        if (!$cek) {
            show_error('Anda tidak memiliki akses untuk menilai ujian ini.', 403, 'Akses Ditolak');
            return;
        }

        $data['title'] = 'Input Nilai Ujian';
        $data['id_ujian'] = $id_ujian;

        // ambil data mahasiswa
        $this->db->select('
            akun.nama AS nama_mahasiswa,
            skripsi.tema AS judul_skripsi,
            jenis_ujian_skripsi.nama AS jenis_ujian
        ');
        $this->db->from('ujian_skripsi');
        $this->db->join('skripsi', 'skripsi.id = ujian_skripsi.id_skripsi', 'left');
        $this->db->join('mstr_akun AS akun', 'akun.id = skripsi.id_mahasiswa', 'left');
        $this->db->join('jenis_ujian_skripsi', 'jenis_ujian_skripsi.id = ujian_skripsi.id_jenis_ujian_skripsi', 'left');
        $this->db->where('ujian_skripsi.id', $id_ujian);
        $data['mahasiswa'] = $this->db->get()->row();

        // ambil komponen nilai
        $data['komponen'] = $this->db->get('mstr_komponen_nilai_ujian_skripsi')->result();

        $this->load_template('dosen/form_penilaian', $data);
    }

    public function simpan_nilai()
    {
        $id_dosen = $this->session->userdata('id');
        $id_ujian = $this->input->post('id_ujian');

        // validasi akses penguji
        $cek = $this->db->query("
            SELECT id FROM ujian_skripsi 
            WHERE id = ? AND ? IN (penguji1, penguji2, penguji3)
        ", [$id_ujian, $id_dosen])->row();

        if (!$cek) {
            show_error('Anda tidak berhak menyimpan nilai ujian ini.', 403, 'Akses Ditolak');
            return;
        }

        $nilai = $this->input->post('nilai');
        $saran = $this->input->post('saran');
        $apresiasi = $this->input->post('apresiasi');

        // simpan nilai tiap komponen
        foreach ($nilai as $id_komponen => $nilai_angka) {
            $this->db->insert('tbl_nilai_ujian_skripsi', [
                'id_ujian_skripsi' => $id_ujian,
                'id_penguji'       => $id_dosen,
                'id_komponen_nilai' => $id_komponen,
                'nilai'            => $nilai_angka
            ]);
        }

        // simpan saran
        $this->db->insert('saran_ujian_skripsi', [
            'id_ujian_skripsi' => $id_ujian,
            'id_dosen' => $id_dosen,
            'saran' => $saran
        ]);

        // simpan apresiasi
        $this->db->insert('apresiasi_ujian_skripsi', [
            'id_ujian_skripsi' => $id_ujian,
            'id_dosen' => $id_dosen,
            'apresiasi' => $apresiasi
        ]);

        $this->session->set_flashdata('success', 'Nilai berhasil disimpan!');
        redirect('dosen/penilaian_ujian');
    }
}
