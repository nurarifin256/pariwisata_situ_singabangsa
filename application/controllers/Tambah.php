<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tambah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') != 1) {
            $this->session->set_flashdata('pesan_auth', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Login terlebih dahulu
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');

            redirect('Auth');
        }
    }

    public function acara()
    {
        $data['judul'] = 'Acara';
        $data['acara'] = $this->Model_acara->getAllAcara()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('tambah/acara', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('tambah/sweetalert');
    }

    public function tambahAcara()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
            'required' => 'Keterangan harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Acara';

            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('tambah/tambahAcara');
            $this->load->view('templates/foot');
            $this->load->view('templates/footer');
            $this->load->view('pesanan/imgPreview');
        } else {

            $gambar = $_FILES['gambar']['name'];
            // var_dump($gambar);
            // die;

            if ($gambar = '') {
            } else {
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/acara';
                $config['allowed_types'] = 'jpg|jpeg|png';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gambar')) {
                    echo "Foto Gagal diupload";
                } else {
                    $gambar = $this->upload->data('file_name');
                }
            }

            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
                'gambar' => $gambar
            ];

            $this->Model_acara->simpanAcara($data);
            $datas = ['acara'   => 'Di tambahkan'];

            $this->session->set_userdata($datas);
            redirect('Tambah/acara');
        }
    }

    public function hapusAcara()
    {
        $id_acara = $this->input->post('id_acara');

        $this->Model_acara->hapusAcara($id_acara);
        $pesan["pesan"] = ($this->db->trans_status()) ? "ok" : "gagal";
        echo json_encode($pesan);

        // redirect('Tambah/acara');
    }

    public function aktifkanAcara($id_acara)
    {
        $this->Model_acara->aktifkanAcara($id_acara);
        $datas = ['acara'   => 'Di aktifkan'];

        $this->session->set_userdata($datas);
        redirect('Tambah/acara');
    }

    public function nonAktifkanAcara($id_acara)
    {
        $this->Model_acara->nonAktifkanAcara($id_acara);
        $datas = ['acara'   => 'Di nonaktifkan'];

        $this->session->set_userdata($datas);
        redirect('Tambah/acara');
    }

    public function editAcara($id_acara)
    {
        $data['judul'] = 'Edit Acara';
        $data['acara'] = $this->Model_acara->getAcaraById($id_acara)->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
            'required' => 'Keterangan harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('tambah/edit', $data);
            $this->load->view('templates/foot');
            $this->load->view('templates/footer');
            $this->load->view('pesanan/imgPreview');
        } else {
            $gambar_baru = $_FILES['gambar']['name'];
            // var_dump($gambar_baru);
            // die;

            if ($gambar_baru) {
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/acara';
                $config['allowed_types'] = 'jpg|jpeg|png';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gambar')) {
                    echo "Foto Gagal diupload";
                } else {
                    $gambar_baru = $this->upload->data('file_name');
                }
            }
            if ($gambar_baru != null) {
                $gambar = $gambar_baru;
            } else {
                $gambar = $data['acara']['gambar'];
            }

            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
                'gambar' => $gambar
            ];

            $this->Model_acara->updateAcara($id_acara, $data);
            $datas = ['acara'   => 'Di update'];

            $this->session->set_userdata($datas);
            redirect('Tambah/acara');
        }
    }
}
