<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email harus diisi',
            'valid_email' => 'Format email salah'
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password harus diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Log In';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/index');
            $this->load->view('templates/footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email      = htmlspecialchars($this->input->post('email', true));
        $password   = htmlspecialchars($this->input->post('password', true));
        $user       = $this->Model_auth->getUserByEmail($email);

        if ($user) {

            if ($user['is_aktif'] == 1) {

                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id_user'   => $user['id_user'],
                        'email'     => $user['email'],
                        'role_id'   => $user['role_id'],
                        'nama'      => $user['nama']
                    ];

                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('Admin');
                    } else if ($user['role_id'] == 2) {
                        redirect('LandingPage/index');
                    } else if ($user['role_id'] == 4) {
                        redirect('Toko/BelumVerifikasi');
                    } else if ($user['role_id'] == 5) {
                        redirect('Toko2/BerandaToko');
                    } else {
                        redirect('Petugas');
                    }
                } else {
                    $this->session->set_flashdata('pesan_auth', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Password salah
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('pesan_auth', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Email belum diaktivasi. Silahkan cek email anda untuk aktivasi
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('pesan_auth', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Email belum terdaftar. Silahkan klik buat akun
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('Auth');
        }
    }

    public function registrasi()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi'
        ]);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email harus diisi',
            'valid_email' => 'Format email salah',
            'is_unique' => 'Email sudah terdaftar'
        ]);

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Password harus diisi',
            'min_length' => 'Password minimal 6 karakter',
            'matches' => 'Password tidak sama'
        ]);

        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'required' => 'Password harus diisi',
            'matches' => 'Password tidak sama'
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Daftar Akun';

            $this->load->view('templates/header', $data);
            $this->load->view('auth/registrasi');
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email', true);
            $role_id = 2;

            if ($this->session->userdata('role_id') == 1) {
                $role_id = 3;
            }

            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => $role_id,
                'is_aktif' => 0,
                'tanggal_dibuat' => time()
            ];

            $token = base64_encode(random_bytes(32));

            $user_token = [
                'email' => $email,
                'token' => $token,
                'tanggal_dibuat' => time()
            ];

            $this->Model_auth->tambahUser($data);
            $this->Model_auth->tambahUserToken($user_token);

            $this->_sendEmail($token);

            $this->session->set_flashdata('pesan_auth', '<div class="alert alert-success alert-dismissible fade show" role="alert">Akun berhasil dibuat. Mohon aktivasi, silahkan cek email anda
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');

            redirect('Auth');
        }
    }

    public function registrasiToko()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => 'Nama harus diisi'
        ]);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|valid_emails|is_unique[user.email]', [
            'required' => 'Email harus diisi',
            'valid_email' => 'Format email salah',
            'valid_emails' => 'Format email salah',
            'is_unique' => 'Email sudah terdaftar'
        ]);

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'required' => 'Password harus diisi',
            'min_length' => 'Password minimal 6 karakter',
            'matches' => 'Password tidak sama'
        ]);

        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
            'required' => 'Password harus diisi',
            'matches' => 'Password tidak sama'
        ]);

        if ($this->form_validation->run() == false) {
            $data['judul'] = 'Daftar Akun';

            $this->load->view('templates/header', $data);
            $this->load->view('auth/registrasiToko');
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email', true);


            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 4,
                'is_aktif' => 0,
                'tanggal_dibuat' => time()
            ];

            // siapkan token
            $token = base64_encode(random_bytes(32));

            $user_token = [
                'email' => $email,
                'token' => $token,
                'tanggal_dibuat' => time()
            ];

            $this->Model_auth->tambahUser($data);
            $this->Model_auth->tambahUserToken($user_token);

            $this->_sendEmail($token);

            $this->session->set_flashdata('pesan_auth', '<div class="alert alert-success alert-dismissible fade show" role="alert">Akun berhasil dibuat. Mohon aktivasi, silahkan cek email anda
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');

            redirect('Auth');
        }
    }

    private function _sendEmail($token)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'situsingabangsa@gmail.com',
            'smtp_pass' => 'situSinga56',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('situsingabangsa@gmail.com', 'Situ Singabangsa');
        $this->email->to($this->input->post('email'));

        $this->email->subject('Aktivasi Akun');
        $this->email->message('Klik link untuk aktivasi akun anda : <a href="' . base_url() . 'Auth/aktivasi?email=' . $this->input->post('email') . '&token='  . urlencode($token) . '">Aktivasi</a>');

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function aktivasi()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->Model_auth->getUserByEmail($email);

        if ($user) {
            $user_token = $this->Model_auth->getUserToken($token)->row_array();

            if ($user_token) {

                if (time() - $user_token['tanggal_dibuat'] < (60 * 60 * 24)) {
                    $this->Model_auth->updateAktif($email);

                    $this->Model_auth->hapusToken($email);

                    $this->session->set_flashdata('pesan_auth', '<div class="alert alert-success alert-dismissible fade show" role="alert">Akun ' . $email . ' telah diaktivasi. Silahkan login
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');

                    redirect('Auth');
                } else {
                    $this->Model_auth->hapusUser($email);

                    $this->Model_auth->hapusToken($email);

                    $this->session->set_flashdata('pesan_auth', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Aktivasi gagal, Token expired
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');

                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('pesan_auth', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Aktivasi gagal, token salah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>');

                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('pesan_auth', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Aktivasi gagal, email salah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');

            redirect('Auth');
        }
    }

    public function hapusUserPegawai()
    {
        $id_user = $this->input->post('id_user');

        $this->Model_auth->hapusUserPegawai($id_user);
        $pesan["pesan"] = ($this->db->trans_status()) ? "ok" : "gagal";
        echo json_encode($pesan);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('LandingPage/index');
    }
}
