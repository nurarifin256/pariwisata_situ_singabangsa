<?php

class Model_tiket extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('tiket');
    }

    public function getWahanaById($id_tiket)
    {
        return $this->db->get_where('tiket', ['id_tiket' => $id_tiket]);
    }

    public function getWahanaByStatus()
    {
        return $this->db->get_where('tiket', ['status' => 'aktif']);
    }

    public function simpanTiket($data)
    {
        $this->db->insert('tiket', $data);
    }

    public function aktifkanWahana($id_tiket)
    {
        $this->db->set('status', 'aktif');
        $this->db->where('id_tiket', $id_tiket);
        $this->db->update('tiket');
    }

    public function nonAktifkanWahana($id_tiket)
    {
        $this->db->set('status', 'nonaktif');
        $this->db->where('id_tiket', $id_tiket);
        $this->db->update('tiket');
    }

    public function simpanKeKeranjang($data)
    {
        $this->db->insert('keranjang_tiket', $data);
    }

    public function hapusWahana($id_tiket)
    {
        $this->db->trans_start();
        $this->db->delete('tiket', [
            'id_tiket' => $id_tiket
        ]);
        $this->db->trans_complete();
    }

    public function updateTiket($id_tiket, $data)
    {
        $this->db->set($data);
        $this->db->where('id_tiket', $id_tiket);
        $this->db->update('tiket');
    }

    public function hapusKeranjang($id_user, $id_keranjang_tiket, $id_tiket)
    {
        $this->db->trans_start();
        $this->db->delete('keranjang_tiket', [
            'id_keranjang_tiket' => $id_keranjang_tiket,
            'id_user' => $id_user,
            'id_tiket' => $id_tiket
        ]);
        $this->db->trans_complete();
    }

    public function updateJumlahTiket($id_user, $id_keranjang_tiket, $id_tiket, $jumlah, $total_bayar)
    {
        $this->db->set([
            'jumlah' => $jumlah,
            'total_bayar' => $total_bayar
        ]);
        $this->db->where([
            'id_keranjang_tiket' => $id_keranjang_tiket,
            'id_user' => $id_user,
            'id_tiket' => $id_tiket
        ]);
        $this->db->update('keranjang_tiket');
    }

    public function updateTanggal($id_user, $id_keranjang_tiket, $id_tiket, $tanggal)
    {
        $this->db->set([
            'tanggal' => $tanggal,
        ]);
        $this->db->where([
            'id_keranjang_tiket' => $id_keranjang_tiket,
            'id_user' => $id_user,
            'id_tiket' => $id_tiket
        ]);
        $this->db->update('keranjang_tiket');
    }

    public function updateJam($id_user, $id_keranjang_tiket, $id_tiket, $jam)
    {
        $this->db->set([
            'jam' => $jam,
        ]);
        $this->db->where([
            'id_keranjang_tiket' => $id_keranjang_tiket,
            'id_user' => $id_user,
            'id_tiket' => $id_tiket
        ]);
        $this->db->update('keranjang_tiket');
    }

    public function hapusAllKeranjangTiket($id_user)
    {
        $this->db->delete('keranjang_tiket', ['id_user' => $id_user]);
    }

    public function getTiketByIdUser($id_user)
    {
        $this->db->select('*, user.nama AS nama_user, tiket.nama AS nama_tiket');
        $this->db->from('keranjang_tiket');
        $this->db->join('user', 'user.id_user = keranjang_tiket.id_user');
        $this->db->join('tiket', 'tiket.id_tiket = keranjang_tiket.id_tiket');
        $this->db->where('keranjang_tiket.id_user', $id_user);
        $query = $this->db->get();

        return $query;
    }
}
