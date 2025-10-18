<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_skripsi extends CI_Model {

    // Ambil semua data skripsi + nama mahasiswa dan dosen pembimbing
    public function get_all_skripsi()
    {
        $this->db->select('
            skripsi.*,
            mhs.nama AS nama_mahasiswa,
            d1.nama AS pembimbing1_nama,
            d2.nama AS pembimbing2_nama
        ');
        $this->db->from('skripsi');
        $this->db->join('mstr_akun AS mhs', 'mhs.id = skripsi.id_mahasiswa');
        $this->db->join('mstr_akun AS d1', 'd1.id = skripsi.pembimbing1', 'left');
        $this->db->join('mstr_akun AS d2', 'd2.id = skripsi.pembimbing2', 'left');
        return $this->db->get()->result();
    }

    // Ambil skripsi terakhir berdasarkan mahasiswa tertentu
    public function get_latest_by_mahasiswa($id_mahasiswa)
    {
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        return $this->db->get('skripsi')->row();
    }

    // Hitung jumlah skripsi pada setiap tahap untuk grafik progress
    public function get_progress_data()
    {
        $stages = ['proposal', 'seminar', 'sidang'];
        $progress_data = [];

        foreach ($stages as $stage) {
            $this->db->where('tahap', $stage); // kolom 'tahap' berisi tahapan skripsi
            $count = $this->db->count_all_results('skripsi');
            $progress_data[] = [
                'tahap' => ucfirst($stage),
                'jumlah' => $count
            ];
        }

        return $progress_data;
    }

    public function get_progress_by_mahasiswa($id_mahasiswa)
{
    $skripsi = $this->get_latest_by_mahasiswa($id_mahasiswa);

    if (!$skripsi) {
        return ['proposal' => 0, 'seminar' => 0, 'sidang' => 0];
    }

    // Misal kolom 'tahap' berisi: proposal, seminar, sidang
    $tahap = strtolower($skripsi->tahap ?? 'proposal');

    $progress = ['proposal' => 0, 'seminar' => 0, 'sidang' => 0];

    if ($tahap === 'proposal') {
        $progress['proposal'] = 100;
    } elseif ($tahap === 'seminar') {
        $progress['proposal'] = 100;
        $progress['seminar'] = 100;
    } elseif ($tahap === 'sidang') {
        $progress['proposal'] = 100;
        $progress['seminar'] = 100;
        $progress['sidang'] = 100;
    }

    return $progress;
}

}
