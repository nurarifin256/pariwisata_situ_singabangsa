<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
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

    public function tiket()
    {
        $data['judul'] = 'Laporan Tiket';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('laporan/tiket');
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }

    public function laporanTiket()
    {
        $tgl1 = $this->input->get('tanggal1');
        $tgl2 = $this->input->get('tanggal2');

        $data['judul'] = 'Laporan Tiket';
        $data['laporan'] = $this->Model_laporan->getLaporan($tgl1, $tgl2)->result_array();
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('laporan/laporanTiket', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('laporan/dataTable');
    }

    public function detailLaporanTiket($id_tiket)
    {
        $data['judul'] = 'Detail Laporan Tiket';
        $data['laporan'] = $this->Model_laporan->getLaporanById($id_tiket)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('laporan/DetailLaporanTiket');
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('laporan/dataTable');
    }
}
