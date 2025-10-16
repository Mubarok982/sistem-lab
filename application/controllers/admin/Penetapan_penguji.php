<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penetapan_penguji extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        $data['title'] = 'Penetapan Dosen Penguji';

        $this->db->select('
            ujian_skripsi.id,
            ujian_skripsi.tanggal,
            ujian_skripsi.ruang,
            ujian_skripsi.status,
            skripsi.tema,
            akun.nama AS nama_mahasiswa,
            d1.nama AS penguji1,
            d2.nama AS penguji2,
            d3.nama AS penguji3
        ');
        $this->db->from('ujian_skripsi');
        $this->db->join('skripsi', 'skripsi.id = ujian_skripsi.id_skripsi', 'left');
        $this->db->join('mstr_akun AS akun', 'akun.id = skripsi.id_mahasiswa', 'left');
        $this->db->join('mstr_akun AS d1', 'd1.id = ujian_skripsi.penguji1', 'left');
        $this->db->join('mstr_akun AS d2', 'd2.id = ujian_skripsi.penguji2', 'left');
        $this->db->join('mstr_akun AS d3', 'd3.id = ujian_skripsi.penguji3', 'left');
        $this->db->order_by('ujian_skripsi.tanggal', 'DESC');
        
        $data['ujian'] = $this->db->get()->result();
        $this->load_template('admin/ujian/penguji', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Penetapan Penguji';
        $data['ujian'] = $this->db->get_where('ujian_skripsi', ['id' => $id])->row();
        $data['dosen'] = $this->db->get_where('mstr_akun', ['role' => 'dosen'])->result();
        $this->load_template('admin/ujian/form_penguji', $data);
    }

    public function update($id)
    {
        $data = [
            'penguji1' => $this->input->post('penguji1'),
            'penguji2' => $this->input->post('penguji2'),
            'penguji3' => $this->input->post('penguji3'),
        ];
        $this->db->where('id', $id);
        $this->db->update('ujian_skripsi', $data);
        redirect('admin/penetapan_penguji');
    }
}
