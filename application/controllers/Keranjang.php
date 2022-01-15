<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') != 2) {
            $this->session->set_flashdata('pesan_auth', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Login terlebih dahulu
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');

            redirect('Auth');
        }
    }

    public function beliTiket($id_tiket)
    {
        $data['judul'] = 'Pesan Tiket';
        $data['tiket'] = $this->Model_tiket->getWahanaById($id_tiket)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('keranjang/beliTiket', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('keranjang/keranjangJs');
    }

    public function bayarTiket()
    {
        $data = [
            'id_user'   => $this->session->userdata('id_user'),
            'id_tiket'  => $this->input->post('id_tiket'),
            'tanggal'   => $this->input->post('tanggal'),
            'jam'   => $this->input->post('jam'),
            'jumlah'    => $this->input->post('jumlah'),
            'total_bayar'    => $this->input->post('total_bayar')
        ];

        $this->Model_tiket->simpanKeKeranjang($data);
        // $this->session->set_flashdata('wahanaLanding', 'Tiket');
        $datas = ['tiket'   => 'Tiket'];
        $this->session->set_userdata($datas);
        redirect('LandingPage/semuaWahana');
    }

    public function beliCemilan($id_cemilan)
    {
        $data['judul'] = 'Beli Cemilan';
        $data['cemilan'] = $this->Model_cemilan->getCemilanById($id_cemilan)->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('keranjang/beliCemilan', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }

    public function tambahKeKeranjang($id_cemilan)
    {
        $cemilan = $this->Model_cemilan->getCemilanById($id_cemilan)->row_array();
        // var_dump($cemilan['id_cemilan']);
        // die;

        $data = [
            'id_cemilan'    => $cemilan['id_cemilan'],
            'id_user'       => $this->session->userdata('id_user'),
            'jumlah'        => 1,
            'tanggal'       => date("Y-m-d"),
            'total_bayar'   => $cemilan['harga'] * 1,
            'status'        => 1
        ];

        $this->Model_cemilan->simpanKeKeranjang($data);
        $datas = ['cemilanLanding'   => 'Cemilan'];
        $this->session->set_userdata($datas);
        redirect('LandingPage/cemilan');
    }

    public function hapusKeranjangTiket()
    {
        $id_user = $this->session->userdata('id_user');
        $id_keranjang_tiket = $this->input->post('id_keranjang_tiket');
        $id_tiket = $this->input->post('id_tiket');

        $this->Model_tiket->hapusKeranjang($id_user, $id_keranjang_tiket, $id_tiket);
        $pesan["pesan"] = ($this->db->trans_status()) ? "ok" : "gagal";
        echo json_encode($pesan);
    }

    public function updateJumlahTiket()
    {
        $id_user = $this->session->userdata('id_user');

        $id_keranjang_tiket = $this->input->post('id_keranjang_tiket_urut');
        $id_tiket = $this->input->post('id_tiket_urut');
        $jumlah = $this->input->post('jumlah_det_urut');
        $harga = $this->input->post('harga_det_urut');

        $harga_set = str_replace(",", "", $harga);
        $total_bayar = $jumlah * $harga_set;

        $this->Model_tiket->updateJumlahTiket($id_user, $id_keranjang_tiket, $id_tiket, $jumlah, $total_bayar);
    }

    public function updateJumlahCem()
    {
        $id_user = $this->session->userdata('id_user');

        $jumlah = $this->input->post('jumlah_cem');
        $harga = $this->input->post('harga_cem');
        $id_keranjang_cemilan = $this->input->post('id_keranjang_cem');
        $id_cemilan = $this->input->post('id_cemilan');

        $harga_set = str_replace(",", "", $harga);
        $total_bayar = $jumlah * $harga_set;

        $this->Model_cemilan->updateJumlahCemilan($id_user, $id_keranjang_cemilan, $id_cemilan, $jumlah, $total_bayar);
    }

    public function updateTanggal()
    {
        $id_user = $this->session->userdata('id_user');

        $id_keranjang_tiket = $this->input->post('id_keranjang_tiket_urut');
        $id_tiket = $this->input->post('id_tiket_urut');
        $tanggal = $this->input->post('tanggal_d');

        $this->Model_tiket->updateTanggal($id_user, $id_keranjang_tiket, $id_tiket, $tanggal);
    }

    public function updateJam()
    {
        $id_user = $this->session->userdata('id_user');

        $id_keranjang_tiket = $this->input->post('id_keranjang_tiket');
        $id_tiket = $this->input->post('id_tiket');
        $jam = $this->input->post('jam');

        $this->Model_tiket->updateJam($id_user, $id_keranjang_tiket, $id_tiket, $jam);
    }

    public function hapusKeranjangCemilan()
    {
        $id_user = $this->session->userdata('id_user');
        $id_keranjang_cemilan = $this->input->post('id_keranjang_cemilan');
        $id_cemilan = $this->input->post('id_cemilan');

        $this->Model_cemilan->hapusKeranjang($id_user, $id_keranjang_cemilan, $id_cemilan);
        $pesan["pesan"] = ($this->db->trans_status()) ? "ok" : "gagal";
        echo json_encode($pesan);
    }

    public function hapusPesananCemilanByidToko()
    {
        $id_toko = $this->input->post('id_toko');
        $id_user = $this->session->userdata('id_user');

        $this->Model_cemilan->hapusPesananCemilanByIdToko($id_user, $id_toko);
        $pesan["pesan"] = ($this->db->trans_status()) ? "ok" : "gagal";
        echo json_encode($pesan);
    }

    public function detailKeranjang()
    {
        $id_user = $this->session->userdata('id_user');

        $data['judul']      = 'Detail Keranjang';
        $data['tiket']      = $this->Model_tiket->getTiketByIdUser($id_user);
        $data['cemilan']    = $this->Model_cemilan->getCemilanByIdUser($id_user);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('keranjang/detailKeranjang2', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('keranjang/detailKeranjangJs');
    }

    public function totalAll()
    {
        $jumlah = $this->input->post('jumlah_det_urut');
        $harga = $this->input->post('harga_det_urut');

        $jumlah_set = str_replace(",", "", $jumlah);
        $harga_set = str_replace(",", "", $harga);

        $jumlah_fix = ($jumlah_set > 0) ? ($jumlah_set) : 0;
        $harga_fix = ($harga_set > 0) ? ($harga_set) : 0;

        $total_bayar = number_format($jumlah_fix * $harga_fix);

        $data["total_bayar"] = $total_bayar;
        echo json_encode($data);
    }

    public function jumlahAll()
    {
        $jumlah = $this->input->post('jumlah_cem');
        $harga = $this->input->post('harga_cem');

        $jumlah_set = str_replace(",", "", $jumlah);
        $harga_set = str_replace(",", "", $harga);

        $jumlah_fix = ($jumlah_set > 0) ? ($jumlah_set) : 0;
        $harga_fix = ($harga_set > 0) ? ($harga_set) : 0;

        $total_bayar = number_format($jumlah_fix * $harga_fix);

        $data["total_bayarr"] = $total_bayar;
        echo json_encode($data);
    }

    public function jumlahTotalAll()
    {
        $total = $this->input->post("total_bayarr");

        $totall = str_replace(",", "", $total);

        $jumlah_total = 0;
        $jumlah_total = ($jumlah_total > 0) ? ($jumlah_total) : 0;

        foreach ($totall as $key => $value) {
            $total_set = str_replace(",", "", $totall[$key]);
            $jumlah_total += $total_set;
        }

        $data["jumlah_totall"] = $jumlah_total;
        echo json_encode($data);
    }

    public function getTotalAll()
    {
        $total = $this->input->post("total_bayar");

        $total_all = 0;
        $total_all = ($total_all > 0) ? ($total_all) : 0;

        foreach ($total as $key => $value) {
            $total_set = str_replace(",", "", $total[$key]);
            $total_all += $total_set;
        }

        $data["total_all"] = number_format($total_all);
        echo json_encode($data);
    }

    public function jumlahBerat()
    {
        $jumlah = $this->input->post('jumlah_cem');
        $berat = $this->input->post('berat_cem');

        $jumlah_fix = ($jumlah > 0) ? ($jumlah) : 0;
        $berat_fix = ($berat > 0) ? ($berat) : 0;

        $total_berat = ($jumlah_fix * $berat_fix);

        $data["sub_berat"] = $total_berat;
        echo json_encode($data);
    }

    public function jumlahBeratAll()
    {
        $total = $this->input->post("sub_berat");

        $total_all = 0;
        $total_all = ($total_all > 0) ? ($total_all) : 0;

        foreach ($total as $key => $value) {
            $total_set = str_replace(",", "", $total[$key]);
            $total_all += $total_set;
        }

        $data["sub_berat"] = ($total_all);
        echo json_encode($data);
    }

    public function detailKeranjangCemilan($id_toko)
    {
        $id_user = $this->session->userdata('id_user');

        $data['judul']      = 'Detail Keranjang Cemilan';
        $data['cemilan']    = $this->Model_cemilan->getCemilanByIdUser_IdToko($id_user, $id_toko)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('keranjang/detailKeranjangCemilan', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('keranjang/detailKeranjangJs');
    }
}
