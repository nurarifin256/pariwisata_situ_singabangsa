<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
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

        date_default_timezone_set('Asia/Jakarta');
    }

    public function pCemilan($id_toko)
    {
        $datas['jenis'] = 'Cemilan';
        $datas['judul'] = 'Pembayaran Cemilan';
        $datas['toko'] = $this->Model_toko->getTokoByIdToko($id_toko)->row_array();

        $this->load->view('templates/header', $datas);
        $this->load->view('templates/navbar');
        $this->load->view('keranjang/terimakasihCemilan', $datas);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }

    public function pTiket()
    {
        $datas['jenis'] = 'Tiket';
        $datas['judul'] = 'Pembayaran Tiket';
        $this->load->view('templates/header', $datas);
        $this->load->view('templates/navbar');
        $this->load->view('keranjang/terimakasih', $datas);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }

    public function tiket()
    {
        $id_user = $this->session->userdata('id_user');

        $total_all = $this->input->post('total_all');
        $total_all_set =  str_replace(",", "", $total_all);

        $data = [
            'id_user'       => $id_user,
            'jumlah_bayar'  => $total_all_set,
            'status'        => 'Belum konfirmasi pembayaran',
            'tanggal_approve' => null
        ];
        $this->Model_pesanan->simpanPesananTiket($data);

        $id_pesanan_tiket   = $this->db->insert_id();
        $id_barang          = $this->Model_tiket->getTiketByIdUser($id_user)->result_array();


        foreach ($id_barang as $id) {
            $data = [
                'id_pesanan_tiket'  => $id_pesanan_tiket,
                'id_tiket'          => $id['id_tiket'],
                'tanggal_kedatangan' => $id['tanggal'],
                'jam'               => $id['jam'],
                'jumlah'            => $id['jumlah'],
                'status'            => 'Belum digunakan',
                'validator'            => '-'
            ];
            $this->Model_pesanan->simpanDetailPesananTiket($data);
            $this->Model_tiket->hapusAllKeranjangTiket($id_user);
        }
        // return true;

        redirect('Pembayaran/pTiket');
    }

    public function cemilan()
    {
        $id_user            = $this->session->userdata('id_user');

        $nama       = $this->session->userdata('nama');
        $no_hp      = $this->input->post('no_hp');
        $alamat     = $this->input->post('alamat');
        $kota       = $this->input->post('kota');
        $provinsi   = $this->input->post('provinsi');

        $ekspedisi  = $this->input->post('ekspedisi');
        $jenis      = $this->input->post('jenis');
        $ongkir      = $this->input->post('ongkir');

        $total_berat = $this->input->post('jumlah_beratt');
        $total_bayar = $this->input->post('jumlah_totall');
        $grand_total = $this->input->post('tot_bayar');

        if ($ongkir > 0) {
            $data = [
                'id_user'       => $id_user,
                'status'        => 'Belum konfirmasi pembayaran',
                'penerima'        => $nama . ' ' . $no_hp . ' ' . $alamat . ', ' . $kota . ' - ' . $provinsi,
                'pengirim' => $ekspedisi . ' - ' . $jenis,
                'total_berat' => $total_berat,
                'ongkir' => $ongkir,
                'total_bayar' => $total_bayar,
                'grand_total' => $grand_total,
                'no_resi' => '-',
                'tanggal_approve' => null,
                'tanggal_pesan' => time()
            ];

            $this->Model_pesanan->simpanPesananCemilan($data);

            $id_pesanan_cemilan   = $this->db->insert_id();
            $id_toko = $this->input->post('id_toko');
            $id_cemilan = $this->Model_cemilan->getCemilanDiDetailKerangjangCemilan($id_user, $id_toko)->result_array();

            foreach ($id_cemilan as $ic) {
                $id_cemilan_keranjang = $ic['id_cemilan'];
                $id_keranjang_cemilan = $ic['id_keranjang_cemilan'];
                $data = [
                    'id_pesanan_cemilan'  => $id_pesanan_cemilan,
                    'id_cemilan'          => $id_cemilan_keranjang,
                    'jumlah'              => $ic['jumlah'],
                ];
                $this->Model_pesanan->simpanDetailPesanancemilan($data);
                $this->Model_cemilan->updateStatusKeranjangCemilan($id_keranjang_cemilan, $id_cemilan_keranjang, $id_user);
            }
            // return true;
            redirect('Pembayaran/pCemilan/' . $id_toko);
        } else {
            echo "<script>
                    alert('jenis pengiriman belum di pilih');
                    location.replace('http://localhost/situ/Keranjang/detailKeranjang');
                  </script>";
        }
    }
}
