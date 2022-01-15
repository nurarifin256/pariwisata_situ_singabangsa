<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wahana extends CI_Controller
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

    public function index()
    {
        $data['judul'] = 'Wahana';
        $data['tiket'] = $this->Model_tiket->getAll()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('wahana/index', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('wahana/dataTable');
    }

    public function tambahWahana()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
            'required' => 'Keterangan harus diisi'
        ]);

        $this->form_validation->set_rules('harga', 'Harga', 'required|trim', [
            'required' => 'Harga harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Tambah Wahana';

            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('wahana/tambahWahana');
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
                $config['upload_path'] = './assets/img';
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
                'harga' => htmlspecialchars($this->input->post('harga', true)),
                'foto' => $gambar,
                'status' => 'nonaktif'
            ];

            $this->Model_tiket->simpanTiket($data);
            $datas = ['wahana'   => 'Di tambahkan'];

            $this->session->set_userdata($datas);
            redirect('Wahana/index');
        }
    }

    public function aktifkanWahana($id_tiket)
    {
        $this->Model_tiket->aktifkanWahana($id_tiket);
        $datas = ['wahana'   => 'Di aktifkan'];

        $this->session->set_userdata($datas);
        redirect('Wahana/index');
    }

    public function nonAktifkanWahana($id_tiket)
    {
        $this->Model_tiket->nonAktifkanWahana($id_tiket);
        $datas = ['wahana'   => 'Di nonaktifkan'];

        $this->session->set_userdata($datas);
        redirect('Wahana/index');
    }

    public function hapusWahana()
    {
        $id_tiket = $this->input->post('id_tiket');

        $this->Model_tiket->hapusWahana($id_tiket);
        $pesan["pesan"] = ($this->db->trans_status()) ? "ok" : "gagal";
        echo json_encode($pesan);
    }

    public function editWahana($id_tiket)
    {
        $data['judul'] = 'Edit Wahana';
        $data['tiket'] = $this->Model_tiket->getWahanaById($id_tiket)->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
            'required' => 'Keterangan harus diisi'
        ]);

        $this->form_validation->set_rules('harga', 'Harga', 'required|trim', [
            'required' => 'Harga harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('wahana/editWahana', $data);
            $this->load->view('templates/foot');
            $this->load->view('templates/footer');
            $this->load->view('pesanan/imgPreview');
        } else {
            $gambar_baru = $_FILES['gambar']['name'];
            // var_dump($gambar_baru);
            // die;

            if ($gambar_baru = '') {
            } else {
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img';
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
                $gambar = $data['tiket']['foto'];
            }

            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
                'harga' => htmlspecialchars($this->input->post('harga', true)),
                'foto' => $gambar,
            ];

            $this->Model_tiket->updateTiket($id_tiket, $data);
            $datas = ['wahana'   => 'Di update'];

            $this->session->set_userdata($datas);
            redirect('Wahana/index');
        }
    }
}
