<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_hasil extends CI_Model {

    /**
     * Ambil nilai komponen per mahasiswa (Sempro & Sidang)
     */
    public function get_detail_nilai($id_mahasiswa)
    {
        $this->db->select('
            j.nama AS jenis_ujian,
            k.keterangan AS komponen_nilai,
            k.jenis_nilai,
            k.bobot,
            n.id_penguji,
            n.nilai,
            u.id AS id_ujian_skripsi
        ');
        $this->db->from('tbl_nilai_ujian_skripsi n');
        $this->db->join('mstr_komponen_nilai_ujian_skripsi k', 'k.id = n.id_komponen_nilai', 'left');
        $this->db->join('ujian_skripsi u', 'u.id = n.id_ujian_skripsi', 'left');
        $this->db->join('skripsi s', 's.id = u.id_skripsi', 'left');
        $this->db->join('jenis_ujian_skripsi j', 'j.id = u.id_jenis_ujian_skripsi', 'left');
        $this->db->where('s.id_mahasiswa', $id_mahasiswa);
        $this->db->order_by('u.id', 'DESC');
        $this->db->order_by('k.urutan', 'ASC');
        return $this->db->get()->result();
    }

    /**
     * Hitung rekap nilai akhir per komponen
     */
    public function get_rekap_nilai($id_mahasiswa)
    {
        $nilai = $this->get_detail_nilai($id_mahasiswa);
        if (empty($nilai)) {
            return []; // kalau belum ada nilai, biar gak error
        }

        $rekap = [];

        foreach ($nilai as $n) {
            $key = $n->komponen_nilai;

            if (!isset($rekap[$key])) {
                $rekap[$key] = [
                    'jenis_ujian' => $n->jenis_ujian,
                    'komponen' => $n->komponen_nilai,
                    'jenis_nilai' => $n->jenis_nilai,
                    'bobot' => $n->bobot,
                    'nilai' => []
                ];
            }

            $rekap[$key]['nilai'][] = $n->nilai;
        }

        // Hitung rata-rata dan nilai akhir per komponen
        foreach ($rekap as &$r) {
            $r['rata_rata'] = round(array_sum($r['nilai']) / count($r['nilai']), 2);
            $r['nilai_akhir'] = round($r['rata_rata'] * $r['bobot'], 2);
        }

        return $rekap;
    }
}
