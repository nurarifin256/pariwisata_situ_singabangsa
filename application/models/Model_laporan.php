<?php

class Model_laporan extends CI_Model
{
    public function getLaporan($tgl1, $tgl2)
    {
        return $this->db->query("SELECT SUM(B.jumlah) AS Jumlahtiket, C.tanggal_approve AS tanggalApprove, A.nama AS nama_tiket, A.harga AS harga_tiket, A.id_tiket AS id_tiket, B.id_pesanan_tiket as id_pesanan_tiket 
        FROM tiket A 
        INNER JOIN detail_pesanan_tiket B ON B.id_tiket=A.id_tiket 
        INNER JOIN pesanan_tiket C ON C.id_pesanan_tiket=B.id_pesanan_tiket 
        INNER JOIN konfirmasi_tiket D ON D.id_pesanan_tiket=C.id_pesanan_tiket
        -- WHERE C.tanggal_approve BETWEEN '$tgl1' AND '$tgl2' AND B.status='sudah di gunakan / petugas : puci'
        WHERE C.tanggal_approve BETWEEN '$tgl1' AND '$tgl2'
        GROUP BY A.nama");
    }

    public function getLaporanById($id_tiket)
    {
        return $this->db->query("SELECT E.nama AS nama_pengunjung, B.tanggal_kedatangan AS tanggal_datang, B.jumlah AS jumlah_tiket, C.id_pesanan_tiket AS no_pesanan
        FROM tiket A 
        INNER JOIN detail_pesanan_tiket B ON B.id_tiket=A.id_tiket 
        INNER JOIN pesanan_tiket C ON C.id_pesanan_tiket=B.id_pesanan_tiket 
        INNER JOIN konfirmasi_tiket D ON D.id_pesanan_tiket=C.id_pesanan_tiket
        INNER JOIN user E ON E.id_user=C.id_user
        WHERE A.id_tiket='$id_tiket' AND C.status='siap di gunakan'");
    }

    public function getLaporanCemilan($tgl1, $tgl2, $id_user)
    {
        return $this->db->query("SELECT SUM(B.jumlah) AS jumlah_cemilan, C.nama AS nama_cemilan, C.variant AS variant, C.harga AS harga_cemilan, C.id_cemilan AS id_cemilan FROM
        pesanan_cemilan A 
        INNER JOIN detail_pesanan_cemilan B ON B.id_pesanan_cemilan=A.id_pesanan_cemilan
        INNER JOIN cemilan C ON C.id_cemilan=B.id_cemilan
        INNER JOIN konfirmasi_cemilan D ON D.id_pesanan_cemilan=A.id_pesanan_cemilan
        INNER JOIN toko E ON E.id_toko=C.id_toko
        INNER JOIN user F ON F.id_user=E.id_user
        WHERE A.status='sudah di terima' AND E.id_user=$id_user AND A.tanggal_approve BETWEEN '$tgl1' AND '$tgl2'
        GROUP BY C.nama, C.variant");
    }

    public function getLaporanCemilann($tgl1 = '', $tgl2 = '')
    {
        $where_tgl = ((empty($tgl1)) and (empty($tgl2))) ? "" : " AND A.tanggal_approve BETWEEN '$tgl1' AND '$tgl2'";
        return $this->db->query("SELECT SUM(B.jumlah) AS jumlah_cemilan, C.nama AS nama_cemilan, C.variant AS variant, C.harga AS harga_cemilan, C.id_cemilan AS id_cemilan FROM
        pesanan_cemilan A 
        INNER JOIN detail_pesanan_cemilan B ON B.id_pesanan_cemilan=A.id_pesanan_cemilan
        INNER JOIN cemilan C ON C.id_cemilan=B.id_cemilan
        INNER JOIN konfirmasi_cemilan D ON D.id_pesanan_cemilan=A.id_pesanan_cemilan
        WHERE A.status='sedang di kirim'
        $where_tgl
        GROUP BY C.nama, C.variant");
    }

    public function getLaporanCemilanById($id_cemilan)
    {
        return $this->db->query("SELECT A.id_pesanan_cemilan AS no_pesanan, A.penerima AS penerima, SUM(B.jumlah) AS jumlah_cemilan FROM
        pesanan_cemilan A 
        INNER JOIN detail_pesanan_cemilan B ON B.id_pesanan_cemilan=A.id_pesanan_cemilan
        INNER JOIN cemilan C ON C.id_cemilan=B.id_cemilan
        INNER JOIN konfirmasi_cemilan D ON D.id_pesanan_cemilan=A.id_pesanan_cemilan
        INNER JOIN user E ON E.id_user=A.id_user
        WHERE C.id_cemilan='$id_cemilan' GROUP BY A.id_pesanan_cemilan");
    }
}
