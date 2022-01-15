<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
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

    public function index()
    {
        $id_user = $this->session->userdata('id_user');

        $data['judul'] = 'Pesanan Saya';
        $data['tiket'] = $this->Model_pesanan->getPesananTiket($id_user);
        $data['cemilan'] = $this->Model_pesanan->getPesananCemilan($id_user);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('pesanan/index', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }

    public function detailTiket($id_pesanan_tiket)
    {
        $data['judul'] = 'Detail Pesanan';
        $data['tiket'] = $this->Model_pesanan->DetailPesananTiket($id_pesanan_tiket)->result_array();
        // var_dump($data);
        // die; 

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('pesanan/detailTiket', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('pesanan/pesananJS');
    }

    public function updateTanggal()
    {
        // $id_pesanan_tiket = $this->uri->segment(3);
        $id_detail_pesanan_tiket = $this->input->post('id_detail_pesanan_tiket_urut');
        $id_tiket = $this->input->post('id_tiket_urut');
        $tanggal = $this->input->post('tanggal_ked');

        $this->Model_pesanan->updateTanggal($id_detail_pesanan_tiket, $id_tiket, $tanggal);
    }

    public function updateJam()
    {
        $id_detail_pesanan_tiket = $this->input->post('id_detail_pesanan_tiket');
        $id_tiket = $this->input->post('id_tiket');
        $jam = $this->input->post('jam');

        $this->Model_pesanan->updateJam($id_detail_pesanan_tiket, $id_tiket, $jam);
    }

    public function detailCemilan($id_pesanan_cemilan)
    {
        $data['judul'] = 'Detail Pesanan';
        $data['cemilan'] = $this->Model_pesanan->DetailPesananCemilan($id_pesanan_cemilan)->result_array();
        // var_dump($data);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('pesanan/detailCemilan', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }

    public function konfirmasiTiket($id_pesanan_tiket)
    {


        $this->form_validation->set_rules('nama_rekening', 'Nama', 'required|trim', [
            'required' => 'Nama rekening harus diisi'
        ]);

        $this->form_validation->set_rules('no_rekening', 'No Rekening', 'required|trim', [
            'required' => 'No rekening harus diisi'
        ]);

        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim', [
            'required' => 'Nama bank belum dipilih'
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Konfirmasi Pesanan Tiket';
            $id_pesanan_tikett['id'] = $id_pesanan_tiket;
            // var_dump($id_pesanan_tiket);
            // die;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('pesanan/konfirmasiTiket', $id_pesanan_tikett);
            $this->load->view('templates/foot');
            $this->load->view('templates/footer');
            $this->load->view('pesanan/imgPreview');
        } else {

            $id_pesanan_tiket = htmlspecialchars($this->input->post('id_pesanan_tiket', true));
            $gambar = $_FILES['gambar']['name'];


            if ($gambar = '') {
            } else {
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/bukti';
                $config['allowed_types'] = 'jpg|jpeg|png';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gambar')) {
                    echo "Foto Gagal diupload";
                } else {
                    $gambar = $this->upload->data('file_name');
                }
            }

            $data = [
                'id_pesanan_tiket' => $id_pesanan_tiket,
                'nama_rekening' => htmlspecialchars($this->input->post('nama_rekening', true)),
                'no_rekening' => htmlspecialchars($this->input->post('no_rekening', true)),
                'nama_bank' => htmlspecialchars($this->input->post('nama_bank', true)),
                'tanggal_konfirmasi' => date("Y-m-d"),
                'gambar' => $gambar
            ];

            // var_dump($data);
            // die;

            $this->Model_konfirmasi->simpanKonfirmasiTiket($data);
            $this->Model_pesanan->updateStatusPesananTiket($id_pesanan_tiket);
            $datas = ['pesanan'   => 'Tiket'];

            $this->session->set_userdata($datas);
            redirect('Pesanan');
        }
    }

    public function expired()
    {
        $data['judul'] = 'Pesanan Expired';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('pesanan/expired');
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }

    public function konfirmasiCemilan($id_pesanan_cemilan)
    {
        $sql = $this->db->get_where('pesanan_cemilan', ['id_pesanan_cemilan' => $id_pesanan_cemilan])->row_array();

        if (time() - $sql['tanggal_pesan'] < (60 * 60 * 24)) {

            $this->form_validation->set_rules('nama_rekening', 'Nama', 'required|trim', [
                'required' => 'Nama rekening harus diisi'
            ]);

            $this->form_validation->set_rules('no_rekening', 'No Rekening', 'required|trim', [
                'required' => 'No rekening harus diisi'
            ]);

            $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim', [
                'required' => 'Nama bank belum dipilih'
            ]);

            if ($this->form_validation->run() == false) {
                $data['judul'] = 'Konfirmasi Pesanan cemilan';
                $id_pesanan_cemilann['id'] = $id_pesanan_cemilan;
                // var_dump($id_pesanan_tiket);
                // die;

                $this->load->view('templates/header', $data);
                $this->load->view('templates/navbar');
                $this->load->view('pesanan/konfirmasiCemilan', $id_pesanan_cemilann);
                $this->load->view('templates/foot');
                $this->load->view('templates/footer');
                $this->load->view('pesanan/imgPreview');
            } else {

                $id_pesanan_cemilan = htmlspecialchars($this->input->post('id_pesanan_cemilan', true));
                $gambar = $_FILES['gambar']['name'];


                if ($gambar = '') {
                } else {
                    $config['max_size']     = '2048';
                    $config['upload_path'] = './assets/img/bukti';
                    $config['allowed_types'] = 'jpg|jpeg|png';

                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('gambar')) {
                        echo "Foto Gagal diupload";
                    } else {
                        $gambar = $this->upload->data('file_name');
                    }
                }

                $data = [
                    'id_pesanan_cemilan' => $id_pesanan_cemilan,
                    'nama_rekening' => htmlspecialchars($this->input->post('nama_rekening', true)),
                    'no_rekening' => htmlspecialchars($this->input->post('no_rekening', true)),
                    'nama_bank' => htmlspecialchars($this->input->post('nama_bank', true)),
                    'tanggal_konfirmasi' => date("Y-m-d"),
                    'gambar' => $gambar
                ];

                $this->Model_konfirmasi->simpanKonfirmasiCemilan($data);
                $this->Model_pesanan->updateStatusPesananCemilan($id_pesanan_cemilan);
                $datas = ['pesanan'   => 'Cemilan'];

                $this->session->set_userdata($datas);
                redirect('Pesanan');
            }
        } else {
            $this->db->delete('detail_pesanan_cemilan', ['id_pesanan_cemilan' => $id_pesanan_cemilan]);
            $this->db->delete('pesanan_cemilan', ['id_pesanan_cemilan' => $id_pesanan_cemilan]);

            redirect('Pesanan/expired');
        }
    }

    public function cemilanDiTerima($id_pesanan_cemilann)
    {
        $this->Model_pesanan->updateStatusPesananDiTerima($id_pesanan_cemilann);
        $datas = ['pesanan'   => 'Cemilan'];

        $this->session->set_userdata($datas);
        redirect('Pesanan');
    }
}
