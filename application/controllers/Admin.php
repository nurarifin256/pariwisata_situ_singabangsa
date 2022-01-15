<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        $data['user_pegawai'] = $this->Model_auth->getUserPegawai()->result_array();
        $data['judul'] = 'Beranda';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('admin/index', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('admin/dataTable');
    }

    public function konfirmasiTiket()
    {
        $data['judul'] = 'Konfirmasi Tiket';
        $data['konfirmasiT'] = $this->Model_konfirmasi->getAllTiket()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('admin/konfirmasiTiket', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('admin/dataTable');
    }

    public function detailPesananTiket($id_pesanan_tiket)
    {
        $data['judul'] = 'detail Pesanan Tiket';
        $data['tiket'] = $this->Model_pesanan->DetailPesananTiket($id_pesanan_tiket)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('admin/detailKonfirmasiTiket', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('admin/dataTable');
    }

    public function approveTiket($id_pesanan_tiket)
    {
        $this->Model_konfirmasi->updateStatusPesanan($id_pesanan_tiket);

        $data = ['approve'   => 'Di approve'];

        $this->session->set_userdata($data);
        redirect('Admin/konfirmasiTiket');
    }

    public function batalApproveTiket($id_pesanan_tiket)
    {
        $this->Model_konfirmasi->batalApproveTiket($id_pesanan_tiket);


        $data = ['approve'   => 'Di unapprove'];

        $this->session->set_userdata($data);
        redirect('Admin/konfirmasiTiket');
    }

    public function konfirmasiToko()
    {
        $data['judul'] = 'Konfirmasi Toko';
        $data['konfirmasiTo'] = $this->Model_konfirmasi->getToko()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('admin/konfirmasiToko', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('admin/dataTable2');
    }

    public function approveToko($id_user)
    {
        $this->Model_konfirmasi->updateStatusToko($id_user);

        $data = ['approve'   => 'Di approve'];

        $this->session->set_userdata($data);
        redirect('Admin/konfirmasiToko');
    }

    public function batalApproveToko($id_user)
    {
        $this->Model_konfirmasi->updateStatusToko2($id_user);

        $data = ['approve'   => 'Di unapprove'];

        $this->session->set_userdata($data);
        redirect('Admin/konfirmasiToko');
    }

    public function konfirmasiCemilanToko()
    {
        $data['judul'] = 'Konfirmasi Cemilan';
        $data['konfirmasiC'] = $this->Model_konfirmasi->getAllCemilanToko()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('admin/konfirmasiCemilanToko', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('admin/sweetalert');
    }

    public function approveCemilanToko($id_cemilan, $id_toko)
    {
        $this->Model_konfirmasi->updateStatusCemilanToko($id_cemilan, $id_toko);

        $data = ['approve'   => 'Di approve'];

        $this->session->set_userdata($data);
        redirect('Admin/konfirmasiCemilanToko');
    }

    public function batalApproveCemilanToko($id_cemilan, $id_toko)
    {
        $this->Model_konfirmasi->batalApproveCemilanToko($id_cemilan, $id_toko);

        $data = ['approve'   => 'Di unapprove'];

        $this->session->set_userdata($data);
        redirect('Admin/konfirmasiCemilanToko');
    }
}
