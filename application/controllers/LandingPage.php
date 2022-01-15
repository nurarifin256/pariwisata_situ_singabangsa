<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LandingPage extends CI_Controller
{

    public function index()
    {
        $data['judul'] = 'Beranda';
        $data['tiket'] = $this->Model_tiket->getWahanaByStatus()->result_array();
        $data['acara'] = $this->Model_acara->getAcara()->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('landingPage/index', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('landingPage/animasiIndex');
    }

    public function semuaWahana()
    {
        $data['judul'] = 'Wahana';
        $data['tiket'] = $this->Model_tiket->getAll()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('landingPage/semuaWahana', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('keranjang/sweetalert');
    }

    public function detailWahana($id_tiket)
    {
        $data['judul'] = 'Detail Wahana';
        $data['detail_wahana'] = $this->Model_tiket->getWahanaById($id_tiket)->row_array();
        // var_dump($data);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('landingPage/detailWahana', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }

    public function cemilan()
    {
        $data['judul'] = 'Cemilan';
        $data['cemilan'] = $this->Model_cemilan->getAllCemilan()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('landingPage/cemilan', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('keranjang/sw2');
    }

    public function detailCemilan($id_cemilan)
    {
        $data['judul'] = 'Detail Cemilan';
        $data['cemilan'] = $this->Model_cemilan->getCemilanById($id_cemilan)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('landingPage/detailCemilan', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }

    public function kirimPesan()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi'
        ]);

        $this->form_validation->set_rules('no_tlp', 'No. Tlp', 'required|trim|min_length[12]', [
            'required' => 'Nomor wa harus diisi',
            'min_length' => 'Nomor wa minimal 12 digit'
        ]);

        $this->form_validation->set_rules('pesan', 'Pesan', 'required|trim', [
            'required' => 'Pesan harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Beranda';
            $data['tiket'] = $this->Model_tiket->getWahanaByStatus()->result_array();
            $data['acara'] = $this->Model_acara->getAcara()->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('landingPage/index', $data);
            $this->load->view('templates/foot');
            $this->load->view('templates/footer');
            $this->load->view('landingPage/animasiIndex');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'no_tlp' => htmlspecialchars($this->input->post('no_tlp', true)),
                'pesan' => htmlspecialchars($this->input->post('pesan', true)),
                'tanggal' => date('Y-m-d')
            ];

            $this->Model_pesan->tambahPesan($data);

            $data = ['pesan'   => 'Di Kirim'];

            $this->session->set_userdata($data);
            redirect('LandingPage/index');
        }
    }
}
