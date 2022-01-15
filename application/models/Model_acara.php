<?php

class Model_acara extends CI_Model
{
    public function getAcara()
    {
        return $this->db->get_where('acara', ['status' => 1]);
    }

    public function getAllAcara()
    {
        return $this->db->get('acara');
    }

    public function simpanAcara($data)
    {
        $this->db->insert('acara', $data);
    }

    public function hapusAcara($id_acara)
    {
        $this->db->trans_start();
        $this->db->delete('acara', ['id_acara' => $id_acara]);
        $this->db->trans_complete();
    }

    public function aktifkanAcara($id_acara)
    {
        $this->db->set('status', 1);
        $this->db->where('id_acara', $id_acara);
        $this->db->update('acara');
    }

    public function nonAktifkanAcara($id_acara)
    {
        $this->db->set('status', 0);
        $this->db->where('id_acara', $id_acara);
        $this->db->update('acara');
    }

    public function getAcaraById($id_acara)
    {
        return $this->db->get_where('acara', ['id_acara' => $id_acara]);
    }

    public function updateAcara($id_acara, $data)
    {
        $this->db->set($data);
        $this->db->where('id_acara', $id_acara);
        $this->db->update('acara');
    }
}
