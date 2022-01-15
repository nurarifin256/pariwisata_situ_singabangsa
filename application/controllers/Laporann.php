<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporann extends CI_Controller
{

    public function index()
    {
        $this->load->library('Mypdf');
        $tgl1 = $this->input->post("tgl1");
        $tgl2 = $this->input->post("tgl2");
        $id_user = $this->input->post("id_user");
        $data = [
            'tgl1' => $tgl1,
            'tgl2' => $tgl2
        ];
        $data['data'] = $this->Model_laporan->getLaporanCemilan($tgl1, $tgl2, $id_user)->result_array();

        $this->mypdf->generate('Laporann/dompdf', $data, 'laporan', 'A4', 'landscape');
    }

    public function tiket()
    {
        $this->load->library('Mypdf');
        $tgl1 = $this->input->post("tgl1");
        $tgl2 = $this->input->post("tgl2");
        $data = [
            'tgl1' => $tgl1,
            'tgl2' => $tgl2
        ];
        $data['data'] = $this->Model_laporan->getLaporan($tgl1, $tgl2)->result_array();

        $this->mypdf->generate('Laporann/tiket', $data, 'laporan', 'A4', 'landscape');
    }
}
