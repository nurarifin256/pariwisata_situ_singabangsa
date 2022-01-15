<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesan extends CI_Controller
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
        $data['judul'] = 'Pesan Customer';
        $data['pesan'] = $this->Model_pesan->getAllPesan()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('pesan/index', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('pesan/dataTable');
    }

    public function hapusPesan()
    {
        $id_pesan = $this->input->post('id_pesan');

        $this->Model_pesan->hapusPesan($id_pesan);
        $pesan["pesan"] = ($this->db->trans_status()) ? "ok" : "gagal";
        echo json_encode($pesan);
    }
}