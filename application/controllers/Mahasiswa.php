<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {

    public function __construct()
{
    parent::__construct();

    // Load semua model yang dibutuhkan
    $this->load->model([
        'M_akun'     => 'm_akun',
        'M_skripsi'  => 'm_skripsi',
        'M_ujian'    => 'm_ujian',
        'M_nilai'    => 'm_nilai',
        'M_validasi' => 'm_validasi', 
        'M_hasil'    => 'm_hasil'     
    ]);

    // Load library umum
    $this->load->library(['form_validation', 'session']);
    $this->load->helper('url');

    // Cek login mahasiswa
    if (!$this->session->userdata('id') || $this->session->userdata('role') !== 'mahasiswa') {
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-danger">Silakan login sebagai mahasiswa terlebih dahulu!</div>'
        );
        redirect('auth/mahasiswa');
    }
}

    /** Dashboard Mahasiswa */
    public function index()
    {
        $id_mahasiswa = $this->session->userdata('id');
        $data['skripsi'] = $this->m_skripsi->get_latest_by_mahasiswa($id_mahasiswa);

        $data['title'] = 'Dashboard Mahasiswa';

        $this->load->view('mahasiswa/dashboard', $data);
    }

    /** Profil Mahasiswa */
    public function profil()
    {
        $id_mahasiswa = $this->session->userdata('id');
        $data['mahasiswa'] = $this->m_akun->get_user_by_id($id_mahasiswa);

        $data['title'] = 'Profil Mahasiswa';
        $data['sidebar'] = $this->load->view('templates/sidebar_mahasiswa', $data, TRUE);
        $data['header']  = $this->load->view('templates/header', $data, TRUE);
        $data['footer']  = $this->load->view('templates/footer', $data, TRUE);

        $this->load->view('mahasiswa/profil', $data);
    }

    /** Ajukan Judul Skripsi */
 public function ajukan_skripsi()
{
    $id_mahasiswa = $this->session->userdata('id');

    $this->form_validation->set_rules('tema','Tema Skripsi','required|trim');
    $this->form_validation->set_rules('judul','Judul Skripsi','required|trim');
    $this->form_validation->set_rules('skema','Skema','required|trim');

    if ($this->form_validation->run() == FALSE) {
        $data['pengajuan_terakhir'] = $this->m_skripsi->get_latest_by_mahasiswa($id_mahasiswa);
        $data['title'] = 'Ajukan Judul Skripsi';
        $this->load_template('mahasiswa/ajukan_skripsi', $data);
    } else {
        // Konfigurasi upload
        $config['upload_path']   = './uploads/naskah/';
        $config['allowed_types'] = 'pdf|doc|docx';
        $config['max_size']      = 5120; // Maks 5MB
        $config['file_name']     = 'skripsi_' . $id_mahasiswa . '_' . time();

        $this->load->library('upload', $config);

        $file_name = null;
        if (!empty($_FILES['naskah']['name'])) {
            if ($this->upload->do_upload('naskah')) {
                $file_name = $this->upload->data('file_name');
            } else {
                $this->session->set_flashdata('message', 
                    '<div class="alert alert-danger">Upload gagal: ' . $this->upload->display_errors('', '') . '</div>'
                );
                redirect('mahasiswa/ajukan_skripsi');
            }
        }

        // Simpan ke database
        $data_insert = [
            'id_mahasiswa' => $id_mahasiswa,
            'tema'         => $this->input->post('tema'),
            'judul'        => $this->input->post('judul'),
            'skema'        => $this->input->post('skema'),
            'tgl_pengajuan_judul' => date('Y-m-d'),
            'status'       => 'Diajukan',
            'naskah'       => $file_name
        ];

        $this->m_skripsi->insert_skripsi($data_insert);

        $this->session->set_flashdata('message','<div class="alert alert-success">Judul skripsi berhasil diajukan!</div>');
        redirect('mahasiswa/ajukan_skripsi');
    }
}


    /** Pendaftaran Ujian (Sempro/Sidang) */
    public function daftar_ujian($tipe='sempro')
    {
        $id_mahasiswa = $this->session->userdata('id');

        $skripsi = $this->m_skripsi->get_latest_by_mahasiswa($id_mahasiswa);
        if (!$skripsi) {
            $this->session->set_flashdata('message','<div class="alert alert-danger">Silahkan ajukan judul skripsi terlebih dahulu!</div>');
            redirect('mahasiswa/ajukan_skripsi');
        }

        $ujian = $this->m_ujian->get_by_skripsi($skripsi->id, $tipe);
        $data['aktif'] = ($ujian && $ujian->persetujuan_pembimbing1=='Disetujui' && $ujian->persetujuan_pembimbing2=='Disetujui');

        $data['syarat'] = $this->m_ujian->get_syarat_by_mahasiswa($id_mahasiswa, $tipe);

        $data['title'] = 'Daftar Ujian '.strtoupper($tipe);
        $data['sidebar'] = $this->load->view('templates/sidebar_mahasiswa', $data, TRUE);
        $data['header']  = $this->load->view('templates/header', $data, TRUE);
        $data['footer']  = $this->load->view('templates/footer', $data, TRUE);

        $this->load->view('mahasiswa/daftar_ujian', $data);
    }

    /** Lihat Hasil Ujian */
    public function hasil_ujian()
    {
        $id_mahasiswa = $this->session->userdata('id');

        $data['nilai'] = $this->m_nilai->get_nilai_by_mahasiswa($id_mahasiswa);

        $data['title'] = 'Hasil Ujian Mahasiswa';
        $data['sidebar'] = $this->load->view('templates/sidebar_mahasiswa', $data, TRUE);
        $data['header']  = $this->load->view('templates/header', $data, TRUE);
        $data['footer']  = $this->load->view('templates/footer', $data, TRUE);

        $this->load->view('mahasiswa/hasil_ujian', $data);
    }

    /** Logout Mahasiswa */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/mahasiswa');
    }

public function pengajuan()
{
    $this->load->library('form_validation');

    $id_mahasiswa = $this->session->userdata('id');

    // Ambil pengajuan skripsi terakhir
    $pengajuan_terakhir = $this->db
        ->where('id_mahasiswa', $id_mahasiswa)
        ->order_by('id', 'DESC')
        ->get('skripsi')
        ->row();

    // Jika ada skripsi terakhir, ambil status ujian (jika sudah didaftarkan)
    if($pengajuan_terakhir){
        $ujian = $this->db
            ->where('id_skripsi', $pengajuan_terakhir->id)
            ->order_by('id', 'DESC')
            ->get('ujian_skripsi')
            ->row();
        $pengajuan_terakhir->status_ujian = $ujian->status ?? '-';
    } else {
        $pengajuan_terakhir = null;
    }

    $data['pengajuan_terakhir'] = $pengajuan_terakhir;

    // Form validation
    $this->form_validation->set_rules('tema', 'Tema', 'required|trim');
    $this->form_validation->set_rules('judul', 'Judul Skripsi', 'required|trim');
    $this->form_validation->set_rules('skema', 'Skema', 'required|trim');

    if ($this->form_validation->run() == FALSE) {
        $data['title'] = 'Ajukan Skripsi';
        $this->load->view('templates/header');
        $this->load->view('mahasiswa/ajukan_skripsi', $data);
        $this->load->view('templates/footer');
    } else {
        $insert = [
            'id_mahasiswa' => $id_mahasiswa,
            'tema' => $this->input->post('tema'),
            'judul' => $this->input->post('judul'),
            'skema' => $this->input->post('skema'),
            'tgl_pengajuan_judul' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('skripsi', $insert);

        $this->session->set_flashdata('message', 'Judul skripsi berhasil diajukan.');
        redirect('mahasiswa/pengajuan');
    }
}
public function pendaftaran_ujian()
{
    $this->load->library('form_validation');
    $id_mahasiswa = $this->session->userdata('id');

    // Ambil skripsi terakhir
    $skripsi = $this->db
        ->where('id_mahasiswa', $id_mahasiswa)
        ->order_by('id', 'DESC')
        ->get('skripsi')
        ->row();

    if(!$skripsi){
        $this->session->set_flashdata('message', 'Anda belum mengajukan skripsi.');
        redirect('mahasiswa/pengajuan');
    }

    // Cek persetujuan pembimbing
    $ujian = $this->db
        ->where('id_skripsi', $skripsi->id)
        ->get('ujian_skripsi')
        ->row();

    $bisa_daftar = false;
    if(!$ujian){
        // Belum ada pendaftaran, cek persetujuan pembimbing di skripsi
        $bisa_daftar = true; // Bisa daftar jika logika persetujuan di skripsi sudah ada
    } elseif($ujian->persetujuan_pembimbing1 && $ujian->persetujuan_pembimbing2){
        $bisa_daftar = true;
    }

    $data['skripsi'] = $skripsi;
    $data['bisa_daftar'] = $bisa_daftar;
    $data['ujian'] = $ujian;
    $data['title'] = 'Pendaftaran Ujian';

    $this->load->view('templates/header');
    $this->load->view('mahasiswa/pendaftaran_ujian', $data);
    $this->load->view('templates/footer');
}

public function submit_ujian()
{
    // Pastikan mahasiswa sudah login
    $id_mahasiswa = $this->session->userdata('id');
    if (!$id_mahasiswa) {
        redirect('auth/mahasiswa');
    }

    $this->load->library('form_validation');
    
    // Validasi IPK
    $this->form_validation->set_rules('ipk', 'IPK', 'required|numeric|greater_than[0]|less_than[4.51]');

    if ($this->form_validation->run() == FALSE) {
        $data['title'] = 'Pendaftaran Ujian';
        $this->load->view('templates/header');
        $this->load->view('mahasiswa/pendaftaran_ujian', $data);
        $this->load->view('templates/footer');
        return;
    }

    // Ambil ID ujian skripsi mahasiswa (asumsi sudah ada)
    $ujian = $this->db->get_where('ujian_skripsi', ['id_skripsi' => $this->input->post('id_skripsi')])->row();
    if (!$ujian) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Ujian skripsi tidak ditemukan.</div>');
        redirect('mahasiswa/pendaftaran_ujian');
    }
    $id_ujian = $ujian->id;

    // Folder upload
    $upload_path = './uploads/syarat_pendadaran/';
    if (!is_dir($upload_path)) mkdir($upload_path, 0755, true);

    // Daftar kolom file di tabel syarat_pendadaran
    $file_fields = [
        'naskah',
        'berita_acara_seminar',
        'daftar_nilai_sementara',
        'krs_terbaru',
        'dokumen_identitas',
        'sertifikat_toefl_niit',
        'sertifikat_office_puskom',
        'sertifikat_btq_ibadah',
        'sertifikat_bahasa',
        'sertifikat_kompetensi_ujian_komprehensif',
        'sertifikat_semaba_ppk_masta',
        'sertifikat_kkn',
        'buku_kendali_bimbingan',
        'bukti_pembayaran_sidang'
    ];

    $uploaded_files = [];
    $this->load->library('upload');

    foreach ($file_fields as $field) {
        if (!empty($_FILES[$field]['name'])) {
            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'pdf|doc|docx|jpg|png';
            $config['file_name']     = time().'_'.$field;
            $config['overwrite']     = true;

            $this->upload->initialize($config);

            if ($this->upload->do_upload($field)) {
                $uploaded_files[$field] = $this->upload->data('file_name');
            } else {
                $uploaded_files[$field] = null; // Bisa ditangani error jika ingin lebih strict
            }
        } else {
            $uploaded_files[$field] = null;
        }
    }

    // Simpan data ke tabel syarat_pendadaran
    $data_insert = [
        'id_ujian_skripsi' => $id_ujian,
        'ipk' => $this->input->post('ipk'),
        'status' => 0, // default belum divalidasi
        'catatan' => null
    ];

    // Gabungkan nama file yang diupload
    $data_insert = array_merge($data_insert, $uploaded_files);

    $this->db->insert('syarat_pendadaran', $data_insert);

    $this->session->set_flashdata('message', '<div class="alert alert-success">Berkas pendaftaran ujian berhasil diunggah.</div>');
    redirect('mahasiswa/pendaftaran_ujian');
}

/** Pendaftaran Seminar Proposal (Sempro) */
public function pendaftaran_sempro()
{
    $id_mahasiswa = $this->session->userdata('id');

    // Ambil skripsi terakhir
    $skripsi = $this->db->where('id_mahasiswa', $id_mahasiswa)
                        ->order_by('id', 'DESC')
                        ->get('skripsi')
                        ->row();

    if (!$skripsi) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning">Anda belum mengajukan skripsi.</div>');
        redirect('mahasiswa/pengajuan');
    }

    // Cek apakah mahasiswa sudah daftar sempro
    $ujian = $this->db->where('id_skripsi', $skripsi->id)
                      ->get('ujian_skripsi')
                      ->row();

    $bisa_daftar = is_null($ujian);

    // Ambil file yang sudah diupload jika ada
    $syarat = [];
    if ($ujian) {
        $syarat = $this->db->where('id_ujian_skripsi', $ujian->id)
                           ->get('syarat_sempro')
                           ->row_array();
    }

    $data = [
        'skripsi' => $skripsi,
        'ujian' => $ujian,
        'bisa_daftar' => $bisa_daftar,
        'syarat' => $syarat,
        'title' => 'Pendaftaran Seminar Proposal',
        'sidebar' => $this->load->view('templates/sidebar_mahasiswa', [], TRUE),
        'header'  => $this->load->view('templates/header', [], TRUE),
        'footer'  => $this->load->view('templates/footer', [], TRUE)
    ];

    $this->load->view('mahasiswa/pendaftaran_sempro', $data);
}

/** Submit Form Sempro */
public function submit_sempro()
{
    $id_mahasiswa = $this->session->userdata('id');
    if (!$id_mahasiswa) redirect('auth/mahasiswa');

    $this->load->library('form_validation');
    $this->form_validation->set_rules('ipk', 'IPK', 'required|numeric|greater_than[0]|less_than[4.51]');

    if ($this->form_validation->run() == FALSE) {
        $this->pendaftaran_sempro(); // Load ulang form
        return;
    }

    $skripsi = $this->db->where('id_mahasiswa', $id_mahasiswa)
                        ->order_by('id', 'DESC')
                        ->get('skripsi')
                        ->row();

    if (!$skripsi) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Skripsi tidak ditemukan.</div>');
        redirect('mahasiswa/pengajuan');
    }

    // Insert ujian sempro jika belum ada
    $id_ujian = $this->m_ujian->insert_ujian_sempro($skripsi->id, $this->input->post('ipk'));

    // Folder upload
    $upload_path = './uploads/syarat_sempro/';
    if (!is_dir($upload_path)) mkdir($upload_path, 0755, true);

    $file_fields = [
        'naskah',
        'fotokopi_daftar_nilai',
        'fotokopi_krs',
        'buku_kendali_bimbingan',
        'lembar_revisi_ba_dan_tanda_terima_laporan_kp',
        'bukti_seminar_teman'
    ];

    $uploaded_files = [];
    $this->load->library('upload');

    foreach ($file_fields as $field) {
        if (!empty($_FILES[$field]['name'])) {
            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'pdf|doc|docx|jpg|png';
            $config['file_name']     = time().'_'.$field;
            $config['overwrite']     = true;

            $this->upload->initialize($config);
            if ($this->upload->do_upload($field)) {
                $uploaded_files[$field] = $this->upload->data('file_name');
            } else {
                $uploaded_files[$field] = null;
            }
        } else {
            $uploaded_files[$field] = null;
        }
    }

    $data_insert = array_merge([
        'id_ujian_skripsi' => $id_ujian,
        'ipk' => $this->input->post('ipk'),
        'status' => 0,
        'catatan' => null
    ], $uploaded_files);

    $this->db->insert('syarat_sempro', $data_insert);

    $this->session->set_flashdata('message', '<div class="alert alert-success">Berkas Seminar Proposal berhasil diunggah.</div>');
    redirect('mahasiswa/pendaftaran_sempro');
}
/** 
 * Validasi Berkas Seminar Proposal (Sempro)
 */

public function validasi_sempro()
{
    $id_mahasiswa = $this->session->userdata('id');

    $this->db->select('v.*, s.id_ujian_skripsi');
    $this->db->from('validasi_syarat_sempro v');
    $this->db->join('syarat_sempro s', 's.id = v.id_syarat_sempro');
    $this->db->join('ujian_skripsi u', 'u.id = s.id_ujian_skripsi');
    $this->db->join('skripsi sk', 'sk.id = u.id_skripsi');
    $this->db->where('sk.id_mahasiswa', $id_mahasiswa);

    $data['validasi'] = $this->db->get()->result();
    $data['title'] = 'Validasi Seminar Proposal';

    $this->load->view('templates/header', $data);
    $this->load->view('mahasiswa/validasi_sempro', $data);
    $this->load->view('templates/footer');
}

/** 
 * Validasi Berkas Pendadaran (Sidang Skripsi)
 */
public function validasi_pendadaran()
{
    $data['title'] = 'Validasi Berkas Pendadaran';

    $this->db->select('
        vsp.id,
        vsp.nama_field_syarat,
        vsp.status,
        vsp.catatan,
        vsp.updated_at,
        sp.id AS id_syarat_pendadaran,
        uj.id AS id_ujian_skripsi,
        s.id AS id_skripsi,
        s.tema,
        akun.nama AS nama_mahasiswa
    ');
    $this->db->from('validasi_syarat_pendadaran AS vsp');
    $this->db->join('syarat_pendadaran AS sp', 'sp.id = vsp.id_syarat_pendadaran', 'left');
    $this->db->join('ujian_skripsi AS uj', 'uj.id = sp.id_ujian_skripsi', 'left');
    $this->db->join('skripsi AS s', 's.id = uj.id_skripsi', 'left');
    $this->db->join('mstr_akun AS akun', 'akun.id = s.id_mahasiswa', 'left');
    $this->db->order_by('vsp.updated_at', 'DESC');

    $data['berkas'] = $this->db->get()->result();

    // Tampilkan halaman validasi
    $this->load->view('templates/header', $data);
    $this->load->view('mahasiswa/validasi_pendadaran', $data);
    $this->load->view('templates/footer');
}



}
