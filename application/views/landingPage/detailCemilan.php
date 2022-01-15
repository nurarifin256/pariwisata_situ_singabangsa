<br>
<div class="container mt-5">

    <h1 class="text-center">Detail Cemilan</h1>
    <div class="card mb-3 mt-3" style="max-width: 800px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="<?= base_url() . 'assets/img/' . $cemilan['foto'] ?>" class="img-thumbnail">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $cemilan['nama_cemilan'] ?> <?= $cemilan['variant'] ?></h5>
                    <?php
                    if ($cemilan['icon'] == "") {
                        $gambar = "default-store.png";
                    } else {
                        $gambar = 'iconToko/' . $cemilan['icon'];
                    } ?>
                    <p>
                        <img src="<?= base_url() . 'assets/img/' . $gambar ?>" class="" style="height: 20px; width:20px" alt="">
                        <?= $cemilan['nama_user'] ?>
                    </p>
                    <p class="card-text"><?= $cemilan['keterangan'] ?></p>
                    <p class="card-text">Rp. <?= number_format($cemilan['harga'], 0, ',', '.') ?></p>
                </div>
                <div class="card-body">
                    <a href="<?= base_url() ?>LandingPage/cemilan" class="btn btn-success">Kembali</a>
                    <a href="<?= base_url() ?>Keranjang/tambahKeKeranjang/<?= $cemilan['id_cemilan'] ?>" class="btn btn-primary ml-2">Tambah Ke Keranjang <i class="fas fa-shopping-cart"></i></a>
                </div>
            </div>
        </div>
    </div>

</div>