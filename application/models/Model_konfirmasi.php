<?php

class Model_konfirmasi extends CI_Model
{
    public function simpanKonfirmasiTiket($data)
    {
        $this->db->insert('konfirmasi_tiket', $data);
    }

    public function simpanKonfirmasiCemilan($data)
    {
        $this->db->insert('konfirmasi_cemilan', $data);
    }

    public function getAllTiket()
    {
        $this->db->select('*, pesanan_tiket.status as status_pesanan');
        $this->db->from('konfirmasi_tiket');
        $this->db->join('pesanan_tiket', 'pesanan_tiket.id_pesanan_tiket = konfirmasi_tiket.id_pesanan_tiket');
        $this->db->where('pesanan_tiket.status', 'sedang di proses');
        $this->db->or_where('pesanan_tiket.status', 'siap di gunakan');
        $query = $this->db->get();

        return $query;
    }

    public function getAllTiketP()
    {
        $sql = "(SELECT A1.*, (CASE WHEN A1.JML_DT=A1.JML_SELESAI THEN 'Sudah di gunakan' ELSE 'Siap di gunakan' END) AS STATUS_AKHIR FROM (
                    SELECT A.id_pesanan_tiket,B.nama,A.status,
                    (SELECT COUNT(X.id_detail_pesanan_tiket) FROM detail_pesanan_tiket X WHERE X.id_pesanan_tiket=A.id_pesanan_tiket) AS JML_DT,
                    (SELECT COUNT(X.id_detail_pesanan_tiket) FROM detail_pesanan_tiket X WHERE X.id_pesanan_tiket=A.id_pesanan_tiket AND X.status='sudah di gunakan') AS JML_SELESAI
                    FROM pesanan_tiket A
                    INNER JOIN user B ON B.id_user=A.id_user
                    INNER JOIN konfirmasi_tiket C ON C.id_pesanan_tiket=A.id_pesanan_tiket
                    WHERE A.status='siap di gunakan'
                ) A1 ) A2";
        $this->db->from($sql);
        $query = $this->db->get();

        return $query;
    }

    public function updateStatusTiket($id_detail_pesanan_tiket, $nama)
    {
        $this->db->set('status', 'sudah di gunakan');
        $this->db->set('validator', $nama);
        $this->db->where('id_detail_pesanan_tiket', $id_detail_pesanan_tiket);
        $this->db->update('detail_pesanan_tiket');
    }

    public function updateStatusBatalTiket($id_detail_pesanan_tiket)
    {
        $this->db->set('status', 'siap di gunakan');
        $this->db->where('id_detail_pesanan_tiket', $id_detail_pesanan_tiket);
        $this->db->update('detail_pesanan_tiket');
    }

    public function updateStatusPesanan($id_pesanan_tiket)
    {
        $this->db->set('status', 'siap di gunakan');
        $this->db->set('tanggal_approve', date('Y-m-d'));
        $this->db->where('id_pesanan_tiket', $id_pesanan_tiket);
        $this->db->update('pesanan_tiket');

        $this->db->set('status', 'siap di gunakan');
        $this->db->where('id_pesanan_tiket', $id_pesanan_tiket);
        $this->db->update('detail_pesanan_tiket');
    }

    public function batalApproveTiket($id_pesanan_tiket)
    {
        $this->db->set('status', 'sedang di proses');
        $this->db->set('tanggal_approve', null);
        $this->db->where('id_pesanan_tiket', $id_pesanan_tiket);
        $this->db->update('pesanan_tiket');
        $this->db->set('status', 'sedang di proses');
        $this->db->where('id_pesanan_tiket', $id_pesanan_tiket);
        $this->db->update('detail_pesanan_tiket');
    }

    public function getAllCemilan()
    {
        $this->db->select('*');
        $this->db->from('konfirmasi_cemilan');
        $this->db->join('pesanan_cemilan', 'pesanan_cemilan.id_pesanan_cemilan = konfirmasi_cemilan.id_pesanan_cemilan');
        $this->db->where('pesanan_cemilan.status', 'sedang di proses');
        $this->db->or_where('pesanan_cemilan.status', 'sedang di packing');
        $this->db->or_where('pesanan_cemilan.status', 'sedang di kirim');
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

    public function getToko()
    {
        $this->db->from('user');
        $this->db->where('role_id', 4);
        $this->db->or_where('role_id', 5);
        $query = $this->db->get();

        return $query;
    }

    public function updateStatusToko($id_user)
    {
        $this->db->set('role_id', 5);
        $this->db->where('id_user', $id_user);
        $this->db->update('user');
    }

    public function updateStatusToko2($id_user)
    {
        $this->db->set('role_id', 4);
        $this->db->where('id_user', $id_user);
        $this->db->update('user');
    }

    public function getAllCemilanToko()
    {
        $this->db->select('*, user.nama AS nama_user, cemilan.nama AS nama_cemilan');
        $this->db->from('cemilan');
        $this->db->join('toko', 'toko.id_toko = cemilan.id_toko');
        $this->db->join('user', 'user.id_user = toko.id_user');
        $query = $this->db->get();
        return $query;
    }

    public function updateStatusCemilanToko($id_cemilan, $id_toko)
    {
        $this->db->set('status', 'Aktif');
        $this->db->where(['id_cemilan' => $id_cemilan, 'id_toko' => $id_toko]);
        $this->db->update('cemilan');
    }

    public function batalApproveCemilanToko($id_cemilan, $id_toko)
    {
        $this->db->set('status', 'Menunggu persetujuan admin');
        $this->db->where(['id_cemilan' => $id_cemilan, 'id_toko' => $id_toko]);
        $this->db->update('cemilan');
    }
}
