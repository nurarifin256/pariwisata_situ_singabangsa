<?php

class Model_toko extends CI_Model
{
    public function simpanDataBank($data)
    {
        $this->db->insert('toko', $data);
    }

    public function getTokoById($id_user)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('toko', 'toko.id_user = user.id_user');
        $this->db->where('toko.id_user', $id_user);
        $query = $this->db->get();

        return $query;
    }

    public function getTokoByIdToko($id_toko)
    {
        return $this->db->get_where('toko', ['id_toko' => $id_toko]);
    }

    public function editProfilToko($id_user, $data, $data2)
    {
        $this->db->set($data);
        $this->db->where('id_user', $id_user);
        $this->db->update('toko');

        $this->db->set($data2);
        $this->db->where('id_user', $id_user);
        $this->db->update('user');
    }

    public function hapusCemilan($id_cemilan, $id_toko)
    {
        $this->db->trans_start();
        $this->db->delete('cemilan', [
            'id_cemilan' => $id_cemilan,
            'id_toko' => $id_toko
        ]);
        $this->db->trans_complete();
    }

    public function getCemilanById($id_cemilan, $id_toko)
    {
        return $this->db->get_where('cemilan', ['id_cemilan' => $id_cemilan, 'id_toko' => $id_toko]);
    }

    public function updateCemilan($id_cemilan, $data)
    {
        $this->db->set($data);
        $this->db->where('id_cemilan', $id_cemilan);
        $this->db->update('cemilan');
    }

    public function getPesananByIdUser($id_user)
    {
        $this->db->select('*, konfirmasi_cemilan.no_rekening as no_rek, pesanan_cemilan.status as statusPesanan');
        $this->db->from('konfirmasi_cemilan');
        $this->db->join('pesanan_cemilan', 'pesanan_cemilan.id_pesanan_cemilan = konfirmasi_cemilan.id_pesanan_cemilan');
        $this->db->join('detail_pesanan_cemilan', 'detail_pesanan_cemilan.id_pesanan_cemilan = pesanan_cemilan.id_pesanan_cemilan');
        $this->db->join('cemilan', 'cemilan.id_cemilan = detail_pesanan_cemilan.id_cemilan');
        $this->db->join('toko', 'toko.id_toko = cemilan.id_toko');
        $this->db->join('user', 'user.id_user = toko.id_user');
        $this->db->group_by('pesanan_cemilan.id_pesanan_cemilan');
        $this->db->where([
            'user.id_user' => $id_user,
        ]);
        $query = $this->db->get();

        return $query;
    }

    public function updateStatusPesananCemilan($id_pesanan_cemilan)
    {
        $this->db->set([
            'status' => 'sedang di packing',
            'tanggal_approve' => date('Y-m-d')
        ]);
        $this->db->where('id_pesanan_cemilan', $id_pesanan_cemilan);
        $this->db->update('pesanan_cemilan');
    }

    public function updateStatusBatalPesananCemilan($id_pesanan_cemilan)
    {
        $this->db->set([
            'status' => 'sedang di proses',
            'tanggal_approve' => null,
            'no_resi' => '-'
        ]);
        $this->db->where('id_pesanan_cemilan', $id_pesanan_cemilan);
        $this->db->update('pesanan_cemilan');
    }

    public function updateStatusDenganResi($id_pesanan_cemilan, $no_resi)
    {
        $this->db->set('status', 'sedang di kirim');
        $this->db->set('no_resi', $no_resi);
        $this->db->where('id_pesanan_cemilan', $id_pesanan_cemilan);
        $this->db->update('pesanan_cemilan');
    }
}
