<?php

class Model_pesanan extends CI_Model
{
    public function simpanPesananTiket($data)
    {
        $this->db->insert('pesanan_tiket', $data);
    }

    public function simpanDetailPesananTiket($data)
    {
        $this->db->insert('detail_pesanan_tiket', $data);
    }

    public function simpanPesananCemilan($data)
    {
        $this->db->insert('pesanan_cemilan', $data);
    }

    public function simpanDetailPesanancemilan($data)
    {
        $this->db->insert('detail_pesanan_cemilan', $data);
    }

    public function getPesananTiket($id_user)
    {
        $sql = "(SELECT A1.*, (CASE WHEN A1.JML_DT=A1.JML_SELESAI THEN 'Sudah di gunakan' ELSE A1.status END) AS STATUS_AKHIR FROM (    
    SELECT A.id_pesanan_tiket,B.nama,A.status,A.jumlah_bayar,
    (SELECT COUNT(X.id_detail_pesanan_tiket) FROM detail_pesanan_tiket X WHERE X.id_pesanan_tiket=A.id_pesanan_tiket) AS JML_DT,
    (SELECT COUNT(X.id_detail_pesanan_tiket) FROM detail_pesanan_tiket X WHERE X.id_pesanan_tiket=A.id_pesanan_tiket AND 
     X.status='sudah di gunakan') AS JML_SELESAI
FROM pesanan_tiket A
INNER JOIN user B ON B.id_user=A.id_user
WHERE A.id_user='" . $id_user . "'
) A1 
        ) A2";
        $this->db->from($sql);
        $query = $this->db->get();

        return $query;
    }

    public function getPesananCemilan($id_user)
    {
        $this->db->select('*, user.nama as nama_user');
        $this->db->from('pesanan_cemilan');
        $this->db->join('detail_pesanan_cemilan', 'detail_pesanan_cemilan.id_pesanan_cemilan = pesanan_cemilan.id_pesanan_cemilan');
        $this->db->join('user', 'user.id_user = pesanan_cemilan.id_user');
        $this->db->where('pesanan_cemilan.id_user', $id_user);
        $this->db->group_by('pesanan_cemilan.id_pesanan_cemilan');
        $query = $this->db->get();

        return $query;
    }

    public function DetailPesananTiket($id_pesanan_tiket)
    {
        $this->db->select('*, detail_pesanan_tiket.status as status_detail_pesanan_tiket, user.nama as nama_pembeli, tiket.nama as nama_tiket');
        $this->db->from('pesanan_tiket');
        $this->db->join('detail_pesanan_tiket', 'detail_pesanan_tiket.id_pesanan_tiket = pesanan_tiket.id_pesanan_tiket');
        $this->db->join('tiket', 'tiket.id_tiket = detail_pesanan_tiket.id_tiket');
        $this->db->join('user', 'user.id_user = pesanan_tiket.id_user');
        $this->db->where('pesanan_tiket.id_pesanan_tiket', $id_pesanan_tiket);
        $query = $this->db->get();

        return $query;
    }

    public function DetailPesananCemilan($id_pesanan_cemilan)
    {
        $this->db->select('*');
        $this->db->from('pesanan_cemilan');
        $this->db->join('detail_pesanan_cemilan', 'detail_pesanan_cemilan.id_pesanan_cemilan = pesanan_cemilan.id_pesanan_cemilan');
        $this->db->join('cemilan', 'cemilan.id_cemilan = detail_pesanan_cemilan.id_cemilan');
        $this->db->where('pesanan_cemilan.id_pesanan_cemilan', $id_pesanan_cemilan);
        $query = $this->db->get();

        return $query;
    }

    public function updateStatusPesananTiket($id_pesanan_tiket)
    {
        $this->db->set('status', 'sedang di proses');
        $this->db->where('id_pesanan_tiket', $id_pesanan_tiket);
        $this->db->update('pesanan_tiket');
    }

    public function updateStatusPesananCemilan($id_pesanan_cemilan)
    {
        $this->db->set('status', 'sedang di proses');
        $this->db->where('id_pesanan_cemilan', $id_pesanan_cemilan);
        $this->db->update('pesanan_cemilan');
    }

    public function updateStatusPesananDiTerima($id_pesanan_cemilan)
    {
        $this->db->set('status', 'sudah di terima');
        $this->db->where('id_pesanan_cemilan', $id_pesanan_cemilan);
        $this->db->update('pesanan_cemilan');
    }

    public function getPesananCemilanById($id_pesanan_cemilan)
    {
        return $this->db->get_where('pesanan_cemilan', ['id_pesanan_cemilan' => $id_pesanan_cemilan]);
    }

    public function updateTanggal($id_detail_pesanan_tiket, $id_tiket, $tanggal)
    {
        $this->db->set([
            'tanggal_kedatangan' => $tanggal,
        ]);
        $this->db->where([
            'id_detail_pesanan_tiket' => $id_detail_pesanan_tiket,
            'id_tiket' => $id_tiket
        ]);
        $this->db->update('detail_pesanan_tiket');
    }

    public function updateJam($id_detail_pesanan_tiket, $id_tiket, $jam)
    {
        $this->db->set([
            'jam' => $jam,
        ]);
        $this->db->where([
            'id_detail_pesanan_tiket' => $id_detail_pesanan_tiket,
            'id_tiket' => $id_tiket
        ]);
        $this->db->update('detail_pesanan_tiket');
    }
}
