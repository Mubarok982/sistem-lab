<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_skripsi', 'm_skripsi');
        $this->load->library(['form_validation', 'upload']);
        $this->_cek_login();
    }

    private function _cek_login()
    {
        if (!$this->session->userdata('id') || $this->session->userdata('role') !== 'mahasiswa') {
            redirect('auth/mahasiswa');
        }
    }

    public function index()
    {
        $id = $this->session->userdata('id');

        // --- Validasi input ---
        $this->form_validation->set_rules('tema', 'Tema', 'required|trim');
        $this->form_validation->set_rules('judul', 'Judul Skripsi', 'required|trim');
        $this->form_validation->set_rules('skema', 'Skema', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            // --- Tampilkan halaman form ---
            $data['pengajuan_terakhir'] = $this->m_skripsi->get_latest_by_mahasiswa($id);
            $data['title'] = 'Ajukan Skripsi';
            
            // Pastikan pakai template mahasiswa
            $this->load->view('templates/header', $data);
            $this->load->view('mahasiswa/ajukan_skripsi', $data);
            $this->load->view('templates/footer');
        } else {
            // --- Proses upload file ---
            $config = [
                'upload_path'   => './uploads/naskah/',
                'allowed_types' => 'pdf|doc|docx',
                'max_size'      => 5120, // 5 MB
                'file_name'     => 'skripsi_' . $id . '_' . time()
            ];

            $this->upload->initialize($config);

            $file_name = null;
            if (!empty($_FILES['naskah']['name'])) {
                if (!$this->upload->do_upload('naskah')) {
                    // Jika gagal upload, tampilkan pesan error
                    $this->session->set_flashdata('message', 
                        '<div class="alert alert-danger">' . $this->upload->display_errors() . '</div>'
                    );
                    redirect('mahasiswa/pengajuan');
                    return;
                } else {
                    $file_name = $this->upload->data('file_name');
                }
            }

            // --- Data yang akan disimpan ---
            $data_insert = [
                'id_mahasiswa' => $id,
                'tema'         => htmlspecialchars($this->input->post('tema', TRUE)),
                'judul'        => htmlspecialchars($this->input->post('judul', TRUE)),
                'skema'        => htmlspecialchars($this->input->post('skema', TRUE)),
                'tgl_pengajuan_judul' => date('Y-m-d'),
                'status'       => 'Diajukan',
                'naskah'       => $file_name
            ];

            // --- Simpan ke database ---
            $this->m_skripsi->insert_skripsi($data_insert);

            $this->session->set_flashdata('message', 
                '<div class="alert alert-success">Judul skripsi berhasil diajukan!</div>'
            );
            redirect('mahasiswa/pengajuan');
        }
    }
}
