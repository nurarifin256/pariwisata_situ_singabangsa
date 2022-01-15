<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    function halaman($nama = '')
    {
        $nama_replace = str_replace(" ", "_", $nama);
        $data['judul'] = 'Cemilan';
        $data['cemilan'] = $this->Model_cemilan->get_cemilan($nama_replace)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('landingPage/cemilan', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }
}
