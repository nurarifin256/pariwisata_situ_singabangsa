<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') == 2) {
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
        $data['judul'] = 'Daftar Pengunjung';
        $data['konfirmasiT'] = $this->Model_konfirmasi->getAllTiketP()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('petugas/konfirmasiTiket', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('admin/dataTable');
    }

    public function detailPesananTiket($id_pesanan_tiket)
    {
        $data['judul'] = 'Detail Tiket Pengunjung';
        $data['tiket'] = $this->Model_pesanan->DetailPesananTiket($id_pesanan_tiket)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('petugas/detailKonfirmasiTiket', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('admin/dataTable');
    }

    public function gunakanTiket($id_detail_pesanan_tiket)
    {
        $nama = $this->session->userdata('nama');
        $this->Model_konfirmasi->updateStatusTiket($id_detail_pesanan_tiket, $nama);

        $datas = ['update_tiket'   => 'Di gunakan'];
        $this->session->set_userdata($datas);

        redirect('Petugas');
    }

    public function gunakanTikett($id_detail_pesanan_tiket)
    {
        $nama = $this->session->userdata('nama');
        $this->Model_konfirmasi->updateStatusTiket($id_detail_pesanan_tiket, $nama);

        $datas = ['approve'   => 'Di gunakan'];
        $this->session->set_userdata($datas);
        redirect('Admin/konfirmasiTiket');
    }

    public function batalGunakanTiket($id_detail_pesanan_tiket)
    {
        $this->Model_konfirmasi->updateStatusBatalTiket($id_detail_pesanan_tiket);

        $datas = ['approve'   => 'Batal di gunakan'];
        $this->session->set_userdata($datas);
        redirect('Admin/konfirmasiTiket');
    }
}
