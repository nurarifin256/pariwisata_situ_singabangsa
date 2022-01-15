<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toko2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') != 5) {
            $this->session->set_flashdata('pesan_auth', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Login terlebih dahulu
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');

            redirect('Auth');
        }
    }

    public function BerandaToko()
    {
        $id_user = $this->session->userdata('id_user');
        $data['judul'] = 'Toko';
        $data['toko'] = $this->Model_toko->getTokoById($id_user)->row_array();
        // var_dump($data["toko"]["icon"]);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('toko/BerandaToko', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('toko/imgPreview');
    }

    public function LengkapiProfil()
    {
        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim', [
            'required' => 'Nama bank belum dipilih'
        ]);

        $this->form_validation->set_rules('no_rekening', 'No Rekening', 'required|trim', [
            'required' => 'No rekening harus diisi'
        ]);

        $this->form_validation->set_rules('nama_pemilik_rekening', 'Nama Pemilik Rekening', 'required|trim', [
            'required' => 'Nama Pemilik rekening harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Profil Toko';

            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('toko/lengkapiProfil');
            $this->load->view('templates/foot');
            $this->load->view('templates/footer');
            $this->load->view('toko/imgPreview');
        } else {
            $gambar = $_FILES['gambar']['name'];
            if ($gambar = '') {
            } else {
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/iconToko';
                $config['allowed_types'] = 'jpg|jpeg|png';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gambar')) {
                    echo "Foto Gagal diupload";
                } else {
                    $gambar = $this->upload->data('file_name');
                }
            }
            $data = [
                'id_user' => $this->session->userdata('id_user'),
                'nama_bank' => htmlspecialchars($this->input->post('nama_bank', true)),
                'no_rekening' => htmlspecialchars($this->input->post('no_rekening', true)),
                'nama_pemilik_rekening' => htmlspecialchars($this->input->post('nama_pemilik_rekening', true)),
                'icon' => $gambar
            ];
            $this->Model_toko->simpanDataBank($data);
            $datas = ['toko'   => 'Di lengkapi'];

            $this->session->set_userdata($datas);
            redirect('Toko2/BerandaToko');
        }
    }

    public function EditProfilToko($id_user)
    {
        $data['judul'] = 'Edit Profil Toko';
        $data['toko'] = $this->Model_toko->getTokoById($id_user)->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi'
        ]);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|valid_emails', [
            'required' => 'Email harus diisi',
            'valid_email' => 'Format email salah',
            'valid_emails' => 'Format email salah',
        ]);

        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim', [
            'required' => 'Nama bank belum dipilih'
        ]);

        $this->form_validation->set_rules('no_rekening', 'No Rekening', 'required|trim', [
            'required' => 'No rekening harus diisi'
        ]);

        $this->form_validation->set_rules('nama_pemilik_rekening', 'Nama Pemilik Rekening', 'required|trim', [
            'required' => 'Nama Pemilik rekening harus diisi'
        ]);

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('toko/editProfil', $data);
            $this->load->view('templates/foot');
            $this->load->view('templates/footer');
            $this->load->view('toko/imgPreview');
        } else {
            $gambar_baru = $_FILES['gambar']['name'];
            // var_dump($gambar);
            // die;

            if ($gambar_baru = '') {
            } else {
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/iconToko';
                $config['allowed_types'] = 'jpg|jpeg|png';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gambar')) {
                    echo "Foto Gagal diupload";
                } else {
                    $gambar_baru = $this->upload->data('file_name');
                }
            }

            if ($gambar_baru != null) {
                $gambar = $gambar_baru;
            } else {
                $gambar = $data['toko']['icon'];
            }
            $data = [
                'nama_bank' => htmlspecialchars($this->input->post('nama_bank', true)),
                'no_rekening' => htmlspecialchars($this->input->post('no_rekening', true)),
                'nama_pemilik_rekening' => htmlspecialchars($this->input->post('nama_pemilik_rekening', true)),
                'icon' => $gambar
            ];

            $data2 = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true))
            ];
            $this->Model_toko->editProfilToko($id_user, $data, $data2);
            $datas = ['toko'   => 'Di edit'];

            $this->session->set_userdata($datas);
            redirect('Toko2/BerandaToko');
        }
    }

    public function Produk()
    {
        $id_user = $this->session->userdata('id_user');
        $getIdToko = $this->Model_toko->getTokoById($id_user)->row_array();
        $id_toko = $getIdToko['id_toko'];

        $data['judul'] = 'Produk';
        $data['cemilan'] = $this->Model_cemilan->getCemilanByIdUserToko($id_toko)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('toko/ProdukToko', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('toko/imgPreview');
    }

    public function tambahCemilan()
    {
        $data['judul'] = 'Tambah Cemilan';

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi'
        ]);

        $this->form_validation->set_rules('variant', 'Variant', 'required|trim', [
            'required' => 'Variant harus diisi'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
            'required' => 'Keterangan harus diisi'
        ]);

        $this->form_validation->set_rules('berat', 'Berat', 'required|trim', [
            'required' => 'Berat harus diisi'
        ]);

        $this->form_validation->set_rules('harga', 'Harga', 'required|trim', [
            'required' => 'Harga harus diisi'
        ]);

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('toko/tambahCemilan');
            $this->load->view('templates/foot');
            $this->load->view('templates/footer');
            $this->load->view('toko/imgPreview');
        } else {
            $gambar = $_FILES['gambar']['name'];

            if ($gambar = '') {
            } else {
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img';
                $config['allowed_types'] = 'jpg|jpeg|png';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gambar')) {
                    echo "Foto Gagal diupload";
                } else {
                    $gambar = $this->upload->data('file_name');
                }
            }

            $id_user = $this->session->userdata('id_user');
            $getIdToko = $this->Model_toko->getTokoById($id_user)->row_array();
            $id_toko = $getIdToko['id_toko'];
            $data = [
                'id_toko' => $id_toko,
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'variant' => htmlspecialchars($this->input->post('variant', true)),
                'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
                'berat' => htmlspecialchars($this->input->post('berat', true)),
                'harga' => htmlspecialchars($this->input->post('harga', true)),
                'foto' => $gambar,
                'status' => "Menunggu persetujuan admin"
            ];

            $this->Model_cemilan->simpanCemilan($data);

            $datas = ['cemilan'   => 'Di tambahkan'];

            $this->session->set_userdata($datas);
            redirect('Toko2/produk');
        }
    }

    public function hapusCemilanByIdToko()
    {
        $id_cemilan = $this->input->post('id_cemilan');
        $id_user = $this->session->userdata('id_user');
        $getIdToko = $this->Model_toko->getTokoById($id_user)->row_array();
        $id_toko = $getIdToko['id_toko'];

        $this->Model_toko->hapusCemilan($id_cemilan, $id_toko);
        $pesan["pesan"] = ($this->db->trans_status()) ? "ok" : "gagal";
        echo json_encode($pesan);
    }

    public function editCemilan($id_cemilan, $id_toko)
    {
        $data['judul'] = 'Edit Cemilan';
        $data['cemilan'] = $this->Model_toko->getCemilanById($id_cemilan, $id_toko)->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi'
        ]);

        $this->form_validation->set_rules('variant', 'Variant', 'required|trim', [
            'required' => 'Variant harus diisi'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
            'required' => 'Keterangan harus diisi'
        ]);

        $this->form_validation->set_rules('berat', 'Berat', 'required|trim', [
            'required' => 'Berat harus diisi'
        ]);

        $this->form_validation->set_rules('harga', 'Harga', 'required|trim', [
            'required' => 'Harga harus diisi'
        ]);

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('toko/editCemilan', $data);
            $this->load->view('templates/foot');
            $this->load->view('templates/footer');
            $this->load->view('toko/imgPreview');
        } else {
            $gambar_baru = $_FILES['gambar']['name'];

            if ($gambar_baru = '') {
            } else {
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img';
                $config['allowed_types'] = 'jpg|jpeg|png';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gambar')) {
                    echo "Foto Gagal diupload";
                } else {
                    $gambar_baru = $this->upload->data('file_name');
                }
            }

            if ($gambar_baru != null) {
                $gambar = $gambar_baru;
            } else {
                $gambar = $data['cemilan']['foto'];
            }
            $harga = htmlspecialchars($this->input->post('harga', true));
            $harga_set = preg_replace("/[^0-9]/", "", $harga);
            $data = [
                'id_toko' => $id_toko,
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'variant' => htmlspecialchars($this->input->post('variant', true)),
                'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
                'berat' => htmlspecialchars($this->input->post('berat', true)),
                'harga' => $harga_set,
                'foto' => $gambar,
                'status' => "Menunggu persetujuan admin"
            ];

            $this->Model_cemilan->updateCemilan($id_cemilan, $data);

            $datas = ['cemilan'   => 'Di update'];

            $this->session->set_userdata($datas);
            redirect('Toko2/produk');
        }
    }

    public function Pesanan()
    {
        $data['judul'] = 'Pesanan';
        $id_user = $this->session->userdata('id_user');
        $data['konfirmasiC'] = $this->Model_toko->getPesananByIdUser($id_user)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('toko/Pesanan');
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('toko/imgPreview');
    }

    public function detailPesananCemilan($id_pesanan_cemilan)
    {
        $data['judul'] = 'Detail Pesanan Cemilan';
        $data['cemilan'] = $this->Model_pesanan->DetailPesananCemilan($id_pesanan_cemilan)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('toko/detailKonfirmasiCemilan', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }


    public function approveCemilan($id_pesanan_cemilan)
    {
        $this->Model_toko->updateStatusPesananCemilan($id_pesanan_cemilan);

        $data = ['pesan_cemilan'   => 'Di approve'];

        $this->session->set_userdata($data);
        redirect('Toko2/pesanan');
    }

    public function batalApproveCemilan($id_pesanan_cemilan)
    {
        $this->Model_toko->updateStatusBatalPesananCemilan($id_pesanan_cemilan);

        $data = ['pesan_cemilan'   => 'Di unapprove'];

        $this->session->set_userdata($data);
        redirect('Toko2/pesanan');
    }

    public function inputResi($id_pesanan_cemilan)
    {
        $this->form_validation->set_rules('no_resi', 'No Resi', 'required|trim', [
            'required' => 'Nomor resi harus diisi'
        ]);

        if ($this->form_validation->run() == false) {

            $data['judul'] = 'Input No resi';
            $data['id_pesanan_cemilan'] = $id_pesanan_cemilan;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('toko/inputResi', $data);
            $this->load->view('templates/foot');
            $this->load->view('templates/footer');
        } else {

            $no_resi = htmlspecialchars($this->input->post('no_resi', true));
            $id_pesanan_cemilan = htmlspecialchars($this->input->post('id_pesanan_cemilan', true));
            $this->Model_toko->updateStatusDenganResi($id_pesanan_cemilan, $no_resi);

            $data = ['no_resi'   => 'Di input'];

            $this->session->set_userdata($data);
            redirect('Toko2/pesanan');
        }
    }

    public function editResi($id_pesanan_cemilan)
    {
        $this->form_validation->set_rules('no_resi', 'No Resi', 'required|trim', [
            'required' => 'Nomor resi harus diisi'
        ]);

        if ($this->form_validation->run() == false) {

            $data['judul'] = 'Edit No resi';
            $data['cemilan'] = $this->Model_pesanan->getPesananCemilanById($id_pesanan_cemilan)->row_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('toko/editResi', $data);
            $this->load->view('templates/foot');
            $this->load->view('templates/footer');
        } else {

            $no_resi = htmlspecialchars($this->input->post('no_resi', true));
            $id_pesanan_cemilan = htmlspecialchars($this->input->post('id_pesanan_cemilan', true));
            $this->Model_toko->updateStatusDenganResi($id_pesanan_cemilan, $no_resi);

            $data = ['no_resi'   => 'Di update'];

            $this->session->set_userdata($data);
            redirect('Toko2/pesanan');
        }
    }

    public function Laporan()
    {
        $data['judul'] = 'Laporan Cemilan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('toko/cemilan');
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
    }

    public function laporanCemilan()
    {
        $tgl1 = $this->input->get('tanggal1');
        $tgl2 = $this->input->get('tanggal2');
        $id_user = $this->session->userdata('id_user');

        $data['judul'] = 'Laporan Cemilan';
        $data['laporan'] = $this->Model_laporan->getLaporanCemilan($tgl1, $tgl2, $id_user)->result_array();
        $data["tgl1"] = $tgl1;
        $data["tgl2"] = $tgl2;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('toko/laporanCemilan', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('laporan/dataTable');
    }

    public function detailLaporanCemilan($id_cemilan)
    {
        $data['judul'] = 'Laporan Cemilan';
        $data['laporan'] = $this->Model_laporan->getLaporanCemilanById($id_cemilan)->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('toko/detailLaporanCemilan', $data);
        $this->load->view('templates/foot');
        $this->load->view('templates/footer');
        $this->load->view('laporan/dataTable');
    }
}
