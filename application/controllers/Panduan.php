<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panduan extends CI_Controller
{

    public function index()
    {
        $data['judul'] = 'Panduan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('panduan/index');
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }

    public function ubahJadwal()
    {
        $data['judul'] = 'Panduan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('panduan/ubahJadwal');
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }

    public function gunakanTiket()
    {
        $data['judul'] = 'Panduan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('panduan/gunakanTiket');
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }
}
