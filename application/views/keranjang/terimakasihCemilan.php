<br>
<div class="container mt-5">
    <div class="text-center">
        <h1>Terimakasih Telah Membeli <?= $jenis ?></h1>
        <img src="<?= base_url() ?>assets/img/sukses.png" style="max-width: 500px" width="300px">
        <p>Selanjutnya silahkan lakukan pembayaran dengan transfer ke rekening <?= $toko['no_rekening'] ?>/bca atas nama <?= $toko['nama_pemilik_rekening'] ?>, hati- hati penipuan</p>
        <p>Simpan bukti pembayaran, lalu lakukan konfirmasi pembayaran pada menu<a href="<?= base_url() ?>Pesanan" class="btn btn-outline-primary ml-2">Pesanan Saya</a></p>
    </div>
</div>