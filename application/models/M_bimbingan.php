<?php
class M_bimbingan extends CI_Model {

    public function get_upcoming_bimbingan($id_mahasiswa)
    {
        $today = date('Y-m-d');
        $bimbingan = $this->db->select('tanggal, topik')
                              ->from('bimbingan')
                              ->where('id_mahasiswa', $id_mahasiswa)
                              ->where('tanggal >=', $today)
                              ->order_by('tanggal', 'ASC')
                              ->limit(3)
                              ->get()
                              ->result_array();
        
        if (empty($bimbingan)) return [];
        
        $hasil = [];
        foreach ($bimbingan as $b) {
            $hasil[] = date('d M Y', strtotime($b['tanggal'])) . ' - ' . $b['topik'];
        }
        return $hasil;
    }
}
