<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ujian extends CI_Model {

    /**
     * Ambil daftar jadwal ujian skripsi lengkap dengan nama mahasiswa dan dosen penguji.
     */
    public function get_jadwal()
    {
        $this->db->select('
            ujian_skripsi.id,
            ujian_skripsi.tanggal,
            ujian_skripsi.ruang,
            ujian_skripsi.status,
            mhs.nama AS nama_mahasiswa,
            d1.nama AS penguji1,
            d2.nama AS penguji2,
            d3.nama AS penguji3,
            jus.nama AS jenis_ujian
        ');
        $this->db->from('ujian_skripsi');
        $this->db->join('skripsi', 'skripsi.id = ujian_skripsi.id_skripsi', 'left');
        $this->db->join('mstr_akun AS mhs', 'mhs.id = skripsi.id_mahasiswa', 'left');
        $this->db->join('mstr_akun AS d1', 'd1.id = ujian_skripsi.penguji1', 'left');
        $this->db->join('mstr_akun AS d2', 'd2.id = ujian_skripsi.penguji2', 'left');
        $this->db->join('mstr_akun AS d3', 'd3.id = ujian_skripsi.penguji3', 'left');
        $this->db->join('jenis_ujian_skripsi AS jus', 'jus.id = ujian_skripsi.id_jenis_ujian_skripsi', 'left');
        $this->db->order_by('ujian_skripsi.tanggal', 'DESC');

        return $this->db->get()->result();
    }

    /**
     * Insert data ujian untuk pendaftaran seminar proposal (Sempro)
     * Catatan: IPK tidak disimpan di tabel ujian_skripsi — ambil dari tabel syarat_pendadaran jika diperlukan.
     */
    public function insert_ujian_sempro($id_skripsi)
    {
        $data = [
            'id_skripsi' => $id_skripsi,
            'id_jenis_ujian_skripsi' => 1, // 1 = Seminar Proposal (pastikan sesuai isi tabel jenis_ujian_skripsi)
            'persetujuan_pembimbing1' => 0,
            'persetujuan_pembimbing2' => 0,
            'status' => 'Diajukan',
            'tanggal_daftar' => date('Y-m-d')
        ];

        $this->db->insert('ujian_skripsi', $data);
        return $this->db->insert_id();
    }

    /**
     * Ambil data ujian berdasarkan ID skripsi tertentu
     */
    public function get_ujian_by_skripsi($id_skripsi)
    {
        $this->db->select('ujian_skripsi.*, jus.nama AS jenis_ujian');
        $this->db->from('ujian_skripsi');
        $this->db->join('jenis_ujian_skripsi AS jus', 'jus.id = ujian_skripsi.id_jenis_ujian_skripsi', 'left');
        $this->db->where('ujian_skripsi.id_skripsi', $id_skripsi);
        return $this->db->get()->row();
    }

    /**
     * Ambil IPK dari tabel syarat_pendadaran
     */
    public function get_ipk_by_skripsi($id_skripsi)
    {
        $this->db->select('ipk');
        $this->db->from('syarat_pendadaran');
        $this->db->where('id_skripsi', $id_skripsi);
        $query = $this->db->get();
        return $query->row() ? $query->row()->ipk : null;
    }

    /**
     * Update status ujian
     */
    public function update_status($id_ujian, $status)
    {
        $this->db->where('id', $id_ujian);
        return $this->db->update('ujian_skripsi', ['status' => $status]);
    }
}
