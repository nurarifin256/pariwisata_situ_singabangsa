<?php

class Model_pesan extends CI_Model
{
    public function tambahPesan($data)
    {
        $this->db->insert('pesan', $data);
    }

    public function getAllPesan()
    {
        return $this->db->get('pesan');
    }

    public function hapusPesan($id_pesan)
    {
        $this->db->trans_start();
        $this->db->delete('pesan', ['id_pesan' => $id_pesan]);
        $this->db->trans_complete();
    }
}
