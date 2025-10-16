<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skripsi extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        $data['title'] = 'Manajemen Skripsi';

        $this->db->select('
            skripsi.*,
            mhs.nama AS nama_mahasiswa,
            d1.nidk AS pembimbing1_nidk,
            akun1.nama AS pembimbing1_nama,
            d2.nidk AS pembimbing2_nidk,
            akun2.nama AS pembimbing2_nama
        ');
        $this->db->from('skripsi');

        // Relasi mahasiswa (dari mstr_akun)
        $this->db->join('mstr_akun AS mhs', 'mhs.id = skripsi.id_mahasiswa', 'left');

        // Pembimbing 1 → relasi ke data_dosen dan nama di mstr_akun
        $this->db->join('data_dosen AS d1', 'd1.id = skripsi.pembimbing1', 'left');
        $this->db->join('mstr_akun AS akun1', 'akun1.id = skripsi.pembimbing1', 'left');

        // Pembimbing 2 → relasi ke data_dosen dan nama di mstr_akun
        $this->db->join('data_dosen AS d2', 'd2.id = skripsi.pembimbing2', 'left');
        $this->db->join('mstr_akun AS akun2', 'akun2.id = skripsi.pembimbing2', 'left');

        $data['skripsi'] = $this->db->get()->result();

        $this->load_template('admin/skripsi/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Skripsi';
        // ambil mahasiswa dari mstr_akun yang role-nya mahasiswa
        $data['mahasiswa'] = $this->db->get_where('mstr_akun', ['role' => 'mahasiswa'])->result();
        $data['dosen'] = $this->db->get('data_dosen')->result();
        $this->load_template('admin/skripsi/form', $data);
    }

    public function simpan()
    {
        $data = [
            'id_mahasiswa' => $this->input->post('id_mahasiswa'),
            'tema' => $this->input->post('tema'),
            'pembimbing1' => $this->input->post('pembimbing1'),
            'pembimbing2' => $this->input->post('pembimbing2'),
            'tgl_pengajuan_judul' => $this->input->post('tgl_pengajuan_judul'),
            'skema' => $this->input->post('skema'),
            'naskah' => $this->input->post('naskah'),
        ];
        $this->db->insert('skripsi', $data);
        redirect('admin/skripsi');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Skripsi';
        $data['skripsi'] = $this->db->get_where('skripsi', ['id' => $id])->row();
        $data['mahasiswa'] = $this->db->get_where('mstr_akun', ['role' => 'mahasiswa'])->result();
        $data['dosen'] = $this->db->get('data_dosen')->result();
        $this->load_template('admin/skripsi/form', $data);
    }

    public function update($id)
    {
        $data = [
            'tema' => $this->input->post('tema'),
            'pembimbing1' => $this->input->post('pembimbing1'),
            'pembimbing2' => $this->input->post('pembimbing2'),
            'tgl_pengajuan_judul' => $this->input->post('tgl_pengajuan_judul'),
            'skema' => $this->input->post('skema'),
            'naskah' => $this->input->post('naskah'),
        ];
        $this->db->where('id', $id);
        $this->db->update('skripsi', $data);
        redirect('admin/skripsi');
    }

    public function hapus($id)
    {
        $this->db->delete('skripsi', ['id' => $id]);
        redirect('admin/skripsi');
    }
}
