<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toko extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') != 4) {
            $this->session->set_flashdata('pesan_auth', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Login terlebih dahulu
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');

            redirect('Auth');
        }
    }

    public function BelumVerifikasi()
    {
        $data['judul'] = 'Toko';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('toko/BelumVerifikasi');
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }
}
