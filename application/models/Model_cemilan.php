<?php

class Model_cemilan extends CI_Model
{
    public function getAllCemilan()
    {
        $this->db->select('*, user.nama AS nama_user, cemilan.nama AS nama_cemilan');
        $this->db->from('cemilan');
        $this->db->join('toko', 'toko.id_toko = cemilan.id_toko');
        $this->db->join('user', 'user.id_user = toko.id_user');
        $this->db->where('cemilan.status', 'Aktif');
        $query = $this->db->get();

        return $query;
    }

    public function simpanCemilan($data)
    {
        $this->db->insert('cemilan', $data);
    }

    public function hapusCemilan($id_cemilan)
    {
        $this->db->trans_start();
        $this->db->delete('cemilan', [
            'id_cemilan' => $id_cemilan,
        ]);
        $this->db->trans_complete();
    }

    public function hapusCemilanByToko($id_cemilan, $id_toko)
    {
        $this->db->trans_start();
        $this->db->delete('cemilan', [
            'id_cemilan' => $id_cemilan,
            'id_toko' => $id_toko
        ]);
        $this->db->trans_complete();
    }

    public function getCemilanById($id_cemilan)
    {
        $this->db->select('*, user.nama AS nama_user, cemilan.nama AS nama_cemilan');
        $this->db->from('cemilan');
        $this->db->join('toko', 'toko.id_toko = cemilan.id_toko');
        $this->db->join('user', 'user.id_user = toko.id_user');
        $this->db->where(['id_cemilan' => $id_cemilan]);
        $query = $this->db->get();

        return $query;
    }

    public function updateCemilan($id_cemilan, $data)
    {
        $this->db->set($data);
        $this->db->where('id_cemilan', $id_cemilan);
        $this->db->update('cemilan');
    }

    public function updateJumlahCemilan($id_user, $id_keranjang_cemilan, $id_cemilan, $jumlah, $total_bayar)
    {
        $this->db->set([
            'jumlah' => $jumlah,
            'total_bayar' => $total_bayar
        ]);
        $this->db->where([
            'id_keranjang_cemilan' => $id_keranjang_cemilan,
            'id_user' => $id_user,
            'id_cemilan' => $id_cemilan
        ]);
        $this->db->update('keranjang_cemilan');
    }

    public function updateStatusKeranjangCemilan($id_keranjang_cemilan, $id_cemilan, $id_user)
    {
        $this->db->set('status', 2);
        $this->db->where([
            'id_keranjang_cemilan' => $id_keranjang_cemilan,
            'id_cemilan' => $id_cemilan,
            'id_user' => $id_user
        ]);
        $this->db->update('keranjang_cemilan');
    }

    function get_cemilan($nama = '')
    {
        $this->db->select('*, user.nama AS nama_user, cemilan.nama AS nama_cemilan');
        $this->db->from('cemilan');
        $this->db->join('toko', 'toko.id_toko = cemilan.id_toko');
        $this->db->join('user', 'user.id_user = toko.id_user');
        $this->db->where("cemilan.status='Aktif'");
        $this->db->where("replace(cemilan.nama,' ','_') LIKE '%$nama%'");
        $query = $this->db->get();

        return $query;
    }

    public function simpanKeKeranjang($data)
    {
        $this->db->insert('keranjang_cemilan', $data);
    }

    public function hapusKeranjang($id_user, $id_keranjang_cemilan, $id_cemilan)
    {
        $this->db->trans_start();
        $this->db->delete('keranjang_cemilan', [
            'id_keranjang_cemilan' => $id_keranjang_cemilan,
            'id_user' => $id_user,
            'id_cemilan' => $id_cemilan
        ]);
        $this->db->trans_complete();
    }

    public function getCemilanByIdUser($id_user)
    {
        $this->db->select('*, user.nama as nama_toko');
        $this->db->from('keranjang_cemilan');
        $this->db->join('cemilan', 'cemilan.id_cemilan = keranjang_cemilan.id_cemilan');
        $this->db->join('toko', 'toko.id_toko = cemilan.id_toko');
        $this->db->join('user', 'user.id_user = toko.id_user');
        $this->db->group_by('toko.id_toko');
        $this->db->where([
            'keranjang_cemilan.id_user' => $id_user,
            'keranjang_cemilan.status' => 1
        ]);
        $query = $this->db->get();

        return $query;
    }

    public function hapusAllKeranjangCemilan($id_user)
    {
        $this->db->delete('keranjang_cemilan', ['id_user' => $id_user]);
    }

    public function getCemilanByIdUserToko($id_toko)
    {
        $this->db->select('*, cemilan.nama AS nama_cemilan');
        $this->db->from('cemilan');
        $this->db->join('toko', 'toko.id_toko = cemilan.id_toko');
        $this->db->where('cemilan.id_toko', $id_toko);
        $query = $this->db->get();

        return $query;
    }

    public function getCemilanByIdUser_IdToko($id_user, $id_toko)
    {
        $this->db->select('*, user.nama as nama_pembeli, cemilan.nama as nama_cemilan');
        $this->db->from('keranjang_cemilan');
        $this->db->join('cemilan', 'cemilan.id_cemilan = keranjang_cemilan.id_cemilan');
        $this->db->join('user', 'user.id_user = keranjang_cemilan.id_user');
        $this->db->join('toko', 'toko.id_toko = cemilan.id_toko');
        $this->db->where([
            'keranjang_cemilan.id_user' => $id_user,
            'keranjang_cemilan.status' => 1,
            'cemilan.id_toko' => $id_toko
        ]);
        $query = $this->db->get();

        return $query;
    }

    public function getCemilanDiDetailKerangjangCemilan($id_user, $id_toko)
    {
        $this->db->select('*');
        $this->db->from('keranjang_cemilan');
        $this->db->join('cemilan', 'cemilan.id_cemilan = keranjang_cemilan.id_cemilan');
        $this->db->join('user', 'user.id_user = keranjang_cemilan.id_user');
        $this->db->join('toko', 'toko.id_toko = cemilan.id_toko');
        $this->db->where([
            'keranjang_cemilan.id_user' => $id_user,
            'cemilan.id_toko' => $id_toko,
            'keranjang_cemilan.status' => 1
        ]);
        $query = $this->db->get();

        return $query;
    }

    // public function hapusPesananCemilanByIdToko($id_user, $id_toko)
    // {
    //     $this->db->delete('keranjang_cemilan', [
    //         'id_user' => $id_user
    //     ]);
    // }
}
