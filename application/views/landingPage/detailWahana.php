<br>
<div class="container mt-5">

    <h1 class="text-center">Detail Wahana</h1>
    <div class="card mb-3 mt-3" style="max-width: 800px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url() . 'assets/img/' . $detail_wahana['foto'] ?>" class="img-thumbnail">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $detail_wahana['nama'] ?></h5>
                    <p class="card-text"><?= $detail_wahana['keterangan'] ?></p>
                    <p class="card-text">Rp. <?= number_format($detail_wahana['harga'], 0, ',', '.') ?></p>
                </div>
                <div class="card-body">
                    <a href="<?= base_url() ?>LandingPage/semuaWahana" class="btn btn-success">Kembali</a>
                    <a href="<?= base_url() ?>Keranjang/beliTiket/<?= $detail_wahana['id_tiket'] ?>" class="btn btn-primary ml-2">Beli Tiket</a>
                </div>
            </div>
        </div>
    </div>

</div>