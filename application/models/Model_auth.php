<?php

class Model_auth extends CI_Model
{

    public function tambahUser($data)
    {
        $this->db->insert('user', $data);
    }

    public function tambahUserToken($user_token)
    {
        $this->db->insert('user_token', $user_token);
    }

    public function getUserByEmail($email)
    {
        return $this->db->get_where('user', ['email' => $email])->row_array();
    }

    public function getUserToken($token)
    {
        return $this->db->get_where('user_token', ['token' => $token]);
    }

    public function updateAktif($email)
    {
        $this->db->set('is_aktif', 1);
        $this->db->where('email', $email);
        $this->db->update('user');
    }

    public function hapusToken($email)
    {
        $this->db->delete('user_token', ['email' => $email]);
    }

    public function hapusUser($email)
    {
        $this->db->trans_start();
        $this->db->delete('user', ['email' => $email]);
        $this->db->trans_complete();
    }

    public function hapusUserPegawai($id_user)
    {
        $this->db->delete('user', ['id_user' => $id_user]);
    }

    public function getUserPegawai()
    {
        return $this->db->get_where('user', ['role_id' => 3]);
    }
}
